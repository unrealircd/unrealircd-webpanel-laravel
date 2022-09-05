<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Crypt;
use Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use UnrealIRCd\Connection;

class LoginController
{
    public function show(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function login(LoginRequest $request)
    {
        $url = sprintf('%s://%s:%s@%s:%s/api',
            in_array(config('unrealircd.rpc.method'), ['websockets', 'wss', 'wockets', 'websocks']) ? 'wss' : 'https',
            $request->get('username'),
            $request->get('password'),
            config('unrealircd.server.host'),
            config('unrealircd.server.port')
        );

        $credentials = sprintf("%s:%s",
            $request->get('username'),
            $request->get('password')
        );

        $query = new Connection($url, $credentials, ["tls_verify" => config('unrealircd.tls_verify')]);

        $response = $query->query('user.list');

        if(!is_bool($response)) {
            $user = User::whereUsername($request->get('username'));
            if($user->count() === 0) {
                $user = User::create([
                    'username' => $request->get('username'),
                    'password' => Hash::make($request->get('password'))]
                );
            } else {
                $user = $user->first();
            }

            session()->put('user_password', Crypt::encryptString($request->get('password')));

            auth()->login($user);
            return redirect()->route('dashboard');
        }
    }

    public function signout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return true;
    }
}
