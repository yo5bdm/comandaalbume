<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Elementecomanda;

/**
 * ElementecomandaSearch represents the model behind the search form of `app\models\Elementecomanda`.
 */
class ElementecomandaSearch extends Elementecomanda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'produsID', 'tipDeBaza', 'maiMulteBucatiIdentice', 'maiMulteBucatiNeidentice', 'minBucati', 'maxBucati'], 'integer'],
            [['descriere', 'observatii'], 'safe'],
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
        $query = Elementecomanda::find();

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
            'produsID' => $this->produsID,
            'tipDeBaza' => $this->tipDeBaza,
            'maiMulteBucatiIdentice' => $this->maiMulteBucatiIdentice,
            'maiMulteBucatiNeidentice' => $this->maiMulteBucatiNeidentice,
            'minBucati' => $this->minBucati,
            'maxBucati' => $this->maxBucati,
        ]);

        $query->andFilterWhere(['like', 'descriere', $this->descriere])
            ->andFilterWhere(['like', 'observatii', $this->observatii]);

        return $dataProvider;
    }
}
