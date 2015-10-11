<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SocialAccount;

/**
 * SocialAccountSearch represents the model behind the search form about `frontend\models\SocialAccount`.
 */
class SocialAccountSearch extends SocialAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['url', 'network_id', 'relative_id', 'created_at', 'updated_at'], 'safe'],
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
        $query = SocialAccount::find()->orderBy('relative_id');

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
        $query->joinWith('network');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'network_id' => $this->network_id,
            'relative_id' => $this->relative_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
                ->orFilterWhere(['like', 'social_networks.title', $this->network_id])
                ->orFilterWhere(['like', 'relatives.sname', $this->relative_id])
                ->orFilterWhere(['like', 'relatives.fname', $this->relative_id]);

        return $dataProvider;
    }
}
