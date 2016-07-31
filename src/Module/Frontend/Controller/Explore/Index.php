<?php

namespace Module\Frontend\Controller\Explore;

use Lib\Controller\AbstractController;


class Index extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Explore');
    }

    public function execute($args)
    {
        $this->logger->log(\Psr\Log\LogLevel::DEBUG, 'Explore Index controller');
        $this->render();
    }

}
