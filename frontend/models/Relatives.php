<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "relatives".
 *
 * @property string $id
 * @property string $index
 * @property string $sname
 * @property string $fname
 * @property string $mname
 * @property string $bdate
 * @property integer $bday
 * @property string $bmonth
 * @property string $byear
 * @property string $mother_id
 * @property string $father_id
 * @property string $img
 * @property string $bplace
 * @property integer $gender
 * @property string $descr
 * @property string $second_sname
 * @property string $ddate
 * @property string $dday
 * @property string $dmonth
 * @property string $dyear
 * @property string $rod
 * @property integer $visible
 * @property string $last_change
 * @property string $hidden
 * @property integer $show_pict
 * @property double $grave_lon
 * @property double $grave_lat
 * @property string $cemetery_id
 * @property string $grave_picture
 * @property string $created_at
 * @property string $updated_at
 * @property string $fuName
 */
class Relatives extends \yii\db\ActiveRecord
{
//    public $fuName;
    
    const MAN = 0;
    const WOMAN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relatives';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index', 'rod', 'visible', 'last_change', 'created_at', 'updated_at'], 'required'],
            [['bdate', 'ddate', 'last_change', 'created_at', 'updated_at', 'fuName'], 'safe'],
            [['bday', 'mother_id', 'father_id', 'gender', 'visible', 'show_pict', 'cemetery_id'], 'integer'],
            [['grave_lon', 'grave_lat'], 'number'],
            [['index'], 'string', 'max' => 40],
            [['sname', 'mname', 'rod', 'grave_picture'], 'string', 'max' => 50],
            [['fname'], 'string', 'max' => 25],
            [['bmonth', 'dday', 'dmonth'], 'string', 'max' => 2],
            [['byear', 'dyear'], 'string', 'max' => 4],
            [['img'], 'string', 'max' => 100],
            [['bplace', 'second_sname'], 'string', 'max' => 150],
            [['descr', 'hidden'], 'string', 'max' => 3000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'index' => 'Index',
            'sname' => 'Фамилия',
            'fname' => 'Имя',
            'mname' => 'Отчество',
            'bdate' => 'Bdate',
            'bday' => 'День рождения',
            'bmonth' => 'Месяц рождения',
            'byear' => 'Год рождения',
            'mother_id' => 'Мать',
            'father_id' => 'Отец',
            'img' => 'Img',
            'bplace' => 'Место рождения',
            'gender' => 'Пол',
            'descr' => 'Доп. сведения',
            'second_sname' => 'Другие фамилии',
            
            'dday' => 'День смерти',
            'dmonth' => 'Месяц смерти',
            'dyear' => 'Год смерти',
            'rod' => 'Род',
            'visible' => 'Видимость',
            'hidden' => 'Hidden',
            'show_pict' => 'Показывать аватар',
            'grave_lon' => 'Grave Lon',
            'grave_lat' => 'Grave Lat',
            'cemetery_id' => 'Cemetery ID',
            'grave_picture' => 'Grave Picture',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }
    
    public static function getFullName($id)
    {
        $rel = Relatives::findOne($id);
        $result = $rel->sname.' '.$rel->fname.' '.$rel->mname;
        if ($rel->second_sname != '')
        {
            $result .= ' ('.$rel->second_sname.')';
        }
        return $result;
    }
    
    public function getFuName()
    {
        return self::getFullName($this->id);
    }
    
/**
 * Получение даты рождения
 * @param integer $id
 * @return string
 */    
    public static function getBDate($id)
    {
        $rel = Relatives::findOne($id);
        $text = '';
        if ($rel->bday != null)
        {
            $text = $rel->bday.'.';
        }
        if ($rel->bmonth != null)
        {
            if ($rel->bmonth<10)
            {
                $text .= '0'.$rel->bmonth.'.';
            }
            else 
            {
                $text .= $rel->bmonth.'.';
            }
        }
        if ($rel->byear != null)
        {
            $text .= $rel->byear;
        }
        return $text;
    }
    
    public function getDDate()
    {
        $text = '';
        if ($this->dday != null)
        {
            $text = $this->dday.'.';
        }
        if ($this->dmonth != null)
        {
            if ($this->dmonth<10)
            {
                $text .= '0'.$this->dmonth.'.';
            }
            else 
            {
                $text .= $this->dmonth.'.';
            }
        }
        if ($this->dyear != null)
        {
            $text .= $this->dyear;
        }
        return $text;
    }

    public static function getAvatar($id)
    {
        $rel = Relatives::findOne($id);
        $result = '';
        if ($rel->hasAvatar())
        {
            $result = '<img src="/pics/thumb/30_'.$rel->img.'">';
        }
        return $result;
    }
    
    public static function renderRow($id)
    {
        if ($id != NULL)
        {
            $rel = Relatives::findOne($id);
        }
        echo Html::beginTag('tr', ['class' => 'detail']);
            if ($id > 0)
            {
                $text = Html::a(self::getFullName($id), '/relatives/view?id='.$id, ['title' => $rel->descr]);
            }
            else
            {
                $text = 'Нет данных';
            }
            echo Html::tag('td', $text);
            //  пол
            if ($id != null)
            {
                if ($rel->gender === null)
                {
                    $text = '<span class="label label-info">Нет данных</span>';
                }
                elseif ($rel->gender)
                {
                    $text = '<span class="label label-woman">Женский</span>';
                }
                elseif (!$rel->gender)
                {
                    $text = '<span class="label label-man">Мужской</span>';
                }
            }
            else
            {
                $text = '';
            }
            echo Html::tag('td', $text, ['class' => 'col-lg-2']);
            //  дата рождения
            if ($id != null)
            {
                $text = self::getBDate($id);
            }
            else { $text = ''; }
            echo Html::tag('td', $text, ['class' => 'col-lg-2']);
            //  аватар
            if ($id != null)
            {
                $text = self::getAvatar($id);
            }
            else { $text = ''; }
            echo Html::tag('td', $text, ['class' => 'col-lg-1']);
        echo Html::endTag('tr');
    }
    
    public function hasAvatar()
    {
        $fileName = 'pics/'.$this->img;
        $result = file_exists($fileName);
        return $result;

    }    
    
    public function hasGraveCoordinates()
    {
        $result = false;
        if (is_float($this->grave_lat) && is_float($this->grave_lon))
        {
            $result = true;
        }
        return $result;        
    }

        public function hasChildren()
    {
        if ($this->gender)
        {
            $field = 'mother_id';
        }
        else
        {
            $field = 'father_id';
        }
        //$result = count(Relatives::find()->where([$field => $this->id])->all());
        $result = count(Relatives::findAll([$field => $this->id]));
        return $result;
    }
    
    public function getParents()
    {
        $result = FALSE;
        if ($this->father_id != null)
        {
            $result[] = Relatives::findOne($this->father_id);
        }
        if ($this->mother_id != null)
        {
            $result[] = Relatives::findOne($this->mother_id);
        }
        return $result;
    }
}
