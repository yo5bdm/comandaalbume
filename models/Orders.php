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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientID' => 'Client ID',
            'workerID' => 'Worker ID',
            'status' => 'Status',
            'dataPlasat' => 'Data Plasat',
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
}
