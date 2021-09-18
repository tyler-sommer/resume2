<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nice\Application;
use Nice\Extension\TwigExtension;
use Nice\Router\RouteCollector;
use TylerSommer\Resume\Transformer\SimpleXmlTransformer;

require __DIR__ . '/vendor/autoload.php';

$env = 'dev';
$app = new Application($env);

$cacheDir = $app->getCacheDir();
$templateDir = __DIR__ . '/views/';

/**
 * @param Request $request
 * @param string $template
 * @return Response
 */
$renderCachedPage = function(Request $request, $template) use ($app, $templateDir, $cacheDir) {
    $response = new Response();
    $response->setLastModified(new \DateTime('@'.filemtime($templateDir.$template)));
    $response->setPublic();
    if (($hash = md5_file($templateDir.$template)) !== '') {
        $response->setEtag($hash);
    }
    if ($response->isNotModified($request)) {
        return $response;
    }

    $cacheFile = $cacheDir.'/twig-'.$hash;
    if (file_exists($cacheFile)) {
        $content = file_get_contents($cacheFile);
    } else {
        $transformer = new SimpleXmlTransformer();
        $model = $transformer->transformFile(__DIR__ . '/data.xml');
        $content = $app->get('twig')->render($template, array('resume' => $model));
        file_put_contents($cacheFile, $content);
    }

    $response->setContent($content);

    return $response;
};

$app->appendExtension(new TwigExtension($templateDir));
$app->set('routes', function (RouteCollector $r) use ($renderCachedPage) {
    $r->map('/', 'home', function (Request $request, Application $app) use ($renderCachedPage) {
        return $renderCachedPage($request, 'index.html.twig');
    });

    $r->map('/print', 'print', function (Request $request) use ($renderCachedPage) {
        return $renderCachedPage($request, 'print.html.twig');
    });

    // Deprecated routes
    $r->map('/print.html', null, function (Application $app) {
        $url = $app->get('router.url_generator')->generate('print');

        return new RedirectResponse($url, 301);
    });

    $r->map('/index.html', null, function (Application $app) {
        $url = $app->get('router.url_generator')->generate('home');

        return new RedirectResponse($url, 301);
    });
});
