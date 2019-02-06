<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientID', 'workerID', 'status'], 'integer'],
            [['dataPlasat'], 'safe'],
            [['pretTotal'], 'number'],
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
        if(Yii::$app->user->identity->userType == 0) { //admin vede tot
            $query = Orders::find();
        } elseif(Yii::$app->user->identity->userType == 1) { //worker vede doar ale lui sau null
            $query = Orders::find()->where(['workerID'=>Yii::$app->user->identity->id])->orWhere(['workerID'=>null]);
        } else { //clientul le vede doar ale lui
            $query = Orders::find()->where(['clientID'=>Yii::$app->user->identity->id]);
        }

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
            'workerID' => $this->workerID,
            'status' => $this->status,
            'dataPlasat' => $this->dataPlasat,
            'pretTotal' => $this->pretTotal,
        ]);

        return $dataProvider;
    }
}
