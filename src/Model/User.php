<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Model;

use Aura\Di\Exception;
use Lib\Model\AbstractModel;

class User extends AbstractModel
{

    protected $table = 'user';

    protected $fieldSet = [
        'id',
        'username',
        'username_canonical',
        'email',
        'email_canonical',
        'enabled',
        'salt',
        'password',
        'last_login',
        'locked',
        'expired',
        'expires_at',
        'confirmation_token',
        'password_requested_at',
        'roles',
        'credentials_expired',
        'credentials_expire_at',
        'register_date',
    ];

    protected $privateFields = [
        'enabled',
        'salt',
        'password',
        'last_login',
        'locked',
        'expired',
        'expires_at',
        'confirmation_token',
        'password_requested_at',
        'roles',
        'credentials_expired',
        'credentials_expire_at',
        'register_date',
    ];

    protected $_algorithm = 'sha512';

    public function getByEmail($email)
    {
        $stmt = $this->getDb()->prepare('select ' . implode(', ', $this->_getPublicFields()) . ' FROM ' . $this->table . ' WHERE email_canonical = :email');
        $stmt->execute(['email' => $this->_canonicalize($email)]);
        return $stmt->fetch();
    }


    public function authenticate($credential, $password)
    {
        $result = null;
        $q = 'select username, email, password, salt FROM '
            . $this->table
            . ' WHERE email_canonical = :credentialCanonical OR username_canonical = :credentialCanonical';

        $stmt = $this->getDb()->prepare($q);
        $stmt->execute([
            'credentialCanonical' => $this->_canonicalize($credential)
        ]);

        $user = $stmt->fetch();
        if ($user) {
            if ($user['password'] == bin2hex(hash($this->_algorithm, $user['salt'] . $password, true)) ) {
                $result = $this->getByEmail($user['email']);
            }
        }

        return $result;
    }

    public function register($params)
    {
        $salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $passwordHash = bin2hex(hash($this->_algorithm, $salt . $params['password'], true));

        $fields = array(
            'username'            => $params['username'],
            'username_canonical'  => $this->_canonicalize($params['username']),
            'email'               => $params['email'],
            'email_canonical'     => $this->_canonicalize($params['email']),
            'enabled'             => 1,
            'salt'                => $salt,
            'password'            => $passwordHash,
            'locked'              => 0,
            'expired'             => 0,
            'roles'               => serialize(['user']),
            'credentials_expired' => 0,
            'register_date'       => date("Y-m-d H:i:s"),
        );

        foreach ($fields as $key => $value) {
            $fields[$key] = $this->getDb()->quote($value);
        }

        $field = '`' . implode('`,`', array_keys($fields)) . '`';
        $values = implode(",", $fields);

        $q = "INSERT INTO `user` ($field) VALUES ($values)";

        $this->getDb()->exec($q);

        return $this->getByEmail($params['email']);

    }

}