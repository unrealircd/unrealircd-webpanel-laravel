<?php

return [
    /*
    | The host name and port that UnrealIRCds RPC server is listening on.
    */

    'server' => [

        /*
        | The socket is only available on the machine UnrealIRCd is running on.
        |
        | See also: @todo link to reverse proxy???
        */

        'socket' => env('UNREAL_RPC_SERVER_SOCKET', 'unix:///home/xyz/unrealircd/data/rpc.sock'),

        'host' => env('UNREAL_RPC_SERVER_ADDRESS', '192.168.0.3'),
        'port' => env('UNREAL_RPC_SERVER_PORT', 6969),
    ],

    'rpc' => [

        /*
        | The method that we will use to connect to the RPC service.
        |
        | Supported drivers: "http", "wockets"
        */

        'method' => env('UNREAL_RPC_METHOD', 'websockets'),

        /*
        | The username and password defined in "rpc.modules.default.conf".
        */

        'user' => [
            'username' => env('UNREAL_RPC_USER_USERNAME', 'apiuser'),
            'password' => env('UNREAL_RPC_USER_PASSWORD', 'password'),
        ]

    ],

];
