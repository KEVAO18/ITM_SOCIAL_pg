<?php


namespace config{

    require_once('conection.php');

    use config\conection;

    /**
     * @class sql
     * 
     * @package config
     * 
     * @brief class to execute sql queries
     * 
     * @version 1.0
     * 
     * @created 2020-09-10
     * 
     * @updated by Kevin Andres Orrego Martinez
     * 
     * @since 1.0
     * 
     * @see conection
     * 
     * @see PDO
     * 
     * @see PDOException
     * 
     */
    class sql extends conection{

        /**
         * 
         * __construct
         * 
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * execute
         * 
         * @param string $query
         * 
         * @return array
         * 
         */
        public function execute($query){
            $result = $this->conect()->query($query);
            return $result;
        }

        /**
         * select
         * 
         * @param string $tabla
         * 
         * @return array
         * 
         */
        public function select($tabla){
            $query = "SELECT * FROM ".$tabla;
            return $this->execute($query);
        }

        /**
         * select where
         * 
         * @param string $tabla
         * 
         * @param string $condicion
         * 
         * @return array
         * 
         */
        public function selectWhere($tabla, $condicion){
            $query = "SELECT * FROM ".$tabla." WHERE ".$condicion;
            return $this->execute($query);
        }

        /**
         * 
         * insert
         * 
         * @param string $tabla
         * 
         * @param string $campos
         * 
         * @param string $valores
         * 
         * @return boolean
         * 
         */
        public function insert($tabla, $campos, $valores){
            $query = "INSERT INTO ".$tabla." (".$campos.") VALUES (".$valores.")";

            return ($this->execute($query)?true:false);
        }

        /**
         * 
         * update
         * 
         * @param string $tabla
         * 
         * @param string $campos
         * 
         * @param string $valores
         * 
         * @param string $condicion
         * 
         * @return boolean
         * 
         */
        public function update($tabla, $campos, $valores, $condicion){

            $query = "UPDATE ".$tabla." SET ".$campos." = ".$valores." WHERE ".$condicion;

            return ($this->execute($query))?true:false;
        }

        /**
         * 
         * delete
         * 
         * @param string $tabla
         * 
         * @param string $condicion
         * 
         * @return boolean
         * 
         */
        public function delete($tabla, $condicion){
            $query = "DELETE FROM ".$tabla." WHERE ".$condicion;

            return ($this->execute($query))?true:false;
        }

        /**
         * 
         * inner join
         * 
         * @param string $tabla1
         * 
         * @param string $tabla2
         * 
         * @param string $on
         * 
         * @return array
         * 
         */
        public function innerJoin($tabla1, $tabla2, $on){
            $query = "SELECT * FROM ".$tabla1." INNER JOIN ".$tabla2." ON ".$on;
            return $this->execute($query);
        }

        /**
         * 
         * left join
         * 
         * @param string $tabla1
         * 
         * @param string $tabla2
         * 
         * @param string $on
         * 
         * @return array
         * 
         */
        public function leftJoin($tabla1, $tabla2, $on){
            $query = "SELECT * FROM ".$tabla1." LEFT JOIN ".$tabla2." ON ".$on;
            return $this->execute($query);
        }

        /**
         * 
         * right join
         * 
         * @param string $tabla1
         * 
         * @param string $tabla2
         * 
         * @param string $on
         * 
         * @return array
         * 
         */
        public function rightJoin($tabla1, $tabla2, $on){
            $query = "SELECT * FROM ".$tabla1." RIGHT JOIN ".$tabla2." ON ".$on;
            return $this->execute($query);
        }

        /**
         * 
         * full join
         * 
         * @param string $tabla1
         * 
         * @param string $tabla2
         * 
         * @param string $on
         * 
         * @return array
         * 
         */
        public function fullJoin($tabla1, $tabla2, $on){
            $query = "SELECT * FROM ".$tabla1." FULL JOIN ".$tabla2." ON ".$on;
            return $this->execute($query);
        }

        /**
         * 
         * order by
         * 
         * @param string $tabla
         * 
         * @param string $campo
         * 
         * @param string $orden
         * 
         * @return array
         * 
         */
        public function orderBy($tabla, $campo, $orden){
            $query = "SELECT * FROM ".$tabla." ORDER BY ".$campo." ".$orden;
            return $this->execute($query);
        }

        /**
         * 
         * group by
         * 
         * @param string $tabla
         * 
         * @param string $campo
         * 
         * @return array
         * 
         */
        public function groupBy($tabla, $campo){
            $query = "SELECT * FROM ".$tabla." GROUP BY ".$campo;
            return $this->execute($query);
        }

        /**
         * 
         * having
         * 
         * @param string $tabla
         * 
         * @param string $campo
         * 
         * @param string $condicion
         * 
         * @return array
         * 
         */
        public function having($tabla, $campo, $condicion){
            $query = "SELECT * FROM ".$tabla." HAVING ".$campo." = ".$condicion;
            return $this->execute($query);
        }

        /**
         * 
         * count
         * 
         * @param string $tabla
         * 
         * @param string $campo
         * 
         * @return int
         * 
         */
        public function count($tabla, $campo){
            

            $query = "SELECT COUNT(".$campo.") FROM ".$tabla;

            $ex = $this->execute($query);

            $count = 0;

            foreach($ex as $e){
                $count += 1;
            }

            return $count;
        }
    }
    
}


?>