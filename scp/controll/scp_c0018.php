<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'historicoprontuario':
            historicoProntuario();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function historicoProntuario(){}

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
    
    if($G_MEC->recebePost($_POST, 'nr_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $nr_prontuario = $G_MEC->recebePost($_POST, 'nr_prontuario');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0006::setcd_empresa($cd_empresa);
    SCP_M0006::setnr_prontuario($G_MEC->recebePost($_POST, 'nr_prontuario'));

    $rs = SCP_M0006::historicoProntuario();
    if(count($rs)>0){
        $Render = new renderView();
        $headers = array(
            'dt_solic_mov'=> 'Data Solic.',
            'hr_solic_mov'=> 'Hora Solic.',
            'nm_usuario'=> 'Solicitante',
            'dt_devol_solic_mov'=> 'Data Dev.',
            'hr_devol_solic_mov'=> 'Hora Dev.',
            'in_solic_mov'=> 'Situação'
        );
        $html = $Render->renderGrid($rs, $headers, 0, strtolower($_POST['url']), strtolower($_POST['opr']));
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Sucesso: Movimentação Prontuário Localizada com Sucesso!';
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Prontuário sem Movimentação!';
        echo json_encode(array('dados'=>$json));
        exit;
    }   
    
?>