<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string $denumire
 * @property int $userType
 * @property int $def
 *
 * @property Orders[] $orders
 */
class Statuses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['denumire', 'userType'], 'required'],
            [['userType', 'def'], 'integer'],
            [['denumire'], 'string', 'max' => 20],
            [['denumire'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denumire' => 'Denumire',
            'userType' => 'User Type',
            'def' => 'Def',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['status' => 'id']);
    }
    
    public function getDefault() {
       return $this->find()->where(['def'=>1])->one()->id;
   }
    
}
