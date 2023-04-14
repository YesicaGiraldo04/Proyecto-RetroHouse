<?php 
    class Validador {
        public function validarDatos($datos) {
            if(!isset($datos)) return false;

            if(!is_array($datos)) return !empty($datos);

            if(sizeof($datos) == 0) return 0;

            foreach($datos as $item) {
                if(!isset($item) || empty($item)) return false;
            }

            return true;
        }
    }

?>