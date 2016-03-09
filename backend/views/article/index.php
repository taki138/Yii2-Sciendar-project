<?php
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Articles';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    'id',
    'title',
    'description',
    [
        'attribute' => 'createdAtFilter',
        'value'     => 'created_at',
        'format'    => ['date', 'php:Y-m-d'],

        'width'               => '200px',
        'filterType'          => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format'         => 'yyyy-mm-dd',
                'autoclose'      => true,
                'todayHighlight' => true,
            ],
        ],
    ],
    [
        'attribute' => 'updatedAtFilter',
        'value'     => 'updated_at',
        'format'    => ['date', 'php:Y-m-d'],

        'width'               => '200px',
        'filterType'          => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format'         => 'yyyy-mm-dd',
                'autoclose'      => true,
                'todayHighlight' => true,
            ],
        ],
    ],
    [
        'attribute' => 'userEmailFilter',
        'value'     => 'user.email',
    ],
    [
        'label'  => 'Preview Image',
        'format' => 'html',
        'mergeHeader' => true,
        'value' => function ($model) {
            return Html::img($model->previewImagePath, [
                'alt'   => 'Картинка в Grid View',
                'style' => 'width: 100px',
            ]);
        },
    ],

    ['class' => 'kartik\grid\ActionColumn'],
];
?>
<div class="article-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,

        'pjax' => true,

        'panel' => [
            'type'    => GridView::TYPE_DEFAULT,
            'heading' => 'Users',
            'before'  => Html::a('<i class="glyphicon glyphicon-plus"></i> Create an article', ['create'],
                ['class' => 'btn btn-success']),
            'after'   => false,
        ],

        'columns' => $columns,
    ]); ?>

</div>
