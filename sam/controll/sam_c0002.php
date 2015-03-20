<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'incluir':
            Incluir();
            break;
        default:
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Operação não Informada!';
            echo json_encode($json);
            exit;
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}


Function Incluir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $ValidaDados = ValidaDados();
    if($ValidaDados){
        
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_usuario = $_SESSION['cd_usuario_log'];
        $cd_cnes = '5208702659832';
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
        $cd_escola = $G_MEC->recebePost($_POST, 'cd_escola');
        $in_turno = $G_MEC->recebePost($_POST, 'in_turno');
        $in_diabetico = $G_MEC->recebePost($_POST, 'in_diabetico');
        $cd_conselho = $G_MEC->recebePost($_POST, 'cd_conselho');
        $nr_conselho = $G_MEC->recebePost($_POST, 'nr_conselho');
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
        $cd_espld_medc = $G_MEC->recebePost($_POST, 'cd_espld_medc');
        $cd_tp_grade = $G_MEC->recebePost($_POST, 'cd_tp_grade');
        $tp_atend = $G_MEC->recebePost($_POST, 'tp_atend');
        $st_fila = $G_MEC->recebePost($_POST, 'st_fila');
        $st_atend = $G_MEC->recebePost($_POST, 'st_atend');
        $dt_atend = $G_MEC->recebePost($_POST, 'dt_atend');
        $ds_hist_atual_doenca = $G_MEC->recebePost($_POST, 'ds_hist_atual_doenca');
        $ds_anteced = $G_MEC->recebePost($_POST, 'ds_anteced');
        $ds_ectoscopia = $G_MEC->recebePost($_POST, 'ds_ectoscopia');
        $in_av_sc_od = $G_MEC->recebePost($_POST, 'in_av_sc_od');
        $in_av_sc_oe = $G_MEC->recebePost($_POST, 'in_av_sc_oe');
        $in_oc_od = $G_MEC->recebePost($_POST, 'in_oc_od');
        $in_oc_oe = $G_MEC->recebePost($_POST, 'in_oc_oe');
        $in_rf_dn_od = $G_MEC->recebePost($_POST, 'in_rf_dn_od');
        $in_rf_dn_oe = $G_MEC->recebePost($_POST, 'in_rf_dn_oe');
        $ds_conduta = $G_MEC->recebePost($_POST, 'ds_conduta');

        SGA_M0007::setcd_empresa($cd_empresa);
        SGA_M0007::setcd_cnes($cd_cnes);
        SGA_M0007::setcd_prof($cd_prof);
        SGA_M0007::setcd_espld_medc($cd_espld_medc);
        SGA_M0007::setcd_pac($cd_pac);
        SGA_M0007::settp_atend($tp_atend);
        SGA_M0007::setdt_atend($G_MEC->FormataDataTiraBarraInverte($dt_atend));
        SGA_M0007::sethr_atend($G_MEC->HoraHoje());
        SGA_M0007::sethr_cheg($G_MEC->HoraHoje());
        SGA_M0007::setst_fila($st_fila);
        SGA_M0007::setst_atend($st_atend);
        SGA_M0007::setcd_usu_cad_fila($cd_usuario);
        SGA_M0007::setdt_usu_cad_fila($G_MEC->DataHoje());
        $G_MEC->TransacaoInicio();
        $rs = SGA_M0007::Incluir();
        if($rs !== false){
            $cd_fila = $rs;
            SGA_M0011::setcd_empresa($cd_empresa);
            SGA_M0011::setcd_fila($cd_fila);
            SGA_M0011::setcd_escola($cd_escola);
            SGA_M0011::setin_turno($in_turno);
            SGA_M0011::setin_diabetico($in_diabetico);
            SGA_M0011::setds_hist_atual_doenca($ds_hist_atual_doenca);
            SGA_M0011::setds_anteced($ds_anteced);
            SGA_M0011::setds_ectoscopia($ds_ectoscopia);
            SGA_M0011::setin_av_sc_od($in_av_sc_od);
            SGA_M0011::setin_av_sc_oe($in_av_sc_oe);
            SGA_M0011::setin_oc_od($in_oc_od);
            SGA_M0011::setin_oc_oe($in_oc_oe);
            SGA_M0011::setin_rf_dn_od($in_rf_dn_od);
            SGA_M0011::setin_rf_dn_oe($in_rf_dn_oe);
            SGA_M0011::setds_conduta($ds_conduta);
            SGA_M0011::setcd_usu_cad_fila_atend($cd_usuario);
            SGA_M0011::setdt_usu_cad_fila_atend($G_MEC->DataHoje());
            $rs_inc = SGA_M0011::incluir();
            if($rs_inc !== false){
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Sucesso: Registro Incluído com Sucesso!';
                echo json_encode($json);
                exit;
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Erro ao Inserir Registro!';
                echo json_encode($json);
                exit;
            }
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Erro ao Inserir Registro!';
            echo json_encode($json);
            exit;
        }
    }
}

Function ValidaDados(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'cd_escola')=== NULL || $G_MEC->recebePost($_POST, 'cd_escola')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Escola não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'in_turno')=== NULL || $G_MEC->recebePost($_POST, 'in_turno')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Turno não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'in_diabetico')=== NULL || $G_MEC->recebePost($_POST, 'in_diabetico')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Informação Diabético não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'cd_conselho')=== NULL || $G_MEC->recebePost($_POST, 'cd_conselho')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Conselho não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'nr_conselho')=== NULL || $G_MEC->recebePost($_POST, 'nr_conselho')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Número Conselho não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'cd_espld_medc')=== NULL || $G_MEC->recebePost($_POST, 'cd_espld_medc')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Especialidade não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'cd_tp_grade')=== NULL || $G_MEC->recebePost($_POST, 'cd_tp_grade')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Tipo Grade não Informado!';
        echo json_encode($json);
        return false;
    }
    
    if($G_MEC->recebePost($_POST, 'dt_atend')=== NULL || $G_MEC->recebePost($_POST, 'dt_atend')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Data Atendimento não Informado!';
        echo json_encode($json);
        return false;
    }
    return true;
}
?>
