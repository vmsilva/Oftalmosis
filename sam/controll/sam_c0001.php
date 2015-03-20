<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'consultacodigoescola':
            consultaCodigoEscola();
            break;
        case 'consultanomeescola':
            consultaNomeEscola();
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

Function consultaCodigoEscola(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    if($G_MEC->recebePost($_POST, 'cd_escola')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Escola não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_escola = $G_MEC->recebePost($_POST, 'cd_escola');
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
    
    SAM_M0001::setcd_escola($cd_escola);
    $rs = SAM_M0001::consultaCodigo();
    if(count($rs)>0){
        if($form === 'sam_h0001'){
            $dados = array(
                'cd_escola'=>$rs['0']['cd_escola'],
                'nm_escola'=>$rs['0']['nm_escola'],
                'nm_resp_esc'=>$rs['0']['nm_resp_esc'],
                'cd_munic_esc'=>$rs['0']['cd_munic_esc'],
                'nm_munic'=>$rs['0']['nm_munic'],
                'sg_uf'=>$rs['0']['sg_uf'],
                'nm_bairro_esc'=>$rs['0']['nm_bairro_esc'],
                'ds_logr_esc'=>$rs['0']['ds_logr_esc'],
                'ds_compl_esc'=>$rs['0']['ds_compl_esc'],
                'ds_qd_esc'=>$rs['0']['ds_qd_esc'],
                'ds_lt_esc'=>$rs['0']['ds_lt_esc'],
                'nr_end_esc'=>$rs['0']['nr_end_esc'],
                'nr_cep_esc'=>$rs['0']['nr_cep_esc'],
                'nr_fone_01'=>$rs['0']['nr_fone_01'],
                'nr_fone_02'=>$rs['0']['nr_fone_02'],
                'nr_fone_03'=>$rs['0']['nr_fone_03'],
                'st_escola'=>$rs['0']['st_escola'],
                'ds_email_esc'=>$rs['0']['ds_email_esc'],
                'cd_usu_cad_esc'=>$rs['0']['cd_usu_cad_esc'],
                'dt_usu_cad_esc'=>$rs['0']['dt_usu_cad_esc'],
                'cd_usu_alt_esc'=>$rs['0']['cd_usu_alt_esc'],
                'dt_usu_alt_esc'=>$rs['0']['dt_usu_alt_esc']
            );
        }else{
            $dados = array(
                'cd_escola'=>$rs['0']['cd_escola'],
                'nm_escola'=>$rs['0']['nm_escola']
            );
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Escola Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Escola não Localizada!';
        echo json_encode($json);
        exit;
    }
}

Function consultaNomeEscola(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if(@$_POST['nm_escola'] != ''){
        $nm_escola = $_POST['nm_escola'];
    }else{
        $nm_escola = @$_POST['texto'];
    }
    
    $G_MEC = new Mecanismo();
    
    SAM_M0001::setnm_escola($nm_escola);
    $rs = SAM_M0001::consultaNome();
    $Render = new renderView();
    
    $headers = array('cd_escola'=> 'Código', 'nm_escola'=>'Escola');
    
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}

Function Incluir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_escola = $G_MEC->recebePost($_POST, 'cd_escola');
        $nm_escola = $G_MEC->recebePost($_POST, 'nm_escola');
        $nm_resp_esc = $G_MEC->recebePost($_POST, 'nm_resp_esc');
        $cd_munic_esc = $G_MEC->recebePost($_POST, 'cd_munic_esc');
        $nm_bairro_esc = $G_MEC->recebePost($_POST, 'nm_bairro_esc');
        $ds_logr_esc = $G_MEC->recebePost($_POST, 'ds_logr_esc');
        $ds_compl_esc = $G_MEC->recebePost($_POST, 'ds_compl_esc');
        $ds_qd_esc = $G_MEC->recebePost($_POST, 'ds_qd_esc');
        $ds_lt_esc = $G_MEC->recebePost($_POST, 'ds_lt_esc');
        $nr_end_esc = $G_MEC->recebePost($_POST, 'nr_end_esc');
        $nr_cep_esc = $G_MEC->recebePost($_POST, 'nr_cep_esc');
        $nr_fone_01 = $G_MEC->recebePost($_POST, 'nr_fone_01');
        $nr_fone_02 = $G_MEC->recebePost($_POST, 'nr_fone_02');
        $nr_fone_03 = $G_MEC->recebePost($_POST, 'nr_fone_03');
        $st_escola = 0;
        $ds_email_esc = $G_MEC->recebePost($_POST, 'ds_email_esc');

        SAM_M0001::setcd_escola($cd_escola);
        SAM_M0001::setnm_escola($nm_escola);
        SAM_M0001::setnm_resp_esc($nm_resp_esc);
        SAM_M0001::setcd_munic_esc($cd_munic_esc);
        SAM_M0001::setnm_bairro_esc($nm_bairro_esc);
        SAM_M0001::setds_logr_esc($ds_logr_esc);
        SAM_M0001::setds_compl_esc($ds_compl_esc);
        SAM_M0001::setds_qd_esc($ds_qd_esc);
        SAM_M0001::setds_lt_esc($ds_lt_esc);
        SAM_M0001::setnr_end_esc($nr_end_esc);
        SAM_M0001::setnr_cep_esc($nr_cep_esc);
        SAM_M0001::setnr_fone_01($nr_fone_01);
        SAM_M0001::setnr_fone_02($nr_fone_02);
        SAM_M0001::setnr_fone_03($nr_fone_03);
        SAM_M0001::setst_escola($st_escola);
        SAM_M0001::setds_email_esc($ds_email_esc);
        $cd_usu_cad_esc = $_SESSION['cd_usuario_log'];
        SAM_M0001::setcd_usu_cad_esc($cd_usu_cad_esc);
        SAM_M0001::setdt_usu_cad_esc($G_MEC->DataHoje());
        if(count(SAM_M0001::consultaNome())<=0){
            $rs = SAM_M0001::Incluir();
            if($rs !== false){
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $dados = array(
                    'cd_escola' => $rs
                );
                $json['dados'] = $dados;
                $json['msg'] = 'Sucesso: Registro Incluído com Sucesso!';
                echo json_encode($json);
                exit;
            }else{
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Erro ao Inserir Registro!';
                echo json_encode($json);
                exit;
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Registro já existente na tabela!';
            echo json_encode($json);
            exit;
        }
    }
}

Function Alterar(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_escola = $G_MEC->recebePost($_POST, 'cd_escola');
        $nm_escola = $G_MEC->recebePost($_POST, 'nm_escola');
        $nm_resp_esc = $G_MEC->recebePost($_POST, 'nm_resp_esc');
        $cd_munic_esc = $G_MEC->recebePost($_POST, 'cd_munic_esc');
        $nm_bairro_esc = $G_MEC->recebePost($_POST, 'nm_bairro_esc');
        $ds_logr_esc = $G_MEC->recebePost($_POST, 'ds_logr_esc');
        $ds_compl_esc = $G_MEC->recebePost($_POST, 'ds_compl_esc');
        $ds_qd_esc = $G_MEC->recebePost($_POST, 'ds_qd_esc');
        $ds_lt_esc = $G_MEC->recebePost($_POST, 'ds_lt_esc');
        $nr_end_esc = $G_MEC->recebePost($_POST, 'nr_end_esc');
        $nr_cep_esc = $G_MEC->recebePost($_POST, 'nr_cep_esc');
        $nr_fone_01 = $G_MEC->recebePost($_POST, 'nr_fone_01');
        $nr_fone_02 = $G_MEC->recebePost($_POST, 'nr_fone_02');
        $nr_fone_03 = $G_MEC->recebePost($_POST, 'nr_fone_03');
        $st_escola = 0;
        $ds_email_esc = $G_MEC->recebePost($_POST, 'ds_email_esc');
        
        SAM_M0001::setcd_escola($cd_escola);
        SAM_M0001::setnm_escola($nm_escola);
        SAM_M0001::setnm_resp_esc($nm_resp_esc);
        SAM_M0001::setcd_munic_esc($cd_munic_esc);
        SAM_M0001::setnm_bairro_esc($nm_bairro_esc);
        SAM_M0001::setds_logr_esc($ds_logr_esc);
        SAM_M0001::setds_compl_esc($ds_compl_esc);
        SAM_M0001::setds_qd_esc($ds_qd_esc);
        SAM_M0001::setds_lt_esc($ds_lt_esc);
        SAM_M0001::setnr_end_esc($nr_end_esc);
        SAM_M0001::setnr_cep_esc($nr_cep_esc);
        SAM_M0001::setnr_fone_01($nr_fone_01);
        SAM_M0001::setnr_fone_02($nr_fone_02);
        SAM_M0001::setnr_fone_03($nr_fone_03);
        SAM_M0001::setst_escola($st_escola);
        SAM_M0001::setds_email_esc($ds_email_esc);
        $cd_usu_cad_esc = $_SESSION['cd_usuario_log'];
        SAM_M0001::setcd_usu_cad_esc($cd_usu_cad_esc);
        SAM_M0001::setdt_usu_cad_esc($G_MEC->DataHoje());
        if(count(SAM_M0001::consultaNome())<=0){
            $rs = SAM_M0001::Alterar();
            if($rs !== false){
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $dados = array(
                    'cd_escola' => $rs
                );
                $json['dados'] = $dados;
                $json['msg'] = 'Sucesso: Registro Incluído com Sucesso!';
                echo json_encode($json);
                exit;
            }else{
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Erro ao Inserir Registro!';
                echo json_encode($json);
                exit;
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Registro já existente na tabela!';
            echo json_encode($json);
            exit;
        }
    }
}
Function Excluir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_escola = $G_MEC->recebePost($_POST, 'cd_escola');
        SAM_M0001::setcd_escola($cd_escola);
        $rs = SAM_M0001::Excluir();
        if($rs !== false){
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Sucesso: Registro Incluído com Sucesso!';
            echo json_encode($json);
            exit;
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Erro ao Inserir Registro!';
            echo json_encode($json);
            exit;
        }
    }
}

