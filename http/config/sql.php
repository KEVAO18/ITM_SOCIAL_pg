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
         * 
         * metodo para ejecutar una consulta
         * 
         * @param string $query
         * 
         * @param array $params
         * 
         * @return array|boolean
         * 
         */
        public function execute($query, $params = []) {
            try {

                $stmt = $this->conect()->prepare($query);

                foreach ($params as $key => $value) {

                    $stmt->bindValue(':'.$key, $value);

                }

                $stmt->execute();
                
                // Si la consulta es SELECT, devolver los resultados
                if (stripos($query, 'SELECT') === 0) {

                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

                }
                
                return true; // Para consultas que no devuelven resultados

            } catch (\PDOException $e) {

                echo 'Query failed: ' . $e->getMessage();

                return false;

            }
        }
        

        /**
         * metodo para seleccionar datos de una tabla
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
         * metodo para seleccionar datos de una tabla con una condicion
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
         * metodo para insertar datos en una tabla
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
            try {

                if (!is_array($campos)) {
                    $campos = explode(",", $campos);
                }

                if (!is_array($valores)) {
                    $valores = explode(",", $valores);
                }
                
                if (count($campos) != count($valores)) {
                    echo "Error: La cantidad de campos y valores no coincide";
                    return false;
                }

                $placeholders = implode(",", array_map(
                        function($campo) {
                            return " :".trim($campo);
                        }, $campos
                    )
                );
                
                $query = "INSERT INTO $tabla (" . implode(", ", $campos) . ") VALUES ($placeholders)";

                $params = array_combine($campos, $valores);

                return ($this->execute($query, $params)) ? true : false;
                
            } catch (\Throwable $th) {
                echo 'Query failed: ' . $th->getMessage();
            }

        }

        /**
         * 
         * metodo para actualizar datos en una tabla
         * 
         * @param string $tabla
         * 
         * @param string $cambio
         * 
         * @param string $condicion
         * 
         * @return boolean
         * 
         */
        public function update($tabla, $cambio, $condicion){

            if (strpos($condicion, "=") === false) {
                echo "Error: La condicion debe tener el formato columna = valor";
                return false;
            }

            $query = "UPDATE ".$tabla." SET ".$cambio." WHERE ".$condicion;

            return ($this->execute($query))?true:false;
        }

        /**
         * 
         * metodo para eliminar datos de una tabla
         * 
         * @param string $tabla
         * 
         * @param string $condicion
         * 
         * @return boolean
         * 
         */
        public function delete($tabla, $condicion){

            if (strpos($condicion, "=") === false) {
                echo "Error: La condicion debe tener el formato columna = valor";
                return false;
            }

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
         * metodo para agrupar datos en un orden especifico
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
         * metodo para contar los registros de una tabla
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
            
            return $ex[0]['COUNT('.$campo.')'];
        }
    }
    
}


?>