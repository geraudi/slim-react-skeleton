<?php

namespace Module\Frontend\Controller\Auth;

use Lib\Controller\AbstractController;


class Registration extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Registration');

    }

    public function execute($args)
    {
        $this->render();
    }

}
