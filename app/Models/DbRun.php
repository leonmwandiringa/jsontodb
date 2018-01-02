<?php

    namespace DealsWithGold\Models;
    use DealsWithGold\Models\DbConfig;
    Class DbRun{

        public static $_instance = null;
        public static function getInstance(){
            if(!isset(self::$instance)){

                $db_obj = new DbConfig();
                self::$_instance = $db_obj->dbConnection();

            }

            return self::$_instance;

        }

        public static function runQuery($sql, $params = null){

            $query_run = self::getInstance()->prepare($sql);
            $params == null ? $query_run->execute($params) : $query_run->execute();
            
            return $query_run;

        }

    }


?>