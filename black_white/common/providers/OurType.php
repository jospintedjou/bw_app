<?php
namespace common\providers;

use \Yii;

/**
 * This is the cLass for application type component  
 */
class OurType
{
    public $type;           // This is application type
    
    
    /*
     * This function serves to access to type attribute
     * 
     * @return null|String the type requested
     */
    public static function getType(){
        foreach (Yii::$app->getComponents() as $comp){
            if($comp['class'] == 'common\providers\OurType'){
                return $comp['type'];
            }
        }
        return null;
    }
    
    /*
     * This function test whether the application had a correct type.
     * 
     * @return boolean that indicates if the application type is correct.
     */
    public static function isType()
    {
        $type = OurType::getType();
        if($type == 'cloud' || $type == 'succursale' || $type == 'magasin'){
            return true;
        }
        return false;
    }
}