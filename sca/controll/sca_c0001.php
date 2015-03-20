<?php session_start();
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch ($_POST['opr']) {
        case 'consultaCodigoEmpresa':
            consultaCodigoEmpresa();
            break;
        case 'consultaNomeEmpresa':
            consultaNomeEmpresa();
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function consultaCodigoEmpresa(){

    $form = $_POST['form'];
    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();

    $cd_empresa = $G_MEC->recebePost($_POST, 'cd_empresa');
    if($G_MEC->recebePost($_POST, 'cd_empresa') === NULL){
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Empresa não Invalido!';
        echo json_encode($json);
        exit;
    }
    $st_empresa = $G_MEC->recebePost($_POST, 'st_empresa');
    if($G_MEC->recebePost($_POST, 'st_empresa') === NULL){
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Empresa não Invalido!';
        echo json_encode($json);
        exit;
    }

    require_once 'validaSessao.php';
    SCA_M0001::setcd_empresa($cd_empresa);
    SCA_M0001::setst_empresa($st_empresa);
    $rs = SCA_M0001::consultaCodigo();
    if(count($rs)>0){
        if($form === 'sca_h0001'){
            $dados = array(
                'cd_empresa'=>$rs['0']['cd_empresa'],
                'nm_empresa'=>$rs['0']['nm_empresa'],
                'in_logomarca'=>$rs['0']['in_logomarca'],
                'st_empresa'=>$rs['0']['st_empresa']
            );
        }else{
            $dados = array(
                'cd_empresa'=>$rs['0']['cd_empresa'],
                'nm_empresa'=>$rs['0']['nm_empresa']
            );
        }
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Empresa Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Empresa não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomeEmpresa(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if($_POST['nm_empresa'] != ''){
        $nm_empresa = $_POST['nm_empresa'];
    }else{
        $nm_empresa = @$_POST['texto'];
    }

    if($_POST['st_empresa'] != ''){
        $st_empresa = $_POST['st_empresa'];
    }else{
        $st_empresa = $filtro['st_empresa'];
    }

    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('cd_empresa'=> 'Código', 'nm_empresa'=>'Empresa');

    SCA_M0001::setnm_empresa($nm_empresa);
    SCA_M0001::setst_empresa($st_empresa);
    $rs = SCA_M0001::consultaNome();
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
?>