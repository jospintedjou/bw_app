<?php
namespace common\providers;

use common\providers\OurConnection;


/**
 * @author Miguel
 */
class WarehouseProducts {
   
    /*
     * This function allow insert new row in a specific database
     * 
     * @params Array $params the new row to insert.
     * @params OurConnection $db the database to insert.
     * @return Boolean whether insertion terminated successfully.
     */
    public function insert($tableName, $params, $db){
        $query = $db->createCommand()->insert($tableName, $params);
        $a = $query->execute();
        if ($a == 1){
            return true;
        }
        return false;
    }
}