<?php

namespace Module\Frontend\Controller\Home;

use Lib\Controller\AbstractController;


class Index extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Home');
        $viewRenderer->appendStyleSheet('css/app.css');
        $viewRenderer->appendBodyScript('js/app.js');
    }

    public function execute($args)
    {
        $this->logger->log(\Psr\Log\LogLevel::DEBUG, 'Home Index controller');
        $this->render();
    }

}
