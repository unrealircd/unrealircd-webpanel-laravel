[![Unreal](https://img.shields.io/badge/UnrealIRCd-6.0.5_or_later-blue.svg)](https://unrealircd.org)
[![Composer](https://img.shields.io/badge/Composer-2.0_or_later-blue.svg)](https://getcomposer.org/)
[![PHP](https://img.shields.io/badge/PHP-8.0_or_later-blue.svg)](https://www.php.net/)
[![NodeJS](https://img.shields.io/badge/Node-18.12.1_or_later-blue.svg)](https://getcomposer.org/)

[![Twitter Follow](https://img.shields.io/twitter/follow/Unreal_IRCd.svg?style=social&label=Follow)](https://twitter.com/Unreal_IRCd)

## About UnrealIRCd Web Panel
UnrealIRCd Web Panel is an open-source, free administration panel for UnrealIRCd-powered IRC networks.

> This software is currently a work-in-progress.

## Getting Started

Ensure you have PHP and NodeJS installed on your system or that the PHP and NodeJS binaries are in your system path.

```sh
git clone https://github.com/unrealircd/unrealircd-webpanel
cd unrealircd-webpanel
```

Then install the project dependancies
```sh
composer install && npm install
```
You'll need to make sure you're running composer version 2 or higher.

If you are making any changes to the front-end code (located in `resources/js`), you'll need to also run
```sh
npm run dev
```

This will run the Vite dev server and changes will be reflected immediately in the browser.
## Configuring
There are two configuration files you'll need to configure to match your setup.
* [config/database.php](config/database.php) - The configuration about your database (sqlite, mysqli, postrgesql)
* [config/unrealircd.php](config/unrealircd.php) - The configuration about your UnrealIRCd instance.

Outside of this, you will need to create an `rpc-user {}` block as well as a `listen {}` block in your UnrealIRCd.
For more information on configuring your UnrealIRCd for RPC, [check this link](https://www.unrealircd.org/docs/JSON-RPC)

## Running
To access the project: 
```sh
php artisan serve
```
then point your browser at `http://localhost:8000`

## Documentation
to do...

## Website, support, and other links ##
* https://www.unrealircd.org - Our main website
* https://forums.unrealircd.org - Support
* https://bugs.unrealircd.org - Bug tracker (IRCd software only.)
* https://github.com/unrealircd/unrealircd-webpanel/issues - Bug tracker (Web Panel only.)
* [ircs://irc.unrealircd.org:6697/unreal-support](ircs://irc.unrealircd.org:6697/unreal-support) - IRC support
