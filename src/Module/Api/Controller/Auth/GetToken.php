<?php

namespace Module\Api\Controller\Auth;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Controller\AbstractController;
use Firebase\JWT\JWT;

use Zend\Authentication\AuthenticationService;
use Lib\Auth\Adapter\Db as DbAdapter;


class GetToken extends AbstractController
{

    public function execute($args)
    {
        $postParams = $this->request->getParsedBody();
        $messages = [];

        return $this->response->withJson($postParams);

        /** @var \Model\User $userModel */
        $userModel = $this->modelFactory->get('user');

        if ($userModel->authenticate($postParams['username'], $postParams['password'])) {

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
            $data["status"] = "ok";
            $data["token"] = $token;

            return $this->response->withStatus(201)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        } else {
            /** @var \SLim\Http\Response $response */
            return $this->response->withJson(['Invalid'], 401);
        }

    }

}

