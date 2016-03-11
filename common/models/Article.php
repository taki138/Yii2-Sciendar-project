<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property string  $id
 * @property string  $title
 * @property string  $text
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property string  $description
 * @property string  $preview_text
 * @property string  $preview_image
 * @property integer $status
 * @property string  $previewImagePath
 *
 * @property User    $user
 */
class Article extends ActiveRecord
{
    const PATH = '/article/';

    const STATUS_ACTIVE = 10;
    const STATUS_DRAFT  = 0;

    private $_pathUrl;
    private $_pathRoot;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'preview_text'], 'string'],
            ['status', 'in', 'range' => [static::STATUS_DRAFT, static::STATUS_ACTIVE]],
            [['created_at', 'updated_at', 'user_id'], 'integer'],
            [['user_id'], 'required'],
            [['title', 'description', 'preview_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'title'         => 'Title',
            'text'          => 'Text',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
            'user_id'       => 'User ID',
            'description'   => 'Description',
            'preview_text'  => 'Preview Text',
            'preview_image' => 'Preview Image',
        ];
    }

    /**
     * Получить полный путь к картинке
     *
     * @param bool $isUrl URL или путь в файловой системе(false)
     *
     * @return null|string
     */
    public function getPreviewImagePath($isUrl = true)
    {
        if ( !$this->preview_image) return null;
        if ($isUrl) {
            if ( !$this->_pathUrl) {
                $this->_pathUrl = Yii::getAlias('@images' . static::PATH . $this->preview_image);
            }

            return $this->_pathUrl;
        } else {
            if ( !$this->_pathRoot) {
                $this->_pathRoot = Yii::getAlias('@imagesroot' . static::PATH . $this->preview_image);
            }

            return $this->_pathRoot;
        }
    }

    /**
     * Generate unique fit image name.
     * If the name exists, it will be not regenerate
     *
     * @param string $ext image file extension
     *
     * @return string name
     */
    public function generatePreviewImageName($ext)
    {
            if ($this->preview_image) return $this->preview_image;

            do // generate unique name
            {
                $name = Yii::$app->getSecurity()
                                 ->generateRandomString(30) . ".$ext";
            } while (static::findOne(['preview_image' => $name])); // if exists - regenerate

            $this->preview_image = $name;
            return $name;
    } // end generateName()

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
