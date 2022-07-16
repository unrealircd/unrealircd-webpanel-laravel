<?php

namespace App;

use JetBrains\PhpStorm\ArrayShape;

class UnrealIRCd
{
    #[ArrayShape(['translations' => "array|string"])]
    public static function variables(): array
    {
        return [
            'translations' => static::translations(),
        ];
    }

    private static function translations()
    {
        $file = lang_path(sprintf('%s.json', session('_lang') ?? app()->getLocale()));

        return json_decode(file_get_contents($file), true);
    }
}
