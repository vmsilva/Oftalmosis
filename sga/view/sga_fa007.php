<?php
    header('X-UA-Compatible: IE=edge,chrome=1');
    switch ($_POST['tp_atend']) {
        //Ambulatório
        case 0:
            //Consultório
            if($_POST['in_servico'] == 0){
                $html = file_get_contents('../html/sga_ha007.html');
                break;
            }
            break;
        //Urgência
        case 1:
            //Consultório
            if($_POST['in_servico'] == 0){
                $html = file_get_contents('../html/sga_hb007.html');
                break;
            }
            break;
        default:
            $html = 'Tipo Atendimento e Seviço não Programado!';
            break;
    }
    echo $html;
    if(file_exists('../../default/view/buscaPac.php')){
        include '../../default/view/buscaPac.php';
    }else{
        echo 'Arquivo buscaPac não encontrado!';
    }
?>