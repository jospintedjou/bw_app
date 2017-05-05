<?php
namespace frontend\modules\publication\models;
use Yii;
use yii\base\Model;
use common\models\Publication;
use common\models\LirePubl;
use common\models\User;
//use common\models\LirePubl;

/**
 * Description of PublicationForm
 *
 * @author miguel
 */
class PublicationForm extends Model {
    public $type;
    public $contenu;
    public $date_post;
    
    
    public function rules() {
       return[
           [['type'],'required'],           
           [['type','contenu'],'string'],           
           ['date_post','default','value'=>date('y-m-d H:i:s')],           
       ];
    }
    
    public function  registerpublication(){
        $publication= new Publication();
         
        $publication->type = $this->type;
        $publication->date_post = date('y-m-d H:i:s');
        $publication->contenu =  $this->contenu;
        $publication->id_user = Yii::$app->user->identity->id;
        if($publication->save()){
            $allUsers = User::find()->where(['!=', 'role', 'admin'])->andWhere(['id_supp' => null])->all();
            //Insert into table lire_ubl thet all users haven't read that publication
           
            foreach($allUsers as $user){
                $lp = new LirePubl();
                $lp->id_publ = $publication->id_publ;
                $lp->id_user = $user['id'];
                $lp->affiche = 'non';
                $lp->lu = 'non';
                $lp->save();
            }
            
            return true;
        }
       
    }
}
