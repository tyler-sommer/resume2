<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nice\Application;
use Nice\Extension\TwigExtension;
use Nice\Router\RouteCollector;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app->appendExtension(new TwigExtension(__DIR__ . '/../views'));

$app->set('routes', function (RouteCollector $r) {
    $r->map('/', 'home', function (Application $app) {
        return new Response($app->get('twig')->render('index.html.twig'));
    });

    $r->map('/print', 'print', function (Application $app) {
        return new Response($app->get('twig')->render('print.html.twig'));
    });
});
$app->run();
