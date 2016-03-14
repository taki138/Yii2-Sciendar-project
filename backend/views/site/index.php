<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <p><a class="btn btn-sm btn-success" href=
        <?=
            Yii::$app->homeUrl . '/user/index';
        ?>
    >Users</a></p>
    <p><a class="btn btn-sm btn-success" href=
        <?=
            Yii::$app->homeUrl . 'article/index';
        ?>
    >Articles</a></p>
    <p><a class="btn btn-sm btn-success" href=
        <?=
            Yii::$app->homeUrl . 'feedback/index';
        ?>
    >Feedback</a></p>
</div>
