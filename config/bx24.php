<?php

return [
    'v1' => [
        'scope' => explode(',', env('BX24_V1_SCOPE', 'user,department,log')),
        'id' => env('BX24_V1_ID', 'local.5e4bf7301ac594.65688313'),
        'secret' => env('BX24_V1_SECRET', 'UenhKTf1MyyvJhKidD9uYfhOuWMccw0EUfnhMy9Yp9oPdrluuj'),
    ],
    'status_on_middleware_fail' => env('BX24_STATUS_ON_MIDDLEWARE_FAIL', 401),
    'bad_requests_log_channel' => env('BX24_BAD_REQUESTS_LOG_CHANNEL', 'bx24_bad_requests'),
    'redirect_on_fail_check_install' => env('BX24_REDIRECT_ON_FAIL_CHECK_INSTALL', true),
];

