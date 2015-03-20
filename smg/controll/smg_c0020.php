<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch ($_POST['opr']) {
        case 'alterarPaciente':
            alterarPaciente();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}


function alterarPaciente(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(trim($G_MEC->recebePost($_POST, 'cd_pac')) === ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Paciente não Informado!';
            echo json_encode($json);
            return false;
    }else{
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    }
    
    if(trim($G_MEC->recebePost($_POST, 'nm_pac')) === ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Nome Paciente não Informado!';
            echo json_encode($json);
            return false;
    }else{
        $nm_pac = $G_MEC->recebePost($_POST, 'nm_pac');
    }
    
    if(trim($G_MEC->recebePost($_POST, 'tp_sexo_pac')) === ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Sexo Paciente não Informado!';
            echo json_encode($json);
            return false;
    }else{
        $tp_sexo_pac = $G_MEC->recebePost($_POST, 'tp_sexo_pac');
    }
    
    if($G_MEC->recebePost($_POST, 'dt_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'dt_nasc_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Data Nascimento Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        if(!$G_MEC->ValidaData($G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_nasc_pac')))){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Data Nascimento Paciente Inválido!';
            echo json_encode($json);
            return false;
        }else{
            $dataPaciente = $G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_nasc_pac'));
            $dataHoje = $G_MEC->DataHoje();
            if($G_MEC->FormataDataVerificaMaior($dataPaciente, $dataHoje)){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Data Nascimento não pode Ser maior que data Hoje!';
                echo json_encode($json);
                return false;
            }
        }
    }
    
    $dt_nasc_pac = $G_MEC->recebePost($_POST, 'dt_nasc_pac');
    
    if($G_MEC->recebePost($_POST, 'cd_pais_orig_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'cd_pais_orig_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código País de Origem Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $cd_pais_orig_pac = $G_MEC->recebePost($_POST, 'cd_pais_orig_pac');
    }
    if($G_MEC->recebePost($_POST, 'nm_pais_orig_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_pais_orig_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome País de Origem Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $nm_pais_orig_pac = $G_MEC->recebePost($_POST, 'nm_pais_orig_pac');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_munic_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'cd_munic_nasc_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Município Nascimento Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $cd_munic_nasc_pac = $G_MEC->recebePost($_POST, 'cd_munic_nasc_pac');
    }
    
    if($G_MEC->recebePost($_POST, 'sg_uf_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'sg_uf_nasc_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Sigla UF Nascimento Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $sg_uf_nasc_pac = $G_MEC->recebePost($_POST, 'sg_uf_nasc_pac');
    }
    
    if($G_MEC->recebePost($_POST, 'nm_munic_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_munic_nasc_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Município Nascimento Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $nm_munic_nasc_pac = $G_MEC->recebePost($_POST, 'nm_munic_nasc_pac');
    }
    
    if($G_MEC->recebePost($_POST, 'nm_mae_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_mae_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Mãe Paciente não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $nm_mae_pac = $G_MEC->recebePost($_POST, 'nm_mae_pac');
    }
    SMG_M0014::setcd_pac($cd_pac);
    $st_pac = 0;
    SMG_M0014::setst_pac($st_pac);
    $rs = SMG_M0014::consultaCodigo();
    if(count($rs)>0){
        Mecanismo::TransacaoInicio();
        SMG_M0020::setcd_pac($cd_pac);
        SMG_M0020::setnm_pac($rs[0]['nm_pac']);
        SMG_M0020::settp_sexo_pac($tp_sexo_pac);
        SMG_M0020::setdt_nasc_pac($G_MEC->FormataDataTiraBarraInverte($dt_nasc_pac));
        SMG_M0020::setcd_pais_orig_pac($cd_pais_orig_pac);
        SMG_M0020::setcd_munic_nasc_pac($cd_munic_nasc_pac);
        SMG_M0020::setnm_mae_pac($nm_mae_pac);
        $cd_munic_nasc_mae_pac = $G_MEC->recebePost($_POST, 'cd_munic_nasc_mae_pac');
        if(trim($cd_munic_nasc_mae_pac) !== '')
        SMG_M0020::setcd_munic_nasc_mae_pac($cd_munic_nasc_mae_pac);
        SMG_M0020::setcd_usu_alt_pac($_SESSION['cd_usuario_log']);
        SMG_M0020::setdt_usu_alt_pac($G_MEC->DataHoje());
        SMG_M0020::sethr_usu_alt_pac($G_MEC->HoraHoje());
        if(SMG_M0020::Incluir()){
            SMG_M0014::setcd_pac($cd_pac);
            SMG_M0014::setnm_pac($nm_pac);
            SMG_M0014::setdt_nasc_pac($G_MEC->FormataDataTiraBarraInverte($dt_nasc_pac));
            SMG_M0014::settp_sexo_pac($tp_sexo_pac);
            SMG_M0014::setcd_pais_orig_pac($cd_pais_orig_pac);
            SMG_M0014::setcd_munic_nasc_pac($cd_munic_nasc_pac);
            SMG_M0014::setnm_mae_pac($nm_mae_pac);
            $cd_munic_nasc_mae_pac = $G_MEC->recebePost($_POST, 'cd_munic_nasc_mae_pac');
            if(trim($cd_munic_nasc_mae_pac) !== '')
                SMG_M0014::setcd_munic_nasc_mae_pac($G_MEC->recebePost($_POST, 'cd_munic_nasc_mae_pac'));
            if(SMG_M0014::AlterarPaciente()){
                Mecanismo::TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Registro Alterado com Sucesso!';
                echo json_encode($json);
                exit;
            }else{
                Mecanismo::TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao Alterar Dados Paciente!';
                echo json_encode($json);
                exit;
            }
        }else{
            Mecanismo::TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Falha Inclusão de Log!';
            echo json_encode($json);
            exit;
        }
    }

}
?>
