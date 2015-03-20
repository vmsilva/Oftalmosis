<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultacodigo':
            ConsultaCodigo();
            break;
        case 'consultanome':
            ConsultaNome();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConsultaCodigo(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')== NULL || $G_MEC->recebePost($_POST, 'form')== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'nr_cnes')== NULL || $G_MEC->recebePost($_POST, 'nr_cnes')== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Unidade não Informado!';
        echo json_encode($json);
        exit();
    }

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SMG_M0002::setcd_empresa($cd_empresa);
    $nr_cnes = $G_MEC->recebePost($_POST, 'nr_cnes');
    SMG_M0002::setnr_cnes($nr_cnes);
    $rs = SMG_M0002::ConsultaCodigo();
    if(count($rs)>0){
        $dados = array();
        $dados['cd_cnes'] = $rs[0]['cd_cnes'];
        $dados['nr_cnes'] = $rs[0]['nr_cnes'];
        $dados['nm_cnes'] = $rs[0]['nm_cnes'];
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
        $json['msg'] = 'Erro: Código Unidade não Localizada!';
        echo json_encode($json);
        exit;
    }   
}

Function ConsultaNome(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $nm_campo_busca =  @$_POST['nm_campo_busca'];
    $inputBusca = (int)@$_POST['inputBusca'];

    if($_POST['nm_cnes'] != ''){
        $nm_cnes = $_POST['nm_cnes'];
    }else{
        $nm_cnes = @$_POST['texto'];
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SMG_M0002::setcd_empresa($cd_empresa);
    SMG_M0002::setnm_cnes($nm_cnes);
    $rs = SMG_M0002::consultaNome();
    $Render = new renderView();
    $headers = array('nr_cnes'=> 'Código', 'nm_cnes'=>'Unidade');
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
?>
