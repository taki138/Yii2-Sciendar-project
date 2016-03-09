<?php
namespace backend\models;

use Yii;
use common\models\Article as _Article;

/**
 *
 */
class Article extends _Article
{
    /**
     * @var int
     */
    public $createdAtFilter;
    /**
     * @var int
     */
    public $updatedAtFilter;
    /**
     * @var string
     */
    public $userEmailFilter;
}