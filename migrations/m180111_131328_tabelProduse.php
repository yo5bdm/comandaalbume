<?php

use yii\db\Migration;

/**
 * Class m180111_131328_tabelProduse
 */
class m180111_131328_tabelProduse extends Migration
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
        $this->createTable('{{%produse}}', [
            'id'=>$this->primaryKey(),
            'comandaID'=>$this->integer()->notNull(),
            'descriere'=>$this->string(30)
        ]);
        $this->createIndex(
            'idx-produse-comandaID',
            'produse',
            'comandaID'
        );
        $this->addForeignKey(
            'fk-produse-comandaID',
            'produse',
            'comandaID',
            'orders',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180111_131328_tabelProduse cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180111_131328_tabelProduse cannot be reverted.\n";

        return false;
    }
    */
}
