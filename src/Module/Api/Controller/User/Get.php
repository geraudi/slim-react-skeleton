<?php

namespace Module\Api\Controller\User;

use Lib\Controller\AbstractController;

class Get extends AbstractController
{

    public function execute($args)
    {
        $this->request->getAttribute('jwt'); // <= attribute injected by JwtIntercept Middleware
        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');
        return $this->response->withJson(['success'=>true,'user' => $userModel->getById($args['id'])]);
    }

}

