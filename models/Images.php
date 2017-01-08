<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property string $imageUrl
 * @property string $time
 * @property integer $featured
 * @property integer $albums_id
 *
 * @property Albums $albums
 * @property ImagesHasTags[] $imagesHasTags
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public $file = [];
    public function rules()
    {
        return [
            [['imageUrl', 'albums_id'], 'required'],
            [['time'], 'safe'],
            [['featured', 'albums_id'], 'integer'],
            [['imageUrl'], 'unique'],
            [['imageUrl'], 'string', 'max' => 100],
            [['albums_id'], 'exist', 'skipOnError' => true, 'targetClass' => Albums::className(), 'targetAttribute' => ['albums_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'imageUrl' => 'Image Url',
            'time' => 'Time',
            'featured' => 'Featured',
            'albums_id' => 'Albums ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasOne(Albums::className(), ['id' => 'albums_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesHasTags()
    {
        return $this->hasMany(ImagesHasTags::className(), ['images_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesQuery(get_called_class());
    }

}
