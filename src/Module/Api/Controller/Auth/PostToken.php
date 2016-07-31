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
            'success' => false,
            'message' => 'Invalid credential'
        ];
        $httpStatusCode = 200;

        $postParams = $this->request->getParsedBody();

        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');

        if ($user = $userModel->authenticate($postParams['credential'], $postParams['password'])) {

            $now = new \DateTime();
            $future = new \DateTime("now +1 minute");
            $server = $this->request->getServerParams();
            $jti = base64_encode(random_bytes(16));
            $payload = [
                "iat" => $now->getTimestamp(),
                "exp" => $future->getTimestamp(),
                "jti" => $jti
            ];
            $secret = 'supersecretkeyyoushouldnotcommittogithub';
            $token = JWT::encode($payload, $secret, "HS256");
            $data["success"] = true;
            $data["token"] = $token;
            $data["user"] = $user;
        } else {
            $httpStatusCode = 400;
        }

        return $this->response->withJson($data, $httpStatusCode);
    }

}

