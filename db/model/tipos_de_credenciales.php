<?php


namespace App\Model{

    require_once("../../http/config/sql.php");

    use config\sql as q;
    class tipos_de_credencial{

        private q $query;

        private int $id_tipo;

        private string $descripcion;

        public function __construct(){
            $this->query = new q();
        }

        public function toArray(): array {
            return array(
                'id_tipo' => $this->getIdTipo(),
                'descripcion' =>  $this->getDescripcion()
            );
        }

        public function toJson(): string {
            return json_encode($this->toArray());
        }

        public function toString(): string {
            return "'".$this->getIdTipo().
                "', '".$this->getDescripcion()."'";
        }

        public function getAll() : array {
            try {
                $datos = $this->query->select('tipos_de_credenciales');

                $array = array();

                foreach ($datos as $d) {
                    $temp_obj = new tipos_de_credencial();

                    array_push($array, $temp_obj->find('id_tipo = '.$d['id_tipo']));
                }

                return $array;
            } catch (\Throwable $th) {
                return array('error' => $th->getMessage());
            }
        }

        public function setAll(
            int $id_tipo,
            string $descripcion
        ){
            $this->setIdTipo($id_tipo);
            $this->setDescripcion($descripcion);
        }

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