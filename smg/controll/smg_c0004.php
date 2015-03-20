<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultanomeprofissional':
            ConsultaNomeProfissional();
            break;
        case 'consultaprofissionalcpf':
            ConsultaProfissionalCPF();
            break;
        case 'incluir':
            Incluir();
            break;
        case 'alterar':
            Alterar();
            break;
        case 'excluir':
            Excluir();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConsultaNomeProfissional(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $nm_campo_busca =  @$_POST['nm_campo_busca'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if(@$_POST['nm_prof'] != ''){
        $nm_prof = $_POST['nm_prof'];
    }else{
        $nm_prof = @$_POST['texto'];
    }


    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('nr_cpf_prof'=>'CPF','nm_prof'=> 'Profissional');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SMG_M0004::setnm_prof($nm_prof);
    $rs = SMG_M0004::ConsultaNome();
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_prof'] = $value['cd_prof'];
            $dados[$key]['nm_prof'] = $value['nm_prof'];
            $dados[$key]['nr_cpf_prof'] = $G_MEC->Formata_Fone_CEP_CPF_CNPJ($value['nr_cpf_prof'], 'CPF') ;
        }
    }else{
        $dados[0]['nr_cpf_prof'] = '';
        $dados[0]['nm_prof'] = '';
    }
   
    echo $Render->renderGrid($dados, $headers, $inputBusca, $url, $opr);
}

