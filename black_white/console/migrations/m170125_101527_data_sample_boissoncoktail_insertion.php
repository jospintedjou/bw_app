<?php

use yii\db\Migration;

class m170125_101527_data_sample_boissoncoktail_insertion extends Migration
{
     public function up()
    {
     /* -------------- insertion table boisson boisson_cocktail ------------------------------------------------ */
    
	/*AMERICANO*/    
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 109,            
            'id_boisson' => 47,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 109,            
            'id_boisson' => 51,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 109,            
            'id_boisson' => 21,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		/*Caipirinha*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 110,            
            'id_boisson' => 127,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ] 
        );
		
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 110,            
            'id_boisson' => 26,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
		 );
		 
		/*Maguarita*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 111,           
            'id_boisson' => 50,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 111,           
            'id_boisson' => 52,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		/*pina colada*/
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 112,           
            'id_boisson' => 74,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 112,           
            'id_boisson' => 49,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		/*tequila sunrise */
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 113,
            'id_boisson' => 50,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 113,
            'id_boisson' => 13,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		/*Mojito */
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 114,
            'id_boisson' => 74,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		
		 $this->insert('boisson_cocktail', [
            'id_cocktail' => 114,
            'id_boisson' => 26,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		
		/*B52*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 115,
            'id_boisson' => 48,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 115,
            'id_boisson' => 82,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 115,
            'id_boisson' => 128,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		/*cosmopolitan*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 116,
            'id_boisson' => 77,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 116,
            'id_boisson' => 52,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		/*Daiquiri*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 117,
            'id_boisson' => 74,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 117,
            'id_boisson' => 26,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		/*Manathan*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 118,
            'id_boisson' => 56,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 118,
            'id_boisson' => 48,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		/*Matini cocktail*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 119,
            'id_boisson' => 42,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
                ]
        );
		 $this->insert('boisson_cocktail', [
            'id_cocktail' => 119,
            'id_boisson' => 45,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		/*Negroni*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 120,           
            'id_boisson' => 45,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>1,
			'nb_verre'=>0,
			 ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 120,
            'id_boisson' => 51,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
			 ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 120,
            'id_boisson' => 47,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
			 ]
        );
		/*Long island ice tea */
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 121,
            'id_boisson' => 45,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 121,
            'id_boisson' => 77,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 121,
            'id_boisson' => 74,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 121,
            'id_boisson' => 52,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 121,
            'id_boisson' => 22,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		/*Mexican ice tea*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 122,
            'id_boisson' => 45,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 122,
            'id_boisson' => 77,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 122,
            'id_boisson' => 74,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 122,
            'id_boisson' => 50,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 122,
            'id_boisson' => 22,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		/*black & white */
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 123,
            'id_boisson' => 12,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 123,
            'id_boisson' => 13,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		/*Florida*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 124,
            'id_boisson' => 13,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 124,
            'id_boisson' => 126,
			'nb_btlle'=>0,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0.5,
			'nb_verre'=>0,
                ]
        );
		$this->insert('boisson_cocktail', [
            'id_cocktail' => 124,
            'id_boisson' => 21,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		/*Virgin mojito*/
        $this->insert('boisson_cocktail', [
            'id_cocktail' => 125,
            'id_boisson' => 26,
			'nb_btlle'=>1,
			'nb_demie_btlle'=>0,
			'nb_conso'=>0,
			'nb_verre'=>0,
                ]
        );
		
    }

    public function down()
    {
       $this->delete("{{%boisson_cocktail}}");
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
