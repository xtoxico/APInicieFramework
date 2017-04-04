<?php
    require $_SERVER['DOCUMENT_ROOT']."lib/tools.php";
    require $_SERVER['DOCUMENT_ROOT']."lib/help.php";
    require $_SERVER['DOCUMENT_ROOT']."lib/generate.php";

    if (sizeof($argv)<2){
        help::general();
    }else{
        if ($argv[1]=="generate"){
            if (sizeof($argv)>=3){
                if ($argv[2]=="clase"){
                    if (sizeof($argv)==4){
                        generate::clase($argv[3]);
                    }else{
                        generate::clase(prompt("\033[32mIndica el nombre de la clase a crear:\033[0m"));
                    }
                    
                }elseif ($argv[2]=="libreria"){

                }else{
                    help::generate();
                }    
            }else{
                help::generate();
            }               
            
        }else{
            echo "\n\033[31m*** Parametro no valido ***\033[0m\n\n";
            //help::general();
        }
    }



?>