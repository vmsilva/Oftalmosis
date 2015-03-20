<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch ($_POST['opr']) {
        case 'consultaCodigoSistema':
            consultaCodigoSistema();
            break;
        case 'ConsultaNomeSistema':
            ConsultaNomeSistema();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function consultaCodigoSistema(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'cd_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Sistema não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_sistema = $G_MEC->recebePost($_POST, 'cd_sistema');
    }
    
    if($G_MEC->recebePost($_POST, 'st_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Sistema não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_sistema = $G_MEC->recebePost($_POST, 'st_sistema');
    }
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCA_M0003::setcd_sistema($cd_sistema);
    SCA_M0003::setst_sistema($st_sistema);
    $rs = SCA_M0003::consultaSistemaCodigo();
    if(count($rs)>0){
        if($form === 'scp_h0003'){
            $dados = array(
                'cd_sistema'=>$rs['0']['cd_sistema'],
                'nm_sistema'=>$rs['0']['nm_sistema'],
                'st_sistema'=>$rs['0']['st_sistema'],
                'sg_sistema'=>$rs['0']['sg_sistema'],
                'in_hier_sist'=>$rs['0']['in_hier_sist']
            );
        }else{
            $dados = array(
                'cd_sistema'=>$rs['0']['cd_sistema'],
                'nm_sistema'=>$rs['0']['nm_sistema']
            );
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Sistema Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Sistema não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function ConsultaNomeSistema(){

    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];
    $nm_sistema = '';

    if(@$_POST['nm_sistema'] != ''){
        $nm_sistema = @$_POST['nm_sistema'];
    }else{
        $nm_sistema = @$_POST['texto'];
    }
    
    $st_sistema = '';
    if(@$_POST['st_sistema'] != ''){
        $st_sistema = @$_POST['st_sistema'];
    }else{
        $st_sistema = @$filtro['st_sistema'];
    }
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    $Render = new renderView();
    $headers = array('cd_sistema'=> 'Código', 'nm_sistema'=>'Sistema');
    SCA_M0003::setnm_sistema($nm_sistema);
    SCA_M0003::setst_sistema($st_sistema);
    $rs = SCA_M0003::consultaSistemaNome();
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
    
}
?>