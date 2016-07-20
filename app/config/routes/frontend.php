<?php

$app->get('/', 'Module\Frontend\Controller\Home\Index')->setName('frontend.home.index');
$app->get('/hello/{name}', 'Module\Frontend\Controller\Home\Hello')->setName('frontend.home.hello');
