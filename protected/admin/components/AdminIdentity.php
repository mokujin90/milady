<?php
class AdminIdentity extends CUserIdentity
{
    const PASSWORD_EXPIRE = 60; // days

    private $_id;

    public function authenticate()
    {
        $username = strtolower($this->username);
        $user = Admin::model()->find('LOWER(login)=?', array($username));

        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($this->password !== $user->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->username = null;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}