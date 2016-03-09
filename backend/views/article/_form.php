<?php

use backend\models\Article;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this      yii\web\View */
/* @var $model     backend\models\ArticleCreate|backend\models\ArticleUpdate */
/* @var $form      yii\widgets\ActiveForm */
/* @var $isNew     boolean */
/* @var $labelSpan integer */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => $labelSpan, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>


    <?php if (!$isNew): ?>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?= Html::img($model->previewImagePath, ['style' => 'width: 400px']) ?>
            </div>
        </div>
    <?php endif ?>
    <?= $form->field($model, 'previewImageFile')->fileInput()->label('Update preview image') ?>

    <?= $form->field($model, 'status')->dropDownList([
        Article::STATUS_ACTIVE => 'Активна',
        Article::STATUS_DRAFT  => 'Набросок',
    ]) ?>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <?= Html::submitButton($isNew ? 'Create' : 'Update', ['class' => $isNew ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
