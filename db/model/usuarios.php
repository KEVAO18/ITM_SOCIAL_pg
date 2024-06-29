<?php

namespace App\Model{

    $dir = __DIR__."/../../http/config/sql.php";

    include_once($dir);

    use config\sql as q;

    /**
     * 
     * clase usuarios
     * 
     * esta clase se encarga de manejar los datos de la tabla usuarios
     * 
     * @version 1.0
     * 
     * @package App\Model
     * 
     * @uses config\sql
     * 
     * @version 1.0
     * 
     * @category Model
     * 
     * @autor Kevin Orrego
     * 
     * @method toArray
     * 
     * @method toJson
     * 
     * @method toString
     * 
     * @method getAll
     * 
     * @method setAll
     * 
     * @method find
     * 
     * @method save
     * 
     */
    class usuarios{

        /**
         * @var q $query
         */
        private q $query;

        /**
         * @var int $carnet
         */
        private int $carnet;

        /**
         * @var string $nombre
         */
        private string $nombre;

        /**
         * @var string $usuario
         */
        private string $usuario;

        /**
         * @var string $correo
         */
        private string $correo;

        /**
         * @var string $password
         */
        private string $password;

        /**
         * @var string $cumple
         */
        private string $cumple;

        /**
         * @var string $informacion
         */
        private string $informacion;

        /**
         * @var int $tyc
         */
        private int $tyc;

        public function __construct() {
            $this->query = new q();
        }

        /**
         * 
         * metodo para convertir todos los datos de la clase en un array
         * 
         * @return array
         * 
         */
        public function toArray(): array{
            return array(
                'carnet' => $this->getCarnet(),
                'nombre' => $this->getNombre(),
                'usuario' => $this->getUsuario(),
                'correo' => $this->getCorreo(),
                'contraseña' => $this->getPassword(),
                'cumpleaños' => $this->getCumple(),
                'informacion' => $this->getInformacion(),
                'tyc' => $this->getTyc()
            );
        }

        /**
         * 
         * metodo para convertir todos los datos de la clase en un json usando el metodo toArray
         * 
         * @return string
         * 
         */
        public function toJson():string {
            return json_encode($this->toArray());
        }

        /**
         * 
         * metodo para convertir todos los datos de la clase en un string
         * 
         * @return string
         * 
         */
        public function toString():string {

            return "'{$this->getCarnet()}',
                    '{$this->getNombre()}', 
                    '{$this->getUsuario()}', 
                    '{$this->getCorreo()}', 
                    '{$this->getPassword()}', 
                    '{$this->getCumple()}', 
                    '{$this->getInformacion()}',
                    '{$this->getTyc()}'";
        }

        /**
         * 
         * metodo para optener todos los datos de la tabla usuarios
         * 
         * @return array
         */
        public function getAll() {
            try {
                $datos = $this->query->select('usuarios');

                $array = array();

                foreach ($datos as $d) {
                    $temp_obj = new usuarios();
                    
                    array_push($array, $temp_obj->find('carnet = '.$d['carnet']));
                }

                http_response_code(200);

                return $array;
            } catch (\Throwable $th) {

                echo "error en la peticion getall fallo: ".$th;

                http_response_code(500);

                return array();

            }
        }

        /**
         * 
         *  metodo para asignar los datos todas las variables privadas de la clase
         * 
         * @param int $carnet
         * @param string $nombre
         * @param string $usuario
         * @param string $correo
         * @param string $password
         * @param string $cumple
         * @param string $informacion
         * @param int $tyc
         * 
         * @return void
         * 
        */
        public function setAll(
            int $carnet,
            string $nombre,
            string $usuario,
            string $correo,
            string $password,
            string $cumple,
            string $informacion,
            int $tyc
        ): void{
            
            $this->setCarnet($carnet);
            $this->setNombre($nombre);
            $this->setUsuario($usuario);
            $this->setCorreo($correo);
            $this->setPassword($password);
            $this->setCumple($cumple);
            $this->setInformacion($informacion);
            $this->setTyc($tyc);

        }

        /**
         * 
         * metodo para buscar un usuario en la base de datos y optener sus datos
         * 
         * @param string $op
         * 
         * @return usuarios
         * 
         */
        public function find(string $op): usuarios{

            try {

                $datos = $this->query->selectWhere('usuarios', $op);

                foreach ($datos as $d) {
                    $this->setAll(
                        $d['carnet'],
                        $d['nombre'],
                        $d['usuario'],
                        $d['correo'],
                        $d['contraseña'],
                        $d['cumpleaños'],
                        $d['informacion'],
                        $d['tyc']
                    );
                }

                return $this;

            } catch (\Throwable $th) {
                echo "error en la peticion find fallo: ".$th;
            }
        }

