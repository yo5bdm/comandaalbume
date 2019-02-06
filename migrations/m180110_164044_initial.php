<?php

use yii\db\Migration;

/**
 * Class m180110_164044_initial
 */
class m180110_164044_initial extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_romanian_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'userType' => $this->integer()->notNull()->defaultValue(2),
            'username'=> $this->string(20)->notNull(),
            'email'=> $this->string(30)->notNull(),
            'password'=> $this->string(60)->notNull(),
            'authKey'=> $this->string(60)->notNull(),
            'numeComplet'=> $this->string(30)->notNull(),
            'numeFirma'=> $this->string(30)->notNull(),
            'adresaFacturare'=> $this->string(100)->notNull(),
            'oras'=> $this->string(40)->notNull(),
            'judet'=> $this->string(30)->notNull(),
            'CUI'=> $this->string(20)->notNull(),
            'nrRegCom'=> $this->string(20)->notNull(),
            'banca'=> $this->string(100)->notNull(),
            'contBancar'=> $this->string(100)->notNull(),
            'telefon' =>$this->string(20)->notNull(),
        ]);
        $this->createTable('{{%statuses}}', [
            'id'=>$this->primaryKey(),
            'denumire'=>$this->string(20)->notNull(),
            'userType'=>$this->integer()->notNull(),
            'def'=>$this->boolean()->notNull()->defaultValue(0)
        ]);
        $this->createTable('{{%orders}}', [
            'id'=>$this->primaryKey(),
            'clientID'=>$this->integer()->notNull(),
            'workerID'=>$this->integer(),
            'status'=>$this->integer()->notNull(),
            'dataPlasat'=>$this->date()->notNull(),
            'pretTotal'=>$this->float()->notNull()
        ]);
        $this->createTable('{{%adreselivrare}}', [
            'id'=>$this->primaryKey(),
            'clientID'=>$this->integer()->notNull(),
            'numeDestinatar'=>$this->string(20)->notNull(),
            'persoanaContact'=>$this->string(20),
            'telefon'=>$this->string(20)->notNull(),
            'adresa'=>$this->string(40)->notNull(),
            'oras'=>$this->string(20)->notNull(),
            'judet'=>$this->string(20)->notNull(),
            'codPostal'=>$this->string(10)->notNull(),
            'def'=>$this->boolean()->notNull()->defaultValue(0)
        ]);
        //urmeaza indexurile pentru tabele
        $this->createIndex(
            'idx-adreselivrare-clientID',
            'adreselivrare',
            'clientID'
        );
        $this->createIndex(
            'idx-orders-clientID',
            'orders',
            'clientID'
        );
        $this->createIndex(
            'idx-orders-workerID',
            'orders',
            'workerID'
        );
        $this->createIndex(
            'idx-orders-statusID',
            'orders',
            'status'
        );
        $this->createIndex(
            'idx-statuses-clientID',
            'statuses',
            'denumire',
                1 //unique
        );
        $this->createIndex(
            'idx-users-email',
            'users',
            'email',
                1 //unique
        );
        $this->createIndex(
            'idx-users-authKey',
            'users',
            'authKey',
                1 //unique
        );
        $this->createIndex(
            'idx-users-username',
            'users',
            'username',
                1 //unique
        );
        
        //foreign keys
        $this->addForeignKey(
            'fk-orders-clientID',
            'orders',
            'clientID',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-orders-workerID',
            'orders',
            'workerID',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-orders-statusID',
            'orders',
            'status',
            'statuses',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-adreselivrare-userID',
            'adreselivrare',
            'clientID',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
        //insert default data
        $this->batchInsert('{{%statuses}}', ['denumire','userType','def'],[
            ['[in plasare]', 0, 1],
            ['Plasat',0,0],
            ['Preluat',1,0],
            ['In lucru',1,0],
            ['Livrat',1,0],
            ['Anulat',2,0]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180110_164044_initial cannot be reverted.\n";

        return false;
    }

}
