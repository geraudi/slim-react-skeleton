<?php

namespace Module\Api\Controller\User;

use Lib\Controller\AbstractController;

class Get extends AbstractController
{

    public function execute($args)
    {
        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');
        return $this->response->withJson($userModel->getById($args['id']));
    }

}

