<?php

use yii\db\Migration;

class m170125_094717_data_insertion_on_repas_and_tabac_table extends Migration
{
    public function up()
    {
       
/* -------------- insertion table tabac ------------------------------------------------ */
        $this->insert('tabac', [
            'id_tabac' => 102,            
            'prix_achat'=>700,
            'prix_vente'=>3000,
			'quantite' => 25,
                ]
        );
        
/* -------------- insertion table repas ------------------------------------------------ */
        $this->insert('repas', [
            'id_repas' => 103,
            'prix_achat' => 500,
            'prix_vente' => 1000,
            'quantite' => 200,
            
                ]
        );
        $this->insert('repas', [
            'id_repas' => 104,
			'prix_achat' => 2500,
            'prix_vente' => 5000,
            'quantite' => 90,
                ]
        );
        $this->insert('repas', [
            'id_repas' => 105,
			'prix_achat' => 1500,
            'prix_vente' => 3000,
            'quantite' => 200,
                ]
        );
        $this->insert('repas', [
            'id_repas' => 106,
			'prix_achat' => 5000,
            'prix_vente' => 10000,
            'quantite' => 50,
                ]
        );
        $this->insert('repas', [
            'id_repas' => 107,
			'prix_achat' => 500,
            'prix_vente' => 1000,
            'quantite' => 200,
                ]
        );
        $this->insert('repas', [
            'id_repas' => 108,
			'prix_achat' => 500,
            'prix_vente' => 1000,
            'quantite' => 200,
                ]
        );
    }

    public function down() {
          $this->delete("{{%repas}}");
          $this->delete("{{%tabac}}");
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
