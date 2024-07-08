<?php

namespace App\Model{

    $dir = __DIR__."/../../http/config/sql.php";

    include_once($dir);
    
    use config\sql as q;
    
    require_once("usuarios.php");
    
    use App\Model\usuarios as usuarios;
    
    require_once("tipos_de_credenciales.php");
    
    use App\Model\tipos_de_credencial as tp;

    class credenciales{

        private q $query;

        private int $id_credenciales;

        private tp $tipo;

        private usuarios $carnet;

        public function __construct(){
            $this->query = new q();
        }

        /**
         * Devuelve un array con los datos de la credencial
         * 
         * @return array
         */
        public function toArray(): array {
            return array(
                'id_credenciales' => $this->getIdCredenciales(),
                'tipo' =>  $this->getTipo(),
                'usuario' =>  $this->getCarnet()->toArray()
            );
        }

        /**
         * Devuelve un json con los datos de la credencial
         * 
         * @return string
         */
        public function toJson(): string {
            return json_encode($this->toArray());
        }

        /**
         * Devuelve un string con los datos de la credencial
         * 
         * @return string
         */
        public function toString(): string {
            return "'{$this->getIdCredenciales()}', '{$this->getTipo()->getIdTipo()}', '{$this->getCarnet()->getCarnet()}'";
        }

        /**
         * Devuelve un array con todas las credenciales
         * 
         * @return array
         */
        public function getAll() : array {
            try {
                $datos = $this->query->select('credenciales');

                $array = array();

                foreach ($datos as $d) {
                    $temp_obj = new credenciales();

                    array_push($array, $temp_obj->find('id_credenciales = '.$d['id_credenciales']));
                }

                return $array;
            } catch (\Throwable $th) {
                return array('error' => $th->getMessage());
            }
        }

        /**
         * Establece los valores de la credencial
         * 
         * @param int $id_credenciales
         * @param int $tipo
         * @param int $carnet
         * 
         * @return void
         */
        public function setAll(
            int $id_credenciales,
            int $tipo,
            int $carnet
        ){
            $this->setIdCredenciales($id_credenciales);
            $this->setTipo((new tp())->find('id_tipo = '.$tipo));
            $this->setCarnet((new usuarios())->find('carnet = '.$carnet));
        }

        /**
         * Busca una credencial
         * 
         * @param string $op
         * 
         * @return credenciales
         */
        public function find(string $op) {
            try {
                $datos = $this->query->selectWhere('credenciales', $op);

                foreach ($datos as $d) {
                    $this->setAll(
                        $d['id_credenciales'],
                        $d['tipo'],
                        $d['carnet']
                    );
                }

                return $this;
            } catch (\Throwable $th) {
                echo "error en la peticion find fallo: ".$th;
            }
        }

        /**
         * Guarda una credencial
         * 
         * @param int $id_credenciales
         * @param int $tipo
         * @param int $carnet
         * 
         * @return bool
         */
        public function save(
            int $id_credenciales,
            int $tipo,
            int $carnet
        ): bool{
            try {

                $columnas = 'id_credenciales, tipo, carnet';

                $this->setAll(
                    $id_credenciales,
                    $tipo,
                    $carnet
                );

                $this->query->insert(
                    'credenciales',
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
         * Elimina una credencial
         * 
         * @param int $id_credenciales
         * 
         * @return bool
         */
        public function put(
            int $id_credenciales,
            int $tipo,
            int $carnet
        ): bool{
            try {

                $this->setAll(
                    $id_credenciales,
                    $tipo,
                    $carnet
                );

                $columnas = 'id_credenciales, tipo, carnet';

                $this->query->update(
                    'credenciales',
                    $columnas,
                    'tipo = '.$this->getTipo()->getIdTipo().', carnet = '.$this->getCarnet()->getCarnet(),
                    'id_credenciales = '.$this->getIdCredenciales()
                );

                http_response_code(201);

                return true;
            } catch (\Throwable $th) {
                echo "error en la peticion update fallo: ".$th;

                http_response_code(500);

                return false;
            }
        }
    
        /**
         * Get the value of id_credenciales
         */
        public function getIdCredenciales(): int
        {
                return $this->id_credenciales;
        }
    
        /**
         * Set the value of id_credenciales
         */
        public function setIdCredenciales(int $id_credenciales): self
        {
                $this->id_credenciales = $id_credenciales;
    
                return $this;
        }
    
        /**
         * Get the value of tipo
         */
        public function getTipo(): tp
        {
                return $this->tipo;
        }
    
        /**
         * Set the value of tipo
         */
        public function setTipo(tp $tipo): self
        {
                $this->tipo = $tipo;
    
                return $this;
        }
    
        /**
         * Get the value of carnet
         */
        public function getCarnet(): usuarios
        {
                return $this->carnet;
        }
    
        /**
         * Set the value of carnet
         */
        public function setCarnet(usuarios $carnet): self
        {
                $this->carnet = $carnet;
    
                return $this;
        }
        
    }

}

?>