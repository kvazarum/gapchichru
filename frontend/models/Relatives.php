<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use frontend\models\Cemeteries;

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
 * @property string $last_change
 * @property string $hidden
 * @property double $grave_lon
 * @property double $grave_lat
 * @property string $cemetery_id
 * @property string $grave_picture
 * @property string $created_at
 * @property string $updated_at
 * @property string $fullName
 * @property Cemeteries $cemetery
 */
class Relatives extends \yii\db\ActiveRecord
{    
    const MAN = 0;
    const WOMAN = 1;
//    public $fullName;

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
            [['gender'], 'required'],
            [['bdate', 'ddate', 'last_change', 'created_at', 'updated_at', 'fullName'], 'safe'],
            [['bday', 'mother_id', 'father_id', 'gender', 'show_pict', 'cemetery_id'], 'integer'],
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
            'fullName' => 'Фамилия Имя Отчество',
            'bday' => 'День рождения',
            'bmonth' => 'Месяц рождения',
            'byear' => 'Год рождения',
            'mother_id' => 'Мать',
            'father_id' => 'Отец',
            'img' => 'Img',
            'bplace' => 'Место рождения',
            'gender' => 'Пол',
            'descr' => 'Примечания',
            'second_sname' => 'Другие фамилии',
            'dday' => 'День смерти',
            'dmonth' => 'Месяц смерти',
            'dyear' => 'Год смерти',
            'rod' => 'Род',
            'hidden' => 'Доп. сведения',
            'show_pict' => 'Показывать аватар',
            'grave_lon' => 'Долгота места захоронения',
            'grave_lat' => 'Широта места захоронения',
            'cemetery_id' => 'ID кладбища',
            'grave_picture' => 'Фото кладбища',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }
    
/**
 * Получение полного имени человека
 * @return string полное имя в формате Фамилия Имя Отчество
 */    
    public function getFullName()
    {
        if (!Yii::$app->user->isGuest)
        {
            $fname = $this->fname;
            $mname = $this->mname;
        }
        else
        {
            if (strlen($this->fname) > 1)
            {
                $fname = mb_substr($this->fname, 0, 1).'.';
            }
            else
            {
                $fname = "";
            }
            if (strlen($this->mname) > 1)
            {
                $mname = mb_substr($this->mname, 0, 1).'.';
            }
            else
            {
                $mname = "";
            }             
        }
        
        
        $result = $this->sname.' '.$fname.' '.$mname;
        if ($this->second_sname != '')
        {
            $result .= ' ('.$this->second_sname.')';
        }
        return $result;
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
//        if (Yii::$app->user->can('user'))
        if (Yii::$app->user->can('user'))
        {
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
                $text .= $rel->byear.'г.';
            }
        }
        else
        {
            if ($rel->byear != null)
            {
                $text = $rel->byear.'г.';
            }            
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
                $text = Html::a($rel->getFullName(), '/relatives/view?id='.$id, ['title' => $rel->descr]);
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
                $text = '<div style="float: right;">'.self::getBDate($id).'</div>';
            }
            else { $text = ''; }
            echo Html::tag('td', $text, ['class' => 'col-lg-2']);
            //  аватар
            if ($id != null && !Yii::$app->user->isGuest)
            {
                $text = self::getAvatar($id);
            }
            else { $text = ''; }
            echo Html::tag('td', $text, ['class' => 'col-lg-1']);
        echo Html::endTag('tr');
    }
    
    public function hasAvatar()
    {
        if (!is_null($this->img))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
        
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
    
/**
 * Получение родителей человека
 * @return array
 */    
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
    
/**
 * Получение отца
 * @return Relatives
 */
    public function getFather() {
        $result = $this->hasOne(self::classname(),['father_id' => 'id'])
                -> from(self::tableName() . ' AS father');
        return $result;
    }

/**
 * Получение матери
 * @return Relatives
 */    
    public function getMother() {
        $result = $this->hasOne(self::classname(),['mother_id' => 'id'])
                -> from(self::tableName() . ' AS mother');
        return $result;
    }    
    
/**
 * Получение имени матери
 * @return string
 */    
    public function getMotherName() {
        return $this->mother->fullName;
    }

/**
 * Получение имени отца
 * @return string
 */        
    public function getFatherName() {
        return $this->father->fullName;
    }    
    
    public function setImage($fileName = null)
    {
        $this->img = $fileName;
    }

/**
 * Получение списка родов (фамилий предков) человека
 * @param array $clans
 * @return array
 */
    public function getClans(&$clans = null)
    {
        if ($clans == null)
        {
            $clans = [];
        }
        
        if ($this->rod != null)
        {
            if (!in_array($this->rod, $clans))
            {
                $clans[] = $this->rod;
            }
        }
        if ($this->father_id != null)
        {
            Relatives::findOne($this->father_id)->getClans($clans);
        }
        if ($this->mother_id != null)
        {
            Relatives::findOne($this->mother_id)->getClans($clans);;
        }
        return $clans;
    }
    
/**
 * Определяет, является ли родственником человек, заданный параметром <b>$relative_id</b>
 * к пользователю, заданному параметром <b>$my_id</b>
 * @param integer $my_id
 * @param integer $relative_id
 * @return string просто строка если не родственники, иначе ссылка на страницу с подробным графиком родственной связи
 */
    public static function isKinsman($my_id, $relative_id)
    {
        if ($my_id != $relative_id)
        {
            $my_rels = $rel_rels = [];
            $my_rels = self::getRelatives($my_rels, $my_id); // предки юзера
            $rel_rels = self::getRelatives($rel_rels, $relative_id); // предки выбранного человека
            $flag = FALSE;  //  признак того что вы родственники

            if (isset($rel_rels) && in_array($my_id, $rel_rels)){
                $result = 'Вы являетесь предком.';
                $flag = TRUE;    
            }
            elseif (isset($my_rels) && in_array($relative_id, $my_rels)){
                $result = 'Вы являетесь потомком.';
                $flag = TRUE;
            }
            else {
                if (count($my_rels) > count($rel_rels)) {
                    $common_relatives = array_intersect($my_rels, $rel_rels);
                }
                else {
                    $common_relatives = array_intersect($rel_rels, $my_rels);
                }
                if (count($common_relatives) > 0){
                    $result = 'Вы являетесь родственниками';
                }
                else {
                    $result = 'Вы не являетесь родственниками.';
                }
            }
        }
        else{
            $result = 'Это Вы.';
        }
//        if ($flag)
//        {
//            $result = Html::a($result, '/relatives', ['target' => '_blank']);
//        }
        return $result;
    }
    
    private static function getRelatives(&$relatives, $rel_id)
    {
        $relative = Relatives::findOne($rel_id);
        if ($relative->father_id != NULL)
        {
            $relatives[] = $relative->father_id;
            self::getRelatives($relatives, $relative->father_id);
        }
        if ($relative->mother_id != NULL)
        {
            $relatives[] = $relative->mother_id;
            self::getRelatives($relatives, $relative->mother_id);
        }
        return $relatives;        
    }
    
    public function getCemetery()
    {
        return Cemeteries::findOne($this->cemetery_id);
    }
}
