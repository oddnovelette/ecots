<?php
namespace application\forms;

use yii\base\Model;
use application\models\User;

/**
 * Class SignupForm
 * @package frontend\forms
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
}