<?php

    $origem = isset($_GET['nr_prontuario']) ? $_GET['nr_prontuario'] : exit();
    $destino = realpath('.').'/impresso/'.$origem;
    $origem = realpath('.').'/'.$origem;

    copy($origem, $destino);
    unlink($origem);
    
?>