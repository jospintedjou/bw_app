<?php
namespace frontend\modules\publication\models;
use Yii;
use yii\base\Model;
use common\models\Commenter;
use common\models\LireComment;
use common\models\LirePubl;
//use common\models\LirePubl;

/**
 * Description of PublicationForm
 *
 * @author miguel
 */
class CommentForm extends Model {

    public $contenu;
    public $date_post;
    public $publId;
    
    
    public function rules() {
       return[
           [['publId'],'required'],           
           [['contenu'],'string'],  
           ['publId', 'integer'],
           ['date_post','default','value'=>date('y-m-d H:i:s')],           
       ];
    }
    
    public function  registerComment(){
        $comment= new Commenter();
         
        $comment->date_post = date('y-m-d H:i:s');
        $comment->contenu =  $this->contenu;
        $comment->id_user = Yii::$app->user->identity->id;
        $comment->id_publ = $this->publId;
        
        if($comment->save()){
            //Retrieve users who can read the commented publication
            $readers = LirePubl::find()->where(['=', 'id_publ', $comment->id_publ])->all();
            //Insert into table lire_ubl  all users who haven't read the publication
           
            foreach($readers as $user){
                $lc = new LireComment();
                $lc->id_comment = $comment->id_comment;
                $lc->id_user = $user['id_user'];
                $lc->affiche = 'non';
                $lc->lu = 'non';
                $lc->save();
            }
            
            
            return true;
        }
       
    }
}
