<?php
// Application middleware

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

$di = $app->getContainer();

/**
 * Permanently redirect paths with a trailing slash
 * to their non-trailing counterpart
 */
$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) == '/') {
        $uri = $uri->withPath(substr($path, 0, -1));
        return $response->withRedirect((string)$uri, 301);
    }
    return $next($request, $response);
});

//$app->add(new \Slim\Middleware\JwtAuthentication([
//    "path"        => "/api",
//    "secure"      => true,
//    "passthrough" => ["/api/v1/users/token"],
//    "logger"      => $app->getContainer()->get('logger'),
//    "relaxed"     => ["localhost", "fc.box"],
//    "secret"      => "supersecretkeyyoushouldnotcommittogithub",
//    "callback"    => function ($request, $response, $arguments) use ($di) {
//        //Check role here
//        return true;
//    }
//]));