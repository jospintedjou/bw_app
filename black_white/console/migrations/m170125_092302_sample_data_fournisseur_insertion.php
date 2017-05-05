<?php

use yii\db\Migration;

class m170125_092302_sample_data_fournisseur_insertion extends Migration
{
    public function up()
    {
	  
  /*-------------- insertion table fournisseur ------------------------------------------------*/
        
        $this->insert('fournisseur', [
			'id_fournisseur'=>1,            
            'nom' => 'GUINESS',
            'adresse' => 'Yaounde',
            'adresse' => '698562356',
            'ville' => 'Yaounde',
            
                ]
        );
       $this->insert('fournisseur', [
			'id_fournisseur'=>2,            
            'nom' => 'SABC',
            'adresse' => 'Yaounde',
            'adresse' => '698562357',
            'ville' => 'Yaounde',
            
                ]
        );
       $this->insert('fournisseur', [
			'id_fournisseur'=>3,            
            'nom' => 'CAM_liqueur',
            'adresse' => 'Yaounde',
            'adresse' => '698562358',
            'ville' => 'Yaounde',
            
                ]
        );
       $this->insert('fournisseur', [
			'id_fournisseur'=>4,            
            'nom' => 'Ballentines',
            'adresse' => 'Yaounde',
            'adresse' => '698562359',
            'ville' => 'Yaounde',
            
                ]
        );
       $this->insert('fournisseur', [
			'id_fournisseur'=>5,            
            'nom' => 'Heineken',
            'adresse' => 'Yaounde',
            'adresse' => '698562359',
            'ville' => 'Yaounde',
            
                ]
        );
       $this->insert('fournisseur', [
			'id_fournisseur'=>6,            
            'nom' => 'CHIVAS',
            'adresse' => 'Yaounde',
            'adresse' => '698562350',
            'ville' => 'Yaounde',
            
                ]
        );
	
 
    
    }

    public function down()
    {
       $this->delete("{{%fournisseur}}");
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
