<?php
/**
 *
 * @author Géraud ISSERTES <gissertes@galilee.fr>
 * @copyright © 2015 Galilée (www.galilee.fr)
 */

namespace Model;

use Lib\Model\AbstractModel;

class User extends AbstractModel
{

    protected $table = 'user';

    protected $fieldSet = [
        'id',
        'username',
        'email',
        'username_canonical',
        'email_canonical',
        'enabled',
        'salt',
        'password',
        'last_login',
        'locked',
        'expired',
        'expires_at',
        'register_date',
        'folder',
        'avatar'
    ];


    public function getByEmail($email)
    {
        $stmt = $this->getDb()->prepare('select * FROM ' . $this->table . ' WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function authenticate($credential, $password)
    {
        $result = null;
        $stmt = $this->getDb()->prepare(
            'select username, email, password FROM '
            . $this->table
            . ' WHERE email_canonical = :slugCredential OR username_canonical = :credential');
        $stmt->execute([
            'credential'     => $credential,
            'slugCredential' => $this->slugify->slugify($credential)
        ]);
        $user = $stmt->fetch();
        if ($user && ($user['password'] == md5('sdsriHHsq786DFHSDsedgKZd900Ahry' . $password))) {
            unset ($user['password']);
            $result = $user;
        }
        return $result;
    }

}