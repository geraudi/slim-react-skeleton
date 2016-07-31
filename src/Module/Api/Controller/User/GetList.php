<?php

namespace Module\Api\Controller\User;

use Lib\Controller\AbstractController;

class GetList extends AbstractController
{

    public function execute($args)
    {
        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');
        return $this->response->withJson($userModel->getList());
    }

}

