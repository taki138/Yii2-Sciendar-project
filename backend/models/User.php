<?php
namespace backend\models;

use common\models\User as _User;
use yii\helpers\ArrayHelper;

class User extends _User
{
	/**
     * @var int
     */
    public $createdAtFilter;
    /**
     * @var int
     */
    public $updatedAtFilter;

	public function rules()
	{
		$parent = parent::rules();

		$parent = ArrayHelper::merge($parent, [
			['username', 'string', 'max' => 255],
            ['email', 'email'],
		]);

		return $parent;
	}
    public function getUserStatus($model) {
        switch ($model->status) {
            case $model::STATUS_ACTIVE: $status = 'active'; $class = 'success'; break;
            case $model::STATUS_DELETED: $status = 'deleted'; $class = 'danger'; break;
            case $model::STATUS_INACTIVE: $status = 'inactive'; $class = 'warning'; break;
            default: $status = 'undefined'; break;
        }
        return '<span class="label label-'.$class.'">'.$status.'</span>';
    }
}
