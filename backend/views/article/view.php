<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this  yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = [
    'id',
    [
        'attribute' => 'created_at',
        /*'format' => ['date', 'php:Y-m-d'],*/
        'value'=> $model->getCreatedAtFormat($model),
        'format' => 'raw',
    ],
    [
        'attribute' => 'updated_at',
        'value'=> $model->getUpdatedAtFormat($model),
        'format' => 'raw',
    ],
    [
        'attribute' => 'user_id',
        'label' => 'Author ID',
    ],
    [
        'label' => 'Author E-mail',
        'value' => $model->user->email,
    ],
    'title',
    'text:html',
    'description',
    'preview_text:html',
    [
        'label' => 'Preview Image',
        'format' => 'html',
        'value' => Html::img($model->previewImagePath, ['style' => 'width: 400px']),
        'style' => 'width: 100px'
//        'preview_image',
    ],
];
?>

<div class="article-view">

    <p>
        <?php /* = Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */ ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'condensed'  => true,
        'hover'      => true,
        'mode'       => DetailView::MODE_VIEW,
        'buttons1' => '{delete}',
        'panel'      => [
            'heading' => 'Article: ' . $model->title,
            'type'    => DetailView::TYPE_INFO,
        ],
       'deleteOptions' => [
           'params' => ['id' => $model->id, 'kvdelete'=>1],
//           'url' => Url::toRoute(['/article/delete', 'id' => $model->id]),
       ],
       'attributes' => $attributes,
    ]) ?>

</div>
