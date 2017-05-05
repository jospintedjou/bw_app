<?php

namespace frontend\modules\order\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use frontend\modules\order\models\AuthentificationCodeForm;
use common\models\CommandeClient;
use common\models\User;
use common\providers\UserByCode;
use common\providers\Order;
use yii\web\Response;
use yii\web\Request;
use yii\web\Session;

class OrderController extends \yii\web\Controller {
	//Yii::$app->controller->enableCsrfValidation = false;
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'accept-serv-order', 'add-table', 'order-entry', 'print-bill', 'index', 'print-delivry-order',
                            'view-presence-recap', 'view-sales-recap', 'infos', 'commande', 'conso', 'verre', 'erasepanier', 'demiebouteille', 'repas', 'tabac', 'listerclients', 'listertables', 'save-order','supprimer'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'accept-serv-order', 'add-table', 'print-bill', 'index', 'print-delivry-order',
                            'view-presence-recap', 'view-sales-recap'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }
	/**
 * @inheritdoc
 */
public function beforeAction($action)
{            
    
        $this->enableCsrfValidation = false;
    

    return parent::beforeAction($action);
}

    public function actionAcceptServOrder() {

        $model = new AuthentificationCodeForm();
        //  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (($model->load(yii::$app->request->post())) && ($model->validate())) {
            $user = (new \common\providers\UserByCode)->getUser($model->code);

            if (!($user == null)) {

                // user of that code exist in that system
                //we are going to write in database that this user accept to serve one order
                //Also we are going to display again list of order not yet accept by yousing Ajax code
                $query = ( new \common\providers\UserByCode)->UpdateCommandeClient(3, $user['id'], $model->code);
                //the call of function allowing we to create a delivryorder
                //**printDelivryOrder($printer); ************
                print_r($user);
            } else {
                // user of that code not exist in that system
                // that is why we are going to display again the entry code modal 
                print_r('user is empty');
            }
        } else {
            
        }

        //the displaying again accep-serv-order view using the AJax render

        return $this->render('accept-serv-order', ['model' => $model]);
    }

    public function actionAddTable() {
        return $this->render('add-table');
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionOrderEntry() {

        // recuperons la liste des categories
        $orderInstance = new Order();
        $listeCategories = $orderInstance->getCategoryList();

        //recuperons la liste des produits de chaque categorie
        $listeProduitsToutesCategories = [];
        foreach ($listeCategories as $categorie) {
            $listeProduitsCategorie = $orderInstance->getProductList($categorie);
            $listeProduitsToutesCategories[] = $listeProduitsCategorie;
        }

        // recuperons les infos de tous les produits de chacune des categories
        $listeProduitsToutesCategoriesPlusInfos = [];
        foreach ($listeProduitsToutesCategories as $listeProduits) {
            $listeProduitsToutesCategoriesPlusInfos[] = $orderInstance->getProductInfos($listeProduits);
        }

        // construisons la liste des contenus de chaque Tab au niveau de l'interface graphique
        $listeContents = [];
        foreach ($listeProduitsToutesCategoriesPlusInfos as $list) {
            // var_dump($list);
            $content = $this->renderCateguoryContent($list);
            $tempo['contenu'] = $content;
            $listeContents[] = $content;
        }

        // contruisons la liste a envoyer pour construire l'IHM
        $listeRendu = [];
        for ($i = 0; $i < count($listeCategories); $i++) {
            $tempo['category'] = $listeCategories[$i]['nom'];
            $tempo['contenu'] = $listeContents[$i];
            $listeRendu[] = $tempo;
        }


        return $this->render('order-entry', ['liste' => $listeRendu]);
    }

    public function actionPanier() {
        return $this->render('panier');
    }

    public function actionPrintBill($id_order) {
        return $this->render('print-bill');
    }

    public function actionPrintDelivryOrder($id_order) {
        return $this->render('print-delivry-order');
    }

    public function actionViewPresenceRecap() {
        return $this->render('view-presence-recap');
    }

    public function actionViewSalesRecap() {
        return $this->render('view-sales-recap');
    }

    //cette fonction retourne la liste des produits d'une commmande
    public function actionCommande() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $listeProduits = Yii::$app->session->get('commande');
        $prixtotal = 0;
        $commande = [];
        if (count($listeProduits) > 0) {
            foreach ($listeProduits as $p) {
                $prixtotal += $p['prix'];
            }
            $commande['liste'] = $listeProduits;
            $commande['prixTotal'] = $prixtotal;
        }
        return $commande;
    }

    //cette fonction retourne 1 si le produit sollicite de type boisson et demande en bouteillen entiere a ete ajoute a la commande courante et 0 sinon
    public function actionInfos($idProduit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $com = Yii::$app->session->get('commande');

        $traitement_ok = 0;
        $listeProduitsCommande = [];
        //$idProduit = $params['idProduit']; 
        if (isset($idProduit) && !empty($idProduit)) {
            $listeInfos = $orderInstance->getInfosBouteille($idProduit);
            $nombreEnStock = $listeInfos['nb_btlle'];
            $prixBttle = $listeInfos['prix_vente_btlle'];
            $nom = $listeInfos['nom'];
            $nature = "boisson";
            if ((int) $nombreEnStock > 0) {
                $commandeCourante = [];
                $commandeCourante['idProduit'] = $idProduit;
                $commandeCourante['nom'] = $nom;
                $commandeCourante['nature'] = $nature;
                $commandeCourante['prixDemie'] = 0;
                $commandeCourante['prixUnitaireBtlle'] = $prixBttle;
                $commandeCourante['prixUnitaireConso'] = 0;
                $commandeCourante['prixUnitaireVerre'] = 0;
                $commandeCourante['prix'] = $prixBttle;
                $commandeCourante['q1'] = 1;
                $commandeCourante['q2'] = 0;
                $commandeCourante['q3'] = 0;
                $commandeCourante['q4'] = 0;


                if (isset($com)) {
                    //var_dump($liste);
                    $nouvelleListe = [];
                    $isInList = 0;
                    foreach ($com as $l) {

                        if (strcmp($l['nom'], $nom) == 0) {
                            $l['q1'] = $l['q1'] + 1;
                            $l['prixUnitaireBtlle'] = $prixBttle;
                            $l['prix'] = $l['prix'] + $prixBttle;
                            $nouvelleListe[] = $l;
                            $isInList = 1;
                        } else {
                            $nouvelleListe[] = $l;
                        }
                    }
                    if ($isInList == 0) {
                        $nouvelleListe[] = $commandeCourante;
                    }
                    $listeProduitsCommande = $nouvelleListe;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                } else {
                    $listeProduitsCommande[] = $commandeCourante;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                }
            }

            return $traitement_ok;
        }
    }

    //cette fonction retourne 1 si la conso sollicitee a ete ajoutee a la commande
    public function actionConso($idProduit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $listeCommandes = Yii::$app->session->get('commande');
        $listeProduitsCommande = [];

        if (isset($idProduit) && !empty($idProduit)) {
            $traitement_ok = 0;
            $listeInfos = $orderInstance->getInfosConso($idProduit);
            $nombreBtlle = $listeInfos['nb_btlle'];
            $nombre = $listeInfos['nombre'];
            $prixConso = $listeInfos['prix'];
            $nom = $listeInfos['nom'];
            $nature = "boisson";
            if ((int) $nombre > 0 && (int)$nombreBtlle>0) {

                $commandeCourante = [];
                $commandeCourante['idProduit'] = $idProduit;
                $commandeCourante['nom'] = $nom;
                $commandeCourante['nature'] = $nature;
                $commandeCourante['prixUnitaireConso'] = $prixConso;
                $commandeCourante['prixDemie'] = 0;
                $commandeCourante['prixUnitaireBtlle'] = 0;
                $commandeCourante['prixUnitaireVerre'] = 0;
                $commandeCourante['prix'] = $prixConso;
                $commandeCourante['q1'] = 0;
                $commandeCourante['q2'] = 0;
                $commandeCourante['q3'] = 1;
                $commandeCourante['q4'] = 0;

                if (isset($listeCommandes)) {
                    //var_dump($liste);
                    $nouvelleListe = [];
                    $isInList = 0;
                    foreach ($listeCommandes as $l) {

                        if (strcmp($l['nom'], $nom) == 0) {

                            $l['q3'] = $l['q3'] + 1;
                            $l['prixUnitaireConso'] = $prixConso;
                            $l['prix'] = $l['prix'] + $prixConso;
                            $nouvelleListe[] = $l;
                            $isInList = 1;
                        } else {
                            $nouvelleListe[] = $l;
                        }
                    }
                    if ($isInList == 0) {
                        $nouvelleListe[] = $commandeCourante;
                    }
                    $listeProduitsCommande = $nouvelleListe;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                } else {
                    $listeProduitsCommande[] = $commandeCourante;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                }
            }
        }
        return $traitement_ok;
    }

    //cette fonction retourne 1 si le verre sollicite a ete ajoute a la commnande
    public function actionVerre($idProduit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $listeCommandes = Yii::$app->session->get('commande');
        $traitement_ok = 0;
        $listeProduitsCommande = [];
        if (isset($idProduit) && !empty($idProduit)) {
            $listeInfos = $orderInstance->getInfosVerre($idProduit);
            $nombre = $listeInfos['nombre'];
            $prixVerrre = $listeInfos['prix'];
            $nom = $listeInfos['nom'];
            $nature = "boisson";
            if ((int) $nombre > 0) {
                $commandeCourante = [];
                $commandeCourante['idProduit'] = $idProduit;
                $commandeCourante['nom'] = $nom;
                $commandeCourante['nature'] = $nature;
                $commandeCourante['prixUnitaireVerre'] = $prixVerrre;
                $commandeCourante['prixDemie'] = 0;
                $commandeCourante['prixUnitaireBtlle'] = 0;
                $commandeCourante['prixUnitaireConso'] = 0;
                $commandeCourante['prix'] = $prixVerrre;
                $commandeCourante['q1'] = 0;
                $commandeCourante['q2'] = 1;
                $commandeCourante['q3'] = 0;
                $commandeCourante['q4'] = 0;


                if (isset($listeCommandes)) {
                    //var_dump($liste);
                    $nouvelleListe = [];
                    $isInList = 0;
                    foreach ($listeCommandes as $l) {

                        if (strcmp($l['nom'], $nom) == 0) {
                            $l['q2'] = $l['q2'] + 1;
                            $l['prixUnitaireVerre'] = $prixVerrre;
                            $l['prix'] = $l['prix'] + $prixVerrre;
                            $nouvelleListe[] = $l;
                            $isInList = 1;
                        } else {
                            $nouvelleListe[] = $l;
                        }
                    }
                    if ($isInList == 0) {
                        $nouvelleListe[] = $commandeCourante;
                    }
                    $listeProduitsCommande = $nouvelleListe;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                } else {
                    $listeProduitsCommande[] = $commandeCourante;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                }
            }
        }
        return $traitement_ok;
    }

    //cette fonction vide la variable panier en session lors de la suppression d'une commande
    public function actionErasepanier() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->session->set('commande', []);
        $listeCommandes = Yii::$app->session->get('commande');
        if (empty($listeCommandes)) {
            $traitementOk = 1;
        } else {
            $traitementOk = 0;
        }
        return $traitementOk;
    }

    public function actionDemiebouteille($idProduit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $com = Yii::$app->session->get('commande');

        $traitement_ok = 0;
        $listeProduitsCommande = [];

        if (isset($idProduit) && !empty($idProduit)) {
            $listeInfos = $orderInstance->getInfosBouteille($idProduit);
            $prixDemie = $listeInfos['prix_vente_demie'];
            if ($prixDemie != null && $prixDemie > 0) {
                $nombreEnStock = $listeInfos['nb_btlle'];
                $prixDemie = $listeInfos['prix_vente_demie'];
                $prixBttle = $listeInfos['prix_vente_btlle'];
                $nom = $listeInfos['nom'];
                $nature = "boisson";
                if ((int) $nombreEnStock > 0) {
                    $commandeCourante = [];
                    $commandeCourante['idProduit'] = $idProduit;
                    $commandeCourante['nom'] = $nom;
                    $commandeCourante['nature'] = $nature;
                    $commandeCourante['prixDemie'] = $prixDemie;
                    $commandeCourante['prixUnitaireBtlle'] = $prixBttle;
                    $commandeCourante['prix'] = $prixDemie;
                    $commandeCourante['prixUnitaireConso'] = 0;
                    $commandeCourante['prixUnitaireVerre'] = 0;


                    (float) $commandeCourante['q1'] = 0;
                    $commandeCourante['q2'] = 0;
                    $commandeCourante['q3'] = 0;
                    $commandeCourante['q4'] = 0.5;

                    if (isset($com)) {
                        //var_dump($liste);
                        $nouvelleListe = [];
                        $isInList = 0;
                        foreach ($com as $l) {

                            if ($l['idProduit'] == $idProduit) {

                                if ($l['q4'] == 0.5) {
                                    $l['q1'] += 1;
                                    $l['q4'] = 0;
                                } else {
                                    (float) $l['q4'] = $l['q4'] + 0.5;
                                }
                                $l['prix'] = $l['prix'] + $prixDemie;
                                $l['prixDemie'] = $prixDemie;
                                $nouvelleListe[] = $l;
                                $isInList = 1;
                            } else {
                                $nouvelleListe[] = $l;
                            }
                        }
                        if ($isInList == 0) {
                            $nouvelleListe[] = $commandeCourante;
                        }
                        $listeProduitsCommande = $nouvelleListe;
                        Yii::$app->session->set('commande', $listeProduitsCommande);
                        $traitement_ok = 1;
                    } else {
                        $listeProduitsCommande[] = $commandeCourante;
                        Yii::$app->session->set('commande', $listeProduitsCommande);
                        $traitement_ok = 1;
                    }
                }
            }
            return $traitement_ok;
        }
    }

    //cette fonction permet d'ajouter un repas dans le panier
    public function actionRepas($idProduit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $com = Yii::$app->session->get('commande');

        $traitement_ok = 0;
        $listeProduitsCommande = [];
        //$idProduit = $params['idProduit']; 
        if (isset($idProduit) && !empty($idProduit)) {
            $listeInfos = $orderInstance->getInfosRepasPanier($idProduit);
            $nombreEnStock = $listeInfos['quantite'];
            $prixRepas = $listeInfos['prix_vente'];
            $nom = $listeInfos['nom'];
            $nature = "repas";
            if ((int) $nombreEnStock > 0) {
                $commandeCourante = [];
                $commandeCourante['idProduit'] = $idProduit;
                $commandeCourante['nom'] = $nom;
                $commandeCourante['nature'] = $nature;
                $commandeCourante['prixUnitaireRepas'] = $prixRepas;
                $commandeCourante['prix'] = $prixRepas;
                $commandeCourante['q1'] = 1;
                $commandeCourante['q2'] = 0;
                $commandeCourante['q3'] = 0;
                $commandeCourante['q4'] = 0;
                if (isset($com)) {
                    //var_dump($liste);
                    $nouvelleListe = [];
                    $isInList = 0;
                    foreach ($com as $l) {

                        if (strcmp($l['nom'], $nom) == 0) {
                            $l['q1'] = $l['q1'] + 1;
                            $l['prix'] = $l['prix'] + $prixRepas;
                            $nouvelleListe[] = $l;
                            $isInList = 1;
                        } else {
                            $nouvelleListe[] = $l;
                        }
                    }
                    if ($isInList == 0) {
                        $nouvelleListe[] = $commandeCourante;
                    }
                    $listeProduitsCommande = $nouvelleListe;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                } else {
                    $listeProduitsCommande[] = $commandeCourante;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                }
            }

            return $traitement_ok;
        }
    }

    public function actionTabac($idProduit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $com = Yii::$app->session->get('commande');

        $traitement_ok = 0;
        $listeProduitsCommande = [];
        //$idProduit = $params['idProduit']; 
        if (isset($idProduit) && !empty($idProduit)) {
            $listeInfos = $orderInstance->getInfosTabacPanier($idProduit);
            $nombreEnStock = $listeInfos['quantite'];
            $prixTabac = $listeInfos['prix_vente'];
            $nom = $listeInfos['nom'];
            $nature = "tabac";
            if ((int) $nombreEnStock > 0) {
                $commandeCourante = [];
                $commandeCourante['idProduit'] = $idProduit;
                $commandeCourante['nom'] = $nom;
                $commandeCourante['nature'] = $nature;
                $commandeCourante['prixUnitaireTabac'] = $prixTabac;
                $commandeCourante['prix'] = $prixTabac;
                $commandeCourante['q1'] = 1;
                $commandeCourante['q2'] = 0;
                $commandeCourante['q3'] = 0;
                $commandeCourante['q4'] = 0;

                if (isset($com)) {
                    //var_dump($liste);
                    $nouvelleListe = [];
                    $isInList = 0;
                    foreach ($com as $l) {

                        if (strcmp($l['nom'], $nom) == 0) {
                            $l['q1'] = $l['q1'] + 1;
                            $l['prix'] = $l['prix'] + $prixTabac;
                            $nouvelleListe[] = $l;
                            $isInList = 1;
                        } else {
                            $nouvelleListe[] = $l;
                        }
                    }
                    if ($isInList == 0) {
                        $nouvelleListe[] = $commandeCourante;
                    }
                    $listeProduitsCommande = $nouvelleListe;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                } else {
                    $listeProduitsCommande[] = $commandeCourante;
                    Yii::$app->session->set('commande', $listeProduitsCommande);
                    $traitement_ok = 1;
                }
            }

            return $traitement_ok;
        }
    }
    
    //cette fonction retourne 1 si le produit a bien ete supprimer de la commande en session
    public function actionSupprimer($idProduit){
         Yii::$app->response->format = Response::FORMAT_JSON; 
         $commande = Yii::$app->session->get('commande');
        $traitementOk = 0;
        $nouvelleCommande=[];
        if(isset($idProduit)){
            $nb = count($commande);
            for($i=0; $i<$nb;$i++){
                $c = $commande[$i];
               if($c['idProduit']==$idProduit){
                   $traitementOk=1;
               }else{
                   $nouvelleCommande[]=$c;  
               }
             }
             if($traitementOk==1){
                  Yii::$app->session->set('commande', $nouvelleCommande);
             }
        }
        
        return $traitementOk;
    }



    //cette fonction retourne la liste des clients enregistres
    public function actionListerclients() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $listeClients = $orderInstance->getCustommers();

        return $listeClients;
    }

    //cette fonction retourne la liste des tables enregistrees
    public function actionListertables() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $listeTables = $orderInstance->getTablesList();

        return $listeTables;
    }

    //cette fonction permet de sauveguarder une commande
    public function actionSaveOrder() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $orderInstance = new Order();
        $p = (array) json_decode(Yii::$app->request->post('param'));
        //a continuer lundi
        //return Yii::$app->user->identity->nom;
        $client = $p['idclient'];
        $table = $p['idTable'];
        $traitementOK = 0;
        if (strcmp($client, "default") == 0 || strcmp($table, "default") == 0) {
            $traitementOK = 2;
        } else {
            $idUserPreneur = Yii::$app->user->identity->id;
            $traitementOK = $orderInstance->createCustomCommand($idUserPreneur, $p);
            if ($traitementOK == 1) {
                Yii::$app->session->set('commande', []);
            } else {
                $traitementOK = 0;
            }
        }


        return $traitementOK;
