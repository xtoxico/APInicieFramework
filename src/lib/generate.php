<?php
    class generate{
        static function dir_prerequisites(){
            if (!file_exists('src')){
                mkdir('src');
            }
            if (!file_exists('src/model')){
                mkdir('src/model');
            }
            if (!file_exists('src/controller')){
                mkdir('src/controller');
            }
            if (!file_exists('src/router')){
                mkdir('src/router');
            }
        }

        static function clase($name){
            //voy a capturar las distintas variables de la clase
            generate::dir_prerequisites();
            $variables = array();
            $tablaBBDD = "";
            $variable=" "; // valor basura
            echo "\nNecesito saber el nombre de las variables de la clase $name\n";
            echo "(dejar vacio para terminar)\n";
            $variables[]="id_$name";
            $i=1;
            while ($variable!=""){
                $variable=prompt("\033[33mVariable [$i]:\033[0m");
                if($variable!=""){
                    $variables[]=$variable;
                    $i++;
                }
                
            }
            echo "\nNecesito saber el nombre de Tabla donde se almacenara la clase $name\n";
            $tablaBBDD=prompt("\033[33mTabla :\033[0m");
            
            /* Creamos el modelo */ 
            $fichero = fopen('src/model/'.$name.'.php',"w+");            
            fwrite($fichero, "<?php\n");
            fwrite($fichero, "  class $name{\n");
            // añadimos todas la variables
            fwrite($fichero, "      private \$errorcode;\n");
            fwrite($fichero, "      private \$errormsg;\n");
            foreach ($variables as $variable){
                fwrite($fichero, "      private \$$variable;\n");
            }

            fwrite($fichero, "\n\n\n\n");
            // funciones GETs
            foreach ($variables as $variable){
                fwrite($fichero, "      function get_$variable(){\n");
                fwrite($fichero, "          return (\$this->$variable);\n");
                fwrite($fichero, "      }\n");
            }

            // funciones SETs
            foreach ($variables as $variable){
                fwrite($fichero, "      function set_$variable(\$$variable){\n");
                fwrite($fichero, "          \$this->$variable=\$$variable;\n");
                fwrite($fichero, "      }\n");
            }

            fwrite($fichero, "      \n\n");
            //function load 

            fwrite($fichero, "      function load(\$id_$name){\n");
            fwrite($fichero, "          \$con = new \lib\conect;\n");
            fwrite($fichero, "          if (\$id_$name==0){\n");
            fwrite($fichero, "              \$this->id_$name=\$id_$name;\n");
            fwrite($fichero, "              return true;\n");
            fwrite($fichero, "          }\n");
            fwrite($fichero, "          \$sql='SELECT\n");
            $separator=",";
            $i=1;
            foreach ($variables as $variable){
                if ($i<(sizeof($variables))){
                    fwrite($fichero, "                     $variable$separator\n");
                }else{
                    fwrite($fichero, "                     $variable\n");
                }
                $i++;
            }
            fwrite($fichero, "              from $tablaBBDD\n");
            fwrite($fichero, "              where \n");
            fwrite($fichero, "                  id_$name=\"'.\$this->id_$name.'\"';\n");
            fwrite($fichero, "          \$rows=\$con->query(\$sql);\n");
            fwrite($fichero, "          if (sizeof(\$rows)==0){;\n");
            fwrite($fichero, "              \$this->errorcode=\"DNNOR001\";\n");
            fwrite($fichero, "              \$this->errormsg=\"$name seleccionado no existe\";\n");
            fwrite($fichero, "              return false;\n");
            fwrite($fichero, "          }\n");

            fwrite($fichero, "          foreach (\$rows as \$row){\n");
            foreach ($variables as $variable){
                fwrite($fichero, "              \$this->$variable=\$row['$variable'];\n");
            }
            
            fwrite($fichero, "          }\n");
            fwrite($fichero, "          return true;\n");
            fwrite($fichero, "      }\n"); // Cierre función load

            fwrite($fichero, "      function json(){\n");
            fwrite($fichero, "          \$ret = array (\n");
            $separator=",";
            $i=1;
            foreach ($variables as $variable){ 
                if ($i<(sizeof($variables))){
                    fwrite($fichero, "              '$variable'=>\$this->$variable$separator\n");
                }else{
                    fwrite($fichero, "              '$variable'=>\$this->$variable\n");
                }
                $i++;
            }
            fwrite($fichero, "          );\n");
            fwrite($fichero, "          return (json_encode(\$ret));\n");
            fwrite($fichero, "      }\n"); // Cierre función json

            fwrite($fichero, "      function save(){\n"); // Funcion Save
            fwrite($fichero, "          if((\$this->id_$name==0)||is_null(\$this->id_$name==0)){\n"); 
            fwrite($fichero, "              \$sql = 'insert into $tablaBBDD(");
            $separator=",";
            $i=1;
            foreach ($variables as $variable){ 
                if ($i<(sizeof($variables))){
                    fwrite($fichero,"$variable$separator");
                }else{
                    fwrite($fichero,"$variable");
                }
                $i++;
            } 
            $separator=",";
            $i=1;
            fwrite($fichero,") values\n                     (");
            foreach ($variables as $variable){ 
                if ($i<(sizeof($variables))){
                    fwrite($fichero,":$variable$separator");
                }else{
                    fwrite($fichero,":$variable");
                }
                $i++;
            } 
            fwrite($fichero,")';\n");
            fwrite($fichero,"           \$sqlvars=array(\n");
            $separator=",";
            $i=1;            
            foreach ($variables as $variable){ 
                if ($i<(sizeof($variables))){
                    fwrite($fichero,"                   ':$variable'=>\$this->$variable$separator\n");
                }else{
                    fwrite($fichero,"                   ':$variable'=>\$this->$variable\n");
                }
                $i++;
            }
            fwrite($fichero,"               );\n");
            fwrite($fichero, "              \$insert=true;\n"); 
            fwrite($fichero, "          }else{\n"); 
            fwrite($fichero, "              \$sql='UPDATE $tablaBBDD set \n"); 
            $separator=",";
            $i=1;            
            foreach ($variables as $variable){ 
                if ($i<(sizeof($variables))){
                    fwrite($fichero,"               $variable=:$variable$separator\n");
                }else{
                    fwrite($fichero,"               $variable=:$variable\n");
                }
                $i++;
            }
            fwrite($fichero,"               where id_$name=\$this->id_$name';\n");
             fwrite($fichero,"           \$sqlvars=array(\n");
            $separator=",";
            $i=1;            
            foreach ($variables as $variable){ 
                if ($i<(sizeof($variables))){
                    fwrite($fichero,"                   ':$variable'=>\$this->$variable$separator\n");
                }else{
                    fwrite($fichero,"                   ':$variable'=>\$this->$variable\n");
                }
                $i++;
            }
            fwrite($fichero,"               );\n");
            fwrite($fichero, "              \$insert=false;\n"); 
            fwrite($fichero, "          }\n"); 
            fwrite($fichero, "          \$con->query_escape(\$sql,\$sqlvars);\n");
            fwrite($fichero, "          if (\$insert){\n");
            fwrite($fichero, "              \$this->id_$name=\$con->lastid();\n");
            fwrite($fichero, "          }\n");
            fwrite($fichero, "      }\n"); // Cierre función Save
            fwrite($fichero, "  }\n"); //Cierre de Clase
            fwrite($fichero, "?>");
            fclose($fichero);

            
        }
    }
?>