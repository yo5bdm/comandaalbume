<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $clientID
 * @property int $workerID
 * @property int $status
 * @property string $dataPlasat
 * @property double $pretTotal
 *
 * @property Users $client
 * @property Users $worker
 * @property Statuses $statuses
 * @property Produse[] $produses
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientID', 'status', 'dataPlasat', 'pretTotal'], 'required'],
            [['clientID', 'workerID', 'status'], 'integer'],
            [['dataPlasat'], 'safe'],
            [['pretTotal'], 'number'],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['clientID' => 'id']],
            [['workerID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['workerID' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Numar comanda',
            'clientID' => 'Client ID',
            'workerID' => 'Worker ID',
            'status' => 'Status comanda',
            'dataPlasat' => 'Data Plasarii',
            'pretTotal' => 'Pret Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Users::className(), ['id' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Users::className(), ['id' => 'workerID']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getStatuses() 
    { 
       return $this->hasOne(Statuses::className(), ['id' => 'status']); 
    } 
    
    /**
    *  @return \yii\db\ActiveQuery
    */
    public function getProduses()
    {
        return $this->hasMany(Produse::className(), ['comandaID' => 'id']);
    }
    
    public function refreshOrder($id) {
        $totalComanda = 0;
        $produse = Produse::findAll(['comandaID'=>$id]);
        foreach($produse as $produs) {
            $json = json_decode($produs->descriere);
            $totalComanda += $json->pretTotal;
        }
        $order = Orders::find()->where(['id'=>$id])->one();
        $order->pretTotal = $totalComanda;
        $order->save();
    }

}
