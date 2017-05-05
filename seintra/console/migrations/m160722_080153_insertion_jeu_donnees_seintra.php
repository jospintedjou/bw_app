<?php

use yii\db\Migration;

class m160722_080153_insertion_jeu_donnees_seintra extends Migration {

    public function up() {

        /*
         * insertion table USER
         * 
         */
        
        $this->insert('user', [
			'id'=>1,
            'nom' => 'DG',
            'prenom' => 'DG',
            'username' => 'DG',
            'password_hash' => Yii::$app->security->generatePasswordHash('DG'),
            'email' => 'DG@yahoo.fr',
            'role' => 'DG',
                ]
        );
		

        /*
         * ////////fin insertion table USER
         * 
         */
		 /*
         *  insertion table fichier; avatar pour le compte crée
         */
        
		$this->insert('fichier', [
			   'id_user'=>1,
			   'nom'=>'user.png',
			   'type'=>'photo'
		]);
    
    
    }

    public function down() {
        echo "m160722_080153_insertion_jeu_donnees_seintra cannot be reverted.\n";

        return false;
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
