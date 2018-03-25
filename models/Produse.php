<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produse".
 *
 * @property int $id
 * @property int $comandaID
 * @property string $descriere
 *
 * @property Orders $comanda
 */
class Produse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comandaID'], 'required'],
            [['comandaID'], 'integer'],
            [['descriere'], 'string'],
            [['comandaID'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['comandaID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comandaID' => 'Comanda ID',
            'descriere' => 'Descriere',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComanda()
    {
        return $this->hasOne(Orders::className(), ['id' => 'comandaID']);
    }
}
