<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\providers;

/**
 * Description of newPHPClass
 *
 * @author kenne
 */
class Order {

    //retourne la liste des categories de produits
    public function getCategoryList() {
        $query = new \yii\db\Query();
        $query->select('*')->from('categorie')->orderBy('nom');
        $bd = (new \common\providers\OurConnection)->getDb();
        $listeCategorie = $query->createCommand($bd)->queryAll();
        return $listeCategorie;
    }

    //retourne la liste de tous les produits d'une categorie
    public function getProductList($categorie) {
        $bd = (new \common\providers\OurConnection)->getDb();
        $listeProduitsImages = [];
        $listeProduitsImages['id'] = $categorie['id_categorie'];
        $listeProduitsImages['nom'] = $categorie['nom'];
        $listeProduitsImages['type'] = $categorie['type'];

        $query1 = (new \yii\db\Query())->select('p.nom,p.id_produit,f2.nom as photo')
                ->from('produit p')
                ->innerJoin('photo f2', 'p.id_photo=f2.id_photo')
                ->where('p.id_categorie=' . $listeProduitsImages['id'] . '');
        $produits = $query1->createCommand($bd)->queryAll();
        $listeProduitsImages['produits'] = $produits;

        return $listeProduitsImages;
    }

    public function getProductInfos($tableauProduits) {
        $bd = (new \common\providers\OurConnection)->getDb();
        $tableauProduitsPlusInfos = [];
        $id = $tableauProduits['id'];
        $type = $tableauProduits['type'];
        $tableauProduitsPlusInfos['id'] = $id;
        $tableauProduitsPlusInfos['nom'] = $tableauProduits['nom'];
        $infosProduit = [];
        $produits = $tableauProduits['produits'];

        //ajout des produits de type boissson
        if (strcmp($type, "boisson") == 0) {

            foreach ($produits as $p) {
                $idCourant = $p['id_produit'];
                $infosProduit[] = $this->getInfosBoisson($p, $idCourant, $bd);
            }
        }

        //ajout des produits de type tabac

        if (strcmp($type, "tabac") == 0) {
            foreach ($produits as $p) {
                $idCourant = $p['id_produit'];
                $infosProduit[] = $this->getInfosTabac($p, $idCourant, $bd);
            }
        }


        //fin de l'ajout
        //ajout des produits de type repas
        if (strcmp($type, "repas") == 0) {
            foreach ($produits as $p) {
                $idCourant = $p['id_produit'];

                $infosProduit[] = $this->getInfosRepas($p, $idCourant, $bd);
            }
        }

        // fin de l'ajout des repas
        $tableauProduitsPlusInfos['produits'] = $infosProduit;

        return $tableauProduitsPlusInfos;
    }

    //cette fonction recupere les infos sur un produit donné en parametre
    public function getInfosBoisson($p, $idCourant, $bd) {
        /** Get drinks btlle prices from database* */
        $query2 = (new \yii\db\Query())->select('p.id_produit,bt.prix_vente_btlle as prixBtlle,bt.prix_vente_demie as prixDemie,bt.capacite,bt.nb_btlle as quantiteBouteille')
                ->from('bouteille bt')
                ->innerJoin('boisson b', 'b.id_boisson=bt.id_boisson')
                ->innerJoin('produit p', 'p.id_produit=b.id_boisson')
                ->where(['p.id_produit' => $idCourant]);
        $prixBttle = $query2->createCommand($bd)->queryOne();


        $name = $this->getCorrectName($p['nom']);
        $infos['nom'] = $name;
        $infos['photo'] = $p['photo'];
        $infos['id_produit'] = $p['id_produit'];
        $infos['quantiteBouteille'] = $prixBttle['quantiteBouteille'];
        if ($this->estVenduBouteille($prixBttle)) {
            $infos['prix_btlle'] = $prixBttle['prixBtlle'];
        }

        if ($this->estVenduDemie($prixBttle)) {
            $infos['prix_demie'] = $prixBttle['prixDemie'];
        }

        /** Get drinks 'conso' prices from database* */
        $query3 = (new \yii\db\Query())->select('c.nombre,c.prix,c.capacite,p.id_produit')
                ->from('produit p')
                ->innerJoin('boisson b', 'p.id_produit=b.id_boisson')
                ->innerJoin('conso c', 'b.id_boisson=c.id_boisson')
                ->where(['p.id_produit' => $idCourant]);
        $infosConso = $query3->createCommand($bd)->queryOne();
        if ($this->estVenduEnConso($infosConso)) {
            $infos['nombreConso'] = $infosConso['nombre'];
            $infos['prixConso'] = $infosConso['prix'];
            $infos['capaciteConso'] = $infosConso['capacite'];
        }

        /** Get drinks 'verre' prices from database* */
        $query4 = (new \yii\db\Query())->select('v.nombre nombre,v.prix,v.capacite,p.id_produit')
                ->from('produit p')
                ->innerJoin('boisson b', 'p.id_produit=b.id_boisson')
                ->innerJoin('verre v', 'b.id_boisson=v.id_boisson')
                ->where(['p.id_produit' => $idCourant]);
        $infosVerre = $query4->createCommand($bd)->queryOne();

        $infos['nombreVerre'] = $infosVerre['nombre'];
        $infos['prixVerre'] = $infosVerre['prix'];
        $infos['capaciteVerre'] = $infosVerre['capacite'];
        $infos['category'] = 1;
        //var_dump($infos);
        return $infos;
    }

