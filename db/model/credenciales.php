<?php

namespace App\Model{

    require_once("../../http/config/sql.php");
    
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

        public function toArray(): array {
            return array(
                'id_credenciales' => $this->getIdCredenciales(),
                'tipo' =>  $this->getTipo(),
                'carnet' =>  $this->getCarnet()
            );
        }

        public function toJson(): string {
            return json_encode($this->toArray());
        }

        public function toString(): string {
            return "'".$this->getIdCredenciales().
                "', '".$this->getTipo()->getIdTipo().
                "', '".$this->getCarnet()->getCarnet()."'";
        }

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

        public function setAll(
            int $id_credenciales,
            int $tipo,
            int $carnet
        ){
            $this->setIdCredenciales($id_credenciales);
            $this->setTipo((new tp())->find('id_tipo = '.$tipo));
            $this->setCarnet((new usuarios())->find('carnet = '.$carnet));
        }

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
                return array('error' => $th->getMessage());
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