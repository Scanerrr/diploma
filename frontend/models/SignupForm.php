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
    public $name;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'name'], 'required', 'message' => '{attribute} не може бути порожнім'],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Користувач з таким ім\'ям уже існує.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => '{attribute} повинно складати {min} символів'],

            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => '{attribute} повинно складати {min} символів'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email', 'message' => 'Неправильный Email.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Коритсувач з таким Email вже існує.'],

            ['password', 'string', 'min' => 6, 'tooShort' => '{attribute} повинен складати {min} символів'],

            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'message' => '{attribute} введен неправильно.'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Логін',
            'password' => 'Пароль',
            'name' => "Ім'я користувача",
            'email' => 'Email',
            'verifyCode' => 'Код перевірки',
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
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
