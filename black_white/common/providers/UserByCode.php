<?php
namespace common\providers;

use common\providers\OurConnection;
use yii\db\Query;

/**
 * This is the cLass for all select query related to the accounts  
 */
class UserByCode 
{
  
    /*
     * This function allow to select an user with his code into actual database.
     * 
     * @return Array
     */
    public function getUser($code)
    {
        $db = (new OurConnection)->getDb();
        $query = (new Query())
                ->select('*')
                ->from('user')
                ->where(['code' => $code]);
        return $query->createCommand($db)->queryOne();
    }
    /*
     * This function allow to insert in TABLE COMMANDE_CLIENT, information concerning .
     * what server has accept what order and when(the date of that action)
     * We have to guive it in parameter, the id  of Order.
     * @return Array
     */
    
   public function UpdateCommandeClient($id,$id_serveur)
    {
        $db = (new OurConnection)->getDb();
        $query = new Query();
        $update = $query->createCommand($db)
                ->update('commande_client',['id_serveur' => $id_serveur,'etat' => 'servie'],'id_commande_client ='.$id)
                ->execute();
        return $update;
    }
     /*
     * This function allow to select in database all order which was not yet accept by somme server .
     * @return Array
     */
     public function SelectCommandeClient($etat)
    {
       $db = (new OurConnection)->getDb();
       $query = new \yii\db\Query();
       $select= $query->select('cc.id_table,cc.id_commande_client,cc.id_client,p.nom,cp.nombre,cp.nb_demi,cp.nb_conso,cp.nb_verre,cp.prix,cc.code,cc.date')
                ->from('commande_produit cp')
                ->innerJoin('produit p','p.id_produit=cp.id_produit')
                ->innerJoin('commande_client cc','cc.id_commande_client=cp.id_commande_client')
                ->where(['cc.etat'=>$etat])
                ->orderBy(['cc.id_commande_client'=>'SORT_DSC']);
                $commandes = $select->createCommand($db)->queryAll();
        return $commandes;
    }
    
    /*
     * This function allow to select in database all order which was  yet accept by somme server .
     * @return Array
     */
     public function SelectAcceptedCommandeClient($etat)
    {
       $db = (new OurConnection)->getDb();
       $query = new \yii\db\Query();
       $select= $query->select('cc.id_table,cc.id_commande_client,cc.id_client,p.nom,cp.nombre,cp.nb_demi,cp.nb_conso,cp.nb_verre,cp.prix,cc.code,cc.date')
                ->from('commande_produit cp')
                ->innerJoin('produit p','p.id_produit=cp.id_produit')
                ->innerJoin('commande_client cc','cc.id_commande_client=cp.id_commande_client')
                ->where(['cc.etat'=>$etat])
                ->orderBy(['cc.id_commande_client'=>'SORT_DSC']);
                $commandes = $select->createCommand($db)->queryAll();
        return $commandes;
    }
    /*
     * This function allow to get user name using thier id .
     * @return Array
     */
    public function SelectUserNameById($id)
    {
       $db = (new OurConnection)->getDb();
       $query = (new Query())
               ->select('nom')
               ->from('user')
               ->where(['id' => $id]);
       return $query->createCommand($db)->queryOne();
    }
    /*
     * This function allow to get Table name using thier id .
     * @return Array
     */
    public function SelectTableNameById($id)
    {
       $db = (new OurConnection)->getDb();
       $query = (new Query())
               ->select('nom')
               ->from('table')
               ->where(['id_table' => $id]);
       return $query->createCommand($db)->queryOne();
    }
    
    
    public function SelectAddCommandeClient()
    {
       $db = (new OurConnection)->getDb();
       $query = (new Query())
               ->select('count(*) as cnt')
               ->from('commande_client')
               ->where(['etat' => 'attente']);
       return $query->createCommand($db)->queryOne();
    }
    
    public function CancelCommandeClient($idcommande,$id_supp)
    {
        $db = (new OurConnection)->getDb();
        $query = (new Query());
        $cancel = $query->createCommand($db)
                ->update('commande_client',['id_supp' => $id_supp,'etat' => 'supprime'],'id_commande_client ='.$idcommande)
                ->execute();
        return $cancel;
    }
}