function ValidaDados(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_escola')=== NULL || $G_MEC->recebePost($_POST, 'cd_escola')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Escola não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'nm_escola')=== NULL || $G_MEC->recebePost($_POST, 'nm_escola')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Escola não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'nm_resp_esc')=== NULL || $G_MEC->recebePost($_POST, 'nm_resp_esc')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Responsável não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'cd_munic_esc')=== NULL || $G_MEC->recebePost($_POST, 'cd_munic_esc')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Código Município Escola não Informado!';
            echo json_encode($json);
            return false;
    }
    if($G_MEC->recebePost($_POST, 'sg_uf')=== NULL || $G_MEC->recebePost($_POST, 'sg_uf')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Unidade Federativa Município Escola não Informado!';
            echo json_encode($json);
            return false;
    }
    
    if($G_MEC->recebePost($_POST, 'nm_munic')=== NULL || $G_MEC->recebePost($_POST, 'nm_munic')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Nome Município Escola não Informado!';
            echo json_encode($json);
            return false;
    }

    if($G_MEC->recebePost($_POST, 'nr_fone_01')=== NULL || $G_MEC->recebePost($_POST, 'nr_fone_01')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número de Telefone não Informado!';
            echo json_encode($json);
            return false;
    }
    
    return true;
}

?>