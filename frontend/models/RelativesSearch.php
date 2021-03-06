<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Relatives;

/**
 * RelativesSearch represents the model behind the search form about `app\models\Relatives`.
 */
class RelativesSearch extends Relatives
{
    public $fullName;
    
    public $fatherName;
    
    public $motherName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bday', 'gender', 'visible', 'show_pict', 'cemetery_id'], 'integer'],
            [['id', 'fullName', 'fatherName', 'motherName', 'sname', 'fname', 'mname', 'bdate', 'bmonth', 'byear', 'img', 'bplace', 'descr', 'second_sname', 'ddate', 'dday', 'dmonth', 'dyear', 'rod', 'last_change', 'hidden', 'grave_picture', 'created_at', 'updated_at', 'mother_id', 'father_id'], 'safe'],
            [['grave_lon', 'grave_lat'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Relatives::find()->orderBy('sname', 'fname', 'mname');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'fullName' => [
                    'asc' => ['sname' => SORT_ASC, 'fname' => SORT_ASC],
                    'desc' => ['sname' => SORT_DESC, 'fname' => SORT_DESC],
//                    'label' => 'Full Name',
                    'default' => SORT_ASC
                ],
            ]
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['father', 'mother']);
            return $dataProvider;
        }

        $query->andWhere('fname LIKE "%' . $this->fullName . '%" OR sname LIKE "%' . $this->fullName . '%" OR mname LIKE "%' . $this->fullName . '%"');
        
        $query->andFilterWhere([
            'id' => $this->id,
            'bdate' => $this->bdate,
            'bday' => $this->bday,
            'mother_id' => $this->mother_id,
            'father_id' => $this->father_id,
            'gender' => $this->gender,
            'ddate' => $this->ddate,
            'cemetery_id' => $this->cemetery_id,
        ]);

        $query->andFilterWhere(['like', 'bmonth', $this->bmonth])
            ->andFilterWhere(['like', 'byear', $this->byear])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'bplace', $this->bplace])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'second_sname', $this->second_sname])
            ->andFilterWhere(['like', 'dday', $this->dday])
            ->andFilterWhere(['like', 'dmonth', $this->dmonth])
            ->andFilterWhere(['like', 'dyear', $this->dyear])
            ->andFilterWhere(['like', 'rod', $this->rod])
            ->andFilterWhere(['like', 'hidden', $this->hidden])
            ->andFilterWhere(['like', 'grave_picture', $this->grave_picture]);

        return $dataProvider;
    }
}
