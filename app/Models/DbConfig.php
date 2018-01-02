<?php
/**
 * @author Leon
 * @uses DB Config and connection creation singleton way
 * @return PDO Object
 * 
 */
    namespace DealsWithGold\Models;

    class DbConfig{

        public $connection = null;
        protected $dbname = "dealswithgold";
        protected $username = "dealswithgold";
        protected $password = "DealsWithGold1";
        protected $host = "localhost";



        public function dbConnection(){
            try{
                $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username, $this->password);
                $this->connection(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection(PDO::DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            }catch(PDOExeprion $e){

                die("error connecting ".$e->getMessage());

            }
            return $this->connection;
        }

    }

?>