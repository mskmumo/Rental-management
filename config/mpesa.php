<?php

return [
    'consumer_key' => env('MPESA_CONSUMER_KEY', 'nk16Y74eSbTaGQgc9WF8j6FigApqOMWr'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET', 'yXJrKtlGzAfBGxAq'),
    'passkey' => env('MPESA_PASSKEY', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'),
    'shortcode' => env('MPESA_SHORTCODE', '174379'),
    'env' => env('MPESA_ENV', 'sandbox'),
    'callback_url' => env('MPESA_CALLBACK_URL', 'https://yourdomain.com/api/mpesa/callback'),
    'timeout_url' => env('MPESA_TIMEOUT_URL', 'https://yourdomain.com/api/mpesa/timeout'),
    'result_url' => env('MPESA_RESULT_URL', 'https://yourdomain.com/api/mpesa/result'),
]; 