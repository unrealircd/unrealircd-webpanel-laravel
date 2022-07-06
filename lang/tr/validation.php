<?php

return [

    /*
	| Turkish language file. 
    |
    | UnrealIRCd Web Panel is copyright (c) 2022 Sketch
    |	 
    | LANG_NAME
    |	Türkçe (Turkish)
    |
    | Translated by OmerAti (omerati6363@gmail.com) 
    | 
    |--------------------------------------------------------------------------
    | Doğrulama Dili Çizgileri
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, tarafından kullanılan varsayılan hata mesajlarını içerir.
    | doğrulayıcı sınıfı. Bu kuralların bazılarının birden çok versiyonu vardır.
    | boyut kuralları olarak. Bu mesajların her birini burada ayarlamaktan çekinmeyin.
    |
    */

    'accepted' => ':attribute kabul edildi.',
    'accepted_if' => ':attribute, :other :value olduğunda kabul edilir.',
    'active_url' => ':attribute geçerli bir URL değil.',
    'after' => ':attribute, :date tarihinden sonraki bir tarih olmalıdır.',
    'after_or_equal' => ':attribute, :date değerinden sonraki veya buna eşit bir tarih olmalıdır.',
    'alpha' => ':attribute yalnızca harfler içermelidir.',
    'alpha_dash' => ':attribute yalnızca harf, sayı, tire ve alt çizgi içermelidir.',
    'alpha_num' => ':attribute yalnızca harf ve rakamlardan oluşmalıdır.',
    'array' => ':attribute bir dizi olmalıdır.',
    'before' => ':attribute, :date tarihinden önceki bir tarih olmalıdır.',
    'before_or_equal' => ':attribute, :date tarihinden önce veya buna eşit bir tarih olmalıdır.',
    'between' => [
        'array' => ':attribute, :min ve :max öğeleri arasında olmalıdır.',
        'file' => ':attribute :min ile :max kilobayt arasında olmalıdır.',
        'numeric' => ':attribute :min ile :max arasında olmalıdır.',
        'string' => ':attribute :min ve :max karakterleri arasında olmalıdır.',
    ],
    'boolean' => ':attribute alanı doğru veya yanlış olmalıdır.',
    'confirmed' => ':attribute onayı eşleşmiyor.',
    'current_password' => 'Şifre yanlış.',
    'date' => ':attribute geçerli bir tarih değil.',
    'date_equals' => ':attribute, :date değerine eşit bir tarih olmalıdır.',
    'date_format' => ':attribute, :format biçimiyle eşleşmiyor.',
    'declined' => ':attribute reddedilmelidir.',
    'declined_if' => ':attribute, :other :value olduğunda reddedilmelidir.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'digits' => ':attribute :digits olmalıdır.',
    'digits_between' => ':attribute :min ve :max basamakları arasında olmalıdır.',
    'dimensions' => ':attribute geçersiz resim boyutlarına sahip.',
    'distinct' => ':attribute alanında yinelenen bir değer var.',
    'doesnt_start_with' => ':attribute aşağıdakilerden biriyle başlamayabilir: :values.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'ends_with' => ':attribute aşağıdakilerden biriyle bitmelidir: :values.',
    'enum' => 'Seçilen :attribute geçersiz.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanı bir değere sahip olmalıdır.',
    'gt' => [
        'array' => ':attribute, :value öğelerinden daha fazlasına sahip olmalıdır.',
        'file' => ':attribute, :value kilobayttan büyük olmalıdır.',
        'numeric' => ':attribute, :value değerinden büyük olmalıdır.',
        'string' => ':attribute, :value karakterlerinden büyük olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute, :value öğelerine veya daha fazlasına sahip olmalıdır.',
        'file' => ':attribute, :value kilobayttan büyük veya buna eşit olmalıdır.',
        'numeric' => ':attribute, :value değerinden büyük veya buna eşit olmalıdır.',
        'string' => ':attribute, :value karakterlerinden büyük veya ona eşit olmalıdır.',
    ],
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçersiz.',
    'in_array' => ':attribute alanı :other içinde mevcut değil.',
    'integer' => ':attribute bir tamsayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json' => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'lt' => [
        'array' => ':attribute, :value öğelerinden daha azına sahip olmalıdır.',
        'file' => ':attribute :value kilobayttan küçük olmalıdır.',
        'numeric' => ':attribute :value değerinden küçük olmalıdır.',
        'string' => ':attribute, :value karakterlerinden daha az olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute, :value öğelerinden daha fazlasına sahip olmamalıdır.',
        'file' => ':attribute, :value kilobayttan küçük veya ona eşit olmalıdır.',
        'numeric' => ':attribute, :value değerinden küçük veya buna eşit olmalıdır.',
        'string' => ':attribute, :value karakterlerinden küçük veya bunlara eşit olmalıdır.',
    ],
    'mac_address' => ':attribute geçerli bir MAC adresi olmalıdır.',
    'max' => [
        'array' => ':attribute öğesi, :max öğelerinden daha fazlasına sahip olmamalıdır.',
        'file' => ':attribute :max kilobayttan büyük olmamalıdır.',
        'numeric' => ':attribute :max değerinden büyük olmamalıdır.',
        'string' => ':attribute :max karakterden büyük olmamalıdır.',
    ],
    'mimes' => ':attribute, :values ​​türünde bir dosya olmalıdır.',
    'mimetypes' => ':attribute, :values ​​türünde bir dosya olmalıdır.',
    'min' => [
        'array' => ':attribute en az :min öğelerine sahip olmalıdır.',
        'file' => ':attribute en az :min kilobayt olmalıdır.',
        'numeric' => ':attribute en az :min olmalıdır.',
        'string' => ':attribute en az :min karakter olmalıdır.',
    ],
    'multiple_of' => ':attribute, :value nun katı olmalıdır.',
    'not_in' => 'Seçilen :attribute geçersiz.',
    'not_regex' => ':attribute biçimi geçersiz.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'password' => [
        'letters' => ':attribute en az bir harf içermelidir.',
        'mixed' => ':attribute en az bir büyük harf ve bir küçük harf içermelidir.',
        'numbers' => ':attribute en az bir sayı içermelidir.',
        'symbols' => ':attribute en az bir sembol içermelidir.',
        'uncompromised' => 'Verilen :attribute bir veri sızıntısında ortaya çıktı. Lütfen farklı bir :attribute seçin.',
    ],
    'present' => ':attribute alanı mevcut olmalıdır.',
    'prohibited' => ':attribute alanı yasaktır.',
    'prohibited_if' => ':attribute alanı :other :value olduğunda yasaktır.',
    'prohibited_unless' => ':attribute alanı, :other :values ​​içinde olmadığı sürece yasaktır.',
    'prohibits' => ':attribute alanı :other in mevcut olmasını yasaklar.',
    'regex' => ':attribute biçimi geçersiz.',
    'required' => ':attribute alanı gereklidir.',
    'required_array_keys' => ':attribute alanı şunlar için girişler içermelidir: :values.',
    'required_if' => ':attribute alanı, :other :value olduğunda gereklidir.',
    'required_unless' => ':attribute alanı, :other :values ​​içinde olmadıkça gereklidir.',
    'required_with' => ':attribute alanı, :values ​​mevcut olduğunda gereklidir.',
    'required_with_all' => ':attribute alanı, :values mevcut olduğunda gereklidir.',
    'required_without' => ':attribute alanı, :values ​​olmadığında gereklidir.',
    'required_without_all' => ':attribute alanı, :values ​​değerlerinin hiçbiri mevcut olmadığında gereklidir.',
    'same' => ':attribute ve :other eşleşmelidir.',
    'size' => [
        'array' => ':attribute :size öğeleri içermelidir.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'numeric' => ':attribute :size olmalıdır.',
        'string' => ':attribute :size karakter olmalıdır.',
    ],
    'starts_with' => ':attribute aşağıdakilerden biriyle başlamalıdır: :values',
    'string' => ':attribute bir dize olmalıdır.',
    'timezone' => ':attribute geçerli bir saat dilimi olmalıdır.',
    'unique' => ':attribute zaten alınmış.',
    'uploaded' => ':attribute yüklenemedi.',
    'url' => ':attribute geçerli bir URL olmalıdır.',
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',

    /*
    |--------------------------------------------------------------------------
    | Özel Doğrulama Dili Satırları
    |--------------------------------------------------------------------------
    |
    | Burada, öznitelikler için özel doğrulama mesajları belirtebilirsiniz.
    | satırları adlandırmak için "attribute.rule" kuralı. Bu, hızlı olmasını sağlar
    | belirli bir öznitelik kuralı için belirli bir özel dil satırı belirtin.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Özel Doğrulama Nitelikleri
    |--------------------------------------------------------------------------
    |
    | Özellik yer tutucumuzu değiştirmek için aşağıdaki dil satırları kullanılır
    | "e-posta". Bu, mesajımızı daha anlamlı hale getirmemize yardımcı olur
    |
    */

    'attributes' => [],

];
