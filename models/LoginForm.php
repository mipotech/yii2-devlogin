<?php

namespace mipotech\devlogin\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    /**
     *
     * @var string $password
     */
    public $password;

    /**
     *
     * @var string $redirectUrl The URL to which to redirect after successful login
     */
    public $redirectUrl;

    /**
     *
     * @var string $username
     */
    public $username;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['redirectUrl', 'string'],
        ];
    }

    /**
     * Try to perform the actual login
     *
     * @return boolean
     */
    public function login()
    {
        if ($this->username == Yii::$app->devlogin->username && $this->password == Yii::$app->devlogin->password) {
            return true;
        } else {
            $this->addError('username', 'Invalid username/password');
        }
    }
}
