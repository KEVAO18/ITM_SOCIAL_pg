<?php


namespace App\Model{

    $dir = __DIR__."/../../http/config/sql.php";

    include_once($dir);

    use config\sql as q;
    class tipos_de_credencial{

        private q $query;

        private int $id_tipo;

        private string $descripcion;

        public function __construct(){
            $this->query = new q();
        }

        /**
         * Devuelve un array con los datos del tipo de credencial
         * 
         * @return array
         */
        public function toArray(): array {
            return array(
                'id_tipo' => $this->getIdTipo(),
                'descripcion' =>  $this->getDescripcion()
            );
        }

        /**
         * Devuelve un json con los datos del tipo de credencial
         * 
         * @return string
         */
        public function toJson(): string {
            return json_encode($this->toArray());
        }

        /**
         * Devuelve un string con los datos del tipo de credencial
         * 
         * @return string
         */
        public function toString(): string {
            return "'{$this->getIdTipo()}', '{$this->getDescripcion()}'";
        }

        /**
         * Devuelve un array con todos los tipos de credenciales
         * 
         * @return array
         */
        public function getAll() : array {
            try {
                $datos = $this->query->select('tipos_de_credenciales');

                $array = array();

                foreach ($datos as $d) {
                    $temp_obj = new tipos_de_credencial();

                    array_push($array, $temp_obj->find('id_tipo = '.$d['id_tipo']));
                }

                http_response_code(200);

                return $array;
            } catch (\Throwable $th) {

                http_response_code(500);

                return array('error' => $th->getMessage());
            }
        }

        /**
         * Set all data
         * 
         * @param int $id_tipo
         * @param string $descripcion
         * 
         * @return void
         */
        public function setAll(
            int $id_tipo,
            string $descripcion
        ){
            $this->setIdTipo($id_tipo);
            $this->setDescripcion($descripcion);
        }

        /**
         * Busca un tipo de credencial
         * 
         * @param string $op
         * 
         * @return self
         */
        public function find(string $op) {
            try {
                $datos = $this->query->selectWhere('tipos_de_credenciales', $op);

                foreach ($datos as $d) {
                    $this->setAll(
                        $d['id_tipo'],
                        $d['descripcion']
                    );
                }
                return $this;
            } catch (\Throwable $th) {
                echo "error en la peticion find fallo: ".$th;
            }
        }

        /**
         * Guarda un tipo de credencial
         * 
         * @param int $id_tipo
         * @param string $descripcion
         * 
         * @return bool
         */
        public function save(
            int $id_tipo,
            string $descripcion
        ): bool {
            try {

                $this->setAll(
                    $id_tipo,
                    $descripcion
                );

                $columnas = 'id_tipo, descripcion';

                $this->query->insert(
                    'tipos_de_credenciales',
                    $columnas,
                    $this->toString()
                );

                http_response_code(201);

                return true;
            } catch (\Throwable $th) {

                echo "error en la peticion save fallo: ".$th;

                http_response_code(500);

                return false;
            }
        }

        /**
         * Actualiza un tipo de credencial
         * 
         * @param int $id_tipo
         * @param string $descripcion
         * 
         * @return bool
         */
        public function put(
            int $id_tipo,
            string $descripcion
        ): bool {
            try {

            $this->setAll(
                $id_tipo,
                $descripcion
            );
                $columnas = 'id_tipo, descripcion';

                $this->query->update(
                    'tipos_de_credenciales', 
                    $columnas, 
                    "'".$this->getIdTipo()."', '".$this->getDescripcion()."'",
                    'id_tipo = '.$this->getIdTipo()
                );

                http_response_code(202);

                return true;
            } catch (\Throwable $th) {
                echo "error en la peticion update fallo: ".$th;
                                
                http_response_code(500);

                return false;
            }
        }

        /**
         * Elimina un tipo de credencial
         * 
         * @return bool
         */
        public function delete(): bool{
            try {
                $this->query->delete(
                    'tipos_de_credenciales',
                    'id_tipo = '.$this->getIdTipo()
                );

                http_response_code(202);

                return true;
            } catch (\Throwable $th) {
                echo "error en la peticion delete fallo: ".$th;
                                
                http_response_code(500);

                return false;
            }
        }

        /**
         * Get the value of id_tipo
         */
        public function getIdTipo(): int
        {
                return $this->id_tipo;
        }

        /**
         * Set the value of id_tipo
         */
        public function setIdTipo(int $id_tipo): self
        {
                $this->id_tipo = $id_tipo;

                return $this;
        }

        /**
         * Get the value of descripcion
         */
        public function getDescripcion(): string
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         */
        public function setDescripcion(string $descripcion): self
        {
                $this->descripcion = $descripcion;

                return $this;
        }

    }
}

?>