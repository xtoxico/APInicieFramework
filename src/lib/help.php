<?php

/*
CODIGOS DE COLORES EN CONSOLA  
-----------------------------
Black 0;30
Blue 0;34
Green 0;32
Cyan 0;36
Red 0;31
Purple 0;35
Brown 0;33
Light Gray 0;37 
Dark Gray 1;30
Light Blue 1;34
Light Green 1;32
Light Cyan 1;36
Light Red 1;31
Light Purple 1;35
Yellow 1;33
White 1;37

*/


class help{
    static function general(){
        echo "APInicie: Herramienta para construir APIs con el framework APInicie v 0.1\n";
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\033[36mAPInicie\033[0m new <api>\n";
        echo "      Gerera automaticame el skell de la api y los ficheros de configuracion\n";
        echo "\n";

        echo "\033[36mAPInicie\033[0m config <opcion>\n";
        echo "      Gerera ficheros de configuracion\n";
        echo "         Opciones disponibles\n";
        echo "           - all  : Todas las configuraciones\n";
        echo "           - dev  : Configuracion de entorno de desarrollo\n";
        echo "           - prod : Configuracion de entorno de produccion\n";
        echo "           - beta : Configuracion de entorno de pruebas\n";
        echo "\n";
        echo "\033[36mAPInicie\033[0m generate <Blueprint> <nombre>\n";
        echo "      Genera automáticamente el nuevo codigo para los distintos blueprints\n";
        echo "         BluePrints disponibles:\n";
        echo "          - clase\n";
        echo "          - libreria\n";
        echo "\n";
        echo "\n";
        echo "\n";

    }

    static function generate(){
        echo "\033[36mAPInicie\033[0m generate <Blueprint> <nombre>\n";
        echo "      Genera automáticamente el nuevo codigo para los distintos blueprints\n";
        echo "         BluePrints disponibles:\n";
        echo "          - clasen";
        echo "          - libreria\n";
    }
}


?>