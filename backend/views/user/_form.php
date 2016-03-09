<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([
		$model::STATUS_ACTIVE  => 'Active',
		$model::STATUS_DELETED => 'Deleted',
        $model::STATUS_INACTIVE => 'Inactive',
    ]) ?>
    <?= $form->field($model, 'createdAtFormat')->staticInput() ?>
    <?= $form->field($model, 'updatedAtFormat')->staticInput() ?>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
