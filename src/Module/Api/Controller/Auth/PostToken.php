<?php

namespace Module\Api\Controller\Auth;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Controller\AbstractController;
use Firebase\JWT\JWT;

class PostToken extends AbstractController
{

    public function execute($args)
    {
        $data = [
            'success' => true,
            'message' => ''
        ];
        $httpStatusCode = 200;

        $postParams = $this->request->getParsedBody();

        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');

        if ($user = $userModel->authenticate($postParams['credential'], $postParams['password'])) {

            $token = $this->jwtHelper->createToken(['user_id' => $user['id']]);
            $data['token'] = $token;
            $data['user'] = $user;

        } else {
            $httpStatusCode = 400;
            $data['success'] = false;
            $data['message'] = 'Invalid credential';
        }

        return $this->response->withJson($data, $httpStatusCode);
    }

}