Function ConsultaProfissionalCPF(){
    
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
    
    if($G_MEC->recebePost($_POST, 'nr_cpf_prof')=== NULL || $G_MEC->recebePost($_POST, 'nr_cpf_prof')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número CPF Profissional não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'st_prof')=== NULL || $G_MEC->recebePost($_POST, 'st_prof')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Profissional não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $nr_cpf_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST,'nr_cpf_prof'));
    $st_prof = $G_MEC->recebePost($_POST,'st_prof');
    
    SMG_M0004::setnr_cpf_prof($nr_cpf_prof);
    SMG_M0004::setst_prof($st_prof);
    $rs = SMG_M0004::ConsultaProfissionalCPF();
    if(count($rs)>0){
        $dados['cd_prof'] = $rs[0]['cd_prof'];
        $dados['nm_prof'] = $rs[0]['nm_prof'];
        $dados['nr_cns_prof'] = $rs[0]['nr_cns_prof'];
        $dados['nr_cpf_prof'] = $G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs[0]['nr_cpf_prof'], 'CPF') ;
        if(strtolower(trim($form)) == 'smg_h0004' || strtolower(trim($form)) == 'sca_h0002'){
            $dados['nm_mae_prof'] = $rs[0]['nm_mae_prof'];
            $dados['tp_sexo_prof'] = $rs[0]['tp_sexo_prof'];
            $dados['dt_nasc_prof'] = $G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_prof']);
            $dados['cd_munic_nasc_prof'] = $rs[0]['cd_munic_nasc_prof'];    
            $dados['nr_fone_prof'] = $G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs[0]['nr_fone_prof'],'Fone');
            $dados['cd_pais_orig_prof'] = $rs[0]['cd_pais_orig_prof'];
            $dados['cd_munic_end_prof'] = $rs[0]['cd_munic_end_prof'];
            $dados['cd_bairro_end_prof'] = $rs[0]['cd_bairro_end_prof'];
            $dados['nm_bairro_end_prof'] = $rs[0]['nm_bairro_end_prof'];
            $dados['ds_logr_end_prof'] = $rs[0]['ds_logr_end_prof'];
            $dados['ds_compl_end_prof'] = $rs[0]['ds_compl_end_prof'];
            $dados['ds_qd_end_prof'] = $rs[0]['ds_qd_end_prof'];
            $dados['ds_lt_end_prof'] = $rs[0]['ds_lt_end_prof'];
            $dados['nr_end_prof'] = $rs[0]['nr_end_prof'];
            $dados['nr_cep_end_prof'] = $G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs[0]['nr_cep_end_prof'],'CEP');
            $dados['st_prof'] = $rs[0]['st_prof'];
            $dados['ds_email_prof'] = $rs[0]['ds_email_prof'];
            $dados['cd_usu_cad_end_prof'] = $rs[0]['cd_usu_cad_end_prof'];
            $dados['dt_usu_cad_end_prof'] = $rs[0]['dt_usu_cad_end_prof'];
            $dados['cd_usu_alt_end_prof'] = $rs[0]['cd_usu_alt_end_prof'];
            $dados['dt_usu_alt_end_prof'] = $rs[0]['dt_usu_alt_end_prof'];    
        }
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: CPF Profissional Localizado com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode(array('dados'=>$json));
        exit();
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: CPF Profissional não Localizado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
}
Function Incluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        $form = $G_MEC->recebePost($_POST, 'form');
        
        //Verificar se CPF Existe;
        $nr_cpf_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_cpf_prof', NULL));
        SMG_M0004::setnr_cpf_prof($nr_cpf_prof);
        $st_prof = '0|1';
        SMG_M0004::setst_prof($st_prof);
        $rs = SMG_M0004::ConsultaProfissionalCPF();
        if(count($rs)>0){
           $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: CPF Profissional já Cadastrado Localizado!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
        //Verificar se CNS Existe;

        $nm_prof = $G_MEC->recebePost($_POST, 'nm_prof', NULL);
        SMG_M0004::setnm_prof($nm_prof);
        $nm_mae_prof = $G_MEC->recebePost($_POST, 'nm_mae_prof', NULL);
        SMG_M0004::setnm_mae_prof($nm_mae_prof);
        $tp_sexo_prof = $G_MEC->recebePost($_POST, 'tp_sexo_prof', NULL);
        SMG_M0004::settp_sexo_prof($tp_sexo_prof);
        $dt_nasc_prof = $G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_nasc_prof', NULL));
        SMG_M0004::setdt_nasc_prof($dt_nasc_prof);
        $cd_munic_nasc_prof = $G_MEC->recebePost($_POST, 'cd_munic_nasc_prof', NULL);
        SMG_M0004::setcd_munic_nasc_prof($cd_munic_nasc_prof);
        $nr_cns_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_cns_prof', NULL));
        SMG_M0004::setnr_cns_prof($nr_cns_prof);
        
        $nr_fone_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_fone_prof', NULL));
        SMG_M0004::setnr_fone_prof($nr_fone_prof);
        $cd_pais_orig_prof = $G_MEC->recebePost($_POST, 'cd_pais_orig_prof', NULL);
        SMG_M0004::setcd_pais_orig_prof($cd_pais_orig_prof);
        $cd_munic_end_prof = $G_MEC->recebePost($_POST, 'cd_munic_end_prof', NULL);
        SMG_M0004::setcd_munic_end_prof($cd_munic_end_prof);
        $nm_bairro_end_prof = $G_MEC->recebePost($_POST, 'nm_bairro_end_prof', NULL);
        SMG_M0004::setnm_bairro_end_prof($nm_bairro_end_prof);
        $ds_logr_end_prof = $G_MEC->recebePost($_POST, 'ds_logr_end_prof', NULL);
        SMG_M0004::setds_logr_end_prof($ds_logr_end_prof);
        $ds_compl_end_prof = $G_MEC->recebePost($_POST, 'ds_compl_end_prof', NULL);
        SMG_M0004::setds_compl_end_prof($ds_compl_end_prof);
        $ds_qd_end_prof = $G_MEC->recebePost($_POST, 'ds_qd_end_prof', NULL);
        SMG_M0004::setds_qd_end_prof($ds_qd_end_prof);
        $ds_lt_end_prof = $G_MEC->recebePost($_POST, 'ds_lt_end_prof', NULL);
        SMG_M0004::setds_lt_end_prof($ds_lt_end_prof);
        $nr_end_prof = $G_MEC->recebePost($_POST, 'nr_end_prof', NULL);
        SMG_M0004::setnr_end_prof($nr_end_prof);
        $nr_cep_end_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_cep_end_prof', NULL));
        SMG_M0004::setnr_cep_end_prof($nr_cep_end_prof);
        $st_prof = $G_MEC->recebePost($_POST, 'st_prof', NULL);
        SMG_M0004::setst_prof($st_prof);
        $cd_usu_cad_end_prof = $_SESSION['cd_usuario_log'];
        SMG_M0004::setcd_usu_cad_end_prof($cd_usu_cad_end_prof);
        
        $dt_usu_cad_end_prof = $G_MEC->DataHoje();
        SMG_M0004::setdt_usu_cad_end_prof($dt_usu_cad_end_prof);
        
        $ds_email_prof = $G_MEC->recebePost($_POST, 'ds_email_prof', NULL);
        SMG_M0004::setds_email_prof($ds_email_prof);
        $rs = SMG_M0004::Incluir();
        if($rs['sinal']==1){
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Profissional Incluído com Sucesso!';
            $json['dados'] = array('cd_prof'=>$rs['cd_prof']);
            echo json_encode(array('dados'=>$json));
        }else{
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Inserir Profissional!';
            echo json_encode(array('dados'=>$json));
        }
    }
}

