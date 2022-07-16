<!DOCTYPE html>
<html lang="{{ session('_lang') ?? str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script charset="UTF-8">
            window.Unreal = `<?php echo json_encode(\App\UnrealIRCd::variables()); ?>`;
        </script>
        @routes
        @vite('resources/css/app.scss')
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
