<?php
define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        /*'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],*/
        'view' => [
            'template_path' => __DIR__ . '/../templates',
            'twig' => [
                'cache' => __DIR__ . '/../var/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'mode' => 'development',
        'debug' => true,
        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/../var/doctrine',

            // you should add any other path containing annotated entity classes
            /*'metadata_dirs' => [
                APP_ROOT . '/../src/Entity',
            ],*/
            'meta' => [
                'entity_path' => [
                    'src/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../var/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver' => 'pdo_sqlite',
                'path' => APP_ROOT . '/../src/db/db.sqlite',
            ]
        ],
        'appUri' => 'http://localhost/magpie',
    ],
];
