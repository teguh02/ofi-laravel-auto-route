<?php

return [
    // Default Namespace
    'namespace'     => 'App\Http\Controllers',

    // Default Method
    'defaultMethod' => 'index',

    // Allowed Http
    // For example if you just only define GET in
    // allowedHttp array, so you can visit your
    // auto routing url in GET Method only
    'allowedHttp' => ["GET", "POST", "PUT", "PATCH", "DELETE", "OPTIONS"]
];
