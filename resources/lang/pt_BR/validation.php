<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'accepted' => ':attribute deve ser aceito',
    'active_url' => ':attribute deve conter uma URL válida',
    'after' => 'Deve ser posterior a :date',
    'after_or_equal' => 'Deve ser posterior ou igual a :date',
    'alpha' => 'Informe apenas letras',
    'alpha_dash' => 'Informe apenas letras, números e traços',
    'alpha_num' => 'Informe apenas letras e números',
    'array' => ':attribute deve conter um array',
    'base64_image' => ':attribute deve conter uma imagem',
    'base64_file_size' => 'O aquivo deve ser menor que :file_size',
    'before' => 'Precisa ser anterior a :date',
    'before_or_equal' => 'Precisa ser anterior ou igual a :date',
    'between' => [
        'numeric' => ':attribute deve conter um número entre :min e :max',
        'file' => ':attribute deve conter um arquivo de :min a :max kilobytes',
        'string' => ':attribute deve conter entre :min a :max caracteres',
        'array' => ':attribute deve conter de :min a :max itens',
    ],
    'boolean' => 'Deve conter o valor sim ou não',
    'cep' => 'O :attribute informado não é válido',
    'confirmed' => 'A confirmação para :attribute não coincide',
    'cpf_format' => 'Deve estar no formato 000.000.000-00',
    'cpf' => 'O CPF informado não é válido',
    'cnpj_format' => 'Deve estar no formato 00.000.000/0000-00',
    'cnpj' => 'O CNPJ informado não é válido',
    'date' => 'Informe uma data válida',
    'date_format' => 'Esta data não é válida',
    'date_time_format' => 'Informe uma data e horário válidos',
    'different' => 'Os campos :attribute e :other devem conter valores diferentes',
    'digits' => ':attribute deve conter :digits dígitos',
    'digits_between' => ':attribute deve conter entre :min a :max dígitos',
    'dimensions' => 'O valor informado para :attribute não é uma dimensão de imagem válida',
    'distinct' => ':attribute está duplicado',
    'email' => 'Este não é um e-mail válido',
    'exists' => ':attribute não foi encontrado',
    'file' => ':attribute deve conter um arquivo',
    'filled' => 'Campo já preenchido',
    'image' => ':attribute deve conter uma imagem',
    'in' => ':attribute não foi encontrado',
    'in_array' => ':attribute não existe em :other',
    'integer' => ':attribute deve conter um número inteiro',
    'ip' => ':attribute deve conter um IP válido',
    'json' => ':attribute deve conter uma string JSON válida',
    'max' => [
        'numeric' => ':attribute deve ser menor que :max',
        'file' => ':attribute deve ser menor que :max kilobytes',
        'string' => ':attribute não pode conter mais de :max caracteres',
        'array' => ':attribute deve conter no máximo :max itens',
    ],
    'mimes' => ':attribute deve conter um arquivo do tipo: :values',
    'mimetypes' => ':attribute deve conter um arquivo do tipo: :values',
    'min' => [
        'numeric' => ':attribute deve ser maior que :min',
        'file' => ':attribute deve ser maior que :min kilobytes',
        'string' => ':attribute deve conter no mínimo :min caracteres',
        'array' => ':attribute deve conter no mínimo :min itens',
    ],
    'money' => ':attribute não está no formato de dinheiro (000,00)',
    'not_in' => ':attribute contém um valor inválido',
    'numeric' => ':attribute deve conter um valor numérico',
    'phone' => ':attribute não contém um número de telefone válido',
    'mobile_number' => 'não contém um número de celular válido',
    'present' => ':attribute deve estar presente',
    'regex' => 'O formato de :attribute é inválido',
    'required' => 'Campo obrigatório',
    'required_if' => 'Campo obrigatório quando o valor do campo :other é igual a :value',
    'required_unless' => 'Campo obrigatório a menos que :other esteja presente em :values',
    'required_with' => 'Campo obrigatório quando :values está presente',
    'required_with_all' => 'Campo obrigatório quando um dos :values está presente',
    'required_without' => 'Campo obrigatório quando :values não está presente',
    'required_without_all' => 'Campo obrigatório quando nenhum dos :values está presente',
    'rg_format' => 'O :attribute deve estar no formato 00.000.000-0',
    'same' => 'Os campos :attribute e :other devem conter valores iguais',
    'size' => [
        'numeric' => ':attribute deve conter o número :size',
        'file' => ':attribute deve conter um arquivo com o tamanho de :size kilobytes',
        'string' => ':attribute deve conter :size caracteres',
        'array' => ':attribute deve conter :size itens',
    ],
    'string' => ':attribute deve ser uma string',
    'time_format' => 'Este não é um horário válido',
    'timezone' => ':attribute deve conter um fuso horário válido',
    'unique' => 'O :attribute informado já está em uso',
    'uploaded' => 'Falha no upload do arquivo :attribute',
    'url' => 'O formato da URL informada para :attribute é inválido',
    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O campo :attribute deve ser maior que :value caracteres.',
        'array'   => 'O campo :attribute deve conter mais de :value itens.',
    ],
    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        'array'   => 'O campo :attribute deve conter :value itens ou mais.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'name' => 'nome',
        'brand_id' => 'marca',
        'model' => 'modelo',
        'model_id' => 'modelo',
        'image' => 'imagem'
    ],
    'validation_exception' => [
        'invalid' => 'Ops! Algumas informações estão erradas, por favor conferir.'
    ],
];
