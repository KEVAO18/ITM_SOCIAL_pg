<?php

namespace App\Model{

    require_once("../../http/config/sql.php");

    use config\sql as q;

    class post{

        private q $query;
        
        private int $id_post;

        private string $titulo;

        private string $descripcion;

        private string $imagen;

        private string $fecha_publicacion;
        
        public function __construct(){
            $this->query = new q();
        }

    }

}

?>