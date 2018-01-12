<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "elementecomanda".
 *
 * @property int $id
 * @property int $produsID
 * @property string $descriere
 * @property int $tipDeBaza
 * @property int $maiMulteBucatiIdentice
 * @property int $maiMulteBucatiNeidentice
 * @property int $minBucati
 * @property int $maxBucati
 * @property string $observatii
 *
 * @property Produsedisponibile $produs
 */
class Elementecomanda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elementecomanda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produsID', 'tipDeBaza', 'maiMulteBucatiIdentice', 'maiMulteBucatiNeidentice'], 'required'],
            [['produsID', 'tipDeBaza', 'maiMulteBucatiIdentice', 'maiMulteBucatiNeidentice', 'minBucati', 'maxBucati'], 'integer'],
            [['observatii'], 'string'],
            [['descriere'], 'string', 'max' => 30],
            [['produsID'], 'exist', 'skipOnError' => true, 'targetClass' => Produsedisponibile::className(), 'targetAttribute' => ['produsID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produsID' => 'Produs ID',
            'descriere' => 'Descriere',
            'tipDeBaza' => 'Tip De Baza',
            'maiMulteBucatiIdentice' => 'Mai Multe Bucati Identice',
            'maiMulteBucatiNeidentice' => 'Mai Multe Bucati Neidentice',
            'minBucati' => 'Min Bucati',
            'maxBucati' => 'Max Bucati',
            'observatii' => 'Observatii',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdus()
    {
        return $this->hasOne(Produsedisponibile::className(), ['id' => 'produsID']);
    }
}
