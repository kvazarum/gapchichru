<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cemeteries".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property double $latitude
 * @property double $longitude
 * @property string $created_at
 * @property string $updated_at
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
            [['title', 'description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
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
