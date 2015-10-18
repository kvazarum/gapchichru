<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "families".
 *
 * @property string $id
 * @property string $husband_id
 * @property string $wife_id
 * @property string $mdate
 * @property string $descr
 * @property string $created_at
 * @property string $updated_at
 * @property Relatives $wife
 * @property Relatives $husband
 */
class Families extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'families';
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
            [['husband_id', 'wife_id'], 'required'],
//            [[], 'integer'],
            [['mdate', 'created_at', 'updated_at', 'husband_id', 'wife_id'], 'safe'],
            [['descr'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'husband_id' => 'Муж',
            'wife_id' => 'Жена',
            'mdate' => 'Дата свадьбы',
            'descr' => 'Описание',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getWife()
    {
        return $this->hasOne(Relatives::className(), ['id' => 'wife_id']);
    }    
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getHusband()
    {
        return $this->hasOne(Relatives::className(), ['id' => 'husband_id']);
    }    
    
/**
 * 
 * @param type $id
 */    
    public static function getFamilies($id)
    {
        $families = Families::find()->where(['wife_id' => $id])
                ->orWhere(['husband_id' => $id])->all();
        return $families;
    }
    
    
    public function getChildren()
    {
        $children = Relatives::find()->where(['father_id' => $this->husband_id])
                ->andWhere(['mother_id' => $this->wife_id])->all();
        
        return $children;
    }
}
