<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email:E-mail',
            // 'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    switch ($model->status) {
                        case $model::STATUS_ACTIVE: $status = 'active'; $class = 'success'; break;
                        case $model::STATUS_DELETED: $status = 'deleted'; $class = 'danger'; break;
                        case $model::STATUS_INACTIVE: $status = 'inactive'; $class = 'warning'; break;
                        default: $status = 'undefined'; break;
                    }
                    return '<span class="label label-'.$class.'">'.$status.'</span>';
                },
                'options' => ['width' => '120'],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute'=>'createdAt',
                'value' => function ($model, $index, $widget) {
                    return date('h:m:s d.m.Y', $model->created_at);
                },
                'width' => '200px',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format'         => 'dd.mm.yyyy',
                        'autoclose'      => true,
                        'todayHighlight' => true,
                    ]
                ],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute'=>'updatedAt',
                'value' => function ($model, $index, $widget) {
                    return date('h:m:s d.m.Y', $model->updated_at);
                },
                'width' => '200px',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format'         => 'dd.mm.yyyy',
                        'autoclose'      => true,
                        'todayHighlight' => true,
                    ]
                ],
            ],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
