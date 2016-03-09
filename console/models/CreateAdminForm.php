<?php
namespace console\models;

use Yii;
use yii\base\Model;

/**
 * Create admin from
 */
class CreateAdminForm extends Model
{
    public $email;
    public $username;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => User::className(),
                'message'     => 'This username has already been taken.',
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message'     => 'This email address has already been taken.',
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email'    => 'E-mail',
            'password' => 'Пароль',
        ];
    } // end attributeLabels()

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function create()
    {
        if ($this->validate()) {
            $user           = new User();
            $user->username = $this->username;
            $user->email    = $this->email;
            $user->role     = User::ROLE_ADMIN;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
