<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

  /** -----------------------------------  Table table --------------------------------------------------------------------------**/      
        $this->createTable('{{%table}}', [
            'id_table' => $this->primaryKey(11),
            'nom' => $this->string(50)->notNull(),
                ], $tableOptions);
        
        $this->alterColumn('{{%table}}', 'id_table', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
  /** -----------------------------------  Table photo --------------------------------------------------------------------------**/      
        $this->createTable('{{%photo}}', [
            'id_photo' => $this->primaryKey(11),
            'nom' => $this->text(255)->notNull(),
                ], $tableOptions);
        
        $this->alterColumn('{{%photo}}', 'id_photo', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
/** -----------------------------------  Table user --------------------------------------------------------------------------**/
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(11),
            'id_supp' => $this->integer(11),
            'id_photo' => $this->integer(11),
            'nom' => $this->string()->notNull(),
            'prenom' => $this->string(),
            'sexe' => $this->string(5)->notNull()->check("sexe in ('homme', 'femme')"),
            'code' => $this->string(20)->unique(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'telephone' => $this->string(45)->unique(),
            'email' => $this->string()->unique(),
            'role' => $this->string(5)->notNull()->check("role in ('DG','GS', 'MP', 'BM', 'SE', "
                                                        . "'CU', 'VI', 'GP', 'ADMIN')"),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%user}}', 'id', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_user', 'user', 'id_supp', 'user', 'id');
        $this->addForeignKey('fk2_user', 'user', 'id_photo', 'photo', 'id_photo');
        
  
        
