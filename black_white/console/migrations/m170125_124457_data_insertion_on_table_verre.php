<?php

use yii\db\Migration;

class m170125_124457_data_insertion_on_table_verre extends Migration
{
    public function up()
    {
/* -------------- insertion table verre ------------------------------------------------ */
		$this->insert('verre', [
            'id_verre'=>1,
			'id_boisson' => 10,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>2,
			'id_boisson' => 11,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>3,
			'id_boisson' => 12,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>4,
			'id_boisson' => 13,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>5,
			'id_boisson' => 14,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>6,
			'id_boisson' => 15,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
		$this->insert('verre', [
            'id_verre'=>7,
			'id_boisson' => 17,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>8,
			'id_boisson' => 18,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
		$this->insert('verre', [
            'id_verre'=>9,
			'id_boisson' => 19,
            'nombre' => 50,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
        $this->insert('verre', [
            'id_verre'=>10,
			'id_boisson' => 20,
            'nombre' => 50,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
		$this->insert('verre', [
            'id_verre'=>11,
			'id_boisson' => 92,
            'nombre' => 5,
            'prix' => 3500,
            'capacite' =>15,
                ]
        );
		$this->insert('verre', [
            'id_verre'=>12,
			'id_boisson' => 96,
            'nombre' => 5,
            'prix' => 3500,
            'capacite' =>15,
                ]
        );
		$this->insert('verre', [
            'id_verre'=>13,
			'id_boisson' => 126,
            'nombre' => 5,
            'prix' => 1500,
            'capacite' =>30,
                ]
        );
    }

    public function down()
    {
        $this->delete("{{%verre}}");
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
