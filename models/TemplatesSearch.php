<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Templates;

/**
 * TemplatesSearch represents the model behind the search form of `app\models\Templates`.
 */
class TemplatesSearch extends Templates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'clientID'], 'integer'],
            [['descriere'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Templates::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'clientID' => $this->clientID,
        ]);

        $query->andFilterWhere(['like', 'descriere', $this->descriere]);

        return $dataProvider;
    }
}
