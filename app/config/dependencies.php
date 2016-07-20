<?php
// DIC configuration

/** @var SlimAura\Container $di */
$di = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// view
$di->set('viewRenderer', function () use ($di) {
    $router = $di->get('router');
    return new Lib\View\Renderer($router);
});

// Set Callable Resolver
$di->set('callableResolver', new Lib\Di\CallableResolver($di));


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$di->params['Monolog\Logger']['name'] = $settings['logger']['name'];

$di->set('logger', function () use ($di) {
    $settings = $di->get('settings')['logger'];
    $logger = $di->newInstance('Monolog\Logger');
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], \Monolog\Logger::DEBUG));

    return $logger;
});

// Db
$di->set('db', function () use ($di) {
    $settings = $di->get('settings')['pdo'];
    $pdo = new \PDO($settings['dns'], $settings['user'], $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
});

// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------
$di->params[Lib\Controller\AbstractController::class]['layoutPath'] = $settings['view']['layoutPath'];
$di->params[Lib\Controller\AbstractController::class]['viewRenderer'] = $di->lazyGet('viewRenderer');
$di->params[Lib\Controller\AbstractController::class]['logger'] = $di->lazyGet('logger');