//        return $p;
    }

    protected function renderCateguoryContent($listeProduitsCategorie) {
        $nom = $listeProduitsCategorie['nom'];
        // $id = $listeProduitsCategorie['id'];
        $produits = $listeProduitsCategorie['produits'];
        $content = '<div class="row" style="max-height:800px; background:#ffffff; overflow-y:auto;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <h4 style="color:#000000;font-weight:bold;" class="page-header">' . $nom . '</h4></div>';
        foreach ($produits as $p) {

            if ($p['category'] == 1) {
                if ((empty($p['prix_btlle']) || $p['prix_btlle'] == null) && (empty($p['prix_demie']) || $p['prix_demie'] == null) && (empty($p['prixVerre']) || $p['prixVerre'] == null) && (empty($p['prixConso']) || $p['prixConso'] == null)) {
                    $content = $content . '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 dropdown" style="background:#ffffff; border:1px solid rgba(0,0,0,0); margin-bottom:1%;margin-left:0"><div style="margin-top:2%; height:320px;" class="thumbnail row" href="#"><a href="#"><img style=" height:200px;"  src="uploads/' . $p['photo'] . '" alt=""></a><h5 class="nomProduit" style="color:#808080;font-weight:bold; margin-top:35px;">' . $p['nom'] . '</h5>';
                    $tempo = $this->addPricesInfos($content, $p);
                    //$content = $content.$tempo;
                    $content = $tempo . '<button id="' . $p['id_produit'] . '" class="btn" type="button"  style="background:#5bc0de;border-radius:0; color:#ffffff;width:98%;margin-left:1%; height:40px;font-weight:bold;font-size:1em; text-align:center;"><span class="glyphocon glyphicon-plus"></span> ADD TO COMMAND</button>'
                            . '</div></center></div>';
                } else {
                    $content = $content . '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 dropdown" style="background:#ffffff; border:1px solid rgba(0,0,0,0); margin-bottom:1%;margin-left:0"><div style="margin-top:2%; height:400px;" class="thumbnail" href="#"><a href="#"><img style=" height:200px;"  src="uploads/' . $p['photo'] . '" alt=""></a><h5 class="nomProduit" style="color:#808080;font-weight:bold; margin-top:35px;">' . $p['nom'] . '</h5>';
                    $tempo = $this->addPricesInfos($content, $p);
                    $content = $tempo;
                    if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prix_demie']) && $p['prix_demie'] != null) && (!empty($p['prixConso']) && $p['prixConso'] != null)) {
                        $content = $content . '<button style="height:40px;width:32%;background:#5bc0de;color:#ffffff;" class="btn bouteilleEntiere" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-bold"></span></button>';
                        $content = $content . '<button style="height:40px;width:32%;color:#ffffff;background:#c10719;" class="btn DemieBouteille" id="' . $p['id_produit'] . '"><i>D</i></button>';
                        $content = $content . '<button style="height:40px;width:28%;color:#ffffff;background:#545e70;" class="btn Conso" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-scale"></span>C</button>';
                    } else {
                        if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prixVerre']) && $p['prixVerre'] != null) && (!empty($p['prixConso']) && $p['prixConso'] != null)) {
                            $content = $content . '<button style="height:40px;width:32%;border-radius:0;background:#5bc0de;color:#ffffff;" class="btn bouteilleEntiere" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-bold"></span></button>';
                            $content = $content . '<button style="height:40px;width:32%;border-radius:0;background:#5bc0de;color:#ffffff;" class="btn Verre" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-glass"></span>V</button>';
                            $content = $content . '<button style="height:40px;width:28%;color:#ffffff;background:#545e70;" class="btn Conso" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-scale"></span>C</button>';
                        } else {
                            if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prix_demie']) && $p['prix_demie'] != null)) {
                                $content = $content . '<button style="height:40px;width:47%;background:#5bc0de;color:#ffffff;" class="btn bouteilleEntiere" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-bold"></span></button>';
                                $content = $content . '<button style="height:40px;width:47%;color:#ffffff;background:#c10719;" class="btn DemieBouteille" id="' . $p['id_produit'] . '"><i>D</i></button>';
                            } else {
                                if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prixVerre']) && $p['prixVerre'] != null)) {
                                    $content = $content . '<button style="height:40px;width:47%;background:#5bc0de;color:#ffffff;" class="btn bouteilleEntiere" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-bold"></span></button>';
                                    $content = $content . '<button style="height:40px;width:47%;background:#c10719;color:#ffffff;" class="btn Verre" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-glass"></span>V</button>';
                                } else {
                                    if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prixConso']) && $p['prixConso'] != null)) {
                                        $content = $content . '<button style="height:40px;width:47%;background:#5bc0de;color:#ffffff;" class="btn bouteilleEntiere" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-bold"></span></button>';
                                        $content = $content . '<button style="height:40px;width:47%;color:#ffffff;background:#545e70;" class="btn Conso" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-scale"></span>C</button>';
                                    } else {
                                        if (!empty($p['prix_demie']) && $p['prix_demie'] != null && (empty($p['prix_btlle']) || $p['prix_btlle'] = null) && (empty($p['prixVerre']) || $p['prixVerre'] = null)) {
                                            $content = $content . '<button style="height:40px;width:100%;color:#ffffff;background:#c10719;" class="btn DemieBouteille" id="' . $p['id_produit'] . '"><i>D</i></button>';
                                        } else {
                                            if (!empty($p['prixVerre']) && $p['prixVerre'] != null) {
                                                $content = $content . '<button style="height:40px;width:100%;border-radius:0;background:#5bc0de;color:#ffffff;" class="btn Verre" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-glass"></span>V</button>';
                                            } else {
                                                if (!empty($p['prixConso']) && $p['prixConso'] != null) {
                                                    $content = $content . '<button style="height:40px;width:100%;border-radius:0;color:#ffffff;background:#545e70;" class="btn Conso" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-scale"></span>C</button>';
                                                } else {
                                                    if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null)) {
                                                        $content = $content . '<button style="height:40px;width:100%;border-radius:0;background:#5bc0de;color:#ffffff;" class="btn bouteilleEntiere" id="' . $p['id_produit'] . '"><span class="glyphicon glyphicon-bold"></span></button>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }







//


                    $content = $content . '</div></center></div>';
                }
            }
            if ($p['category'] == 2) {
                $content = $content . '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6" style="background:#ffffff; border:1px solid rgba(0,0,0,0); margin-bottom:1%;margin-left:0"><a style="margin-top:2%; height:230px;" class="thumbnail" href="#"><img style=" height:150px;"  src="uploads/' . $p['photo'] . '" alt="">'
                        . '<h4 style="color:#808080;font-weight:bold; margin-top:35px;"><center>' . $p['nom'] . '</center></h4></a><center><h3 style="align:left;font-weight:bold;color: #000;">FCFA.' . $p['prixVente'] . '</h3><a class="btn tabacPanier" id="' . $p['id_produit'] . '" style="background:#5bc0de;border-radius:0; color:#ffffff;width:100%; height:40px; font-weight:bold;margin-bottom:5%;"><span class="glyphicon glyphicon-plus">'
                        . '</span> ADD TO COMMAND</a></center> </div>';
            }
            if ($p['category'] == 3) {
                $content = $content . '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6" style="background:#ffffff; border:1px solid rgba(0,0,0,0); margin-bottom:1%;margin-left:0"><a style="margin-top:2%;height:220px;" class="thumbnail" href="#"><img style=" height:150px;"  src="uploads/' . $p['photo'] . '" alt=""><h5 style="color:#808080;font-weight:bold; margin-top:35px;"><center>' . $p['nom'] . '</center>'
                        . '</h5></a><center><h3 style="align:left;font-weight:bold;color: #000;">FCFA.' . $p['prixVente'] . '</h3><a id="' . $p['id_produit'] . '" class="btn cuisine" style="background:#5bc0de;border-radius:0; color:#ffffff;width:100%; height:40px; font-weight:bold;margin-bottom:5%;"><span class="glyphicon glyphicon-plus"></span> ADD TO COMMAND</a></center></div>';
            }
        }
        $content = $content . '</div>';

        return $content;
    }

    protected function addPricesInfos($content, $p) {
        if (!empty($p['prix_btlle']) && $p['prix_btlle'] != null && !empty($p['prixVerre']) && $p['prixVerre'] != null && !empty($p['prixConso']) && $p['prixConso'] != null) {
            $content = $content . '<h5 class="prixBouteille" style="color:#000000;font-weight:bold; margin-top:35px;">FCFA ' . $p['prix_btlle'] . '</h5>';
            $content = $content . '<h5 class="nombreBouteilles" style="color:#000000;font-weight:bold;">STOCK: ' . $p['quantiteBouteille'] . ' bouteilles</h5>';
        } else {
            if ((!empty($p['prixVerre']) && $p['prixVerre'] != null) && (!empty($p['prixConso']) && $p['prixConso'] != null)) {
                $content = $content . '<h5 class="prixVerre" style="color:#000000;font-weight:bold; margin-top:35px;">FCFA ' . $p['prixVerre'] . '</h5>';
            } else {
                if ((!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prixConso']) && $p['prixConso'] != null) || (!empty($p['prix_btlle']) && $p['prix_btlle'] != null) && (!empty($p['prixVerre']) && $p['prixVerre'] != null)) {
                    $content = $content . '<h5 class="prixBouteille" style="color:#000000;font-weight:bold; margin-top:35px;">FCFA ' . $p['prix_btlle'] . '</h5>';
                    $content = $content . '<h5 class="nombreBouteilles" style="color:#000000;font-weight:bold;">STOCK: ' . $p['quantiteBouteille'] . ' bouteilles</h5>';
                } else {
                    if (!empty($p['prixVerre']) && $p['prixVerre'] != null) {
                        $content = $content . '<h5 class="prix_verre" style="color:#000000;font-weight:bold; margin-top:35px;">FCFA ' . $p['prixVerre'] . '</h5>';
                        $content = $content . '<h5 class="nombreBouteilles" style="color:#000000;font-weight:bold;">STOCK: ' . $p['quantiteBouteille'] . ' bouteilles</h5>';
                    }
                    if (!empty($p['prixConso']) && $p['prixConso'] != null) {
                        $content = $content . '<h5 class="prixConso" style="color:#000000;font-weight:bold; margin-top:35px;">FCFA ' . $p['prixConso'] . '</h5>';
                        $content = $content . '<h5 class="nombreConso" style="color:#000000;font-weight:bold;">STOCK: ' . $p['nombreConso'] . ' conso</h5>';
                    }
                    if (!empty($p['prix_btlle']) && $p['prix_btlle'] != null) {
                        $content = $content . '<h5 class="prixBouteille" style="color:#000000;font-weight:bold; margin-top:35px;">FCFA ' . $p['prix_btlle'] . '</h5>';
                        $content = $content . '<h5 class="nombreBouteilles" style="color:#000000;font-weight:bold;">STOCK: ' . $p['quantiteBouteille'] . ' bouteilles</h5>';
                    }
                }
            }
        }

        return $content;
    }

}
