<?php

use yii\db\Migration;

class m130524_201442_init extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /**
         * create table user
         */
        $this->createTable('{{%user}}', [
            'id' => $this->integer(11)->unique(),
            'id_supp' => $this->integer(11),
            'nom' => $this->string(20)->notNull(),
            'prenom' => $this->string(20),
            'username' => $this->string(20)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string(50)->notNull()->unique(),          
            'role' => $this->string(15)->notNull()->check("role in ('DG','DT','AD','DEV','ADMIN')"),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->addPrimaryKey('pk_user', 'user', 'id');

        $this->alterColumn('{{%user}}', 'id', $this->integer(11) . 'NOT NULL AUTO_INCREMENT');
        
        $this->addForeignKey('fk1_user', 'user', 'id_supp', 'user', 'id');

        /**
         * create table client
         */
        $this->createTable('{{%client}}', [
            'id_user' => $this->integer(11),
            'denomination' => $this->string(100)->notNull(),
            'raison_sociale' => $this->string(20)->notNull(),
            'localisation' => $this->text()->notNull(),
            'email' => $this->string(30),
            'personne_source' => $this->string(30),
            'telephone_source' => $this->string(30),
            'telephone' => $this->text(),
            'boite_postale' => $this->text(),
            'adresse_web' => $this->text(),
            'type' => $this->string(10)->notNull()->check("role in ('prive','public')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_client', 'client', 'id_user');

        $this->alterColumn('{{%client}}', 'id_user', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * create table contact
         */
        $this->createTable('{{%contact}}', [
            'id_contact' => $this->integer(11),
            'id_user' => $this->integer(11)->notNull(),
            'id_client' => $this->integer(11)->notNull(),
            'date' => $this->date()->notNull(),
            'motif' => $this->text()->notNull(),
            'debouche' => $this->text()->notNull(),
            'moyen' => $this->string(20)->notNull()->check("role in ('appel','rencontre','email')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_contact', 'contact', 'id_contact');

        $this->alterColumn('{{%contact}}', 'id_contact', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_user of  contact table reference id of  user table
         */
        $this->addForeignKey('fk1_contact', 'contact', 'id_user', 'user', 'id');
        $this->addForeignKey('fk2_contact', 'contact', 'id_client', 'client', 'id_user');


        /**
         * create table fichier
         * 
         */
        $this->createTable('{{%fichier}}', [
            'id_fichier' => $this->integer(11),
            'id_user' => $this->integer(),
            'nom' => $this->text(255)->notNull(),
            'type' => $this->string(20)->notNull()->check("role in ('archive','photo','email')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_fichier', 'fichier', 'id_fichier');

        /**
         * foreign key id_user of client  table  reference id of  user table
         */
        $this->addForeignKey('fk1_fichier', 'fichier', 'id_user', 'user', 'id');

        $this->alterColumn('{{%fichier}}', 'id_fichier', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * create table marche_prive
         */
        $this->createTable('{{%marche_prive}}', [
            'id_marche' => $this->integer(11),
            'intitule' => $this->text(),
            'id_client' => $this->integer(11)->notNull(),
            'etat' => $this->string(10)->notNull()->check("role in ('gagne','perdu','en_attente')"),
            'date_dmd_cotation' => $this->date(),
            'date_depot_cotation' => $this->date(),
            'date_reponse' => $this->date(),
                ], $tableOptions);

        $this->addPrimaryKey('pk_marche_prive', 'marche_prive', 'id_marche');

        $this->alterColumn('{{%marche_prive}}', 'id_marche', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_client of table marche_prive reference id_user of client table
         */
        $this->addForeignKey('fk1_marche_prive', 'marche_prive', 'id_client', 'client', 'id_user');

        /**
         * create table marche_public
         */
        $this->createTable('{{%marche_public}}', [
            'id_marche' => $this->integer(11),
            'intitule' => $this->text(),
            'id_client' => $this->integer(11),
            'etat' => $this->string(10)->notNull()->check("role in ('gagne','perdu','en_attente')"),
            'date_connaiss' => $this->date()->notNull(),
            'date_prescript' => $this->date(),
            'date_depot_dossier' => $this->date(),
            'date_reponse' => $this->date(),
                ], $tableOptions);

        $this->addPrimaryKey('pk_marche_public', 'marche_public', 'id_marche');

        $this->alterColumn('{{%marche_public}}', 'id_marche', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_client of  marche_public table reference id_user of client table
         */
        $this->addForeignKey('fk1_marche_public', 'marche_public', 'id_client', 'client', 'id_user');

        /**
         * create table bon_de_commande
         */
        $this->createTable('{{%bon_cmde}}', [
            'id_bon' => $this->integer(11),
            'id_client' => $this->integer(11)->notNull(),
            'produit' => $this->text()->notNull(),
            'montant' => $this->string()->notNull(),
            'date_reception' => $this->date()->notNull(),
            'delai' => $this->date()->notNull(),
                ], $tableOptions);

        $this->addPrimaryKey('pk_bon_cmde', 'bon_cmde', 'id_bon');

        $this->alterColumn('{{%bon_cmde}}', 'id_bon', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_client of  bon_cmde reference id_user of client table
         */
        $this->addForeignKey('fk1_bon_cmde', 'bon_cmde', 'id_client', 'client', 'id_user');

        /**
         * create table publication
         */
        $this->createTable('{{%publication}}', [
            'id_publ' => $this->integer(11),
            'id_user' => $this->integer(11)->notNull(),
            'date_post' => $this->dateTime()->notNull(),
            'contenu' => $this->text()->notNull(),
            'type' => $this->string(20)->notNull()->check("role in ('idee','suggestion')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_publication', 'publication', 'id_publ');

        $this->alterColumn('{{%publication}}', 'id_publ', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_user of  publication table reference id of  user table
         */
        $this->addForeignKey('fk1_publication', 'publication', 'id_user', 'user', 'id');

        /**
         * create table lire_publ
         */
        $this->createTable('{{%lire_publ}}', [
            'id_publ' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
            'affiche' => $this->string(3)->notNull()->defaultValue('non')->check("affiche in ('oui','non')"),
            'lu' => $this->string(3)->notNull()->defaultValue('non')->check("lu in ('oui','non')"),
            
                ], $tableOptions);

        $this->addprimaryKey('pk_lire_publ', 'lire_publ', ['id_user', 'id_publ']);
        /**
         * foreign key id_user of  lire_publ table reference id of  user table
         */
        $this->addForeignKey('fk1_lire_publ', 'lire_publ', 'id_user', 'user', 'id');

        /**
         * foreign key id_publ of  lire_publ table reference id of  user table
         */
        $this->addForeignKey('fk2_lire_publ', 'lire_publ', 'id_publ', 'publication', 'id_publ');
        
        
        /**
         * create table commenter
         */
        $this->createTable('{{%commenter}}', [
            'id_comment' => $this->integer(11),
            'id_publ' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
            'contenu' => $this->string()->notNull(),
            'date_post' => $this->dateTime()->notNull(),
                ], $tableOptions);

        $this->addprimaryKey('pk_commenter', 'commenter', 'id_comment');
        
        $this->alterColumn('{{%commenter}}', 'id_comment', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');
        /**
         * foreign key id_user of  commenter table reference id of  user table
         */
        $this->addForeignKey('fk1_commenter', 'commenter', 'id_user', 'user', 'id');

        /**
         * foreign key id_publ of commenter table reference id of  user table
         */
        $this->addForeignKey('fk2_commenter', 'commenter', 'id_publ', 'publication', 'id_publ');
        
        /**
         * create table lire_comment
         */
        $this->createTable('{{%lire_comment}}', [
            'id_comment' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
            'affiche' => $this->string(3)->notNull()->defaultValue('non')->check("affiche in ('oui','non')"),
            'lu' => $this->string(3)->notNull()->defaultValue('non')->check("lu in ('oui','non')"),
            
                ], $tableOptions);
        $this->addprimaryKey('pk_lire_comment', 'lire_comment', ['id_user', 'id_comment']);
        /**
         * foreign key id_user of  lire_comment table reference id of  user table
         */
        $this->addForeignKey('fk1_lire_comment', 'lire_comment', 'id_user', 'user', 'id');

        /**
         * foreign key id_publ of  lire_publ table reference id of  user table
         */
        $this->addForeignKey('fk2_lire_comment', 'lire_comment', 'id_comment', 'commenter', 'id_comment');

        /**
         * create table reunion
         */
        $this->createTable('{{%reunion}}', [
            'id_reunion' => $this->integer(),
            'id_fichier' => $this->integer(11),
            'id_supp' => $this->integer(11),
            'title' => $this->string(),
            'description' => $this->text(),
            'date' => $this->date()->notNull(),
            'heure_debut' => $this->time()->notNull(),
            'heure_fin' => $this->time()->notNull(),
            'lieu' => $this->string(30),
                ], $tableOptions);

        $this->addPrimaryKey('pk_reunion', 'reunion', 'id_reunion');

        $this->alterColumn('{{%reunion}}', 'id_reunion', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');


        /**
         * create table participer_reunion
         */
        $this->createTable('{{%participer_reunion}}', [
            'id_user' => $this->integer(11),
            'id_reunion' => $this->integer(11)->notNull(),
            'ajoute_apres' => $this->string(3)->notNull()->check("role in ('oui','non')"),
            'lus' => $this->string(3)->notNull()->defaultValue('non')->check("role in ('oui','non')"),
                ], $tableOptions);

        $this->addprimaryKey('pk_participer_reunion', 'participer_reunion', ['id_user', 'id_reunion']);
        
        /**
         * foreign key id_user of  participer_reunion table reference id of  user table
         */
        $this->addForeignKey('fk1_participer_reunion', 'participer_reunion', 'id_user', 'user', 'id');

        /**
         * foreign key id_publ of  participer_reunion table reference id of  user table
         */
        $this->addForeignKey('fk2_participer_reunion', 'participer_reunion', 'id_reunion', 'reunion', 'id_reunion');


        /**
         * create table project
         */
        $this->createTable('{{%projet}}', [
            'id_projet' => $this->integer(),
            'id_fichier' => $this->integer(11),
            'nom' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'date_debut' => $this->date()->notNull(),
            'date_fin' => $this->date(),
            'prestataire' => $this->string(30),
            'type' => $this->string(20)->notNull()->check("role in ('adm_struct','technique')"),
            'statut' => $this->string(20)->notNull()->check("role in ('en_cours','en_attente','termine_attente','termine','abandon')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_projet', 'projet', 'id_projet');

        $this->alterColumn('{{%projet}}', 'id_projet', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_fichier of  project table reference id_fichier of  file table
         */
        $this->addForeignKey('fk1_projet', 'projet', 'id_fichier', 'fichier', 'id_fichier');


        /**
         * create table dev_projet
         */
        $this->createTable('{{%dev_projet}}', [
            'id_projet' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
            'role' => $this->string(20)->notNull()->check("role in ('dev','chef')"),
                ], $tableOptions);
       
        $this->addprimaryKey('pk_dev_projet', 'dev_projet', ['id_user', 'id_projet']);
        
        /**
         * foreign key id_user of  dev_projet table reference id of  user table
         */
        $this->addForeignKey('fk1_dev_projet', 'dev_projet', 'id_user', 'user', 'id');

        /**
         * foreign key id_projet of  dev_projet table reference id_projet of  projet table
         */
        $this->addForeignKey('fk2_dev_projet', 'dev_projet', 'id_projet', 'projet', 'id_projet');


        /**
         * create table activite
         */
        $this->createTable('{{%activite}}', [
            'id_activite' => $this->integer(11),
            'id_projet' => $this->integer(11)->notNull(),
            'id_fichier' => $this->integer(11),
            'nom' => $this->string(30),
            'description' => $this->text(),
            'prestataire' => $this->string(30),
            'date_debut' => $this->date()->notNull(),
            'date_fin' => $this->date(),
            'type' => $this->string(20)->notNull()->check("type in ('adm_struct','technique')"),
            'statut' => $this->string(20)->notNull()->check("statut in ('en_cours','en_attente','termine_attente','termine','abandon')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_activite', 'activite', 'id_activite');

        $this->alterColumn('{{%activite}}', 'id_activite', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_fichier of  activite table reference id_fichier of fichier table
         */
        $this->addForeignKey('fk1_activite', 'activite', 'id_fichier', 'fichier', 'id_fichier');

        /**
         * foreign key id_projet of  activite table reference id_projet of projet table
         */
        $this->addForeignKey('fk2_activite', 'activite', 'id_projet', 'projet', 'id_projet');

        /**
         * create table tache
         */
        $this->createTable('{{%tache}}', [
            'id_tache' => $this->integer(11),
            'id_activite' => $this->integer(11)->notNull(),
            'id_fichier' => $this->integer(11),
            'nom' => $this->string(30),
            'description' => $this->text(),
            'prestataire' => $this->string(30),
            'date_debut' => $this->date()->notNull(),
            'date_fin' => $this->date(),
            'type' => $this->string(20)->notNull()->check("type in ('adm_struct','technique')"),
            'statut' => $this->string(20)->notNull()->check("statut in ('en_cours','en_attente','termine_attente','termine','abandon')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_tache', 'tache', 'id_tache');

        $this->alterColumn('{{%tache}}', 'id_tache', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');

        /**
         * foreign key id_fichier of  tache table reference id_fichier of fichier table
         */
        $this->addForeignKey('fk1_tache', 'tache', 'id_fichier', 'fichier', 'id_fichier');

        /**
         * foreign key id_activite of  activite table reference id_activate of activite table
         */
        $this->addForeignKey('fk2_tache', 'tache', 'id_activite', 'activite', 'id_activite');


        /**
         * create table faire_activite
         */
        $this->createTable('{{%faire_activite}}', [
            'id_activite' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
                ], $tableOptions);

         $this->addprimaryKey('pk_faire_activite', 'faire_activite', ['id_user', 'id_activite']);
         
        /**
         * foreign key id_user of faire_activite table reference id of  user table
         */
        $this->addForeignKey('fk1_faire_activite', 'faire_activite', 'id_user', 'user', 'id');

        /**
         * foreign key id_activite of faire_activite table reference id_activite of activite table
         */
        $this->addForeignKey('fk2_faire_activite', 'faire_activite', 'id_activite', 'activite', 'id_activite');


        /**
         * create table faire_tache
         */
        $this->createTable('{{%faire_tache}}', [
            'id_tache' => $this->integer(11)->notNull(),
            'id_user' => $this->integer(11)->notNull(),
                ], $tableOptions);
        
        $this->addprimaryKey('pk_faire_tache', 'faire_tache', ['id_user', 'id_tache']);

        /**
         * foreign key id_user of faire_tache table reference id of  user table
         */
        $this->addForeignKey('fk1_faire_tache', 'faire_tache', 'id_user', 'user', 'id');

        /**
         * foreign key id_tache of faire_tache table reference id_tache of tache table
         */
        $this->addForeignKey('fk2_faire_tache', 'faire_tache', 'id_tache', 'tache', 'id_tache');

        /**
         * create table message
         */
        $this->createTable('{{%message}}', [
            'id_mess' => $this->integer(11),
            'contenu' => $this->text(),
            'date_post' => $this->dateTime()->notNull(),
            'affiche' => $this->string(3)->notNull()->defaultValue('non')->check("affiche in ('oui','non')"),
            'lu' => $this->string(3)->notNull()->defaultValue('non')->check("lu in ('oui','non')"),
                ], $tableOptions);

        $this->addPrimaryKey('pk_message', 'message', 'id_mess');

        $this->alterColumn('{{%message}}', 'id_mess', $this->integer(11) . ' NOT NULL AUTO_INCREMENT');
    }

    public function down() {

        $this->dropTable('{{%marche_prive}}');
        $this->dropTable('{{%marche_public}}');
        $this->dropTable('{{%bon_cmde}}');
        $this->dropTable('{{%contact}}');


        $this->dropTable('{{%lire_publ}}');
        $this->dropTable('{{%publication}}');

        $this->dropTable('{{%participer_reunion}}');
        $this->dropTable('{{%reunion}}');

        $this->dropTable('{{%dev_projet}}');
        $this->dropTable('{{%faire_activite}}');
        $this->dropTable('{{%faire_tache}}');

        $this->dropTable('{{%tache}}');
        $this->dropTable('{{%client}}');
        $this->dropTable('{{%activite}}');
        $this->dropTable('{{%projet}}');

        $this->dropTable('{{%fichier}}');
        $this->dropTable('{{%user}}');

        $this->dropTable('{{%message}}');
    }

}
