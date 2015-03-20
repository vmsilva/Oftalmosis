<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'consultaguichedeptousuario':
            ConsultaGuicheDeptoUsuario();
            break;
        case 'consultanomeservicodepto':
            ConsultaNomeServicoDepto();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function ConsultaGuicheDeptoUsuario(){
    
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
    $opr = $G_MEC->recebePost($_POST, 'opr');
    $url = $G_MEC->recebePost($_POST, 'url');
    
    if($G_MEC->recebePost($_POST, 'st_box')=== NULL || $G_MEC->recebePost($_POST, 'st_box')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro:Status Box//Guichê não Informado!';
        echo json_encode($json);
        exit();
    }
    $st_box = $G_MEC->recebePost($_POST, 'st_box');
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    SGA_M0016::setcd_empresa($cd_empresa);
    SGA_M0016::setst_box($st_box);
    
    $cd_usuario = $_SESSION['cd_usuario_log'];
    SGA_M0016::setcd_usuario($cd_usuario);
    
    $rs = SGA_M0016::ConsultaGuicheDeptoUsuario();
    if(count($rs)>0){
        $Render = new renderView();
        $headers = array('cd_box'=> 'Código', 'nm_box'=>'Box/Guichê');

        echo $Render->renderGrid($rs, $headers, 0, $url, $opr);
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

function ConsultaNomeServicoDepto(){
    
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
        $cd_usuario = $_SESSION['cd_usuario_log'];
        SGA_M0013::setcd_usuario($cd_usuario);
        $rs = SGA_M0013::ConsultaNomeServicoDepto();
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