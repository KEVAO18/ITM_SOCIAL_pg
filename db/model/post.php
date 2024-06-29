<?php

namespace App\Model{

    $dir = __DIR__."/../../http/config/sql.php";

    include_once($dir);

    use config\sql as q;

    require_once("usuarios.php");

    use App\Model\usuarios as usuarios;

    class post{

        private q $query;
        
        private int $id_post;

        private string $titulo;

        private string $descripcion;

        private string $imagen;

        private string $fecha_publicacion;

        private usuarios $carnet_usuario;
        
        public function __construct(){
            $this->query = new q();
        }

        public function toArray(): array{
            return array(
                'id_post' => $this->getIdPost(),
                'titulo' =>  $this->getTitulo(),
                'descripcion' =>  $this->getDescripcion(),
                'imagen' =>  $this->getImagen(),
                'fecha-publicacion' =>  $this->getFechaPublicacion(),
                'carnet_usuario' => $this->getCarnetUsuario()
            );
        }

        public function toJson(): string{
            return json_encode($this->toArray());
        }

        public function toString(): string{
            return "'".$this->getIdPost().
                "', '".$this->getTitulo().
                "', '".$this->getDescripcion().
                "', '".$this->getImagen().
                "', '".$this->getFechaPublicacion().
                "', '".$this->getCarnetUsuario()."'";
        }

        public function getAll() : array {
            try {
                $datos = $this->query->select('post');

                $array = array();

                foreach($datos as $d){
                    $temp_obj = new post();

                    array_push($array, $temp_obj->find('id_post = '.$d['id_post']));
                }

                return $array;
            } catch (\Throwable $th) {
                echo "Error en la peticion getAll fallo: ".$th;
                return array();
            }
        }

        public function setAll(
            int $id_post,

            string $titulo,
    
            string $descripcion,
    
            string $imagen,
    
            string $fecha_publicacion,

            int $carnet_usuario
        ) {
            $this->setIdPost($id_post);
            $this->setTitulo($titulo);
            $this->setDescripcion($descripcion);
            $this->setImagen($imagen);
            $this->setFechaPublicacion($fecha_publicacion);
            $this->setCarnetUsuario((new usuarios)->find('carnet = '.$carnet_usuario));
        }

        public function find(string $op) {
            try {
                $datos = $this->query->selectWhere('post', $op);

                foreach($datos as $d){
                    $this->setAll(
                        $d['id_post'],
                        $d['titulo'],
                        $d['descripcion'],
                        $d['imagen'],
                        $d['fecha_publicacion'],
                        $d['carnet_usuario'],
                    );
                }

                return $this;
            } catch (\Throwable $th) {
                echo "error en la peticion find fallo: ".$th;
            }
        }

        /**
         * Get the value of id_post
         */
        public function getIdPost(): int
        {
                return $this->id_post;
        }

        /**
         * Set the value of id_post
         */
        public function setIdPost(int $id_post): self
        {
                $this->id_post = $id_post;

                return $this;
        }

        /**
         * Get the value of titulo
         */
        public function getTitulo(): string
        {
                return $this->titulo;
        }

        /**
         * Set the value of titulo
         */
        public function setTitulo(string $titulo): self
        {
                $this->titulo = $titulo;

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
         * Get the value of imagen
         */
        public function getImagen(): string
        {
                return $this->imagen;
        }

        /**
         * Set the value of imagen
         */
        public function setImagen(string $imagen): self
        {
                $this->imagen = $imagen;

                return $this;
        }

        /**
         * Get the value of fecha_publicacion
         */
        public function getFechaPublicacion(): string
        {
                return $this->fecha_publicacion;
        }

        /**
         * Set the value of fecha_publicacion
         */
        public function setFechaPublicacion(string $fecha_publicacion): self
        {
                $this->fecha_publicacion = $fecha_publicacion;

                return $this;
        }

        /**
         * Get the value of carnet_usuario
         */
        public function getCarnetUsuario(): usuarios
        {
                return $this->carnet_usuario;
        }

        /**
         * Set the value of carnet_usuario
         */
        public function setCarnetUsuario(usuarios $carnet_usuario): self
        {
                $this->carnet_usuario = $carnet_usuario;

                return $this;
        }

    }

}

?>