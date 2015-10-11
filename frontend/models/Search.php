<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * 
 */
class Search 
{

/**
   * функция получения результатов поиска с полным совпадением по всем поисковым словам
   * @param string $searchString
   * @return array массив, содержащий id найденных записей
   */ 
static function getComplitMatch($keywords)
{    
    $keywords = explode(' ', $keywords);

    
    $results = [];
    $flag = FALSE;
    foreach($keywords as $keyword)
    {          
        $results2 = [];
        $records = Relatives::find()->orderBy('sname', 'fname', 'mname')
            ->andWhere(['like', 'sname', $keyword])
            ->orWhere(['like', 'descr', $keyword])
            ->orWhere(['like', 'mname', $keyword])
            ->orWhere(['like', 'rod', $keyword])
            ->orWhere(['like', 'second_sname', $keyword])
            ->orWhere(['like', 'fname', $keyword])->all();
        if (!$flag)
        {
            foreach ($records as $record)
            {
                $results[] = $record->id;
            }
            $flag = true;
        }
        else
        {
            foreach ($records as $record)
            {
                $results2[] = $record->id;
            }
            $results = array_intersect($results2, $results);
        }
    }
    
    $result = Relatives::findAll($results);
    
    return $result;
}

}
