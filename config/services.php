<?php
return [
        'mailgun' => [
                'domain' => env('MAILGUN_DOMAIN'),
                'secret' => env('MAILGUN_SECRET'),
                'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        ],
        'ses' => [
                'key' => env('SES_KEY'),
                'secret' => env('SES_SECRET'),
                'region' => env('SES_REGION', 'us-east-1'),
        ],
        'sparkpost' => [
                'secret' => env('SPARKPOST_SECRET'),
        ],
        'stripe' => [
                'model' => App\User::class,
                'key' => env('STRIPE_KEY'),
                'secret' => env('STRIPE_SECRET'),
                'webhook' => [
                        'secret' => env('STRIPE_WEBHOOK_SECRET'),
                        'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
                ],
        ],
        'google' => [
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect' => env('GOOGLE_REDIRECT'),
        ],
        'facebook' => [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'redirect' => env('FACEBOOK_CALLBACK_URL'),
        ],
        'linkedin' => [
                'client_id' => env('LINKEDIN_CLIENT_ID'),
                'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
                'redirect' => env('LINKEDIN_CALLBACK_URL'),
        ],
];
