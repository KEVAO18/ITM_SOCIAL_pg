<?php
//create a class using the namespace config using routes 

/**
 * @KEVAO18
 */
namespace config{
    
    class routesController{

        function __construct(){
    
        }
    
        function route() {
    
            if(!isset($_SESSION['userData'])){
    
                $this->outRoute();
    
            }
    
        }
    
    
        public function outRoute(){
    
            $ruta = array();
    
            if (isset($_GET["p"])) {
                $p = $_GET["p"];
                $ruta = explode("/", $p);
            }
    
            switch ($ruta[0]) {
    
                case "e403":
                    echo $ruta[0];
                    break;
    
                case "e404":
                    echo $ruta[0];
                    break;
    
                default:
                    echo "Por defecto";
            }
        }
    
        public function error() {
            ?>
            <h1 class="text-center display-2 pt-4">Error</h1>
            <h1 class="text-center display-2 pb-4">404</h1>
            <p class="display-6 text-center">Page not found</p>
            <?php
        }
    }
}
?>