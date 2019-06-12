<?php

use App\Middleware\Router;
use \Nyholm\Psr7\Factory\Psr17Factory;
use \Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__.'/vendor/autoload.php';

try {
    $file = __DIR__. '/files/cdrs.csv';
    $response = (new \App\Services\FileCalculationManager())->calculate($file);
} catch (Exception $e) {
    $response = $e->getMessage();
}
var_dump($response);
die();



$psr17Factory = new Psr17Factory();

$request = (new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
))->fromGlobals();

$middlewares[] = new Router();

$runner = (new \Relay\RelayBuilder())->newInstance($middlewares);
$response = $runner->handle($request);


var_dump($response->getBody());