Function Alterar(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_prof= $G_MEC->recebePost($_POST, 'cd_prof');
        SMG_M0004::setcd_prof($cd_prof);
        
        $cd_munic_nasc_prof = $G_MEC->recebePost($_POST, 'cd_munic_nasc_prof', NULL);
        SMG_M0004::setcd_munic_nasc_prof($cd_munic_nasc_prof);
        $nr_cns_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_cns_prof', NULL));
        SMG_M0004::setnr_cns_prof($nr_cns_prof);
        
        $nr_fone_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_fone_prof', NULL));
        SMG_M0004::setnr_fone_prof($nr_fone_prof);
        $cd_munic_end_prof = $G_MEC->recebePost($_POST, 'cd_munic_end_prof', NULL);
        SMG_M0004::setcd_munic_end_prof($cd_munic_end_prof);
        $nm_bairro_end_prof = $G_MEC->recebePost($_POST, 'nm_bairro_end_prof', NULL);
        SMG_M0004::setnm_bairro_end_prof($nm_bairro_end_prof);
        $ds_logr_end_prof = $G_MEC->recebePost($_POST, 'ds_logr_end_prof', NULL);
        SMG_M0004::setds_logr_end_prof($ds_logr_end_prof);
        $ds_compl_end_prof = $G_MEC->recebePost($_POST, 'ds_compl_end_prof', NULL);
        SMG_M0004::setds_compl_end_prof($ds_compl_end_prof);
        $ds_qd_end_prof = $G_MEC->recebePost($_POST, 'ds_qd_end_prof', NULL);
        SMG_M0004::setds_qd_end_prof($ds_qd_end_prof);
        $ds_lt_end_prof = $G_MEC->recebePost($_POST, 'ds_lt_end_prof', NULL);
        SMG_M0004::setds_lt_end_prof($ds_lt_end_prof);
        $nr_end_prof = $G_MEC->recebePost($_POST, 'nr_end_prof', NULL);
        SMG_M0004::setnr_end_prof($nr_end_prof);
        $nr_cep_end_prof = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST, 'nr_cep_end_prof', NULL));
        SMG_M0004::setnr_cep_end_prof($nr_cep_end_prof);
        $st_prof = $G_MEC->recebePost($_POST, 'st_prof', NULL);
        SMG_M0004::setst_prof($st_prof);
        $cd_usu_alt_end_prof = $_SESSION['cd_usuario_log'];
        SMG_M0004::setcd_usu_alt_end_prof($cd_usu_alt_end_prof);
        $dt_usu_alt_end_prof = $G_MEC->DataHoje();
        SMG_M0004::setdt_usu_alt_end_prof($dt_usu_alt_end_prof);
        
        $ds_email_prof = $G_MEC->recebePost($_POST, 'ds_email_prof', NULL);
        SMG_M0004::setds_email_prof($ds_email_prof);
        
        if(SMG_M0004::Alterar()){
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Profissional Alterado com Sucesso!';
            echo json_encode(array('dados'=>$json));
        }else{
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Alterar Profissional!';
            echo json_encode(array('dados'=>$json));
        }
    }
}

