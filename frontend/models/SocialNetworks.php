<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "social_networks".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $title
 *
 * @property SocialNetworksRecords[] $socialNetworksRecords
 */
class SocialNetworks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_networks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'img', 'title'], 'required'],
            [['title'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'img' => 'Img',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialNetworksRecords()
    {
        return $this->hasMany(SocialNetworksRecords::className(), ['network_id' => 'id']);
    }
}