/** -----------------------------------  Table client --------------------------------------------------------------------------**/
        $this->createTable('{{%client}}', [
            'id_client' => $this->primaryKey(11),
            'nom' => $this->string()->notNull(),
            'prenom' => $this->string(),
            'sexe' => $this->string(5)->notNull()->check("sexe in ('homme', 'femme')"),
            'telephone' => $this->string(45)->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'date_anniv' => $this->date(),
            'date_anniv_epse' => $this->date(),
        ], $tableOptions);
        
        $this->alterColumn('{{%client}}', 'id_client', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        
 /** -----------------------------------  Table succursale -------------------------------------------------------------**/
        $this->createTable('{{%succursale}}', [
            'id_succursale' => $this->primaryKey(11),
            'nom' => $this->string(30)->notNull(),
            'adresse' => $this->string(60),
            'actuelle' => $this->string(3)->defaultValue("non"),
            'ville' => $this->string(60),
        ], $tableOptions);
        
        $this->alterColumn('{{%succursale}}', 'id_succursale', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        
 /** -----------------------------------  Table magasin -----------------------------------------------------------------------------**/
        $this->createTable('{{%magasin}}', [
            'id_magasin' => $this->primaryKey(11),
            'nom' => $this->string(30),
            'adresse' => $this->string(60),
            'actuel' => $this->string(3)->defaultValue("non"),
            'ville' => $this->string(60),
        ], $tableOptions);
        
        $this->alterColumn('{{%magasin}}', 'id_magasin', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        
 /** -----------------------------------  Table transfert -------------------------------------------------------------**/
        $this->createTable('{{%transfert}}', [
            'id_transfert' => $this->primaryKey(11),
            'id_succ_source' => $this->integer(11)->notNull(),
            'id_succ_dest' => $this->integer(11)->notNull(),
            'code' => $this->string(100)->notNull(),
            'date' => $this->dateTime(),
        ], $tableOptions);
        
        $this->alterColumn('{{%transfert}}', 'id_transfert', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_transfert', 'transfert', 'id_succ_source', 'succursale', 'id_succursale');
        $this->addForeignKey('fk2_transfert', 'transfert', 'id_succ_dest', 'succursale', 'id_succursale');
 /** -----------------------------------  Table fourniseur -------------------------------------------------------------**/
        $this->createTable('{{%fournisseur}}', [
            'id_fournisseur' => $this->primaryKey(11),
            'nom' => $this->string(30)->notNull(),
            'adresse' => $this->string(30)->notNull(),
            'telephone' => $this->string(60)->notNull()->check("type in ('repas', 'boisson')"),
            'ville' => $this->string(60)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%fournisseur}}', 'id_fournisseur', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
    
 /** -----------------------------------  Table categorie -------------------------------------------------------------**/
        $this->createTable('{{%categorie}}', [
            'id_categorie' => $this->primaryKey(11),
            'nom' => $this->string(30)->notNull(),
            'type' => $this->string(60)->notNull()->check("type in ('repas', 'boisson', 'tabac')"),
        ], $tableOptions);
        
        $this->alterColumn('{{%categorie}}', 'id_categorie', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
           
  /** -----------------------------------  Table historique_stock -------------------------------------------------------------**/
        $this->createTable('{{%historique_stock}}', [
            'id_historique_stock' => $this->primaryKey(11),
            'date' => $this->dateTime()->notNull()
        ], $tableOptions);
        
        $this->alterColumn('{{%historique_stock}}', 'id_historique_stock', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
     
   /** -----------------------------------  Table produit -------------------------------------------------------------**/
        $this->createTable('{{%produit}}', [
            'id_produit' => $this->primaryKey(11),
            'id_categorie' => $this->integer(11)->notNull(),
            'id_photo' => $this->integer(11),
            'nom' => $this->string(60)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%produit}}', 'id_produit', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_produit', 'produit', 'id_categorie', 'categorie', 'id_categorie');
        $this->addForeignKey('fk2_produit', 'produit', 'id_photo', 'photo', 'id_photo');
        
   /** -----------------------------------  Table repas -------------------------------------------------------------**/
        $this->createTable('{{%repas}}', [
            'id_repas' => $this->primaryKey(11),
            'prix_achat' => $this->integer(11)->notNull(),
            'prix_vente' => $this->integer(11)->notNull(),
            'quantite' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%repas}}', 'id_repas', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_repas', 'repas', 'id_repas', 'produit', 'id_produit');    
    /** -----------------------------------  Table tabac -------------------------------------------------------------**/
        $this->createTable('{{%tabac}}', [
            'id_tabac' => $this->primaryKey(11),
            'prix_achat' => $this->integer(11)->notNull(),
            'prix_vente' => $this->integer(11)->notNull(),
            'quantite' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%tabac}}', 'id_tabac', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_tabac', 'tabac', 'id_tabac', 'produit', 'id_produit');    
    /** -----------------------------------  Table boisson -------------------------------------------------------------**/
        $this->createTable('{{%boisson}}', [
            'id_boisson' => $this->primaryKey(11),
            'dilluant' => $this->string(3)->check("dilluant in ('oui', 'non')"),
        ], $tableOptions);
        
        $this->alterColumn('{{%boisson}}', 'id_boisson', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_boisson', 'boisson', 'id_boisson', 'produit', 'id_produit');          
    /** -----------------------------------  Table bouteille -------------------------------------------------------------**/
        $this->createTable('{{%bouteille}}', [
            'id_bouteille' => $this->primaryKey(),
            'id_boisson' => $this->integer(11)->notNull(),
            'nb_btlle' => $this->float(11)->notNull(),
            'prix_achat_btlle' => $this->integer(11)->notNull(),
            'prix_vente_btlle' => $this->integer(11)->notNull(),
            'prix_vente_demie' => $this->integer(11)->notNull(),
            'capacite' => $this->float(11)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%bouteille}}', 'id_bouteille', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_bouteille', 'bouteille', 'id_boisson', 'boisson', 'id_boisson');    
        
        /** -----------------------------------  Table conso -------------------------------------------------------------**/
        $this->createTable('{{%conso}}', [
            'id_conso' => $this->primaryKey(11),
            'id_boisson' => $this->integer(11)->notNull(),
            'nombre' => $this->float(11)->notNull(),
            'prix' => $this->integer(11)->notNull(),
            'capacite' => $this->float(11)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%conso}}', 'id_conso', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_conso', 'conso', 'id_boisson', 'boisson', 'id_boisson');
        
        /** -----------------------------------  Table verre -------------------------------------------------------------**/
        $this->createTable('{{%verre}}', [
            'id_verre' => $this->primaryKey(11),
            'id_boisson' => $this->integer(11)->notNull(),
            'nombre' => $this->float(11)->notNull(),
            'prix' => $this->integer(11)->notNull(),
            'capacite' => $this->float(11)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%verre}}', 'id_verre', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_verre', 'verre', 'id_boisson', 'boisson', 'id_boisson');
        
        /** -----------------------------------  Table cocktail -------------------------------------------------------------**/
        $this->createTable('{{%cocktail}}', [
            'id_cocktail' => $this->primaryKey(11),
            'nom' => $this->string(30)->notNull(),
            'prix' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%cocktail}}', 'id_cocktail', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_cocktail', 'cocktail', 'id_cocktail', 'produit', 'id_produit');
       /** -----------------------------------  Table boisson_cocktail -------------------------------------------------------------**/
        $this->createTable('{{%boisson_cocktail}}', [
            'id_cocktail' => $this->integer(11)->notNull(),
            'id_boisson' => $this->integer(11)->notNull(),
            'nb_btlle' => $this->float(11)->notNull(),
            'nb_demie_btlle' => $this->float(11)->notNull(),
            'nb_conso' => $this->float(11)->notNull(),
            'nb_verre' => $this->float(11)->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_boisson_cocktail', 'boisson_cocktail', ['id_cocktail', 'id_boisson']);
        $this->addForeignKey('fk1_boisson_cocktail', 'boisson_cocktail', 'id_boisson', 'boisson', 'id_boisson');
        $this->addForeignKey('fk2_boisson_cocktail', 'boisson_cocktail', 'id_cocktail', 'cocktail', 'id_cocktail');
        
         
      /** -----------------------------------  Table transfert_boisson -------------------------------------------------------------**/
        $this->createTable('{{%transfert_boisson}}', [
            'id_transfert' => $this->integer(11)->notNull(),
            'id_boisson' => $this->integer(11)->notNull(),
            'nb_btlle' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_transfert_boisson', 'transfert_boisson', ['id_transfert', 'id_boisson']);
        $this->addForeignKey('fk1_transfert_boisson', 'transfert_boisson', 'id_transfert', 'transfert', 'id_transfert');  
        $this->addForeignKey('fk2_transfert_boisson', 'transfert_boisson', 'id_boisson', 'boisson', 'id_boisson');  
        
        
        /** -----------------------------------  Table commande_client -------------------------------------------------------------**/
        $this->createTable('{{%commande_client}}', [
            'id_commande_client' => $this->primaryKey(11),
            'id_serveur' => $this->integer(11),
            'id_preneur' => $this->integer(11)->notNull(),
            'id_client' => $this->integer(11)->notNull(),
            'id_supp' => $this->integer(11),
            'id_table' => $this->integer(11)->notNull(),
            'code' => $this->string(30)->notNull(),
            'etat' => $this->string(15)->notNull()->defaultValue('attente')->check("etat in ('servie', 'attente', 'annulee')"),
            'date' => $this->dateTime()->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%commande_client}}', 'id_commande_client', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_commande_client', 'commande_client', 'id_serveur', 'user', 'id');
        $this->addForeignKey('fk2_commande_client', 'commande_client', 'id_preneur', 'user', 'id');
        $this->addForeignKey('fk3_commande_client', 'commande_client', 'id_client', 'client', 'id_client');
        $this->addForeignKey('fk4_commande_client', 'commande_client', 'id_supp', 'user', 'id');
        $this->addForeignKey('fk5_commande_client', 'commande_client', 'id_table', 'table', 'id_table');
        
         /** -----------------------------------  Table facture -------------------------------------------------------------**/
        $this->createTable('{{%facture}}', [
            'id_facture' => $this->primaryKey(11),
            'id_commande_client' => $this->integer(11)->notNull(),
            'id_createur' => $this->integer(11)->notNull(),
            'code' => $this->string(30)->notNull(),
            'paye' => $this->string(3)->notNull()->check("paye in ('oui', 'non')"),
            'date' => $this->dateTime()->notNull(),
        ], $tableOptions);
        
        $this->alterColumn('{{%facture}}', 'id_facture', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_facture', 'facture', 'id_commande_client', 'commande_client', 'id_commande_client');
        $this->addForeignKey('fk2_facture', 'facture', 'id_createur', 'user', 'id');
        
       /** -----------------------------------  Table commande_produit -------------------------------------------------------------**/
        $this->createTable('{{%commande_produit}}', [
            'id_commande_client' => $this->integer(11)->notNull(),
            'id_produit' => $this->integer(11)->notNull(),
            'nombre' => $this->integer(11),
            'nb_demi' => $this->integer(11),
            'nb_conso' => $this->integer(11),
            'nb_verre' => $this->integer(11),
            'prix' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_commande_produit', 'commande_produit', ['id_commande_client', 
                             'id_produit']);
        $this->addForeignKey('fk1_commande_produit', 'commande_produit', 'id_produit', 'produit', 'id_produit');
        $this->addForeignKey('fk2_commande_produit', 'commande_produit', 'id_commande_client', 'commande_client', 'id_commande_client');
        
        
        /** -----------------------------------  Table commande_stock -------------------------------------------------------------**/
        $this->createTable('{{%commande_stock}}', [
            'id_commande' => $this->primaryKey(11),
            'id_succursale' => $this->integer(11)->notNull(),
            'id_magasin' => $this->integer(11)->notNull(),
            'code' => $this->string(100)->notNull(),
            'date' => $this->dateTime()->notNull(),
            'lu' => $this->string(3),
            'affiche' => $this->string(3),
        ], $tableOptions);
        
        $this->alterColumn('{{%commande_stock}}', 'id_commande', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_commande_stock', 'commande_stock', 'id_succursale', 
                                'succursale', 'id_succursale');
        
        /** -----------------------------------  Table commande_stock_boisson -------------------------------------------------------------**/
        $this->createTable('{{%commande_stock_boisson}}', [
            'id_commande' => $this->integer(11)->notNull(),
            'id_boisson' => $this->integer(11)->notNull(),
            'nb_btlle' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_commande_stock_boisson', 'commande_stock_boisson',
                                ['id_commande',  'id_boisson' ]);
        $this->addForeignKey('fk1_commande_stock_boisson', 'commande_stock_boisson', 
                              'id_commande', 'commande_stock', 'id_commande');
        $this->addForeignKey('fk2_commande_stock_boisson', 'commande_stock_boisson', 
                              'id_boisson', 'boisson', 'id_boisson');
        
        /** -----------------------------------  Table livraison -------------------------------------------------------------**/
        $this->createTable('{{%livraison}}', [
            'id_livraison' => $this->primaryKey(11),
            'id_magasin' => $this->integer(11)->notNull(),
            'id_succursale' => $this->integer(11)->notNull(),
            'id_commande' => $this->integer(11)->notNull(),
            'code' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'livre' => $this->string(3)->notNull()->check("livre in ('oui', 'non')"),
        ], $tableOptions);
        
        $this->alterColumn('{{%livraison}}', 'id_livraison', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        $this->addForeignKey('fk1_livraison', 'livraison', 'id_magasin', 'magasin', 'id_magasin');
        $this->addForeignKey('fk2_livraison', 'livraison', 'id_succursale', 'succursale', 'id_succursale');
        $this->addForeignKey('fk3_livraison', 'livraison', 'id_commande', 'commande_stock', 'id_commande');
       
        /** -----------------------------------  Table livraison_stock_boisson -------------------------------------------------------------**/
        $this->createTable('{{%livraison_stock_boisson}}', [
            'id_livraison' => $this->integer(11)->notNull(),
            'id_boisson' => $this->integer(11)->notNull(),
            'nb_btlle' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_livraison_stock_boisson', 'livraison_stock_boisson',
                                ['id_livraison',  'id_boisson' ]);
        $this->addForeignKey('fk1_livraison_stock_boisson', 'livraison_stock_boisson', 
                              'id_livraison', 'livraison', 'id_livraison');
        $this->addForeignKey('fk2_livraison_stock_boisson', 'commande_stock_boisson', 
                              'id_boisson', 'boisson', 'id_boisson');
        
         /** -----------------------------------  Table historique_stock_produit -------------------------------------------------------------**/
        $this->createTable('{{%historique_stock_produit}}', [
            'id_historique_stock' => $this->integer(11)->notNull(),
            'id_produit' => $this->integer(11)->notNull(),
            'nombre' => $this->float(11)->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_historique_stock_produit', 'historique_stock_produit',
                                ['id_historique_stock',  'id_produit' ]);
        $this->addForeignKey('fk1_historique_stock_produit', 'historique_stock_produit', 
                              'id_historique_stock', 'historique_stock', 'id_historique_stock');
        $this->addForeignKey('fk2_historique_stock_produit', 'historique_stock_produit', 
                              'id_produit', 'produit', 'id_produit');
        
        /** -----------------------------------  Table fournisseur_produit -------------------------------------------------------------**/
        $this->createTable('{{%fournisseur_produit}}', [
            'id_fournisseur' => $this->integer(11)->notNull(),
            'id_produit' => $this->integer(11)->notNull(),
            'nombre' => $this->float(11)->notNull(),
            'date' => $this->dateTime()->notNull(),
        ], $tableOptions);
        
        $this->addPrimaryKey('pk_fournisseur_produit', 'fournisseur_produit',
                                ['id_fournisseur',  'id_produit' ]);
        $this->addForeignKey('fk1_fournisseur_produit', 'fournisseur_produit', 
                              'id_fournisseur', 'fournisseur', 'id_fournisseur');
        $this->addForeignKey('fk2_fournisseur_produit', 'fournisseur_produit', 
                              'id_produit', 'produit', 'id_produit');
        
        
    }

    public function down()
    {
        
        $this->dropTable('{{%facture}}');
        $this->dropTable('{{%commande_produit}}');
        $this->dropTable('{{%commande_client}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%client}}');
        $this->dropTable('{{%transfert_boisson}}');
        $this->dropTable('{{%boisson_cocktail}}');
        $this->dropTable('{{%transfert}}');
        $this->dropTable('{{%fournisseur_produit}}');
        $this->dropTable('{{%historique_stock_produit}}');
        $this->dropTable('{{%livraison_stock_boisson}}');
         $this->dropTable('{{%livraison}}');
        $this->dropTable('{{%commande_stock_boisson}}');
        $this->dropTable('{{%commande_stock}}');
        $this->dropTable('{{%bouteille}}');
        $this->dropTable('{{%conso}}');
        $this->dropTable('{{%verre}}');
        $this->dropTable('{{%succursale}}');
        $this->dropTable('{{%tabac}}');
        $this->dropTable('{{%repas}}');
        $this->dropTable('{{%cocktail}}');
        $this->dropTable('{{%boisson}}');
        $this->dropTable('{{%produit}}');
         $this->dropTable('{{%categorie}}');
        $this->dropTable('{{%magasin}}');
        $this->dropTable('{{%fournisseur}}');
        $this->dropTable('{{%historique_stock}}');
        $this->dropTable('{{%photo}}');
        $this->dropTable('{{%table}}');
    }
}
