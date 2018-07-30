<?php

$container = $app->getContainer();

// view renderer
/*
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};
*/

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Llave de autentificación
$container['secret'] = 'HiperGredaKey';


// DAOs
$container['IndexDAO'] = function ($c) {
    return new \HiperTweetAPI\DAOS\IndexDAO($c);
};

$container['TweetDAO'] = function ($c) {
    return new \HiperTweetAPI\DAOS\TweetDAO($c);
};

// Models
$container['IndexModel'] = function ($c) {
    return new \HiperTweetAPI\Models\IndexModel();
};
$container['TweetModel'] = function ($c) {
    return new \HiperTweetAPI\Models\TweetModel();
};

// Controllers
$container['IndexController'] = function ($c) {
    return new \HiperTweetAPI\Controllers\IndexController($c);
};
$container['TweetController'] = function ($c) {
    return new \HiperTweetAPI\Controllers\TweetController($c);
};
