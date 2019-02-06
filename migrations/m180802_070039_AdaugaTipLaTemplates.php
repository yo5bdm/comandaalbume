<?php

use yii\db\Migration;

/**
 * Class m180802_070039_AdaugaTipLaTemplates
 */
class m180802_070039_AdaugaTipLaTemplates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('templates','tipProdus',$this->string(30));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('templates','tipProdus');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180802_070039_AdaugaTipLaTemplates cannot be reverted.\n";

        return false;
    }
    */
}
