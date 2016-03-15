<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

    $columns = [
    'id',
    'username',
    'email:email:E-mail',
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
        'attribute' => 'createdAtFilter',
        'value'     => 'created_at',
        'format'    => ['date', 'php: h:m:s d.m.Y'],
        'width'               => '200px',
        'filterType'          => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format'         => 'dd-mm-yyyy',
                'autoclose'      => true,
                'todayHighlight' => true,
            ],
        ],
    ],
    [
        'attribute' => 'updatedAtFilter',
        'value'     => 'updated_at',
        'format'    => ['date', 'php: h:m:s d.m.Y'],
        'width'               => '200px',
        'filterType'          => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format'         => 'dd-mm-yyyy',
                'autoclose'      => true,
                'todayHighlight' => true,
            ],
        ],
    ],
            ['class' => 'kartik\grid\ActionColumn'],
    ];
    ?>
    <div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'pjax' => true,
        'panel' => [
            'type'    => GridView::TYPE_DEFAULT,
            'heading' => 'Users',
            'before'  => Html::a('<i class="glyphicon glyphicon-plus"></i> Create user', ['create'],
                ['class' => 'btn btn-success']),
            'after'   => false,
        ],
        'columns' => $columns,
    ]); ?>

</div>

</div>
