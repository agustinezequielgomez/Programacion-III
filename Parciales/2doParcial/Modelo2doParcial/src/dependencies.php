<?php

use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {
    $container = $app->getContainer();

    //ORM
    $dbSettings = $container->get('settings')['db'];
    $capsule = new Capsule;
    $capsule->addConnection($dbSettings);
    $capsule->bootEloquent();
    $capsule->setAsGlobal();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    /*$container['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
            return $response->withStatus(500)
                ->withHeader('Content-Type', 'text/html')
                ->write('Un error no controlado!');
        };
    };*/
    $container['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $response->withStatus(404)
                ->withHeader('Content-Type', 'text/html')
                ->write('No es una ruta correcta');
        };
    };
    $container['notAllowedHandler'] = function ($c) {
        return function ($request, $response, $methods) use ($c) {
            return $response->withStatus(405)
                ->withHeader('Allow', implode(', ', $methods))
                ->withHeader('Content-type', 'text/html')
                ->write('solo se puede por: ' . implode(', ', $methods));
        };
    };
    
       /*$container['phpErrorHandler'] = function ($c) {
        return function ($request, $response, $error) use ($c) {
            return $response->withStatus(500)
                ->withHeader('Content-Type', 'text/html')
                ->write('Algo paso con tu PHP!');
        };
    };*/
};
