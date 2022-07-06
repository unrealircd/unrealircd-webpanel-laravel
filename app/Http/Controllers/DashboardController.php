<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use UnrealIRCd\Ban;
use UnrealIRCd\Channel;
use UnrealIRCd\User;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        if(!cache()->has('irc_stats')) {
            $url = sprintf('%s://%s:%s@%s:%s/api',
                in_array(config('unrealircd.rpc.method'), ['websockets', 'wss', 'wockets', 'websocks']) ? 'wss' : 'https',
                config('unrealircd.rpc.user.username'),
                config('unrealircd.rpc.user.password'),
                config('unrealircd.server.host'),
                config('unrealircd.server.port')
            );

            $credentials = sprintf("%s:%s",
                config('unrealircd.rpc.user.username'),
                config('unrealircd.rpc.user.password')
            );

            $users = new User($url, $credentials, ["tls_verify" => false]);
            $channels = new Channel($url, $credentials, ["tls_verify" => false]);
            $bans = new Ban($url, $credentials, ["tls_verify" => false]);

            cache()->add('irc_stats', json_encode([
                'users' => $users->get()->list ?? [],
                'channels' => $channels->get()->list ?? [],
                'bans' => $bans->get()->list ?? []
            ]), Carbon::now()->addSeconds(config('app.debug') ? 15 : 120));
        }

        $stats = json_decode(cache('irc_stats'));

        return Inertia::render('Dashboard', [
            'data' => [
                'users' => $stats->users,
                'channels' => $stats->channels,
                'bans' => $stats->bans,
            ]
        ]);
    }
}
