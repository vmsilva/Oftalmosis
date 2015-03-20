<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'incluir':
            incluir();
            break;
        case 'excluir':
            excluir();
            break;
        case 'consultasolicitacaoaberturaprontuario':
            consultaSolicitacaoAberturaProntuario();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function validaDados(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }
    
    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'nm_pac')=== NULL || $G_MEC->recebePost($_POST, 'nm_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'tp_sexo_pac')=== NULL || $G_MEC->recebePost($_POST, 'tp_sexo_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Sexo Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'dt_nasc_pac')=== NULL || $G_MEC->recebePost($_POST, 'dt_nasc_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Data Nascimento Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'nm_mae_pac')=== NULL || $G_MEC->recebePost($_POST, 'nm_mae_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Mãe Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'nr_cns_pac')=== NULL || $G_MEC->recebePost($_POST, 'nr_cns_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Cartão SUS Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

    return true;
}

Function Incluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        
        $form = $G_MEC->recebePost($_POST, 'form');
        //Verificar se já Existe Solicitação
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        SCP_M0003::setcd_empresa($cd_empresa);
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
        SCP_M0003::setcd_pac($cd_pac);
        $rs_aux = SCP_M0003::consultaPacienteSolicitacao();
        if(count($rs_aux) < 1){
            $cd_usu_solic = $_SESSION['cd_usuario_log'];
            SCP_M0003::setcd_usu_solic($cd_usu_solic);
            SCP_M0003::setdt_solic($G_MEC->DataHoje());
            SCP_M0003::sethr_solic($G_MEC->HoraHoje());
            $rs = SCP_M0003::Incluir();
            if($rs === true){
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Sucesso: Paciente Incluído com Sucesso!';
                echo json_encode($json);
            }else{
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Erro ao Inserir Paciente na Fila de Solicitação!';
                echo json_encode($json);
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Paciente já Possui Solicitação!';
            echo json_encode($json);
        }
    }
}

Function Excluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        return false;
    }

   
    $form = $G_MEC->recebePost($_POST, 'form');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0003::setcd_empresa($cd_empresa);
    $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    SCP_M0003::setcd_pac($cd_pac);
        
    $rs = SCP_M0003::Excluir();
    if($rs === true){
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Sucesso: Paciente Excluído com Sucesso!';
        echo json_encode($json);
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Erro ao Excluir Paciente na Fila de Solicitação!';
        echo json_encode($json);
    }
}

Function consultaSolicitacaoAberturaProntuario(){

    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    $Render = new renderView();
    $headers = array('nr_cns_pac'=>'CNS','nm_pac'=> 'Paciente','tp_sexo_pac'=> 'Sexo','dt_nasc_pac'=> 'Dt.Nasc.','nm_mae_pac'=> 'Mãe','dt_solic'=>'Dt.Solic.','hr_solic'=>'Hr.Solic.','nm_usuario'=>'Solicitante');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0003::setcd_empresa($cd_empresa);
    
    $rs = SCP_M0003::listaSolicitacaoAberturaProntuario();
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
?>