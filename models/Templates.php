<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "templates".
 *
 * @property int $id
 * @property int $clientID
 * @property string $descriere
 *
 * @property Users $client
 */
class Templates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clientID'], 'required'],
            [['clientID'], 'integer'],
            [['descriere'], 'string', 'max' => 30],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['clientID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientID' => 'Client ID',
            'descriere' => 'Descriere',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Users::className(), ['id' => 'clientID']);
    }
}
