<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adreselivrare".
 *
 * @property int $id
 * @property int $clientID
 * @property string $numeDestinatar
 * @property string $persoanaContact
 * @property string $telefon
 * @property string $adresa
 * @property string $oras
 * @property string $judet
 * @property string $codPostal
 * @property int $def
 *
 * @property Users $client
 */
class AdreseLivrare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adreselivrare';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientID', 'numeDestinatar', 'telefon', 'adresa'], 'required'],
            [['clientID', 'def'], 'integer'],
            [['numeDestinatar', 'persoanaContact', 'telefon', 'oras', 'judet'], 'string', 'max' => 20],
            [['adresa'], 'string', 'max' => 40],
            [['codPostal'], 'string', 'max' => 10],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['clientID' => 'id']],
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
            'numeDestinatar' => 'Nume Destinatar',
            'persoanaContact' => 'Persoana Contact',
            'telefon' => 'Telefon',
            'adresa' => 'Adresa',
            'oras' => 'Oras',
            'judet' => 'Judet',
            'codPostal' => 'Cod Postal',
            'def' => 'Def',
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
