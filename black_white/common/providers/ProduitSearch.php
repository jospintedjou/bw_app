<?php

namespace common\providers;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Produit;

/**
 * ProduitSearch represents the model behind the search form about `common\models\Produit`.
 */
class ProduitSearch extends Produit
{
   
    /**
     * @inheritdoc
     */
    
    public $categorie;
    public $nb_btlle;
    public $capacite;
    public $quantite;
    public $prix_achat;
    public $prix_vente;
    
    public function rules()
    {
        return [
            [['id_produit', 'id_categorie', 'id_photo'], 'integer'],
            [['nom','categorie','nb_btlle'], 'safe'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search_drink($params)
    {
        $query = new \yii\db\Query();
        // find all informations in database about all products
        $query->select('p.nom,c.nom as categorie,b.nb_btlle,b.prix_achat_btlle,b.prix_vente_btlle,b.prix_vente_demie,b.capacite')
                ->from('produit p')                
                ->innerJoin('bouteille b','b.id_boisson=p.id_produit')                
                ->innerJoin('categorie c','p.id_categorie=c.id_categorie');                
                
                
//        $bd = (new \common\providers\OurConnection)->getDb();
//        $listes_detailles_des_produits = $query->createCommand($bd)->queryAll();
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,            
            'pagination' => [
                'pageSize' => 15,
            ], 
            'sort'=>[
                'attributes'=>['categorie','nom','nb_btlle','prix_vente_btlle','prix_achat_btlle','capacite'],
            ]
        ]);     

        if (!$this->load($params)&& !$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
           return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_produit' => $this->id_produit,
            'id_categorie' => $this->id_categorie,
            'id_photo' => $this->id_photo,
           
        ]);

     $query->andFilterWhere(['like', 'p.nom', $this->nom]);
     $query->andFilterWhere(['like', 'c.nom', $this->categorie]);
     $query->andFilterWhere(['=', 'b.nb_btlle', $this->nb_btlle]);

        return $dataProvider;

        }
    public function search_tabac($params)
    {
        $query = new \yii\db\Query();
        // find all informations in database about all products
        $query->select('p.nom,c.nom as categorie,t.quantite ,t.prix_achat,t.prix_vente,')
                ->from('produit p')
                ->innerJoin('tabac t','t.id_tabac=p.id_produit')                
                ->innerJoin('categorie c','p.id_categorie=c.id_categorie');
                
                
//        $bd = (new \common\providers\OurConnection)->getDb();
//        $listes_detailles_des_produits = $query->createCommand($bd)->queryAll();
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,            
            'pagination' => [
                'pageSize' => 15,
            ], 
            'sort'=>[
                'attributes'=>['nom'],
            ]
        ]);     

        if (!$this->load($params)&& !$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
           return $dataProvider;
        }

        // grid filtering conditions
        

     $query->andFilterWhere(['like', 'p.nom', $this->nom]);

        return $dataProvider;

        }
}
