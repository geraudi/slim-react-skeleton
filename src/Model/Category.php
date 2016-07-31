<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Model;

use Lib\Model\AbstractModel;

class Category extends AbstractModel
{

    protected $table = 'category';

    protected $fieldSet = [
        'id',
        'name_fr',
        'name_en',
        'parent_id'
    ];


}