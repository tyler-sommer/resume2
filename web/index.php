<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nice\Application;
use Nice\Extension\TwigExtension;
use Nice\Router\RouteCollector;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;

require __DIR__ . '/../vendor/autoload.php';

$env = 'prod';
$app = new Application($env);

$cacheDir = $app->getCacheDir();
$templateDir = __DIR__ . '/../views/';

/**
 * @param Request $request
 * @param string $template
 * @return Response
 */
$renderCachedPage = function(Request $request, $template) use ($app, $templateDir) {
    $response = new Response();
    $response->setLastModified(new \DateTime('@' . filemtime($templateDir.$template)));
    $response->setPublic();
    if (($hash = md5_file($templateDir.$template)) !== '') {
        $response->setEtag($hash);
    }
    if ($response->isNotModified($request)) {
        return $response;
    }

    $response->setContent($app->get('twig')->render($template));

    return $response;
};

$app->appendExtension(new TwigExtension($templateDir));
$app->set('routes', function (RouteCollector $r) use ($renderCachedPage) {
    $r->map('/', 'home', function (Request $request) use ($renderCachedPage) {
        return $renderCachedPage($request, 'index.html.twig');
    });

    $r->map('/print', 'print', function (Request $request) use ($renderCachedPage) {
        return $renderCachedPage($request, 'print.html.twig');
    });
});

$stack = new Stack\Builder();
$stack->push(function ($app) use ($cacheDir) {
    return new HttpCache($app, new Store($cacheDir));
});

$app = $stack->resolve($app);

Stack\run($app);