Function Excluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $form = $G_MEC->recebePost($_POST, 'form');
    
    if ($G_MEC->recebePost($_POST, 'cd_prof') == NULL || $G_MEC->recebePost($_POST, 'cd_prof') == '') {
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Código Profissional não Informado!';
        echo json_encode($json);
        return false;
        exit;
    }
    $cd_prof= $G_MEC->recebePost($_POST, 'cd_prof');

    SMG_M0004::setcd_prof($cd_prof);

    if(SMG_M0004::Excluir()){
        $json['ret'] = 'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Profissional Excluído com Sucesso!';
        echo json_encode(array('dados'=>$json));
    }else{
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Falha ao Excluir Profissional!';
        echo json_encode(array('dados'=>$json));
    }
    
}

Function ValidaDados(){
    
    $G_MEC = new Mecanismo();
  
    if ($G_MEC->recebePost($_POST, 'form') == NULL || $G_MEC->recebePost($_POST, 'form') === '') {
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
        exit;
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if(strtolower($G_MEC->recebePost($_POST, 'opr')) != 'incluir'){
        if ($G_MEC->recebePost($_POST, 'cd_prof') == NULL || $G_MEC->recebePost($_POST, 'cd_prof') == '') {
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Código Profissional não Informado!';
            echo json_encode($json);
            return false;
            exit;
        }
    }else{
        if ($G_MEC->recebePost($_POST, 'nr_cpf_prof') == NULL || $G_MEC->recebePost($_POST, 'nr_cpf_prof') == '') {
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Número CPF Profissional não Informado!';
            echo json_encode($json);
            return false;
            exit;
        }

        if ($G_MEC->recebePost($_POST, 'nm_prof') == NULL || $G_MEC->recebePost($_POST, 'nm_prof') == '') {
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Nome Profissional não Informado!';
            echo json_encode($json);
            return false;
            exit;
        }

        if ($G_MEC->recebePost($_POST, 'tp_sexo_prof') == NULL || $G_MEC->recebePost($_POST, 'tp_sexo_prof') == '') {
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Sexo Profissional não Informado!';
            echo json_encode($json);
            return false;
            exit;
        }

        if ($G_MEC->recebePost($_POST, 'dt_nasc_prof') == NULL || $G_MEC->recebePost($_POST, 'dt_nasc_prof') == '') {
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Data de Nascimento Profissional não Informado!';
            echo json_encode($json);
            return false;
            exit;
        }

        if ($G_MEC->recebePost($_POST, 'cd_pais_orig_prof') == NULL || $G_MEC->recebePost($_POST, 'cd_pais_orig_prof') == '') {
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: País de Origem Profissional não Informado!';
            echo json_encode($json);
            return false;
            exit;
        }
    }
    
    
    if ($G_MEC->recebePost($_POST, 'st_prof') == NULL || $G_MEC->recebePost($_POST, 'st_prof') == '') {
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Status Profissional não Informado!';
        echo json_encode($json);
        return false;
        exit;
    }
    
    
    
    if ($G_MEC->recebePost($_POST, 'cd_munic_nasc_prof') == NULL || $G_MEC->recebePost($_POST, 'cd_munic_nasc_prof') == '') {
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Município de Nascimento Profissional não Informado!';
        echo json_encode($json);
        return false;
        exit;
    }
    
    if ($G_MEC->recebePost($_POST, 'cd_munic_end_prof') == NULL || $G_MEC->recebePost($_POST, 'cd_munic_end_prof') == '') {
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro:  Município de Residência Profissional não Informado!';
        echo json_encode($json);
        return false;
        exit;
    }

    return true;
}
?>
