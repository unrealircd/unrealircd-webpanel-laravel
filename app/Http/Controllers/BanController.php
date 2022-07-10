<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Psr\SimpleCache\InvalidArgumentException;
use Redirect;
use UnrealIRCd\Ban;
use UnrealIRCd\Channel;
use UnrealIRCd\User;
use \Symfony\Component\HttpFoundation\Response as HttpResponse;

class BanController extends Controller
{
    private string $url;

    private string $credentials;

    public function __construct()
    {
        $this->url = sprintf('%s://%s:%s@%s:%s/api',
            in_array(config('unrealircd.rpc.method'), ['websockets', 'wss', 'wockets', 'websocks']) ? 'wss' : 'https',
            config('unrealircd.rpc.user.username'),
            config('unrealircd.rpc.user.password'),
            config('unrealircd.server.host'),
            config('unrealircd.server.port')
        );

        $this->credentials = sprintf("%s:%s",
            config('unrealircd.rpc.user.username'),
            config('unrealircd.rpc.user.password')
        );
    }

    /**
     * @return Response|JsonResponse
     * @throws InvalidArgumentException
     */
    public function index(): Response|JsonResponse
    {
        if (!cache()->has('irc_lines')) {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => false]);

            cache()->add('irc_lines', json_encode([
                'bans' => $bans->get()->list ?? []
            ]), Carbon::now()->addSeconds(config('app.debug') ? 15 : 120));
        }

        $stats = json_decode(cache('irc_lines'));

        return Inertia::render('Bans', [
            'base_bans' => $stats->bans,
        ]);
    }

    public function create(Request $request)
    {
        try {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => false]);

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

    public function store(Request $request)
    {
        try {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => false]);

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
        try {
            $bans = new Ban($this->url, $this->credentials, ["tls_verify" => false]);

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
