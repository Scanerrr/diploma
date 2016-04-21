<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required', 'message' => '{attribute} не может быть пустым'],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким именем уже существует.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Имя должно быть не короче {min} символов'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email', 'message' => 'Неправильный Email.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким Email уже существует.'],

            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен быть не короче {min} символов'],

            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'message' => '{attribute} введен неправильно.'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Email',
            'verifyCode' => 'Код проверки',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
