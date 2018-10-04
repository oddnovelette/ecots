<?php
namespace application\forms;

use yii\base\Model;

/**
 * Class LoginForm
 * @package common\forms
 */
class LoginForm extends Model
{
    public $username, $password;
    public $rememberMe = true;

    public function rules() : array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
}