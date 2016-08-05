<?php

namespace Module\Frontend\Controller\Dashboard;

use Lib\Controller\AbstractController;


class Index extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Dashboard');

    }

    public function execute($args)
    {
        $this->render();
    }

}
