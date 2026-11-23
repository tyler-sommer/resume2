<?php

use Symfony\Component\HttpFoundation\Request;
use TylerSommer\Resume\Transformer\SimpleXmlTransformer;

ini_set('display_errors', 'stderr');

require_once __DIR__ . '/boostrap.php';

$app->boot();
$app->getContainer()->set('request', new Request());

$webDir = $app->getRootDir().'/web';

$transformer = new SimpleXmlTransformer();
$model = $transformer->transformFile(__DIR__ . '/data.xml');

foreach (array('index.html.twig', 'print.html.twig') as $template) {
    $hash = md5_file($templateDir.$template);
    $htmlFile = $webDir.'/'.str_replace('.twig', '', $template);
    $content = $app->get('twig')->render($template, array('resume' => $model));
    $cacheFile = $cacheDir.'/twig-'.$hash;
    echo "--> writing $cacheFile\n";
    file_put_contents($cacheFile, $content);
    echo "--> writing $htmlFile\n";
    file_put_contents($htmlFile, $content);
}
