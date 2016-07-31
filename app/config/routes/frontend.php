<?php

$app->get('/', 'Module\Frontend\Controller\Home\Index')->setName('frontend.home.index');
$app->get('/explore', 'Module\Frontend\Controller\Explore\Index')->setName('frontend.explore.index');
$app->get('/auth/login', 'Module\Frontend\Controller\Auth\Login')->setName('frontend.auth.login');
$app->get('/auth/logout', 'Module\Frontend\Controller\Auth\Logout')->setName('frontend.auth.logout');


$app->get('/hello/{name}', 'Module\Frontend\Controller\Home\Hello')->setName('frontend.home.hello');
