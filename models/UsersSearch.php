<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userType'], 'integer'],
            [['username', 'email', 'password', 'authKey', 'numeComplet', 'numeFirma', 'adresaFacturare', 'oras', 'judet', 'CUI', 'nrRegCom', 'banca', 'contBancar', 'telefon'], 'safe'],
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
        $query = Users::find();

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
            'userType' => $this->userType,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'numeComplet', $this->numeComplet])
            ->andFilterWhere(['like', 'numeFirma', $this->numeFirma])
            ->andFilterWhere(['like', 'adresaFacturare', $this->adresaFacturare])
            ->andFilterWhere(['like', 'oras', $this->oras])
            ->andFilterWhere(['like', 'judet', $this->judet])
            ->andFilterWhere(['like', 'CUI', $this->CUI])
            ->andFilterWhere(['like', 'nrRegCom', $this->nrRegCom])
            ->andFilterWhere(['like', 'banca', $this->banca])
            ->andFilterWhere(['like', 'contBancar', $this->contBancar])
            ->andFilterWhere(['like', 'telefon', $this->telefon]);

        return $dataProvider;
    }
}
