<?php

use yii\db\Migration;

class m170125_120853_data_insertion_on_table_bouteille extends Migration
{
    public function up()
    {
        /* -------------- insertion table produit ------------------------------------------------ */

        $this->insert('bouteille', [
		    'id_bouteille'=>1,
            'id_boisson' => 1,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
		    'id_bouteille'=>2,
            'id_boisson' => 2,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>3,
			'id_boisson' => 3,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
		    'id_bouteille'=>4,
            'id_boisson' => 4,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>5,
			'id_boisson' => 5,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
		    'id_bouteille'=>6,
            'id_boisson' => 6,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>7,
			'id_boisson' => 7,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
		    'id_bouteille'=>8,
            'id_boisson' => 8,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
		    'id_bouteille'=>9,
            'id_boisson' => 9,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1000,
            'prix_vente_demie' =>0,
			'capacite'=>50,
                ]
        );        

        $this->insert('bouteille', [
		    'id_bouteille'=>10,
            'id_boisson' => 16,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 500,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
                
        $this->insert('bouteille', [
            'id_bouteille'=>11,
			'id_boisson' => 21,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>60,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>12,
			'id_boisson' => 22,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>30,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>13,
			'id_boisson' => 23,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>60,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>14,
			'id_boisson' => 24,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>50,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>15,
			'id_boisson' => 25,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>50,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>16,
			'id_boisson' => 26,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>30,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>17,
			'id_boisson' => 27,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>50,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>18,
			'id_boisson' => 28,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>30,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>19,
			'id_boisson' => 29,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>30,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>20,
			'id_boisson' => 30,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>21,
			'id_boisson' => 31,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>22,
			'id_boisson' => 32,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>25,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>23,
			'id_boisson' => 33,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>1500,
            'prix_vente_demie' =>0,
			'capacite'=>25,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>24,
			'id_boisson' => 34,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>25,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>25,
			'id_boisson' => 35,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 400,
			'prix_vente_btlle'=>2000,
            'prix_vente_demie' =>0,
			'capacite'=>33,
                ]
        );

        $this->insert('bouteille', [
            'id_bouteille'=>26,
			'id_boisson' => 42,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>20000,
            'prix_vente_demie' =>12000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>27,
			'id_boisson' => 43,
            'nb_btlle' => 0,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>20000,
            'prix_vente_demie' =>12000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>28,
			'id_boisson' => 44,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>22500,
            'prix_vente_demie' =>12500,
			'capacite'=>100,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>29,
			'id_boisson' => 45,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>22500,
            'prix_vente_demie' =>12500,
			'capacite'=>100,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>30,
			'id_boisson' => 46,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>22500,
            'prix_vente_demie' =>12500,
			'capacite'=>100,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>31,
			'id_boisson' => 47,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>22500,
            'prix_vente_demie' =>12500,
			'capacite'=>100,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>32,
			'id_boisson' => 48,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>33,
			'id_boisson' => 49,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>34,
			'id_boisson' => 50,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>0,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>35,
			'id_boisson' => 51,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>0,
			'capacite'=>100,
                ]
        );
        
        $this->insert('bouteille', [
            'id_bouteille'=>36,
			'id_boisson' => 53,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 15000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        
        $this->insert('bouteille', [
            'id_bouteille'=>37,
			'id_boisson' => 56,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>38,
			'id_boisson' => 57,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>39,
			'id_boisson' => 58,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>40,
			'id_boisson' => 59,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>18000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>41,
			'id_boisson' => 60,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 25000,
			'prix_vente_btlle'=>80000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>42,
			'id_boisson' => 61,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 40000,
			'prix_vente_btlle'=>140000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>43,
			'id_boisson' => 62,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>40000,
            'prix_vente_demie' =>20000,
			'capacite'=>100,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>44,
			'id_boisson' => 63,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 30000,
			'prix_vente_btlle'=>70000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>45,
			'id_boisson' => 64,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 15000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>18000,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>46,
			'id_boisson' => 65,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 13000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>18000,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>47,
			'id_boisson' => 66,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 13000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>70,
                ]
        );

        $this->insert('bouteille', [
            'id_bouteille'=>48,
			'id_boisson' => 67,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 13000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>49,
			'id_boisson' => 68,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 13000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>18000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>50,
			'id_boisson' => 69,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 13000,
			'prix_vente_btlle'=>50000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>51,
			'id_boisson' => 70,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 33000,
			'prix_vente_btlle'=>70000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>52,
			'id_boisson' => 71,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 33000,
			'prix_vente_btlle'=>80000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );

        $this->insert('bouteille', [
            'id_bouteille'=>54,
			'id_boisson' => 73,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 50000,
			'prix_vente_btlle'=>200000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>55,
			'id_boisson' => 74,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>56,
			'id_boisson' => 75,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>57,
			'id_boisson' => 76,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>0,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>58,
			'id_boisson' => 77,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>59,
			'id_boisson' => 78,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>60,
			'id_boisson' => 79,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>15000,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>61,
			'id_boisson' => 80,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>35000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        
        $this->insert('bouteille', [
            'id_bouteille'=>62,
			'id_boisson' => 82,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>40000,
            'prix_vente_demie' =>0,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>63,
			'id_boisson' => 83,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>40000,
            'prix_vente_demie' =>0,
			'capacite'=>70,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>64,
			'id_boisson' => 84,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>22500,
            'prix_vente_demie' =>0,
			'capacite'=>37.5,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>65,
			'id_boisson' => 85,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>45000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>66,
			'id_boisson' => 86,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>45000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>67,
			'id_boisson' => 87,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>60000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>68,
			'id_boisson' => 88,
			'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>60000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>69,
			'id_boisson' => 89,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>70000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>70,
			'id_boisson' => 90,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 50000,
			'prix_vente_btlle'=>150000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>71,
			'id_boisson' => 91,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 70000,
			'prix_vente_btlle'=>225000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>72,
			'id_boisson' => 92,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>15000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>73,
			'id_boisson' => 93,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>20000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>74,
			'id_boisson' => 94,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>20000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>75,
			'id_boisson' => 95,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>25000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>76,
			'id_boisson' => 96,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>15000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>77,
			'id_boisson' => 97,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>17500,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>78,
			'id_boisson' => 98,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>20000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>79,
			'id_boisson' => 99,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>17500,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>80,
			'id_boisson' => 100,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>15000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
        $this->insert('bouteille', [
            'id_bouteille'=>81,
			'id_boisson' => 101,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 10000,
			'prix_vente_btlle'=>15000,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );		
		$this->insert('bouteille', [
            'id_bouteille'=>82,
			'id_boisson' => 127,
            'nb_btlle' => 0,
            'prix_achat_btlle' => 0,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>83,
			'id_boisson' => 128,
            'nb_btlle' => 0,
            'prix_achat_btlle' => 0,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		
		$this->insert('bouteille', [
            'id_bouteille'=>84,
			'id_boisson' => 40,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>85,
			'id_boisson' => 41,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>86,
			'id_boisson' => 36,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>87,
			'id_boisson' => 37,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>88,
			'id_boisson' => 38,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>89,
			'id_boisson' => 39,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>90,
			'id_boisson' => 52,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>91,
			'id_boisson' => 54,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
		$this->insert('bouteille', [
            'id_bouteille'=>92,
			'id_boisson' => 55,
            'nb_btlle' => 50,
            'prix_achat_btlle' => 3500,
			'prix_vente_btlle'=>0,
            'prix_vente_demie' =>0,
			'capacite'=>75,
                ]
        );
    }

    public function down()
    {
        $this->delete("{{%bouteille}}");
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
