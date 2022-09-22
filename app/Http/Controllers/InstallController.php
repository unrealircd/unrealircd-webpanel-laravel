<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class InstallController extends Controller
{
    public function __invoke(): Response
    {
        $original_parse = parse_url(config('app.url'), PHP_URL_HOST);

        $get = stream_context_create([
            "ssl" => [
                "capture_peer_cert" => true,
                'verify_peer' => config('unrealircd.tls_verify'),
                'capture_peer_cert_chain' => true,
            ]
        ]);

        $read = stream_socket_client("ssl://".$original_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);

        $cert = stream_context_get_params($read);

        $cert_info = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

        foreach ($cert["options"]["ssl"]["peer_certificate_chain"] as $chain_cert) {
            $chain_parsed = openssl_x509_parse($chain_cert);
            $chain_public_key = openssl_get_publickey($chain_cert);
            $r = openssl_x509_verify($cert['options']['ssl']['peer_certificate'], $chain_public_key);

            if ($r === 1) {
                $valid_cert = $chain_parsed['subject']['CN'];
                break;
            } else {
                $valid_cert = false;
            }
        }

        $checks = [
            'php_version' => PHP_VERSION,
            'min_required' => '8.0.0',
            'is_valid_version' => version_compare(PHP_VERSION, '8.0.0'),

            'has_sqlite' => extension_loaded('sqlite3'),
            'sqlite3_version' => \SQLite3::version(),

            'has_ssl' => $_SERVER['HTTPS'],
            'ssl' => [
                'validity' => $valid_cert,
                'issuer' => $cert_info['issuer']["O"],
                'cert_expiry' => Carbon::createFromTimestamp($cert_info['validTo_time_t'])->format("D, jS M Y"),
            ]
        ];

        return Inertia::render('Install', compact('checks'));
    }
}
