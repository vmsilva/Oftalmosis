<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultanometipograde':
            ConsultaNomeTipoGrade();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConsultaNomeTipoGrade(){

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
    
    if($G_MEC->recebePost($_POST, 'st_tp_grade')=== NULL || $G_MEC->recebePost($_POST, 'st_tp_grade')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Grade não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0004::setcd_empresa($cd_empresa);
    $cd_cnes = '5208702659832';
    SGA_M0004::setcd_cnes($cd_cnes);
    $st_tp_grade = $G_MEC->recebePost($_POST, 'st_tp_grade');
    SGA_M0004::setst_tp_grade($st_tp_grade);
    
    $rs = SGA_M0004::ConsultaNome();
    if(count($rs)>0){
        $dados = array();
        foreach ($rs as $key => $value) {
            $dados[$rs[$key]['cd_tp_grade']] = $rs[$key]['nm_tp_grade'];
        }
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
        $json['msg'] = 'Erro: Tipo Grade não Localizada!';
        echo json_encode($json);
        exit;
    }   

}
?>
