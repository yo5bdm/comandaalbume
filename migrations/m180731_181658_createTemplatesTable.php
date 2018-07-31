<?php

use yii\db\Migration;

/**
 * Class m180731_181658_createTemplatesTable
 */
class m180731_181658_createTemplatesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tabelTemplates = 'templates';
        $tableOptions = null;
        if($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_romanian_ci ENGINE=InnoDB';
        }
        //elementele comentate vor aparea doar in comanda plasata de client
        $this->createTable('{{%'.$tabelTemplates.'}}', [
            'id' => $this->primaryKey(),
            'clientID' => $this->integer()->notNull(),
            'descriere' =>$this->string(30),
        ]);
        $this->createIndex(
            'idx-'.$tabelTemplates.'-clientID',
            $tabelTemplates,
            'clientID'
        );
        $this->addForeignKey(
            'fk-'.$tabelTemplates.'-clientID',
            $tabelTemplates,
            'clientID',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );
        //foreign keys
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180731_181658_createTemplatesTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_181658_createTemplatesTable cannot be reverted.\n";

        return false;
    }
    */
}
