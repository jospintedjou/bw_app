<?php

use yii\db\Migration;

class m170118_121803_insert_user_name_test extends Migration
{
    public function up()
    {
   
      
        
   /*-------------- insertion table Client ------------------------------------------------*/
        
        $this->insert('client', [
	    'id_client'=>1,
            'nom' => 'Guest',
            'prenom' => 'Guest',
            'sexe' => 'homme',
            'telephone' => '600000000',
            'email' => 'guest@yahoo.fr',
                ]
        );
        
  /*-------------- insertion table USER leurs photos de profile ont été crée avec la sample data migration ------------------------------------------------*/
        
        $this->insert('user', [
	    'id'=>2,
            'id_photo'=>1,
            'nom' => 'larry',
            'prenom' => 'jianini',
            'code' => 'LD822',
            'username' => 'larry',
            'password_hash' => Yii::$app->security->generatePasswordHash('larry'),
            'email' => 'larry@yahoo.fr',
            'role' => 'GS',
                ]
        );
	$this->insert('user', [
	    'id'=>3,
            'id_photo'=>1,
            'nom' => 'Ngauss',
            'prenom' => 'erick',
            'code' => 'ND123',
            'username' => 'erick',
            'password_hash' => Yii::$app->security->generatePasswordHash('erick'),
            'email' => 'erick@yahoo.fr',
            'role' => 'BM',
                ]
        );
 
        $this->insert('user', [
	    'id'=>4,
            'id_photo'=>1,
            'nom' => 'Tedjou',
            'prenom' => 'jospin',
            'code' => 'TH164',
            'username' => 'jospin',
            'password_hash' => Yii::$app->security->generatePasswordHash('jospin'),
            'email' => 'jospin@yahoo.fr',
            'role' => 'MP',
                ]
        );
        $this->insert('user', [
	    'id'=>5,
            'id_photo'=>1,
            'nom' => 'Kamdem',
            'prenom' => 'miguel',
            'code' => 'KB205',
            'username' => 'miguel',
            'password_hash' => Yii::$app->security->generatePasswordHash('miguel'),
            'email' => 'miguel@yahoo.fr',
            'role' => 'SE',
                ]
        );
         $this->insert('user', [
	    'id'=>6,
            'id_photo'=>1,
            'nom' => 'Kenne',
            'prenom' => 'fritz',
            'code' => 'KD246',
            'username' => 'fritz',
            'password_hash' => Yii::$app->security->generatePasswordHash('fritz'),
            'email' => 'fritz@yahoo.fr',
            'role' => 'SE',
                ]
        );
         $this->insert('user', [
	    'id'=>7,
            'id_photo'=>1,
            'nom' => 'Guenkam',
            'prenom' => 'yvan',
            'code' => 'GD287',
            'username' => 'yvan',
            'password_hash' => Yii::$app->security->generatePasswordHash('yvan'),
            'email' => 'yvan@yahoo.fr',
            'role' => 'SE',
             
                ]
        );
         $this->insert('user', [
	    'id'=>8,
            'id_photo'=>1,
            'nom' => 'Bodo',
            'prenom' => 'philipe',
            'code' => 'BB328',
            'username' => 'philipe',
            'password_hash' => Yii::$app->security->generatePasswordHash('philipe'),
            'email' => 'philipe@yahoo.fr',
            'role' => 'CU',
             
                ]
        );
         $this->insert('user', [
	    'id'=>9,
            'id_photo'=>1,
            'nom' => 'Patrick',
            'prenom' => 'patrick',
            'code' => 'PB369',
            'username' => 'patrick',
            'password_hash' => Yii::$app->security->generatePasswordHash('patrick'),
            'email' => 'patrick@yahoo.fr',
            'role' => 'CU',
             
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
