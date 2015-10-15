<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cemeteries".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property double $latitude
 * @property double $longitude
 * @property integer $created_at
 * @property integer $updated_at
 */
class Cemeteries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cemeteries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'latitude', 'longitude', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['title', 'description', 'created_at', 'updated_at'], 'safe'],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }
}
