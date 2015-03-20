<?php
   if(file_exists('../../default/html/buscaPac.html')){
       echo '<style>';
       include '../../public/modulo/default/css/buscaPac.css';
       echo '</style>';
       echo '<script type="text/javascript">';
       include '../../public/modulo/default/js/buscaPac.js';
       echo '</script>';
       include '../../default/html/buscaPac.html';
   }else{
       echo 'Tela Busca Paciente não Informada!';
   }
?>
