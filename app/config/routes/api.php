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
    $this->get('/auth', 'Module\Api\Controller\Auth\GetToken')->setName('api.auth.token');


//    $this->group('/users/{id:[0-9]+}', function () {
//        $this->get('', 'UserController:get')->setName('user');
//        $this->delete('', 'UserController::delete')->setName('user-delete');
//        $this->get('/reset-password', 'UserController:reset')->setName('user-password-reset');
//    });

    /**
     * USERS
     */
    $this->get('/users', 'Module\Api\Controller\User\GetList')->setName('api.user.list');
    $this->get('/users/{id:\d+}', 'Module\Api\Controller\User\Get')->setName('api.user.get');
    $this->get('/users/{id:\d+}/albums', 'Module\Api\Controller\User\AlbumGetList')->setName('api.user.album.list');
    $this->get('/users/{id:\d+}/photos', 'Module\Api\Controller\User\PhotoGetList')->setName('api.user.photo.list');


    /**
     * ALBUMS
     */
    $this->get('/albums', 'Module\Api\Controller\Album\GetList')->setName('api.album.list');
    $this->get('/albums/{id:\d+}/photos', 'Module\Api\Controller\Album\PhotoGetList')->setName('api.album.photo.list');
    $this->get('/albums/{id:\d+}', 'Module\Api\Controller\Album\Get')->setName('api.album.get');

    /**
     * PHOTOS
     */
    $this->get('/photos', 'Module\Api\Controller\Photos\GetList')->setName('api.photo.list');
    $this->get('/photos/{id:\d+}/comments', 'Module\Api\Controller\Photos\CommentGetList')->setName('api.photo.comment.list');
    $this->get('/photos/{id:\d+}', 'Module\Api\Controller\Photos\Get')->setName('api.photo.get');

    /**
     * CATEGORIES
     */
    $this->get('/categories', 'Module\Api\Controller\Category\GetList')->setName('api.category.list');
});
