import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { homedir } from 'os';
import { resolve } from 'path';
import fs from 'fs';
import os from 'os'

let server = {};

/*if(fs.existsSync(`${os.homedir()}/easyrsa`)) {
    if (os.platform() === "linux") {
        server = {
            https: {
                key: fs.readFileSync(
                    `${os.homedir()}/easyrsa/pki/private/Unreal.key`
                ),
                cert: fs.readFileSync(
                    `${os.homedir()}/easyrsa/pki/issued/Unreal.crt`
                ),
            },
            host: "unreal.test",
        };
    }
}*/

export default defineConfig({
    server,
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources/js"
        }
    }
})
