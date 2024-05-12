<?php

namespace App\Model{

    require_once("../../http/config/sql.php");

    use config\sql as q;

    class eventos{

        private q $query;

        private int $id_evento;

        private string $fecha_evento;

        private string $fecha_creacion;

        private string $descripcion;

        private string $interesados;

        private usuarios $organizador;

        public function __construct() {
            $this->query = new q();
        }

        /**
         * 
         * metodo para pasar la informacion de la clase a array
         * 
         */
        public function toArray() {
            return array(
                'id_evento'=>$this->getIdEvento(),
                'fecha_evento'=>$this->getFechaEvento(),
                'fecha_creacion'=>$this->getFechaCreacion(),
                'descripcion'=>$this->getDescripcion(),
                'interesados'=>$this->getInteresados(),
                'organizador'=>$this->getOrganizador()->toArray(),
            );
        }

        public function toJson(){
            return $this->toArray();
        }

        public function toString(){
            return "'" . $this->getIdEvento() . 
            "','" . $this->getFechaEvento() . 
            "','" . $this->getFechaCreacion() . 
            "','" . $this->getDescripcion() . 
            "','" . $this->getInteresados() . 
            "','" . $this->getOrganizador()->getCarnet() . "'";
        }

        public function getAll(){
            try {
                $datos = $this->query->select('eventos');

                $array = array();

                foreach ($datos as $d) {
                    $evento = new eventos();
                    
                    array_push($array, $evento->find('id_evento = '.$d['id_evento']));
                }

                return $array;
            } catch (\Throwable $th) {
                return "error en la peticion getAll fallo: ".$th;
            }
        }

        public function setAll(
            int $id_evento,
            string $fecha_evento,
            string $fecha_creacion,
            string $descripcion,
            string $interesados,
            int $organizador
        ){
            $this->setIdEvento($id_evento);
            $this->setFechaEvento($fecha_evento);
            $this->setFechaCreacion($fecha_creacion);
            $this->setDescripcion($descripcion);
            $this->setInteresados($interesados);
            $this->setOrganizador((new usuarios())->find('carnet = '.$organizador));
        }

        public function find(string $op){
            try {
                $datos = $this->query->selectWhere('eventos', $op);

                foreach ($datos as $d) {
                    $this->setAll(
                        $d['id_evento'],
                        $d['fecha_evento'],
                        $d['fecha_creacion'],
                        $d['descripcion'],
                        $d['interesados'],
                        $d['carnet_organizador']
                    );
                }

                return $this;
            } catch (\Throwable $th) {
                return "error en la peticion find fallo: ".$th;
            }
        }

        /**
         * Get the value of query
         */
        public function getQuery(): q
        {
                return $this->query;
        }

        /**
         * Set the value of query
         */
        public function setQuery(q $query): self
        {
                $this->query = $query;

                return $this;
        }

        /**
         * Get the value of id_evento
         */
        public function getIdEvento(): int
        {
                return $this->id_evento;
        }

        /**
         * Set the value of id_evento
         */
        public function setIdEvento(int $id_evento): self
        {
                $this->id_evento = $id_evento;

                return $this;
        }

        /**
         * Get the value of fecha_evento
         */
        public function getFechaEvento(): string
        {
                return $this->fecha_evento;
        }

        /**
         * Set the value of fecha_evento
         */
        public function setFechaEvento(string $fecha_evento): self
        {
                $this->fecha_evento = $fecha_evento;

                return $this;
        }

        /**
         * Get the value of fecha_creacion
         */
        public function getFechaCreacion(): string
        {
                return $this->fecha_creacion;
        }

        /**
         * Set the value of fecha_creacion
         */
        public function setFechaCreacion(string $fecha_creacion): self
        {
                $this->fecha_creacion = $fecha_creacion;

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
         * Get the value of interesados
         */
        public function getInteresados(): string
        {
                return $this->interesados;
        }

        /**
         * Set the value of interesados
         */
        public function setInteresados(string $interesados): self
        {
                $this->interesados = $interesados;

                return $this;
        }

        /**
         * Get the value of organizador
         */
        public function getOrganizador(): usuarios
        {
                return $this->organizador;
        }
    
        /**
         * Set the value of organizador
         */
        public function setOrganizador(usuarios $organizador): self
        {
                $this->organizador = $organizador;
    
                return $this;
        }
    }
}

?>