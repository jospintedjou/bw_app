<?php

use yii\db\Migration;

class m170116_120952_sample_data_insertion extends Migration
{
    public function up()
    {
    /* ------------  insertion table fichier; avatar pour le compte crée ------------ */

        $this->insert('photo', [
                   'id_photo'=>1,
                   'nom'=>'user.png',
        ]);
        
  /*-------------- insertion table USER ------------------------------------------------*/
        $code1 = 'TH'."411";
        $this->insert('user', [
	    'id'=>1,
            'id_photo'=>1,
            'nom' => 'tom',
            'prenom' => 'tom',
            'code' => $code1,
            'username' => 'tom',
            'password_hash' => Yii::$app->security->generatePasswordHash('tom'),
            'email' => 'DG@yahoo.fr',
            'role' => 'DG',
                ]
        );
	
 
    
    
    }
    

    public function down()
    {
       
        $this->delete("{{%user}}");
        $this->delete("{{%photo}}");
        //$this->delete("{{%migration}}");
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
