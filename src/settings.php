<?php
return [
    'settings' => [
        'origin' => 'http://localhost:4200', // set the origin allowed
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'tweetlanding-api',
            'path' => __DIR__ . '/../logs/tweetlanding.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
