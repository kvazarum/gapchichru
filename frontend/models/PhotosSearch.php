<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Photos;

/**
 * PhotosSearch represents the model behind the search form about `frontend\models\Photos`.
 */
class PhotosSearch extends Photos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'descr', 'relative_id'], 'safe'],
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
        $query = Photos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('relative');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'relative_id' => $this->relative_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'relatives.sname', $this->relative_id])
            ->orFilterWhere(['like', 'relatives.fname', $this->relative_id])
            ->orFilterWhere(['like', 'relatives.mname', $this->relative_id])
            ->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
