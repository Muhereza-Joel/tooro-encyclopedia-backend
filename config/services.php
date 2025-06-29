<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'pesapal' => [
        'consumer_key' => env('PESAPAL_CONSUMER_KEY'),
        'consumer_secret' => env('PESAPAL_CONSUMER_SECRET'),
        'ipn_id' => env('PESAPAL_IPN_ID'),
        'ipn_url' => env('PESAPAL_IPN_URL'),
        'callback_url' => env('PESAPAL_CALLBACK_URL', 'https://yourdomain.com/pesapal/callback'),
        'submit_order_url' => env('PESAPAL_SUBMIT_ORDER_URL'),
        'request_token_url' => env('PESAPAL_REQUEST_TOKEN_URL'),
        'transaction_status_url' => env('PESAPAL_TRANSACTION_STATUS_URL'),

    ],


];
