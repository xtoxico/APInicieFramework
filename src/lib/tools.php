<?php
    
    // Función que lee por consola
    function prompt($msg){
        echo "$msg ";
        return trim(fgets(STDIN));
    }
?>