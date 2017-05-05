<?php

namespace backend\modules\stocks\models;

use yii\base\Model;
use common\models\Produit;
use common\models\Photo;
use common\models\Bouteille;
use common\models\Boisson;
use common\models\Verre;
use common\models\Categorie;
use common\models\Conso;
use yii\web\UploadedFile;
use common\providers\OurConnection;
use common\providers\WarehouseProducts;

/**
 * StockProductForm represents the model save prodruct in black and white
 */
class StockProductForm extends Model {

    /**
     * @inheritdoc
     */
    public $btlle;
    public $verre;
    public $conso;
    public $demie_btlle;
    public $tabac;
    // attributs table produit
    public $nom;
    public $categorie;
    //attributs table bouteille
    public $prix_achat_btlle;
    public $prix_vente_btlle;
    public $prix_vente_demie_btlle;
    public $capacite_btlle;
    //attributs table conso
    public $prix_vente_conso;
    public $capacite_conso;
    public $nombre_conso;
    //attributs table verre
    public $prix_vente_verre;
    public $capacite_verre;
    public $nombre_verre;
    //attributs table photo
    public $photo;
    //attributs table Boisson
    public $dilluant;
    //attributs table tabac
    public $prix_achat_tabac;
    public $prix_vente_tabac;

    public function rules() {
        return [


            ['nom', 'required', 'message' => 'entrez le nom du produit'],
            ['nom', 'string', 'message' => 'entrez une chaine de caractère'],
            ['nom', 'trim'],
            ['categorie', 'required', 'message' => 'veuillez remplir la categorie du produit'],
            ['categorie', 'exist', 'skipOnError' => false, 'targetClass' => Categorie::className(), 'targetAttribute' => ['categorie' => 'id_categorie'], 'message' => 'cette categorie n\'existe pas'],
            ['prix_achat_btlle', 'required', 'when' => function($model) {
                    return $model->btlle == 'bouteille';
                    
            },
                            'whenClient' => "function(attribute,value){
            return $('input[name=\'StockProductForm[btlle]\']').is(':checked');}", 'message' => 'veuillez entrer un montant en fcfa'
            ],
            ['capacite_btlle', 'required', 'when' => function($model) {
                    return $model->btlle == 'bouteille';
                    
            },
                            'whenClient' => "function(attribute,value){
            return $('input[name=\'StockProductForm[btlle]\']').is(':checked');}", 'message' => 'veuillez entrer une valeur entiere ou decimale'
            ],
            [['prix_vente_btlle', 'dilluant'], 'required', 'when' => function($model) {
            return $model->btlle == 'bouteille';
        },
                'whenClient' => "function(attribute,value){
            return $('input[name=\'StockProductForm[btlle]\']').is(':checked');}", 'message' => 'veuillez entrer une valeur'
            ],
            [['prix_vente_tabac', 'prix_achat_tabac'], 'required', 'when' => function($model) {
            return $model->tabac == 'tabac';
        },
                'whenClient' => "function(attribute,value){
            return $('#stockproductform-categorie option:selected').text() == 'Tabac' ;}", 'message' => 'veuillez entrer une valeur'
            ],
            ['dilluant', 'string', 'max' => 3],
            ['dilluant', 'in', 'range' => ['oui', 'non'], 'message' => 'veuillez entrer oui on non'],
            [['prix_achat_btlle', 'prix_vente_btlle'], 'integer', 'message' => 'veuillez entrer un entier'],
            [['prix_vente_conso', 'capacite_conso', 'nombre_conso'], 'required', 'when' => function($model) {
            return $model->conso == 'conso';
        },
                'whenClient' => "function(attribute,value){
            return $('input[name=\'StockProductForm[conso]\']').is(':checked');}", 'message' => 'veuillez entrer une valeur'
            ],
            [['prix_vente_conso'], 'integer', 'message' => 'veuillez entrer un entier'],
            [['prix_vente_verre', 'capacite_verre', 'nombre_verre'], 'required', 'when' => function($model) {
            return $model->verre == 'verre';
        },
                'whenClient' => "function(attribute,value){
            return $('input[name=\'StockProductForm[verre]\']').is(':checked');}", 'message' => 'veuillez entrer une valeur'
            ],
            [['prix_vente_verre'], 'integer', 'message' => 'veuillez entrer un entier'],
            ['prix_vente_demie_btlle', 'required', 'when' => function($model) {
                    return $model->demie_btlle == 'demie_btlle';
                },
                'whenClient' => "function(attribute,value){
            return $('input[name=\'StockProductForm[demie_btlle]\']').is(':checked');}", 'message' => 'veuillez entrer une valeur'
            ],
            ['prix_vente_demie_btlle', 'integer', 'message' => 'veuillez entrer un entier'],
            ['capacite_btlle', 'double', 'message' => 'veuillez entrer un entier ou un decimal'],
            ['capacite_verre', 'double', 'message' => 'veuillez entrer un entier ou un decimal'],
            ['capacite_conso', 'double', 'message' => 'veuillez entrer un entier ou un decimal'],
            ['btlle', 'required', 'whenClient' => "function(attribute,value){
            return $('#stockproductform-categorie option:selected').text()!='Tabac';}", 'message' => 'veuillez cocher cette case ..'
            ],
            [['photo'], 'file', 'skipOnEmpty' => true,
                'extensions' => 'png, jpg, gif, jpeg', 'wrongExtension' => 'uniquement les extensions png, jpg ,gif ,jpeg ...', 'uploadRequired' => 'veuillez insérer une image'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function save() {
        if (!$this->validate()) {
            return false;
        }
        $nbre = Produit::find()->where(['nom' => $this->nom, 'id_categorie' => $this->categorie,])->count();
        if ($nbre != 0) {
            return false;
        }
        $this->photo = UploadedFile::getInstance($this, 'photo');
        $id_photo = (Photo::find()->select("max(id_photo)")->scalar()) + 1;
        $id_produit = (Produit::find()->select("max(id_produit)")->scalar()) + 1;
        $namePhoto = $id_photo . str_replace(' ', '_', $this->photo->baseName) . '.' . $this->photo->extension;
        $path = '../../frontend/web/uploads/';
        $this->photo->saveAs($path . $namePhoto);

        foreach ((new OurConnection)->getAllDatabases() as $db) {
            $photo = (new WarehouseProducts)->insert('photo', ['id_photo' => $id_photo, 'nom' => $namePhoto], $db);

            if (!$photo) {
                return false;
            }
            $produit = ['id_produit' => $id_produit, 'nom' => $this->nom, 'id_categorie' => $this->categorie, 'id_photo' => $id_photo];
            $product = (new WarehouseProducts)->insert('produit', $produit, $db);
            if (!$product) {
                return false;
            }

            if ($this->prix_achat_btlle != "") {
                $boisson = ['id_boisson' => $id_produit, 'dilluant' => $this->dilluant];

                $drink = (new WarehouseProducts)->insert('boisson', $boisson, $db);

                $id_bouteille = (Bouteille::find()->select("max(id_bouteille)")->scalar()) + 1;
                if ($this->prix_vente_demie_btlle == null) {
                    $this->prix_vente_demie_btlle = '0';
                };
                $bouteille = [
                    'id_bouteille' => $id_bouteille, 'id_boisson' => $id_produit,
                    'nb_btlle' => 0, 'prix_achat_btlle' => $this->prix_achat_btlle,
                    'prix_vente_btlle' => $this->prix_vente_btlle,
                    'capacite' => $this->capacite_btlle,
                    'prix_vente_demie' => $this->prix_vente_demie_btlle,
                ];
                $bottle = (new WarehouseProducts)->insert('bouteille', $bouteille, $db);
            }

            if ($this->prix_vente_conso != "") {
                $conso = ['id_boisson' => $id_produit, 'nombre' => $this->nombre_conso, 'prix' => $this->prix_vente_conso, 'capacite' => $this->capacite_conso];
                $c = (new WarehouseProducts)->insert('conso', $conso, $db);
                if (!$c) {
                    return false;
                }
            }
            if ($this->prix_vente_verre != "") {
                $id_verre = (Verre::find()->select("max(id_verre)")->scalar()) + 1;
                $verre = ['id_verre' => $id_verre, 'id_boisson' => $id_produit, 'nombre' => $this->nombre_verre, 'prix' => $this->prix_vente_verre, 'capacite' => $this->capacite_verre];
                $v = (new WarehouseProducts)->insert('verre', $verre, $db);
                if (!$v) {
                    return false;
                }
            }

            if ($this->prix_achat_tabac != "") {
                $tabac = ['id_tabac' => $id_produit, 'prix_achat' => $this->prix_achat_tabac, 'prix_vente' => $this->prix_vente_tabac, 'quantite' => 0];
                $t = (new WarehouseProducts)->insert('tabac', $tabac, $db);
                if (!$t) {
                    return false;
                }
            }
        }
        return true;
    }

}
