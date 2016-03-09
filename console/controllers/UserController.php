<?php
namespace console\controllers;

use console\models\CreateAdminForm;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class UserController extends Controller
{
    /**
     * @var string пароль админа
     */
    public $password;

    /**
     * @var string e-mail админа
     */
    public $email;

    /**
     * @var string username админа
     */
    public $username;

    public function options($actionID)
    {
        return ['password', 'email', 'username'];
    }

    public function actionCreateAdmin()
    {
        $user = new CreateAdminForm();

        $user->password = $this->password;
        $user->email    = $this->email;
        $user->username = $this->username;

        if ($user->create()) {
            $this->stdout("User created successful\n");
            return static::EXIT_CODE_NORMAL;
        }

        if ($user->hasErrors()) {
            foreach ($user->getErrors() as $one) {
                $this->stderr($one[0]."\n", Console::FG_RED);
            }

            return static::EXIT_CODE_ERROR;
        }



    }
}