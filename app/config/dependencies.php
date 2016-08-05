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
$di->set('loggerNameSetting', function () use ($di) {
    return $di->get('settings')['logger']['name'];
});

$di->params['Monolog\Logger']['name'] = $di->lazyGet('loggerNameSetting');

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

// Model
$di->params[Lib\Model\AbstractModel::class] = [
    'db'          => $di->lazyGet('db'),
    'slugHandler' => \Behat\Transliterator\Transliterator::class
];

$di->params[Lib\Model\ModelFactory::class] = [
    'map' => [
        'user'     => $di->newFactory('Model\User'),
        'category' => $di->newFactory('Model\Category'),
    ],
];
$di->set('modelFactory', $di->lazyNew('Lib\Model\ModelFactory'));

// JWT
$di->set('jwtHelper', function () use ($di) {
    $settings = $di->get('settings')['auth'];
    return new \Lib\Helper\JwtHelper($settings['jwtKey'], $settings['requestAttribute']);
});
$di->params[Lib\Middleware\JwtIntercept::class]['jwtHelper'] = $di->lazyGet('jwtHelper');
$di->set('jwtMiddleware', $di->lazyNew('Lib\Middleware\JwtIntercept'));


// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------

$di->set('layoutSetting', function () use ($di) {
    return $di->get('settings')['view']['layoutPath'];
});

$di->params[Lib\Controller\AbstractController::class] = [
    'layoutPath'   => $di->lazyGet('layoutSetting'),
    'viewRenderer' => $di->lazyGet('viewRenderer'),
    'logger'       => $di->lazyGet('logger'),
    'modelFactory' => $di->lazyGet('modelFactory'),
    'jwtHelper'    => $di->lazyGet('jwtHelper'),
];


