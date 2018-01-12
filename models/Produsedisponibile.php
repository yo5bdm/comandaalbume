<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produsedisponibile".
 *
 * @property int $id
 * @property string $descriere
 *
 * @property Elementecomanda[] $elementecomandas
 */
class Produsedisponibile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produsedisponibile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descriere'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descriere' => 'Descriere',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementecomandas()
    {
        return $this->hasMany(Elementecomanda::className(), ['produsID' => 'id']);
    }
}
