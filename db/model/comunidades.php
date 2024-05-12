<?php

namespace App\Model{

    require_once("../../http/config/sql.php");

    use config\sql as q;

    use App\Model\usuarios as usuarios;

    class comunidades {

        private q $query;

        private int $id_comunidad;

        private string $nombre;

        private string $descripcion;

        private string $admins;

        private usuarios $owner;

        public function __construct() {
            $this->query = new q();
            $this->owner = new usuarios();
        }

        /**
         * 
         * metodo para pasar la informacion de la clase a array
         * 
         */
        public function toArray() {
            return array(
                'id_comunidades'=>$this->getIdComunidad(),
                'nombre'=>$this->getNombre(),
                'descripcion'=>$this->getDescripcion(),
                'admins'=>$this->getAdmins(),
                'dueño'=>$this->getOwner()->toArray(),
            );
        }

        public function toJson(){
            return $this->toArray();
        }

        public function toString(){
            return "'" . $this->getIdComunidad() . 
            "','" . $this->getNombre() . 
            "','" . $this->getDescripcion() . 
            "','" . $this->getAdmins() . 
            "','" . $this->getOwner()->getCarnet() . "'";
        }

        public function getAll(){
            try {
                $datos = $this->query->select('comunidades');

                $array = array();

                foreach ($datos as $d) {

                    $temp_user = new comunidades();
                    
                    array_push($array, $temp_user->find('id_comunidad = '.$d['id_comunidad']));
                    
                }

                return $array;
            } catch (\Throwable $th) {

                echo "error en la peticion getall fallo: ".$th;

                return array();

            }
        }

        public function setAll(
            int $id_comunidad,
            string $nombre,
            string $descripcion,
            string $admins,
            int $owner
        ){
            $this->setIdComunidad($id_comunidad);
            $this->setNombre($nombre);
            $this->setDescripcion($descripcion);
            $this->setAdmins($admins);
            $this->setOwner(((new usuarios)->find("carnet = ".$owner)));
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

        /**
         * Get the value of id_comunidades
         */
        public function getIdComunidad(): int
        {
                return $this->id_comunidad;
        }

        /**
         * Set the value of id_comunidades
         */
        public function setIdComunidad(int $id_comunidad): self
        {
                $this->id_comunidad = $id_comunidad;

                return $this;
        }

        /**
         * Get the value of nombre
         */
        public function getNombre(): string
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         */
        public function setNombre(string $nombre): self
        {
                $this->nombre = $nombre;

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

        /**
         * Get the value of admins
         */
        public function getAdmins(): string
        {
                return $this->admins;
        }

        /**
         * Set the value of admins
         */
        public function setAdmins(string $admins): self
        {
                $this->admins = $admins;

                return $this;
        }

        /**
         * Get the value of owner
         */
        public function getOwner(): usuarios
        {
                return $this->owner;
        }

        /**
         * Set the value of owner
         */
        public function setOwner(usuarios $owner): self
        {
                $this->owner = $owner;

                return $this;
        }
        
    }
}

?>