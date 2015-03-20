<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'consultacodigogrupoconsulta':
            consultaCodigoGrupoConsulta();
            break;
        case 'consultanomegrupoconsulta':
            consultaNomeGrupoConsulta();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function consultaCodigoGrupoConsulta(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'cd_grp_consulta')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Grupo Consulta não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
    }
    
    if($G_MEC->recebePost($_POST, 'st_grp_consulta')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Grupo Consulta não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');
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
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setcd_grp_consulta($cd_grp_consulta);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    $rs = SGA_M0001::ConsultaGrupoConsulta();
    if(count($rs)>0){
        $dados = array(
            'cd_grp_consulta'=>$rs['0']['cd_grp_consulta'],
            'nm_grp_consulta'=>$rs['0']['nm_grp_consulta'],
            'st_grp_consulta'=>$rs['0']['st_grp_consulta']
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
            'cd_grp_consulta'=>'',
            'nm_grp_consulta'=>'',
            'st_grp_consulta'=>'',
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

function consultaNomeGrupoConsulta(){
    
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('cd_grp_consulta'=>'Código','nm_grp_consulta'=> 'Descrição');
    
    if(@$_POST['nm_procd_medc'] != ''){
        $nm_grp_consulta = $_POST['nm_grp_consulta'];
    }else{
        $nm_grp_consulta = @$_POST['texto'];
    }

    if(@$_POST['st_grp_consulta'] != ''){
        $st_grp_consulta = $_POST['st_grp_consulta'];
    }else{
        $st_grp_consulta = @$_POST['filtro']['st_grp_consulta'];
    }

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setnm_grp_consulta($nm_grp_consulta);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    $rs = SGA_M0001::ConsultaGrupoConsulta();

    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
