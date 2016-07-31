<?php

namespace Module\Frontend\Controller\Auth;

use Lib\Controller\AbstractController;


class Login extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Login');

    }

    public function execute($args)
    {
        $this->render();
    }

}
