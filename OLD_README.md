(No longer maintained)

## Getting Started

Ensure you have PHP and NodeJS installed on your system or that the PHP and NodeJS binaries are in your system path.

```sh
git clone ....
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
To run the webpanel: 
```sh
php artisan serve
```
then point your browser at `http://localhost:8000`

## Documentation
to do...
