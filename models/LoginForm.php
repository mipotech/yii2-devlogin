<?php

namespace mipotech\devlogin\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    /**
     *
     * @var string $username
     */
    public $username;

    /**
     *
     * @var string $password
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
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
