<?php
return [

    'displayErrorDetails' => true, // set to false in production

    'addContentLengthHeader' => false, // Allow the web server to send the content-length header

    'view' => [
        'layoutPath' => __DIR__ . '/../../src/layout/',
    ],

    'logger' => [
        'name' => 'slim-app',
        'path' => __DIR__ . '/../log/app.log',
    ],

    'pdo' => [
        'dns'      => 'mysql:dbname=#DBNAME#;host=127.0.0.1;charset=utf8',
        'user'     => 'root',
        'password' => 'root'
    ]

];
