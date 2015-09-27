<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "photos".
 *
 * @property string $id
 * @property string $name
 * @property string $descr
 * @property string $relative_id
 *
 * @property Relatives $relative
 */
class Photos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'relative_id'], 'required'],
            [['descr'], 'string'],
            [['relative_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['relative_id'], 'exist', 'skipOnError' => true, 'targetClass' => Relatives::className(), 'targetAttribute' => ['relative_id' => 'id']],
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
            'descr' => 'Примечание',
            'relative_id' => 'Relative ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelative()
    {
        return $this->hasOne(Relatives::className(), ['id' => 'relative_id']);
    }
}
