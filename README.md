[![Twitter Follow](https://img.shields.io/twitter/follow/Unreal_IRCd.svg?style=social&label=Follow)](https://twitter.com/Unreal_IRCd)

## About UnrealIRCd Web Panel
UnrealIRCd Web Panel is an open-source, free administration panel for UnrealIRCd-powered IRC networks.

> This software is currently a work-in-progress.

## Getting Started

Ensure you have PHP and NodeJS installed on your system or that the PHP and NodeJS binaries are in your system path.

```sh
git clone git@github.com:unrealircd/unrealircd-webpanel.git
cd unrealircd-webpanel
```

Then install the project dependancies
```sh
composer install && npm install
```

If you are making any changes to the front-end code (located in `resources/js`), you'll need to also run
```sh
npm run dev
```

This will run the Vite dev server and changes will be reflected immediately in the browser.

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
