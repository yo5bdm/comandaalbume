<?php

use yii\db\Migration;

/**
 * Handles adding titlu to table `templates`.
 */
class m180802_130209_add_titlu_column_to_templates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('templates', 'titlu', $this->string(30));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('templates', 'titlu');
    }
}
