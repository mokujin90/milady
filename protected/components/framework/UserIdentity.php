<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {

        $criteria = new CDbCriteria();
        $criteria->addCondition('LOWER(login) = :login AND is_active = 1');
        $criteria->params = array(':login' =>mb_strtolower($this->username));
        $user = User::model()->find($criteria);
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($this->password !== $user->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
            $user->last_login_date = Candy::currentDate();
            $user->save(false);
        }
        $this->onAfterLogin(new CEvent($this));
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function onAfterLogin($event)
    {
        Direct::remove();
        $this->raiseEvent('onAfterLogin', $event);
    }

    public static function createAuthenticatedIdentity($model) {
        $identity = new self($model->login,$model->password);
        $identity->_id=$model->id;
        $identity->errorCode=self::ERROR_NONE;
        return $identity;
    }
}