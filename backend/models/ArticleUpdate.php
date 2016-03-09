<?php
namespace backend\models;

use common\models\Article;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class ArticleUpdate extends Article
{
    const SCENARIO_UPDATE = 'update';

    /**
     * @var UploadedFile
     */
    public $previewImageFile;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [
                ['previewImageFile'],
                'image',
                'mimeTypes'   => ['image/jpg', 'image/jpeg', 'image/gif'],
                'extensions'  => ['jpg', 'jpeg', 'gif'],
            ],
        ]);
    }

    public function init()
    {
        $this->on(static::EVENT_AFTER_VALIDATE, function() {
            if ($this->previewImageFile) {
                $this->generatePreviewImageName($this->previewImageFile->extension);

                if ( ! $this->previewImageFile->saveAs($this->getPreviewImagePath(false), true) ) {
                    throw new ServerErrorHttpException('Can not upload preview image for unknown reason');
                }
            }
        });

    }

    public function transactions()
    {
        return [
            static::SCENARIO_UPDATE => static::OP_UPDATE,
        ];
    }

    public function scenarios()
    {
        return [
            static::SCENARIO_UPDATE => [
                'title',
                'text',
                'description',
                'preview_text',
                'status',
                'previewImageFile',
            ],
        ];
    }
}