<?php
    //Listar todos Prontuários não impresso
    $handle = opendir(realpath('.'));
    $lista = array();
    if ($handle) {
        while (false !== ($file = readdir($handle))) {
            if (is_file($file) && $file !== 'etiqueta.php' && $file !== 'impresso.php') {
                $lista[] = $file;
            }
        }
        echo implode('|', $lista);
    }
?>
