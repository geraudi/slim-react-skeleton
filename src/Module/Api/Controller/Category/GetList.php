<?php

namespace Module\Api\Controller\Category;

use Lib\Controller\AbstractController;

class GetList extends AbstractController
{

    public function execute($args)
    {
        /** @var \Model\User $userModel */
        $model = $this->modelFactory->get('category');
        return $this->response->withJson($model->getList());
    }

}

