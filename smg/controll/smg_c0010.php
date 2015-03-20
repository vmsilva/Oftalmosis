<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'consultacodigoprocedimento':
            consultaCodigoProcedimento();
            break;
        case 'consultanomeprocedimento':
            consultaNomeProcedimento();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function consultaCodigoProcedimento(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'cd_procd_medc')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Procedimento não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
    }
    
    if($G_MEC->recebePost($_POST, 'st_procd_medc')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Procedimento não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_procd_medc = $G_MEC->recebePost($_POST, 'st_procd_medc');
    }

    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    SMG_M0010::setcd_procd_medc($cd_procd_medc);
    SMG_M0010::setst_procd_medc($st_procd_medc);
    $rs = SMG_M0010::ConsultaProcedimento();
    if(count($rs)>0){
        $dados = array(
            'cd_procd_medc'=>$rs['0']['cd_procd_medc'],
            'nm_procd_medc'=>$rs['0']['nm_procd_medc'],
//            'tp_sexo'=>$rs['0']['tp_sexo'],
//            'vl_idade_min'=>$rs['0']['vl_idade_min'],
//            'vl_idade_max'=>$rs['0']['vl_idade_max'],
//            'vl_sh'=>$rs['0']['vl_sh'],
//            'vl_sa'=>$rs['0']['vl_sa'],
//            'vl_sp'=>$rs['0']['vl_sp'],
            'st_procd_medc'=>$rs['0']['st_procd_medc']
        );

        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Procedimento Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
         $dados = array(
            'cd_procd_medc'=>'',
            'nm_procd_medc'=>'',
//            'tp_sexo'=>'',
//            'vl_idade_min'=>'',
//            'vl_idade_max'=>'',
//            'vl_sh'=>'',
//            'vl_sa'=>'',
//            'vl_sp'=>'',
            'st_procd_medc'=>'',
        );

        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['dados'] = $dados;
        $json['msg'] = 'Erro: Código Procedimento não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomeProcedimento(){
    
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('cd_procd_medc'=>'Código','nm_procd_medc'=> 'Descrição');
    
    if(@$_POST['nm_procd_medc'] != ''){
        $nm_procd_medc = $_POST['nm_procd_medc'];
    }else{
        $nm_procd_medc = @$_POST['texto'];
    }

    if(@$_POST['st_procd_medc'] != ''){
        $st_procd_medc = $_POST['st_procd_medc'];
    }else{
        $st_procd_medc = @$_POST['filtro']['st_procd_medc'];
    }

    SMG_M0010::setnm_procd_medc($nm_procd_medc);
    SMG_M0010::setst_procd_medc($st_procd_medc);
    $rs = SMG_M0010::ConsultaProcedimento();

    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
