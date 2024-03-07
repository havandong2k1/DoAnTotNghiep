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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '244314155263497',
        'client_secret' => 'd9d7f95c1273d71e72f3c02b7c5a461e', 
        'redirect' => 'http://localhost/shopdienthoailaravel/admin/callback'
        ],
    'google' => [
        'client_id' => '493611427683-q0mk8stpo11sthfti4lgpg0hguj4c58s.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/shopdienthoailaravel/google/callback' 
    ],

];
