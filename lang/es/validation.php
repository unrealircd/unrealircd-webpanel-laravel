<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El :attribute debe ser aceptado.',
    'accepted_if' => 'El :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El :attribute no es una URL válida.',
    'after' => 'El :attribute debe ser una fecha después de :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El :attribute sólo debe contener letras.',
    'alpha_dash' => 'El :attribute sólo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute sólo debe contener letras y números.',
    'array' => 'El :attribute debe ser una matriz.',
    'before' => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'array' => 'El :attribute debe tener entre :min y :max elementos.',
        'file' => 'El :attribute debe tener entre :min y :max kilobytes.',
        'numeric' => 'El :attribute debe tener entre :min y :max.',
        'string' => 'The :attribute debe tener entre :min y :max carácteres.',
    ],
    'boolean' => 'El :attribute el campo debe ser verdadero o falso.',
    'confirmed' => 'El :attribute la confirmación no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El :attribute no es una fecha válida.',
    'date_equals' => 'El :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'declined' => 'El :attribute debe ser rechazado.',
    'declined_if' => 'El :attribute debe rechazarse cuando :other es :value.',
    'different' => 'El :attribute y :other debe ser diferente',
    'digits' => 'El :attribute debe ser :digits dígitos.',
    'digits_between' => 'El :attribute debe estar entre :min y :max dígitos.',
    'dimensions' => 'El :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'El :attribute el campo tiene un valor duplicado.',
    'doesnt_start_with' => 'El :attribute no puede comenzar con uno de los siguientes valores: :values.',
    'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'enum' => 'La selección :attribute es inválida.',
    'exists' => 'La selección :attribute es inválida.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El :attribute el campo debe tener un valor.',
    'gt' => [
        'array' => 'El :attribute debe tener más de :value elementos.',
        'file' => 'El :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor a :value.',
        'string' => 'El :attribute debe ser mayor a :value carácteres.',
    ],
    'gte' => [
        'array' => 'El :attribute debe tener :value un elementos o más.',
        'file' => 'El :attribute debe ser mayor o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor o igual a :value.',
        'string' => 'El :attribute debe ser mayor o igual a :value carácteres.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'La selección :attribute es inválida.',
    'in_array' => 'El :attribute campo no existe en :other.',
    'integer' => 'El :attribute debe ser un entero.',
    'ip' => 'El :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El :attribute debe ser una IPv4 válida.',
    'ipv6' => 'El :attribute debe ser una IPv6 válida.',
    'json' => 'El :attribute debe ser una cadena JSON válida.',
    'lt' => [
        'array' => 'El :attribute debe tener menos de :value elementos.',
        'file' => 'El :attribute debe ser menor a :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor a :value.',
        'string' => 'El :attribute debe ser menor a :value carácteres.',
    ],
    'lte' => [
        'array' => 'El :attribute no debe tener más de :value elementos.',
        'file' => 'El :attribute debe ser menor o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor o igual a :value.',
        'string' => 'El :attribute debe ser menor o igual a :value carácteres.',
    ],
    'mac_address' => 'El :attribute debe ser una dirección MAC válida.',
    'max' => [
        'array' => 'El :attribute no debe tener más de :max elementos.',
        'file' => 'El :attribute no debe ser mayor que :max kilobytes.',
        'numeric' => 'El :attribute no debe ser mayor a :max.',
        'string' => 'El :attribute no debe ser mayor a :max carácteres.',
    ],
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El :attribute debe tener al menos :min elementos.',
        'file' => 'El :attribute debe ser por lo menos :min kilobytes.',
        'numeric' => 'El :attribute debe ser por lo menos :min.',
        'string' => 'El :attribute debe ser por lo menos :min carácteres.',
    ],
    'multiple_of' => 'El :attribute debe ser múltiplo de :value.',
    'not_in' => 'La selección :attribute es inválida.',
    'not_regex' => 'El :attribute el formato no es válido.',
    'numeric' => 'El :attribute debe que ser un número.',
    'password' => [
        'letters' => 'El :attribute debe contener al menos una letra.',
        'mixed' => 'El :attribute debe contener al menos una letra mayúscula y una minúscula.',
        'numbers' => 'El :attribute debe contener al menos un número.',
        'symbols' => 'El :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'La selección :attribute ha aparecido en una fuga de datos. Por favor, elija un diferente :attribute.',
    ],
    'present' => 'El :attribute el campo debe estar presente.',
    'prohibited' => 'El :attribute el campo esta prohíbido.',
    'prohibited_if' => 'El :attribute campo está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El :attribute campo está prohibido a menos que :other está en :values.',
    'prohibits' => 'El :attribute campo prohíbe :other de estar presente.',
    'regex' => 'El:attribute el formato no es válido.',
    'required' => 'El :attribute es requerido.',
    'required_array_keys' => 'El :attribute campo debe contener entradas para: :values.',
    'required_if' => 'El :attribute el campo es obligatorio cuando :other es :value.',
    'required_unless' => 'El :attribute el campo es obligatorio a menos que :other está en :values.',
    'required_with' => 'El :attribute el campo es obligatorio cuando :values esté presente.',
    'required_with_all' => 'El :attribute el campo es obligatorio cuando :values está presente.',
    'required_without' => 'El :attribute el campo es requerido cuando :values no está presente.',
    'required_without_all' => 'El :attribute el campo es requerido cuando ninguno de estos :values está presente.',
    'same' => 'El :attribute y :other deben coincidir.',
    'size' => [
        'array' => 'El :attribute debe contener :size elementos.',
        'file' => 'El :attribute debe ser :size kilobytes.',
        'numeric' => 'El :attribute debe ser :size.',
        'string' => 'El :attribute debe ser :size carácteres.',
    ],
    'starts_with' => 'El :attribute debe comenzar con uno de los siguientes: :values.',
    'string' => 'El :attribute mdebe ser una cadena (string).',
    'timezone' => 'El :attribute debe ser una zona horaria válida.',
    'unique' => 'El :attribute ya existe.',
    'uploaded' => 'El :attribute no se pudo cargar.',
    'url' => 'El :attribute debe ser una URL válida.',
    'uuid' => 'El :attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