    //cette fonction recupere les infos sur un produit de type boisson donné en parametre
    public function getInfosTabac($p, $idCourant, $bd) {
        $query5 = (new \yii\db\Query())->select('p.nom,t.id_tabac as idTabac,t.prix_achat as prixAchat, t.prix_vente as prixVente,t.quantite as quantite')
                ->from('produit p')
                ->innerJoin('tabac t', 'p.id_produit=t.id_tabac')
                ->where(['p.id_produit' => $idCourant]);
        $tabac = $query5->createCommand($bd)->queryOne();

        $name = $this->getCorrectName($p['nom']);
        $infos['nom'] = $name;
        $infos['photo'] = $p['photo'];
        $infos['id_produit'] = $p['id_produit'];
        $infos['prixAchat'] = $tabac['prixAchat'];
        $infos['prixVente'] = $tabac['prixVente'];
        $infos['quantite'] = $tabac['quantite'];
        $infos['category'] = 2;

        return $infos;
    }

    //cette fonction recupere les infos sur un produit de type repas qui lui est passé en parametre
    public function getInfosRepas($p, $idCourant, $bd) {
        $query6 = (new \yii\db\Query())->select('p.nom,r.id_repas as idRepas,r.prix_achat as prixAchat, r.prix_vente as prixVente,r.quantite as quantite')
                ->from('produit p')
                ->innerJoin('repas r', 'p.id_produit=r.id_repas')
                ->where(['p.id_produit' => $idCourant]);
        $repas = $query6->createCommand($bd)->queryOne();
        $name = $this->getCorrectName($p['nom']);
        $infos['nom'] = $name;
        $infos['photo'] = $p['photo'];
        $infos['id_produit'] = $p['id_produit'];
        $infos['prixAchat'] = $repas['prixAchat'];
        $infos['prixVente'] = $repas['prixVente'];
        $infos['quantite'] = $repas['quantite'];
        $infos['category'] = 3;
        return $infos;
    }

    //cette fonction retourne 1 si le produit est vendu en bouteille
    protected function estVenduBouteille($produit) {
        if ($produit['prixBtlle'] != null && $produit['prixBtlle'] > 0) {
            return 1;
        }
        return 0;
    }

    //cette fonction retourne 1 si le produit est vendu en demie bouteille
    protected function estVenduDemie($produit) {
        if ($produit['prixDemie'] != null && $produit['prixDemie'] > 0) {
            return 1;
        }
        return 0;
    }

    //cette fonction retourne 1 si le produit est vendu en verre
    protected function estVenduVerre($produit) {
        if ($produit['nombre'] != null && $produit['prix'] != null && $produit['prix'] > 0) {
            return 1;
        }
        return 0;
    }

    //cette fonction retourne 1 si le produit est vendu en conso
    protected function estVenduEnConso($produit) {
        if ($produit['nombre'] != null && $produit['prix'] != null && $produit['prix'] > 0) {
            return 1;
        }
        return 0;
    }

    //cette fonction retourne les noms des produits sans underscore
    protected function getCorrectName($nom) {
        $tempo = explode('_', $nom);
        $name = '';
        for ($i = 0; $i < count($tempo); $i++) {
            $name = $name . ' ' . $tempo[$i];
        }
        return $name;
    }

