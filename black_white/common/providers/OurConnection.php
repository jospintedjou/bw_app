<?php
namespace common\providers;

use \Yii;
use yii\db\Connection;
use common\providers\OurType;

/**
 * This is the cLass for databases components and connections management  
 */
class OurConnection extends Connection
{
    public $name;           // Name attribute of database components
    public $type;           // This is succursale type
    public $id_succursale;           // This is the branch id in database
    public $id_magasin;           // This is the warehouse id in the database
    
    
    /*
     * This function test whether one database specified by her name is one of our databases.
     * 
     * @params String $name the name of succursale or 'cloud'
     * @return boolean that indicates if the database exist.
     */
    public function isDatabase($name)
    {
        foreach (Yii::$app->getComponents() as $component){
            if($component['class'] == 'common\providers\OurConnection' && $component['name'] == $name){
                return true;
            }
        }
        return false;
    }
    
    
    /*
     * This function allow to modify the database which we'll write
     * 
     * @params String $name the name of succursale or 'cloud'
     * @return boolean that indicates if the modification is succesful.
     */
    public function setDbName($name)
    {
        if($this->isDatabase($name) && OurType::getType() == 'cloud'){
            Yii::$app->session->set('bw_database', $name);
            return true;
        }
        return false;
    }


    /*
     * This function serves to obtain the database which we are connect.
     * 
     * @return OurConnection|null
     */
    public function getDb()
    {
        $dbName = isset(Yii::$app->session) ? Yii::$app->session->get('bw_database', false) : false;
        if ($this->isDatabase($dbName)){
            return $this->getDbByName($dbName);
        }
        return Yii::$app->db;
    }
    
    
    /*
     * This function serves to obtain all databases connections components.
     * 
     * @return Array
     */
    public function getAllDatabases()
    {
        $dbs = [];
        foreach(Yii::$app->getComponents() as $component){
            if($component['class'] == 'common\providers\OurConnection'){
                unset($component['class']);
                $db = new OurConnection($component);
                $db->name = $component['name'];
                $dbs[$component['name']] = $db;
            }
        }
        return $dbs;
    }
    
    
    /*
     * This function serves to obtain the connection object to one database specified by her succursale name.
     * 
     * @params String $name the name of succursale
     * @return OurConnection which is the connection to database of succursale specified.
     */
    private function getDbByName($name)
    {
        if ($this->isDatabase($name)){
            $dbs = $this->getAllDatabases();
            return $dbs[$name];
        }
        return null;
    }
}
