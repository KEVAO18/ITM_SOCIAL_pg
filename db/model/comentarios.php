<?php

namespace App\Model{
    $dir = __DIR__."/../../http/config/sql.php";

    include_once($dir);

    use config\sql as q;

    class comentarios{
        private q $query;

        public function __construct() {
            $this->query = new q();
        }

        /**
         * 
         * metodo para pasar la informacion de la clase a array
         * 
         */
        public function toArray(): array {
            return array(

            );
        }

        public function toJson(): string {
            return json_encode($this->toArray());
        }

        public function toString(): string {
            return "";
        }

        public function getAll(){
            try {
                $datos = $this->query->select('comunidades');

                $array = array();

                foreach ($datos as $d) {

                    $temp_obj = new comunidades();
                    
                    array_push($array, $temp_obj->find('id_comunidad = '.$d['id_comunidad']));
                    
                }

                return $array;
            } catch (\Throwable $th) {

                echo "error en la peticion getall fallo: ".$th;

                return array();

            }
        }

        public function setAll(
            
        ){
            
        }

        public function find(string $op){
            try {
                $datos = $this->query->selectWhere("comunidades", $op);

                foreach ($datos as $d) {
                    $this->setAll(
                        $d['id_comunidad'],
                        $d['nombre'],
                        $d['descripcion'],
                        $d['admins'],
                        $d['owner']
                    );
                }
    
                return $this;
            } catch (\Throwable $th) {
                echo "error en la peticion find fallo: ".$th;
            }
        }
    }
}

?>