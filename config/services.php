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

    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_TOKEN', '6534648064:AAEhamJqXUGUdjWvgXm58SbQznob9DV-n6U')
    ],

    'telegram-id' => env('TELEGRAM_ID','460178265'),

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'coinpayment' => [
        'private_key' => env('COINPAYMENT_PRIVATE_KEY'),
        'public_key' => env('COINPAYMENT_PUBLIC_KEY'),
    ],
    'recaptcha' => [
        'key' => env('GOOGLE_RECAPTCHA_KEY'),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
    ],
    
    'telegram' => [
        'bot' => env('TELEGRAM_BOT_NAME'),  // The bot's username
        'client_id' => null,
        'client_secret' => env('TELEGRAM_TOKEN'),
        'redirect' => env('TELEGRAM_REDIRECT_URI'),
    ],

    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_TOKEN', 'YOUR BOT TOKEN HERE'),
        'name' => env('TELEGRAM_BOT_NAME', 'YOUR BOT_NAME')
    ],
];
