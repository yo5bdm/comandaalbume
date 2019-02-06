<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $userType
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $numeComplet
 * @property string $numeFirma
 * @property string $adresaFacturare
 * @property string $oras
 * @property string $judet
 * @property string $CUI
 * @property string $nrRegCom
 * @property string $banca
 * @property string $contBancar
 * @property string $telefon
 * 
 * @property Adreselivrare[] $adreselivrares 
 * @property Orders[] $orders
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userType'], 'integer'],
            [['username','email', 'password', 'authKey', 'numeComplet', 'numeFirma', 'adresaFacturare', 'oras', 'judet', 'CUI', 'nrRegCom', 'banca', 'contBancar', 'telefon'], 'required'],
            [['username','email', 'numeComplet', 'numeFirma', 'judet'], 'string', 'max' => 30],
            [['authKey','password'], 'string', 'max' => 60],
            [['adresaFacturare', 'banca', 'contBancar'], 'string', 'max' => 100],
            [['oras'], 'string', 'max' => 40],
            [['CUI', 'nrRegCom', 'telefon'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userType' => 'User Type',
            'username' => 'Nume de utilizator',
            'email' => 'Email',
            'password' => 'Parola',
            'authKey' => 'Auth Key',
            'numeComplet' => 'Nume Complet',
            'numeFirma' => 'Nume Firma',
            'adresaFacturare' => 'Adresa Facturare',
            'oras' => 'Oras',
            'judet' => 'Judet',
            'CUI' => 'C.U.I.',
            'nrRegCom' => 'Nr. Reg. Com.',
            'banca' => 'Banca',
            'contBancar' => 'Cont Bancar',
            'telefon' => 'Telefon',
        ];
    }

    public function getAuthKey(): string {
        return $this->authKey;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->authKey === $authKey;
    }
    
    public function validatePassword($pass) {
        return Yii::$app->getSecurity()->validatePassword($pass, $this->password);
    }

    
    
    public static function findIdentity($id): \yii\web\IdentityInterface {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
        throw new \yii\base\NotSupportedException();
    }
    
    public static function findByUsername($username) {
        return self::findOne(['username'=>$username]);
    }
//http://code-epicenter.com/how-to-login-user-from-a-database-in-yii-framework-2/
    public function getOrders() 
    { 
        return $this->hasMany(Orders::className(), ['clientID' => 'id']); 
    } 
    
    public function getAdreselivrares() {
        return $this->hasMany(AdreseLivrare::className(), ['clientID' => 'id']); 
    }
}
