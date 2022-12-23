<?php

return [
    'amazon' => [
        'advertising' => [
            'client_id' => env('ADVERTISING_API_CLIENT_ID'),
            'client_secret' => env('ADVERTISING_API_CLIENT_SECRET'),
            'endpoints' => [
                'na' => 'https://advertising-api.amazon.com',
                'eu' => 'https://advertising-api-eu.amazon.com',
                'fe' => 'https://advertising-api-fe.amazon.com',
            ]
        ]
    ]
];
