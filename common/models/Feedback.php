<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\models\User;

class Feedback extends ActiveRecord
{
	public function behaviors()
	{
	    return [
	        // TimestampBehavior::className(),
	        [
	            // 'class' => 'yii\behaviors\TimestampBehavior',
	            'class' => TimestampBehavior::className(),
	            'updatedAtAttribute' => null,
        	],
	    ];
	}

	public static function tableName()
	{
		return '{{%feedback}}';
	}

/*
	$myTimestamp = new TimestampBehavior();
	$myTimestamp->updatedAtAttribute = null;

	$myTimestamp = Yii::createObject('', [
		'updatedAtAttribute' => null
	]);
*/

	// public $date;

	public function rules() {
		return [
			[[/*'date', */'text', 'rating'/*, 'email'*/], 'required', 'message' => 'Поле обязательно для заполнения'],
			[['text'], 'string', 'min' => 10, 'tooShort' => 'Текст должен быть более 10 символов'],

			// [['email'], 'email', 'message' => 'Неправильный формат email'],

			// [['date'], 'date', 'format' => 'php:Y-m-d', 'timestampAttribute' => 'created_at'],

			// [['date'], function ($attribute, $params) {
			// 	$res = \DateTime::createFromFormat('Y-m-d', $this->$attribute);
			// 	if ($res === false) {
			// 		$this->addError($attribute, 'Неправильный формат даты');
			// 	}
			// }],

		];
	}
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}