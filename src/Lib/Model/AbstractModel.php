<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Lib\Model;

abstract class AbstractModel
{

    protected $table;

    protected $fieldSet = array();

    protected $privateFields = array();

    /**
     * @var \PDO
     */
    private $_db;

    protected $_slubHandler;


    public function __construct(\PDO $db, $slugHandler)
    {
        $this->_db = $db;
        $this->_slubHandler = $slugHandler;
    }

    protected function _getPublicFields()
    {
        return array_diff($this->fieldSet, $this->privateFields);
    }

    protected function _transliterate($text)
    {
        return call_user_func($this->_slubHandler.'::transliterate', $text);
    }

    protected function _urlize($text)
    {
        return call_user_func($this->_slubHandler.'::urlize', $text);
    }

    protected function _canonicalize($text)
    {
        if (null === $text) {
            return null;
        }
        $encoding = mb_detect_encoding($text);
        $result = $encoding
            ? mb_convert_case($text, MB_CASE_LOWER, $encoding)
            : mb_convert_case($text, MB_CASE_LOWER);
        return $result;
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
            ' SELECT ' . implode(',', $this->_getPublicFields()) .
            ' FROM ' . $this->table .
            ' WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }
}