<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;
use Inertia\Response;
use Psr\SimpleCache\InvalidArgumentException;
use UnrealIRCd\Ban;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class BanController extends Controller
{
    private string $url;

    private string $credentials;

    private function setup()
    {
        $user = auth()->user();

        $this->credentials = sprintf("%s:%s",
            $user->username,
            Crypt::decryptString(session('user_password'))
        );

        $this->url = sprintf('%s://%s@%s:%s/api',
            in_array(config('unrealircd.rpc.method'), ['websockets', 'wss', 'wockets', 'websocks']) ? 'wss' : 'https',
            $this->credentials,
            config('unrealircd.server.host'),
            config('unrealircd.server.port')
        );
    }

    /**
     * @return Response|JsonResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function index(): Response|JsonResponse
    {
        $this->setup();

        if (!cache()->has('irc_lines')) {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => config('unrealircd.tls_verify')]);

            cache()->add('irc_lines', json_encode([
                'bans' => $bans->get()->list ?? []
            ]), Carbon::now()->addSeconds(config('app.debug') ? 15 : 120));
        }

        $stats = json_decode(cache('irc_lines'));

        return Inertia::render('Bans', [
            'base_bans' => $stats->bans,
        ]);
    }

    public function store(Request $request)
    {
        $this->setup();

        try {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => config('unrealircd.tls_verify')]);

            if ($bans->add($request->get('name'), [
                'type' => $request->get('type_string'),
                'reason' => $request->get('reason'),
                'length' => Carbon::createFromFormat('Y-m-d H:i:s', $request->get('date') .' '. $request->get('time'))->diffInSeconds()
            ])) {
                cache()->forget('irc_lines');
                return redirect()->route('bans', [], HttpResponse::HTTP_SEE_OTHER);
            }
        } catch (Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => $e->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request)
    {
        $this->setup();

        try {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => config('unrealircd.tls_verify')]);

            if ($bans->delete($request->get('name'), ['type' => $request->get('type')])) {
                $bans->add($request->get('name'), [
                    'type' => $request->get('type'),
                    'reason' => $request->get('reason'),
                    'length' => Carbon::createFromFormat('Y-m-d H:i:s', $request->get('date') .' '. $request->get('time'))->diffInSeconds()
                ]);
                cache()->forget('irc_lines');
                return response()->json([
                    'type' => 'success',
                    'message' => 'Entry updated.'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => $e->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Request $request)
    {
        $this->setup();

        try {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => config('unrealircd.tls_verify')]);

            if ($bans->delete($request->get('name'), ['type' => $request->get('type')])) {
                cache()->forget('irc_lines');
                return response()->json([
                    'type' => 'success',
                    'message' => 'Entry deleted.'
                ]);
            }

            throw new Exception(__('Unable to remove :ban', $request->get('type')));
        } catch (Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => $e->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
