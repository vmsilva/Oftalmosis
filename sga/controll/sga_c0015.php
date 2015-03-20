<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'consultanomeservico':
            consultaNomeServico();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function consultaNomeServico(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');

    if($G_MEC->recebePost($_POST, 'st_serv_painel')=== NULL || $G_MEC->recebePost($_POST, 'st_serv_painel')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro:Status Serviço não Informado!';
        echo json_encode($json);
        exit();
    }
    $st_serv_painel = $G_MEC->recebePost($_POST, 'st_serv_painel');
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    SGA_M0013::setcd_empresa($cd_empresa);
    SGA_M0013::setst_serv_painel($st_serv_painel);
    $rs = SGA_M0013::ConsultaServico();
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_servico'] = $value['cd_serv_painel'];
            $dados[$key]['nm_servico'] = $value['nm_serv_painel'];
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Serviço Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Falha ao Localizar Serviço!';
        $json['cd_servico'] = '';
        $json['nm_servico'] = 'Nenhum Registro Localizado!';
        echo json_encode($json);
        exit; 
    }
}