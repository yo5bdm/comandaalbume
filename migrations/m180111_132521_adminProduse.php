<?php

use yii\db\Migration;

/**
 * Class m180111_132521_adminProduse
 */
class m180111_132521_adminProduse extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tabelProduseDisponibile = 'produseDisponibile';
        $tElementeComanda = 'elementeComanda';
        $tableOptions = null;
        if($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_romanian_ci ENGINE=InnoDB';
        }
        //elementele comentate vor aparea doar in comanda plasata de client
        $this->createTable('{{%'.$tabelProduseDisponibile.'}}', [
            'id' => $this->primaryKey(),
            'descriere'=>$this->string(30),
        ]);
        $this->createTable('{{%'.$tElementeComanda.'}}', [
            'id' => $this->primaryKey(),
            'produsID' =>$this->integer()->notNull(), //de aici se leaga tabelul precedent
            'descriere'=>$this->string(30),
            'tipDeBaza'=>$this->integer()->notNull(), //1 - lista, 2 - String
            //'textTipDeBaza'=>$this->string(), //luat de la client, daca tipDeBaza = 2, altfel null
            //'optiuneTipDeBaza'=>$this->integer(), // daca tipDeBaza e 1, aici se va tine valoarea
            //'nrBucati' =>$this->integer(), //mai multe bucati identice
            'maiMulteBucatiIdentice' => $this->boolean()->notNull(), //daca se pot mai multe bucati identice
            'maiMulteBucatiNeidentice' => $this->boolean()->notNull(), //astea 2 nu se pot folosi impreuna
            'minBucati' => $this->integer(),
            'maxBucati' => $this->integer(), //astea 2 se seteaza daca se vrea limitare
            //'pretTotalOptiune'=>$this->float(), //pretul total al optiunii
            'observatii' => $this->text() //daca se vrea a trimite observatii clientului pentru optiunea asta
        ]);
        $this->createIndex(
            'idx-'.$tElementeComanda.'-produsID',
            $tElementeComanda,
            'produsID'
        );
        $this->addForeignKey(
            'fk-'.$tElementeComanda.'-produsID',
            $tElementeComanda,
            'produsID',
            $tabelProduseDisponibile,
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
        echo "m180111_132521_adminProduse cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180111_132521_adminProduse cannot be reverted.\n";

        return false;
    }
    */
}
