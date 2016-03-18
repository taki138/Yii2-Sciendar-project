<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        // 'responsive'=>true,
        // 'hover'=>true,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'user_id',
            [
                'attribute' => 'userEmail',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->user ? $model->user->email : '<span class="text-muted">(Анонимный)</span>';
                },
            ],
            'text:ntext',
            'rating',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute'=>'createdAt',
                // 'format' => ['date', 'php:Y.m.d'],
                'value' => function ($model, $index, $widget) {
                    return date('Y.m.d', $model->created_at);
                },
                'width' => '200px',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format'         => 'yyyy.mm.dd',
                        'autoclose'      => true,
                        'todayHighlight' => true,
                    ]
                ],
            ],

           /* [
                'attribute' => 'createdAt',
                'value' => function($model) {
                    return date('Y.m.d', $model->created_at);
                },
                // 'format' => ['date', 'php:Y.m.d'],
            ],*/
            // [
            //     'attribute' => 'rating',
            //     'value' => function($model) {
            //         $result = '';
            //         for ($i = 0; $i < $model->rating; $i++) $result .= '*';
            //         return $result;
            //     },
            // ],
            // 'rating',
            // 'email:email',

            [ 'class' => 'kartik\grid\ActionColumn' ],
        ],
    ]); ?>

</div>
