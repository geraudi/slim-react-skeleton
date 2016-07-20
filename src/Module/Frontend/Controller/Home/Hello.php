<?php

namespace Module\Frontend\Controller\Home;

use Lib\Controller\AbstractController;

class Hello extends AbstractController
{


    public function execute($args)
    {
        $name = $args['name'];
        $this->viewRenderer->setHeadTitle('Hello ' . $name);
        $this->viewRenderer->setAttributes(['name' => $name]);
        $this->render();
    }

}
