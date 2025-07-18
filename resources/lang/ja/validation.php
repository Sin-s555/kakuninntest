<?php

return [
    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは有効なURLではありません。',
    'after'                => ':attributeには、:date以降の日付を指定してください。',
    'after_or_equal'       => ':attributeには、:date以降もしくは同一の日付を指定してください。',
    'alpha'                => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'           => ':attributeには、英数字とダッシュ(-)及び下線(_)が使用できます。',
    'alpha_num'            => ':attributeには、英数字が使用できます。',
    'array'                => ':attributeには、配列を指定してください。',
    'before'               => ':attributeには、:date以前の日付を指定してください。',
    'before_or_equal'      => ':attributeには、:date以前もしくは同一の日付を指定してください。',
    'between'              => [
        'numeric' => ':attributeには、:minから:maxまでの数字を指定してください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
    ],
    'boolean'              => ':attributeには、trueかfalseを指定してください。',
    'confirmed'            => ':attributeと確認フィールドが一致しません。',
    'date'                 => ':attributeには、有効な日付を指定してください。',
    'date_equals'          => ':attributeには、:dateと同じ日付けを指定してください。',
    'date_format'          => ':attributeの形式は、:formatと一致しません。',
    'different'            => ':attributeと:otherには、異なるものを指定してください。',
    'digits'               => ':attributeは:digits桁にしてください。',
    'digits_between'       => ':attributeは:min桁から:max桁にしてください。',
    'email'                => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください。',
    'required'             => ':attributeは必須です。',
    // ... 他の項目は必要に応じて追加
    'attributes'           => [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],
];
