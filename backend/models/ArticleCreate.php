<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class ArticleCreate extends Model
{
    public $title;
    public $description;
    public $text;
    public $preview_text;
    public $status;

    /**
     * @var UploadedFile
     */
    public $previewImageFile;

    public function rules()
    {
        return [
            [['title', 'description', 'text', 'preview_text', 'status'], 'required'],

            [['title', 'description'], 'string', 'max' => 255],
            [['text', 'preview_text'], 'string'],

            [
                ['previewImageFile'],
                'image',
                'skipOnEmpty' => true,
//                'maxSize'     => 1024 * 600, // 600KB
                // 'maxFiles'    => 1,
                'mimeTypes'   => ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'],
                'extensions'  => ['jpg', 'jpeg', 'gif', 'png'],
//                'minWidth'    => 300,
//                'maxWidth'    => 2000,
//                'minHeight'   => 300,
//                'maxHeight'   => 2000,
            ],

            ['status', 'default', 'value' => Article::STATUS_DRAFT],
        ];
    }

    /**
     * Создать статью и загрузить изображение
     *
     * @return Article|null - Объект созданной статьи или null если создать не удалось
     *
     * @throws \yii\db\Exception
     * @throws \yii\web\ServerErrorHttpException
     */
    public function create()
    {
        if (!$this->validate()) return null;

        $article               = new Article();

        $article->title        = $this->title;
        $article->text         = $this->text;
        $article->description  = $this->description;
        $article->preview_text = $this->preview_text;
        $article->status       = $this->status;
        $article->user_id      = Yii::$app->user->id;
        // $article->preview_image = null;
        // $article->generatePreviewImageName($this->previewImageFile->extension);

            if ( empty($this->previewImageFile->extension) ) {
                $article->preview_image = null;
            } else {
               $article->generatePreviewImageName($this->previewImageFile->extension);
            }

        $transaction = Yii::$app->db->beginTransaction();

        if ( !$article->save()) {
            Yii::warning( Json::encode($article->getErrors()), 'custom' );
            throw new ServerErrorHttpException('Can not create article for unknown reason');
        }

        if ( empty($this->previewImageFile->extension) ) {

            $transaction->commit();
            return $article;

        } else {

            if ( ! $this->previewImageFile->saveAs($article->getPreviewImagePath(false), true) ) {
                $transaction->rollBack();
                throw new ServerErrorHttpException('Can not upload preview image for unknown reason');
            }

            $transaction->commit();
            return $article;
        }
    }
}