<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Response;
use UnrealIRCd\Ban;
use UnrealIRCd\Channel;
use UnrealIRCd\User;

class TestController extends Controller
{
    /**
     * Dump all current methods.
     *
     * @note Disabled when not in debug mode.
     *
     * @throws Exception
     */
    #[NoReturn]
    public function __invoke()
    {
        if (config('app.debug')) {
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

            return dd($users->get(),
                $users->show(['nick' => $users->get()->list[0]->name]),
                $channels->get(),
                // $channels->show(['name' => $channels->get()->list[0]->name,
                $bans->get()
            );
        }

        return app()->abort(Response::HTTP_NOT_FOUND);
    }
}
