<?php

namespace config{

    use PDO;
    use PDOException;

    /**
     * @class conection
     * 
     * @package config
     * 
     * @brief class to connect to the database
     * 
     * @version 1.0
     * 
     * @created 2020-09-10
     * 
     * @updated by Kevin Andres Orrego Martinez
     * 
     * @since 1.0
     * 
     * @see PDO
     * 
     * @see PDOException
     * 
     */
    class conection {

        private $host = "localhost";
        private $db = "itmsocial";
        private$user = "root";
        private $password = "";
        private $charset = "utf8mb4";



        public function __construct() {
            
        }

        
        /**
         * 
         * conect
         * 
         * @return PDO
         * 
         */
        public function conect(){

            try {
                $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
                $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_EMULATE_PREPARES => false,
                            PDO::ATTR_PERSISTENT => true];
                $pdo = new PDO($connection, $this->user, $this->password, $options);
                return $pdo;
            } catch (PDOException $e) {
                print_r("Error connection: ".$e->getMessage());
            }

        }

        /**
         * 
         * getHost
         * 
         * @return string
         */
        public function getHost(){
            return $this->host;
        }

        /**
         * 
         * setHost
         * 
         * @param string $host
         * 
         */
        public function setHost($host){
            $this->host = $host;
        }

        /**
         * 
         * getDb
         * 
         * @return string
         */
        public function getDb(){
            return $this->db;
        }

        /**
         * 
         * setDb
         * 
         * @param string $db
         */
        public function setDb($db){
            $this->db = $db;
        }

        /**
         * 
         * getUser
         * 
         * @return string
         */
        public function getUser(){
            return $this->user;
        }

        /**
         * 
         * setUser
         * 
         * @param string $user
         */
        public function setUser($user){
            $this->user = $user;
        }

        /**
         * 
         * getPassword
         * 
         * @return string
         */
        public function getPassword(){
            return $this->password;
        }

        /**
         * 
         * setPassword
         * 
         * @param string $password
         * 
         */
        public function setPassword($password){
            $this->password = $password;
        }

        /**
         * 
         * getCharset
         * 
         * @return string
         * 
         */
        public function getCharset(){
            return $this->charset;
        }

        /**
         * 
         * setCharset
         * 
         * @param string $charset
         * 
         */
        public function setCharset($charset){
            $this->charset = $charset;
        }
        
    }
    
}

?>