<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Session;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'message' => '{attribute} не може бути порожнім.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => "Ім'я користувача",
            'password' => 'Пароль',
            'rememberMe' => "Запам'ятати мене",
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     * @return boolean
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                Yii::$app->session->setFlash('error', "Неправильне ім'я користувача або пароль");
                return false;
            }
        }
        return true;
    }

    /**
     * Logs in a user using the provided username and password.
     * @param $backend boolean whether login is called on backend.
     * @return boolean whether the user is logged in successfully
     */
    public function login($backend = false)
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user) {

                $session = new Session();
                $session->open();
                $session['role'] = $user->role;

                if ($backend) {
                    if ($this->_user->role != User::ROLE_STUDENT) {
                        return Yii::$app->user->login($this->_user, 0);
                    } else {
                        Yii::$app->session->setFlash('error', 'У даного користувача немає прав доступу.<br> Зверніться до адміністратора.');
                        return false;
                    }
                } else {
                    return Yii::$app->user->login($this->_user, 0);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
