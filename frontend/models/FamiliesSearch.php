<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Families;

/**
 * FamiliesSearch represents the model behind the search form about `frontend\models\Families`.
 */
class FamiliesSearch extends Families
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', ], 'integer'],
            [['mdate', 'descr', 'created_at', 'updated_at', 'husband_id', 'wife_id'], 'safe'],
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
        $query = Families::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('wife');

        $query->andFilterWhere([
            'id' => $this->id,
            'husband_id' => $this->husband_id,
            'wife_id' => $this->wife_id,
            'mdate' => $this->mdate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'descr', $this->descr])
        ->andFilterWhere(['like', 'wife.sname', $this->wife_id,])
        ->andFilterWhere(['like', 'wife.fname', $this->wife_id,]);

        return $dataProvider;
    }
}
