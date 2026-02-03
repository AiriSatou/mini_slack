<?php

return [

    'required' => ':attribute は必須です。',
    'string'   => ':attribute は文字列で入力してください。',
    'max'      => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'unique'   => ':attribute はすでに使用されています。',

    'attributes' => [
        'name' => 'チャンネル名',
        'body' => 'メッセージ',
    ],
];
