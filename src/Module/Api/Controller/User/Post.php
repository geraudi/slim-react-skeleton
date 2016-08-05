<?php

namespace Module\Api\Controller\User;

use Lib\Controller\AbstractController;

class Post extends AbstractController
{

    public function execute($args)
    {
        $data = [
            'success' => true,
            'message' => ''
        ];
        $httpStatusCode = 200;

        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');
        $postParams = $this->request->getParsedBody();
        $data['user'] = $userModel->register($postParams);

        return $this->response->withJson($data, $httpStatusCode);
    }

}

