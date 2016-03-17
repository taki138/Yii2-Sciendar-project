<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php foreach($feeds as $feed): ?>

		<div class="feed">
			<h4><?=$feed->user ? $feed->user->username : 'Anonimus'?> <span class="text-muted"><?=date('Y-m-d H:i:s', $feed->created_at) ?></span></h4>
			<p><?=$feed->text?></p>
			<div class="rating">
					<?php for ($i = 1; $i < $feed->rating; $i++ ): ?>
						<span>*</span>
					<?php endfor ?>
					<?php /* =$feed->rating */ ?>
			</div>
			<hr>
		</div>

<?php endforeach ?>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'feedback-form']); ?>

            <?= $form->field($feedback, 'text')->textarea() ?>
            <?php // = $form->field($feedback, 'email') ?>
            <?= $form->field($feedback, 'rating') ?>
            <?php /*= $form->field($feedback, 'date') */ ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'feedback-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>