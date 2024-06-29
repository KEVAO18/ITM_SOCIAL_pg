<?php

namespace http\controllers{


    class render{

        private string $pagina;

        public function __construct(string $pagina) {
            $this->setPagina($pagina);
            return $this->render();
        }

        public function render(){
            $pagina = __DIR__."web".$this->getPagina();

            if(file_exists($pagina)){
                include_once($pagina);
            }else{
                echo "pagina no encontrada";
            }
        }

        /**
         * Get the value of pagina
         */
        public function getPagina()
        {
                return $this->pagina;
        }
    
        /**
         * Set the value of pagina
         */
        public function setPagina($pagina): self
        {
                $this->pagina = $pagina;
    
                return $this;
        }

    }

}

?>