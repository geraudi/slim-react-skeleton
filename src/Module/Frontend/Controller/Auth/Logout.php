<?php

namespace Module\Frontend\Controller\Auth;

use Lib\Controller\AbstractController;


class Logout extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Logout');

    }

    public function execute($args)
    {
        $this->render();
    }

}
