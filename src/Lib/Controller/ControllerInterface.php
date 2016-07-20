<?php

namespace Lib\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ControllerInterface
{
    /**
     *
     * @param $args
     * @return mixed
     */
     public function execute($args);

}

