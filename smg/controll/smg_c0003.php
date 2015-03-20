<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultanomeconselho':
            ConsultaNomeConselho();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConsultaNomeConselho(){

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
    
    if($G_MEC->recebePost($_POST, 'st_conselho')=== NULL || $G_MEC->recebePost($_POST, 'st_conselho')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Conselho não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $st_conselho = $G_MEC->recebePost($_POST, 'st_conselho');
    SMG_M0003::setst_conselho($st_conselho);
    
    
    $rs = SMG_M0003::ConsultaNome();
    if(count($rs)>0){
        $dados = array();
        $i = 0;
        foreach ($rs as $key => $value) {
            $dados[$i]['cd_conselho'] = $rs[$key]['cd_conselho'];
            $dados[$i]['sg_conselho'] = $rs[$key]['sg_conselho'];
            $i++;
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $dados;
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Conselho não Localizada!';
        echo json_encode($json);
        exit;
    }   
}
?>
