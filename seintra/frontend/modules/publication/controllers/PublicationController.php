<?php

namespace frontend\modules\publication\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\publication\models\PublicationForm;
use frontend\modules\publication\models\CommentForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Publication;
use common\models\User;
use \common\models\LirePubl;
use common\models\Commenter;
use \common\models\LireComment;
use yii\data\Pagination;
use yii\db\Query;

/**
 * Default controller for the `publication` module
 */
class PublicationController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view-pubs', 'add', 'view-comments'],
                'rules' => [
                    [
                        'actions' => ['view-pubs', 'add', 'view-comments', 'update', 'view-markets'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'add' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * This function allow to see a list of ideas or suggestions depending of the $nature parameter
     * @params string nature, either ' idee" or 'suggestion'
     * @return mixed
     */
    public function actionViewPubs($nature) {
        if($nature=='idee' || $nature=='suggestion'){
            $model = new PublicationForm();
            $q = new yii\db\Query();

            $pagination = new Pagination([
                    'defaultPageSize' =>10,
                    'totalCount' => (new Query)->select('count(p.id_publ)')->from('publication p')
                                               ->innerJoin('lire_publ lp', 'lp.id_publ = p.id_publ')
                                               ->where(['p.type'=>$nature])
                                               ->andWhere([ 'lp.id_user' => \Yii::$app->getUser()->id])
                                               ->scalar()
                ]);
            //Retrieve all publications from database
            $publications = $q->select('p.id_publ, count(c.id_publ) nb, count(c.id_publ) non_lus, p.id_user, p.date_post, p.type, p.contenu, u.prenom, f.nom nom_fich')
                            ->from('publication p')
                            ->innerJoin('lire_publ lp', 'lp.id_publ = p.id_publ')
                            ->innerJoin('user u', 'u.id = p.id_user')
                            ->leftJoin('commenter c', 'c.id_publ = p.id_publ')
                           
                            ->leftJoin('fichier f', 'f.id_user = u.id')
                            ->where(['p.type'=>$nature])
                            ->andWhere([ 'lp.id_user'=>  \Yii::$app->getUser()->id])
                            
                            ->groupBy('p.id_publ')
                            ->orderBy('p.id_publ desc')
                            ->offset($pagination->offset)
                            ->limit($pagination->limit)
                           
                            ->all();
            
            foreach($publications as $ky=>$p){
                // conut unrea comments per publication
                $unreadComment = (new Query())->select('lc.id_comment')
                                              ->from('commenter c')
                                              ->InnerJoin('lire_comment lc', 'lc.id_comment = c.id_comment')
                                              ->where([ 'lc.id_user'=>  \Yii::$app->getUser()->id])
                                              ->andWhere(['lc.lu'=>'non'])
                                              ->andWhere(['c.id_publ'=>$p['id_publ']])
                                              ->count();
               $publications[$ky]['non_lus'] = $unreadComment;  
               
                //Update table lire_publ to mention that current user has read publications
                (new yii\db\QuerY())->createCommand()->update('lire_publ', ['affiche'=>'oui', 'lu'=>'oui'],
                             ['and',['id_user'=>  Yii::$app->user->identity->id], ['id_publ'=>$p['id_publ'] ]])
                            ->execute();
            }
             //return print_r($publications);
            
            $model->type = $nature;
            $type = ($nature=='idee') ? ('idées') : 'suggestions';
            return $this->render('view-publs', [
                        'model' => $model,
                        'pagination' => $pagination,
                        'publications' => $publications,
                        'type'=>$type,
                        'nature'=>$nature
                    ]);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * This function create a suggestion or an idea depending of the $nature parameter
     * @params string $nature 
     * @return mixed
     */
    public function actionAdd() {
        $publication = new PublicationForm();
        date_default_timezone_set('Africa/Douala');
        if ($publication->load(Yii::$app->request->post())) {
            if (!empty($publication->contenu)) {
               $publication->registerpublication();
            }
             return $this->redirect(['view-pubs', 'nature' => $publication->type]);
        }
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * This function allow to comment a specific publication (suggestion or idea) depending of the $nature parameter
     * That publication have id $publicationId in the database
     * @params int $publicationId, string $nature
     * @return mixed
     */
    public function actionComment() {
        $comment = new CommentForm();
       date_default_timezone_set('Africa/Douala');
        if ($comment->load(Yii::$app->request->post())) {
            if (!empty($comment->contenu)) {
                if ($comment->registerComment()) {
                    $nature = Publication::find()->select('type')->where(['id_publ'=>$comment->publId])->scalar();
                    return $this->redirect(['view-comments', 'publicationId' => $comment->publId, 'nature'=>$nature]);
                }
            }
        }
         throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * This function allow to view all comments of a specific publication (suggestion or idea) depending of the $nature parameter
     * That publication have id $publicationId in the database
     * @params int $publicationId, string $nature
     * @return mixed
     */
    public function actionViewComments($publicationId, $nature) {
       $model = new CommentForm();
            //$q = new yii\db\Query();
            $publication = (new yii\db\Query())->select('p1.id_publ id_publ, p1.id_user, p1.date_post, p1.type, p1.contenu, u1.prenom, f1.nom nom_fich')
                       ->from('publication p1')
                       ->innerJoin('lire_publ lp', 'lp.id_publ = p1.id_publ')
                       ->innerJoin('user u1', 'u1.id = p1.id_user')
                       ->leftJoin('fichier f1', 'f1.id_user = u1.id')
                       ->where(['p1.id_publ'=>$publicationId, 'lp.id_user'=>  \Yii::$app->getUser()->id ])     
                      ->one();
            if( !empty($publicationId) ){
                $q2 = new yii\db\Query();
            $query = $q2->select('lc.affiche, lc.lu, c.id_comment, c.id_publ, c.id_user, c.date_post, c.contenu, u.prenom, f.nom nom_fich')
                       ->from('commenter c')
                       ->innerJoin('lire_comment lc', 'lc.id_comment = c.id_comment')
                       ->innerJoin('user u', 'u.id = c.id_user')
                       ->leftJoin('fichier f', 'f.id_user = u.id')
                       ->where(['c.id_publ'=>$publicationId])
                       ->andWhere([ 'lc.id_user'=>  \Yii::$app->getUser()->id]);
            
            $pagination = new Pagination([
                    'defaultPageSize' =>10,
                    'totalCount' => (new Query)->select('count(c.id_comment)')->from('commenter c')
                                                ->innerJoin('lire_comment lc', 'lc.id_comment = c.id_comment')
                                                ->where(['c.id_publ'=>$publicationId])
                                                ->andWhere([ 'lc.id_user'=>  \Yii::$app->getUser()->id])
                                                ->scalar()
                ]);
            
            $comments = $query->orderBy('c.id_comment desc')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
            //Update table lire_comment to mention that current user has read comments
            foreach($comments as $c){
                (new yii\db\Query())->createCommand()->update('lire_comment', ['affiche'=>'oui', 'lu'=>'oui'],
                             ['and',['id_user'=>  Yii::$app->user->identity->id], ['id_comment'=>$c['id_comment'] ]])
                            ->execute();
            }

            return $this->render('view-comments', [
                       'model' => $model,
                        'pagination' => $pagination,
                        'publ' => $publication,
                        'comments' => $comments
                    ]);
        }
       throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }
    
    /** This function checks if there are unreaded publications and return there number 
     * **/
    public function actionUnreadPubls(){
        if(\Yii::$app->request->isAjax ){
            //build the request condition. If all publs are requested then do not specify any condition
            $unreadIdeas = $this->getUnread('idee');
            $unreadSuggs = $this->getUnread('suggestion');
            $unreadPubls = $this->getUnread('all');
            
            if(!empty($unreadIdeas) || !empty($unreadSuggs)){
                $nature = (!empty($unreadIdeas)) ? $unreadIdeas[0]['type'] :  $unreadSuggs[0]['type'];
                return json_encode([
                        'status'=>true, 'nbIdeas'=> $unreadIdeas[0]['nb'], 
                        'nbSuggs'=> $unreadSuggs[0]['nb'], 'nbPubls'=> $unreadPubls[0]['nb'],
                        'nature'=>$nature
                     ]);
            }  
            
        }
        return json_encode(['status'=>false, 'nb'=>0]);
    }
    /** This function checks if there are unreaded comments and return there number 
     * **/
     public function actionUnreadComments(){
       // if(\Yii::$app->request->isAjax ){
            //build the request condition. If all publs are requested then do not specify any condition
            $unreadCommentsIdeas = $this->getUnreadComments('idee');
            $unreadCommentsSuggs = $this->getUnreadComments('suggestion');
            $unreadComments = $this->getUnreadComments('all');
            
            if(!empty($unreadComments[0]['type'])){
               $nature = $unreadComments[0]['type'];
               
               
                return json_encode([
                     'status'=>true, 
                    'nbCommentsIdeas'=> $unreadCommentsIdeas[0]['nb'], 
                    'nbCommentsSuggs'=> $unreadCommentsSuggs[0]['nb'], 
                    'nbComments'=> $unreadComments[0]['nb'], 
                        'nature'=>$nature
                     ]);
            }  
            
       // }
        return json_encode(['status'=>false, 'nbComments'=>0]);
    }
    
    /** This function gats unread all comments from database or 'all'
     * **/
    public function getUnreadComments($nature){
       if($nature=='suggestion' || $nature=='idee' || $nature=='all'){
            $array = ($nature=='all') ? [] : ['type'=>$nature];
            $res = (new Query())->select('count(c.id_comment) nb,p.type type')
                                ->from('commenter c')
                                ->InnerJoin('lire_comment lc', 'lc.id_comment = c.id_comment')
                                ->InnerJoin('publication p', 'p.id_publ = c.id_publ')
                                ->where([ 'lc.id_user'=>  \Yii::$app->getUser()->id])
                                ->andWhere(['lc.lu'=>'non'])
                                ->andWhere($array)
                                ->all();
            return $res;
       }
    }
    
    
    /** This function gats unread publications from database 
     *  @param $nature is the type of publication ti retrieve. It can be 'publlication', 'suggestion' or 'all'
     * **/
    public function getUnread($nature){
        if($nature=='suggestion' || $nature=='idee' || $nature=='all'){
            $array = ($nature=='all') ? [] : ['type'=>$nature];
            $query66 = new Query();
            $res = $query66->select('count(p.id_publ) nb, p.type ')
                        ->from('publication p')
                        ->innerJoin('lire_publ lp', 'lp.id_publ = p.id_publ')
                        ->where(['lp.id_user'=>Yii::$app->getUser()->id])
                        ->andWhere(['lu'=>'non'])
                        ->andWhere($array)
                        ->all();
            return $res;
        }
    }
    
}
