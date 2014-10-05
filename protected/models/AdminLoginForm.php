<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * login login form data. It is used by the 'login' action of 'SiteController'.
 */
class AdminLoginForm extends CFormModel
{
    public $username;
    public $password;
    public $rememberMe;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required', 'message' => 'Поле "{attribute}" не может быть пустым '),
            // password needs to be authenticated
            array('password', 'authenticate', 'message' => 'Неверный пароль'),
            array('rememberMe', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe' => 'Запомнить меня',
            'username' => 'Логин',
            'password' => 'Пароль',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) // we only want to authenticate when no input errors
        {
            $identity = new AdminIdentity($this->username, $this->password);
            $identity->authenticate();
            switch ($identity->errorCode) {
                case AdminIdentity::ERROR_NONE:
                    $duration = $this->rememberMe ? 3600 * 24 * AdminIdentity::PASSWORD_EXPIRE : 0;
                    Yii::app()->user->login($identity, $duration);
                    break;
                case AdminIdentity::ERROR_USERNAME_INVALID:
                    $this->addError('username', 'Неверный логин');
                    break;
                default: // UserIdentity::ERROR_PASSWORD_INVALID
                    $this->addError('password', 'Неверный пароль');
                    break;
            }
        }
    }
}
