<?php

use yii\db\Migration;

class m170125_091856_insert_succursale_magasin_name extends Migration
{
    public function up()
    {
     /*-------------- insertion table Succursale ------------------------------------------------*/
        
        $this->insert('succursale', [
			'id_succursale'=>1,            
            'nom' => 'djeuga',
            'adresse' => 'Yaounde',
            'ville' => 'Yaounde',
            
                ]
        );
        $this->insert('succursale', [
			'id_succursale'=>2,            
            'nom' => 'bastos',
            'adresse' => 'Yaounde',
            'ville' => 'Yaounde',
            
                ]
        );
        $this->insert('succursale', [
			'id_succursale'=>3,            
            'nom' => 'douala',
            'adresse' => 'Douala',
            'ville' => 'Douala',
            
                ]
        );
	
 
     /*-------------- insertion table Magasin ------------------------------------------------*/
        
        $this->insert('magasin', [
	        'id_magasin'=>1,            
            'nom' => 'hollando',
            'adresse' => 'Yaounde',
            'ville' => 'Yaounde',
            
                ]
        );
    
    }

    public function down()
    {
		$this->delete("{{%succursale}}");
        $this->delete("{{%magasin}}");
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
