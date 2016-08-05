<?php
// Routes
// https://github.com/nikic/FastRoute

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api/v1', function () {


    /**
     * AUTHENTICATION
     */
    $this->post('/auth', 'Module\Api\Controller\Auth\PostToken')->setName('api.auth.token');

    /**
     * USERS
     */
    $this->get('/users', 'Module\Api\Controller\User\GetList')->setName('api.user.list');
    $this->post('/users', 'Module\Api\Controller\User\Post')->setName('api.user.post');
    $this->get('/users/{id:\d+}', 'Module\Api\Controller\User\Get')->setName('api.user.get');

});