    //cette fonction retourne les infos sur le produit qui lui est passé en parametre dans le but de permettre la construction du panier pour ce produit
    public function getInfosBouteille($idProduit) {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('produit p')
                ->innerJoin('bouteille btle', 'btle.id_boisson=p.id_produit')
                ->where(['p.id_produit' => $idProduit]);
        $listeInfos = $query->createCommand($bd)->queryOne();
        return $listeInfos;
    }

    //cette fonction retourne les infos sur le produit dont on veut commander un verre
    public function getInfosVerre($idProduit) {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('produit p')
                ->innerJoin('verre v', 'v.id_boisson=p.id_produit')
                ->where(['p.id_produit' => $idProduit]);
        $listeInfos = $query->createCommand($bd)->queryOne();
        return $listeInfos;
    }

    //cette fonction retourne les infos sur le produit dont on commande une conso
    public function getInfosConso($idProduit) {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('produit p')
                ->innerJoin('bouteille b','b.id_boisson=p.id_produit')
                ->innerJoin('conso c', 'c.id_boisson=p.id_produit')
                ->where(['p.id_produit' => $idProduit]);
        $listeInfos = $query->createCommand($bd)->queryOne();
        return $listeInfos;
    }

    //cette fonction retourne les infos sur le repas commandé
    public function getInfosRepasPanier($idProduit) {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('produit p')
                ->innerJoin('repas r', 'r.id_repas=p.id_produit')
                ->where(['p.id_produit' => $idProduit]);
        $listeInfos = $query->createCommand($bd)->queryOne();
        return $listeInfos;
    }

    //cette fonction retourne les infos sur un produit de type tabac
    public function getInfosTabacPanier($idProduit) {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('produit p')
                ->innerJoin('tabac t', 't.id_tabac=p.id_produit')
                ->where(['p.id_produit' => $idProduit]);
        $listeInfos = $query->createCommand($bd)->queryOne();
        return $listeInfos;
    }

    //cette fonction retourne la liste des clients
    public function getCustommers() {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('client');
        $liste = $query->createCommand($bd)->queryAll();

        return $liste;
    }

    //cette fonction retourne la liste des tables
    public function getTablesList() {
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('*')->from('table');
        $liste = $query->createCommand($bd)->queryAll();

        return $liste;
    }

    //cette fonction prends un serveur et une commande et retourne 1 si la commande a bien ete enregistree
    public function createCustomCommand($idPreneur, $commande) {
        
        $bd = (new OurConnection())->getDb();
        $query = (new \yii\db\Query())->select('max(id_commande_client)')->from('commande_client');
        $lastidCom = $query->createCommand($bd)->queryScalar();
        $idCom = $lastidCom + 1;

        if ($idCom >= 1 && $idCom <= 9) {
            $code = '000' . $idCom;
        }
        if ($idCom >= 10 && $idCom < 100) {
            $code = '00' . $idCom;
        }
        if ($idCom >= 100 && $idCom < 1000) {
            $code = '0' . $idCom;
        }
        if ($idCom >= 1000 && $idCom < 10000) {
            $code = '0' . $idCom;
        }
        $date = date('Y-m-d H:i:s');
        $etat = "attente";
        $params = ['id_commande_client' => $idCom, 'id_preneur' => $idPreneur, 'id_client' => $commande['idclient'], 'id_table' => $commande['idTable'],
            'code' => $code, 'date' => $date, 'etat' => $etat];
        //insertion du client
        $transaction = $bd->beginTransaction();
        try {
            $bd->createCommand()->insert('commande_client', $params)->execute();
            $listeProduits = $commande['commande'];
            foreach ($listeProduits as $p) {
                $p = (array) $p;
                $produit =['id_commande_client'=>$idCom,'id_produit'=>$p['id'],'nombre'=> $p['quantiteEntiere'],'nb_demi'=>$p['quantiteDemie'],
                   'nb_conso'=>$p['quantiteConso'],'nb_verre'=>$p['quantiteVerre'],'prix'=>$p['prix'] ];
              

                $bd->createCommand()->insert('commande_produit', $produit)->execute();
            }
            $transaction->commit();
            $traitementOk = 1;

            $traitementOk;
        } catch (Exception $ex) {
            $transaction->rollBack();
            $traitementOk = 0;
        }

        return $traitementOk;
    }

}
