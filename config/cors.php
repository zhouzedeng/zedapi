<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => true,
    'allowedOrigins' => [
        '*'
        //'https://www.yingloutong.cn',
    ],
    'allowedHeaders' => [
        'Origin',
        'Content-Type',
        'Accept',
        'Authorization',
    ],
    'allowedMethods' => [
        'GET',
        'POST',
        'PUT',
        'PATCH',
    ],
    'exposedHeaders' => [],
    'maxAge' => 0,
];