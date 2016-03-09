<?php
namespace backend\models;

use Yii;
use common\models\LoginForm as _LoginForm;
use yii\helpers\ArrayHelper;

class LoginForm extends _LoginForm
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['username', 'validateRole'],
        ]);
    }

    /**
     * Validates the role.
     * This method serves as the inline validation for user role.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateRole($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validateRole(User::ROLE_ADMIN)) {
                $this->addError($attribute, 'Only administrators can login to backend');
            }
        }
    }

}