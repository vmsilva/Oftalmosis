<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultacodigoespecialidade':
            ConsultaCodigoEspecialidade();
            break;
        case 'consultanomeespecialidade':
            ConsultaNomeEspecialidade();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConsultaCodigoEspecialidade(){

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
    
    if($G_MEC->recebePost($_POST, 'cd_espld_medc')=== NULL || $G_MEC->recebePost($_POST, 'cd_espld_medc')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Especialidade não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'st_espld_medc')=== NULL || $G_MEC->recebePost($_POST, 'st_espld_medc')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Especialidade não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_espld_medc = $G_MEC->recebePost($_POST, 'cd_espld_medc');
    $st_espld_medc = $G_MEC->recebePost($_POST, 'st_espld_medc');
    SMG_M0008::setcd_espld_medc($cd_espld_medc);
    SMG_M0008::setst_espld_medc($st_espld_medc);
    $rs = SMG_M0008::ConsultaCodigo();
    if(count($rs)>0){
        $dados = array(
            'cd_espld_medc' => $rs[0]['cd_espld_medc'],
            'nm_espld_medc' => $rs[0]['nm_espld_medc'],
            'cd_cbo' => $rs[0]['cd_cbo'],
            'cd_espld_medc_princ' => $rs[0]['cd_espld_medc_princ']
        );
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Especialidade não Localizada!';
        echo json_encode($json);
        exit;
    }   
}

Function ConsultaNomeEspecialidade(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $nm_campo_busca =  @$_POST['nm_campo_busca'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if(@$_POST['nm_espld_medc'] != ''){
        $nm_espld_medc = $_POST['nm_espld_medc'];
    }else{
        $nm_espld_medc = @$_POST['texto'];
    }
    
    if($_POST['st_espld_medc'] != ''){
        $st_espld_medc = $_POST['st_espld_medc'];
    }else{
        $st_espld_medc = $filtro['st_espld_medc'];
    }


    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('cd_espld_medc'=>'Código','nm_espld_medc'=> 'Especialidade');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SMG_M0008::setnm_espld_medc($nm_espld_medc);
    SMG_M0008::setst_espld_medc($st_espld_medc);
    $rs = SMG_M0008::ConsultaNome();

    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
?>
