<?php

use yii\db\Migration;

class m170216_090418_insertion_table_succ extends Migration
{
    public function up()
    {
        $this->insert('table', [
            'id_table'=>1,
            'nom' => 'table 1',
        ]);
        $this->insert('table', [
            'id_table'=>2,
            'nom' => 'table 2',
        ]);
        $this->insert('table', [
            'id_table'=>3,
            'nom' => 'table 3',
        ]);
        $this->insert('table', [
            'id_table'=>4,
            'nom' => 'table 4',
        ]);
        $this->insert('table', [
            'id_table'=>5,
            'nom' => 'table 5',
        ]);
    }

    public function down()
    {
        $this->delete("{{%table}}");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
