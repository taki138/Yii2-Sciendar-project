<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Update Article: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">

    <div class="row">
        <h1 class="col-sm-10 col-sm-offset-2">
            <?= Html::encode($this->title) ?>
        </h1>
    </div>

    <?= $this->render('_form', [
        'model'     => $model,
        'isNew'     => false,
        'labelSpan' => 2,
    ]) ?>

</div>
