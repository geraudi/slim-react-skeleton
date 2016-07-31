<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Lib\Model;

use Cocur\Slugify\Slugify;

abstract class AbstractModel
{

    protected $table;

    protected $fieldSet = array();

    /**
     * @var \PDO
     */
    private $_db;

    public $slugify;


    public function __construct(\PDO $db, Slugify $slugify)
    {
        $this->_db = $db;
        $this->slugify = $slugify;
    }

    /**
     * @return \PDO
     */
    public function getDb()
    {
        return $this->_db;
    }


    public function getList()
    {
        $stmt = $this->getDb()->query(
            ' SELECT ' . implode(',', $this->fieldSet) .
            ' FROM ' . $this->table);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->getDb()->prepare(
            ' SELECT ' . implode(',', $this->fieldSet) .
            ' FROM ' . $this->table .
            ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        //$stmt->debugDumpParams();

        return $stmt->fetch();
    }
}