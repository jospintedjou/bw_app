<?php
namespace common\providers;

use common\providers\OurConnection;
use yii\db\Query;
use Yii;

/**
 * This is the cLass for all select query related to the accounts  
 */
class Account 
{
    private $_user;  // is the User instance which want to select the list of users
    private $all = [
                    'u.id as id',
                    'u.id_photo as id_photo',
                    'u.id_supp as id_supp',
                    'u.nom as nom',
                    'u.prenom as prenom',
                    'u.sexe as sexe',
                    'u.username as username',
                    'u.telephone as telephone',
                    'u.email as email',
                    'u.role as role',
                    'u.code as code',
                    'p.nom as nom_photo'
                   ];


    /*
     * @inheritdoc
     */
    public function __construct($user) {
        $this->_user = $user;
    }
    

    /*
     * This function allow to select a list of users with their profile photo into actual database.
     * 
     * @return Array
     */
    public function getUsersWithPicture()
    {
        $db = (new OurConnection)->getDb();
        return $this->getUsersInDatabase($db);
    }
    
    
    /*
     * This function allow to select an user with his id into actual database.
     * 
     * @params $id the user id in database
     * @return Array
     */
    public function getUser($id)
    {
        $db = (new OurConnection)->getDb();
        $query = (new Query())->select($this->all)->from('user u')
                ->leftJoin('photo p', 'p.id_photo=u.id_photo')->where(['id' => $id, 'id_supp' => null]);
        return $query->createCommand($db)->queryOne();
    }
    
    
    /*
     * This function allow to select all id from users that verify conditions give in options.
     * 
     * @params $options the critere of selection
     * @return Array of id users
     */
    public function getIdUsers($options)
    {
        $db = (new OurConnection)->getDb();
        $query = (new Query())->select('id')->from('user')->where($options);
        return $query->createCommand($db)->queryAll();
    }
    
    
    /*
     * This function allow to select a list of users in a specific database
     * 
     * @params String $name the name attribute of database component
     * @return Array
     */
    public function getUsersInDatabase($db)
    {
        if($this->_user->role == 'DG'){
            $query = (new Query())->select($this->all)->from('user u')
                    ->leftJoin('photo p', 'p.id_photo=u.id_photo')->where(['id_supp' => null]);
        }else if($this->_user->role == 'GS'){
            $query = (new Query())->select($this->all)->from('user u')
                    ->leftJoin('photo p', 'p.id_photo=u.id_photo')
                    ->where(['!=', 'u.role', 'DG'])->andWhere(['id_supp' => null]);
        }else{
            $query = null;
        }
        $users = $query->createCommand($db)->queryAll();
        
        return $users;
    }
    
    /*
     * This function allow to select a list of users in all databases
     * 
     * @return Array
     */
    public function getUsersInAllDatabases()
    {
        $id = 1;
        $users = [];
        foreach ((new OurConnection())->getAllDatabases() as $db){
            foreach ($this->getUsersInDatabase($db) as $usr){
                $users[$id] = $usr;
                $id = $id + 1;
            }
        }
        return $users;
    }
    
    /*
     * This function allow to create a user in selected database.
     * 
     * @params Array $usr the data for user to insert.
     * @params Boolean $havePhoto the value that represent wether user uploaded a file or not.
     * @params UploadedFile $file the photo file object.
     * @return Boolean wether creation have been done succesfully.
     */
    public function createUser($usr, $havePhoto, $file)
    {
        if ($this->_user->role != 'DG' && $this->_user->role != 'GS'){
            return false;
        }
        $db = (new OurConnection)->getDb();
        $query = new Query(); $photo =[]; $photo['nom'] = $usr['username'];
        
        $ids = $query->select('id_photo')->from('photo')->where(['nom' => $usr['username']])->createCommand($db)->queryAll();
        $g = $query->createCommand($db)->delete('photo', ['id_photo' => $ids])->execute();
        if ($g != count($ids)){
            return false;
        }
        $c = $query->createCommand($db)->insert('photo', $photo)->execute();
        if ($c != 1){
            return false;
        }
        $idTof = $query->select('id_photo')->from('photo')->where(['nom' => $photo['nom']])->createCommand($db)->queryScalar();
        $usr['id_photo'] = $idTof;
        $b = $query->createCommand($db)->insert('user', $usr)->execute();
        if ($b != 1){
            return false;
        }
        $idd = $query->select('id')->from('user')->where(['username' => $usr['username']])->createCommand($db)->queryScalar();
        $nameTof = 'user_feminin.jpg';
        if ($usr['sexe'] == 'homme'){
            $nameTof = 'user.png';
        }
        if ($havePhoto){
            $nameTof = 'profile_' . str_replace(' ', '_', $usr['nom']) . '_' . $idd . '_' . date('Y-m-d') . '.' . $file->extension;
            $file->saveAs('uploads/' . $nameTof);
        }
        $d = $query->createCommand($db)->update('photo', ['nom' => $nameTof], ['id_photo' => $idTof])->execute();
        $code = $this->generateCode($idd, $usr['nom'], $db->name);
        $h = $query->createCommand($db)->update('user', ['code' => $code], ['id' => $idd])->execute();
        if ($d != 1 || $h != 1){
            return false;
        }
        return true;
    }
    
    
    /*
     * This function serves to generate a user code
     * 
     * @params $noyau the core of generation algorithm.
     * @return String the code generated.
     */
    private function generateCode($idUser, $nom, $succName, $noyau = 41){
        $chiffre = substr(strval($noyau*$idUser), 0, 2);
        $lettre = substr(strtoupper($nom), 0, 1) . substr(strtoupper($succName), 0, 1);
        return $lettre . $chiffre . $idUser;
    }
    
    /*
     * This function serves to update user account
     * 
     * @params Array $usr the user parameters to update
     * @return Boolean whether the modification is successfully*.
     */
    public function updateUser($usr){
        if ($this->_user->role != 'DG' && $this->_user->role != 'GS'){
            return false;
        }
        $db = (new OurConnection)->getDb();
        $query = $db->createCommand()->update('user', $usr, ['id' => $usr['id']])->execute();
        if ($query != 1){
            return false;
        }
        return true;
    }
    
    
    /*
     * This function serves to update one row in a specific table of current database
     * 
     * @params String $tableName the name of table to update
     * @params Array $params the parameters to update
     * @params Array $filter the elements of where condition
     * @return Boolean whether the modification is successfully*.
     */
    public function update($tableName, $params, $filter){
        if ($this->_user->role != 'DG' && $this->_user->role != 'GS'){
            return false;
        }
        $db = (new OurConnection)->getDb();
        $query = $db->createCommand()->update($tableName, $params, $filter)->execute();
        if ($query != 1){
            return false;
        }
        return true;
    }
   
}
