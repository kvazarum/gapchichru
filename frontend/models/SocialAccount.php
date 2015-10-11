<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "social_account".
 *
 * @property integer $id
 * @property integer $network_id
 * @property integer $relative_id
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 * @property Relatives $relative
 * @property SocialNetworks $network
 */
class SocialAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_account';
    }
    
    /**
     * @inheritdoc
     */
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
            [['network_id', 'relative_id', 'url',], 'required'],
            [[], 'integer'],
            [['created_at', 'updated_at', 'network_id', 'relative_id'], 'safe'],
            [['url'], 'string', 'max' => 100],
            [['network_id'], 'exist', 'skipOnError' => true, 'targetClass' => SocialNetworks::className(), 'targetAttribute' => ['network_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'network_id' => 'Сеть',
            'relative_id' => 'Родственник',
            'url' => 'Url',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetwork()
    {
        return $this->hasOne(SocialNetworks::className(), ['id' => 'network_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelative()
    {
        return $this->hasOne(Relatives::className(), ['id' => 'relative_id']);
    }    
}