        /**
         * 
         * metodo para insertar un nuevo usuario en la base de datos
         * 
         * @param int $carnet
         * @param string $nombre
         * @param string $usuario
         * @param string $correo
         * @param string $password
         * @param string $cumple
         * @param string $informacion
         * @param int $tyc
         * 
         * @return bool
         * 
         */
        public function save(
            int $carnet,
            string $nombre,
            string $usuario,
            string $correo,
            string $password,
            string $cumple,
            string $informacion,
            int $tyc
        ): bool {

            try {

                $this->setAll(
                    $carnet,
                    $nombre,
                    $usuario,
                    $correo,
                    $password,
                    $cumple,
                    $informacion,
                    $tyc
                );

                $columnas = 'carnet, nombre, usuario, correo, contraseña, cumpleaños, informacion, tyc';

                $this->query->insert('usuarios', $columnas, $this->toString());

                http_response_code(201);

                return true;

            } catch (\Throwable $th) {

                echo "error en la peticion save fallo: ".$th;

                http_response_code(500);

                return false;

            }

        }

        /**
         * 
         * metodo para actualizar los datos de un usuario en la base de datos
         * 
         * @param int $carnet
         * @param string $nombre
         * @param string $usuario
         * @param string $correo
         * @param string $password
         * @param string $cumple
         * @param string $informacion
         * @param int $tyc
         * 
         * @return bool
         * 
         */
        public function put(
            int $carnet,
            string $nombre,
            string $usuario,
            string $correo,
            string $password,
            string $cumple,
            string $informacion,
            int $tyc
        ) : bool{
            try{
                $this->setAll(
                    $carnet,
                    $nombre,
                    $usuario,
                    $correo,
                    $password,
                    $cumple,
                    $informacion,
                    $tyc
                );

                $columnas = 'carnet, nombre, usuario, correo, contraseña, cumpleaños, informacion, tyc';

                $this->query->update('usuarios', $columnas, $this->toString(), 'carnet = '.$carnet);

                http_response_code(202);

                return true;
            }catch(\Throwable $th){
                echo "error en la peticion put fallo: ".$th;

                http_response_code(500);

                return false;
            }
        }

        /**
         * 
         * metodo para eliminar un usuario de la base de datos
         * 
         * @param int $carnet
         * 
         * @return bool
         * 
         */
        public function delete(int $carnet): bool{
            try{
                $this->query->delete('usuarios', 'carnet = '.$carnet);

                http_response_code(202);

                return true;
            }catch(\Throwable $th){
                echo "error en la peticion delete fallo: ".$th;

                http_response_code(500);

                return false;
            }
        }

        /**
         * Get the value of carnet
         */
        public function getCarnet(): int
        {
                return $this->carnet;
        }

        /**
         * Set the value of carnet
         */
        public function setCarnet(int $carnet): self
        {
                $this->carnet = $carnet;

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
         * Get the value of usuario
         */
        public function getUsuario(): string
        {
                return $this->usuario;
        }

        /**
         * Set the value of usuario
         */
        public function setUsuario(string $usuario): self
        {
                $this->usuario = $usuario;
                
                return $this;
        }

        /**
         * Get the value of correo
         */
        public function getCorreo(): string
        {
                return $this->correo;
        }
        
        /**
         * Set the value of correo
         */
        public function setCorreo(string $correo): self
        {
                $this->correo = $correo;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword(): string
        {
                return $this->password;
        }

        /**
         * Set the value of password
         */
        public function setPassword(string $password): self
        {
                $this->password = $password;
                
                return $this;
            }

            /**
             * Get the value of cumple
         */
        public function getCumple(): string
        {
                return $this->cumple;
            }

            /**
             * Set the value of cumple
         */
        public function setCumple(string $cumple): self
        {
                $this->cumple = $cumple;

                return $this;
            }

            /**
             * Get the value of informacion
             */
            public function getInformacion(): string
        {
                return $this->informacion;
        }

        /**
         * Set the value of informacion
         */
        public function setInformacion(string $informacion): self
        {
                $this->informacion = $informacion;

                return $this;
        }

        /**
         * Get the value of tyc
         */
        public function getTyc(): int
        {
            return $this->tyc;
        }

        /**
         * Set the value of tyc
         */
        public function setTyc(int $tyc): self
        {
            $this->tyc = $tyc;
            
            return $this;
        }
    }
}

?>