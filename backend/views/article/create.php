<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <div class="row">
        <h1 class="col-sm-10 col-sm-offset-2">
            <?= Html::encode($this->title) ?>
        </h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'isNew' => true,
        'labelSpan' => 2,
    ]) ?>

</div>
