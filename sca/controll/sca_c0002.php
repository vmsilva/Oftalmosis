<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultamatricula':
            consultaMatricula();
            break;
        case 'consultacpfusuario':
            ConsultaCPFUsuario();
            break;
        case 'consultanomeusuario':
            ConsultaNomeUsuario();
            break;
        case 'incluir':
            Incluir();
            break;
        case 'alterar':
            Alterar();
            break;
        case 'gerarsenha':
            GerarSenha();
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

function consultaMatricula(){
    
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
    
    if($G_MEC->recebePost($_POST, 'nr_matr_usu')=== NULL || $G_MEC->recebePost($_POST, 'nr_matr_usu')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Matrícula Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'st_usuario')=== NULL || $G_MEC->recebePost($_POST, 'st_usuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $nr_matr_usu = substr($G_MEC->recebePost($_POST, 'nr_matr_usu'),0,  strlen($G_MEC->recebePost($_POST, 'nr_matr_usu'))-1);
    $dg_matr_usu = substr($G_MEC->recebePost($_POST, 'nr_matr_usu'),strlen($G_MEC->recebePost($_POST, 'nr_matr_usu'))-1,1);
    $st_usuario =  $G_MEC->recebePost($_POST, 'st_usuario');
    
    SCA_M0002::setcd_empresa($cd_empresa);
    SCA_M0002::setnr_matr_usu($nr_matr_usu);
    SCA_M0002::setdg_matr_usu($dg_matr_usu);
    SCA_M0002::setst_usuario($st_usuario);
    $rs = SCA_M0002::consultaUsuarioMatricula();
    if(count($rs)>0){
        if(strtolower($form) === strtolower('sca_h0002')){
            $dados = array(
                'cd_usuario'=>$rs['0']['cd_usuario'],
                'nr_matr_usu'=>$rs['0']['nr_matr_usu'].$rs['0']['dg_matr_usu'],
                'nm_usuario'=>$rs['0']['nm_usuario'],
                'dt_nasc_usu'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_nasc_usu']),           
                'nr_tel_usu'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_tel_usu'],'Fone'),
                'dt_exp_snh_usu'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_exp_snh_usu']),
                'ds_email_usu'=>$rs['0']['ds_email_usu'],
                'tp_perm_usu'=>$rs['0']['tp_perm_usu'],
                'nr_cpf'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_cpf'], 'CPF'),
                'st_usuario'=>$rs['0']['st_usuario']
            );
        }else{
            $dados = array(
                'cd_usuario'=>$rs['0']['cd_usuario'],
                'nr_matr_usu'=>$rs['0']['nr_matr_usu'].$rs['0']['dg_matr_usu'],
                'nm_usuario'=>$rs['0']['nm_usuario']           
            );
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Matrícula Usuário Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Matrícula Usuário não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function ConsultaCPFUsuario(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'nr_cpf')=== NULL || $G_MEC->recebePost($_POST, 'nr_cpf')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: CPF Usuário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'st_usuario')=== NULL || $G_MEC->recebePost($_POST, 'st_usuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Usuário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $nr_cpf = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST,'nr_cpf'));
    $st_usuario =  $G_MEC->recebePost($_POST, 'st_usuario');
    SCA_M0002::setcd_empresa($cd_empresa);
    SCA_M0002::setnr_cpf($nr_cpf);
    SCA_M0002::setst_usuario($st_usuario);
    $rs = SCA_M0002::consultaUsuarioCPF();
    if(count($rs)>0){
        if(strtolower($form) === strtolower('sca_h0002')){
            $dados = array(
                'cd_usuario'=>$rs['0']['cd_usuario'],
                'nr_matr_usu'=>$rs['0']['nr_matr_usu'].$rs['0']['dg_matr_usu'],
                'nm_usuario'=>$rs['0']['nm_usuario'],
                'dt_nasc_usu'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_nasc_usu']),           
                'nr_tel_usu'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_tel_usu'],'Fone'),
                'dt_exp_snh_usu'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_exp_snh_usu']),
                'ds_email_usu'=>$rs['0']['ds_email_usu'],
                'tp_perm_usu'=>$rs['0']['tp_perm_usu'],
                'nr_cpf'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_cpf'], 'CPF'),
                'st_usuario'=>$rs['0']['st_usuario']
            );
        }else{
            $dados = array(
                'cd_usuario'=>$rs['0']['cd_usuario'],
                'nr_matr_usu'=>$rs['0']['nr_matr_usu'].$rs['0']['dg_matr_usu'],
                'nm_usuario'=>$rs['0']['nm_usuario']           
            );
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: CPF Usuário Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: CPF Usuário não Localizada!';
        echo json_encode(array('dados'=>$json));
        exit;
    }
}

Function ConsultaNomeUsuario(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $nm_campo_busca =  @$_POST['nm_campo_busca'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if(@$_POST['nm_usuario'] != ''){
        $nm_usuario = $_POST['nm_usuario'];
    }else{
        $nm_usuario = @$_POST['texto'];
    }

    if(@$_POST['st_usuario'] != ''){
        $st_usuario = $_POST['st_usuario'];
    }else{
        $st_usuario = $filtro['st_usuario'];
    }


    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('nr_matr_usu'=> 'Matrícula', 'nm_usuario'=>'Usuário');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCA_M0002::setcd_empresa($cd_empresa);
    SCA_M0002::setnm_usuario($nm_usuario);
    SCA_M0002::setst_usuario($st_usuario);
    $rs = SCA_M0002::consultaUsuarioNome('like');
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}

function Incluir(){
    
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
    
    $opr = strtolower($G_MEC->recebePost($_POST, 'opr'));
    if(trim($opr) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Operação não informada!';
            echo json_encode($json);
            exit;
    }

    if(ValidaPost($opr)){
        
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $nm_usuario = $G_MEC->recebePost($_POST,'nm_usuario');
        $dt_nasc_usu = $G_MEC->recebePost($_POST,'dt_nasc_usu');
        $nr_tel_usu = $G_MEC->recebePost($_POST,'nr_tel_usu');
        $ds_email_usu = $G_MEC->recebePost($_POST,'ds_email_usu');
        $dt_exp_snh_usu = date('Ymd',  strtotime("60 days"));
        $tp_perm_usu = $G_MEC->recebePost($_POST,'tp_perm_usu');
        
        if($G_MEC->ValidarCPF($G_MEC->recebePost($_POST,'nr_cpf'))){
            $nr_cpf = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST,'nr_cpf'));
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: CPF Inváldo!';
            echo json_encode($json);
            exit;
        }
        
        //Verificar se o nome de usuário já se encontra cadastrado na mesmta instituição
        SCA_M0002::setcd_empresa($cd_empresa);
        SCA_M0002::setnm_usuario($nm_usuario);
        $st_usuario =  '0|1|2';
        SCA_M0002::setst_usuario($st_usuario);
        $rs = SCA_M0002::consultaUsuarioNome('texto');
        if(count($rs)<1){
            //Verificar se o cpf já está cadastrado
            SCA_M0002::setnr_cpf($nr_cpf);
            $rs = SCA_M0002::consultaUsuarioCPF();
            if(count($rs)<1){
                $G_MEC->TransacaoInicio();
                SCA_M0002::setdt_nasc_usu($G_MEC->FormataDataTiraBarraInverte($dt_nasc_usu));
                SCA_M0002::setnr_tel_usu(preg_replace('/[^\d]+/i', '', $nr_tel_usu));
                SCA_M0002::setds_email_usu($ds_email_usu);
                SCA_M0002::setdt_exp_snh_usu($dt_exp_snh_usu);
                SCA_M0002::setcd_empresa($cd_empresa);
                SCA_M0002::settp_perm_usu($tp_perm_usu);
                // 2-Primeiro Acesso
                $st_usuario = 2;
                SCA_M0002::setst_usuario($st_usuario);
                $rs = SCA_M0002::incluir();
                if($rs != false){
                    $G_MEC->TransacaoFinaliza();
                    $json['ret']=  'true';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['nr_matr_usu'] = $rs;
                    $json['msg'] = 'Sucesso: Registro Inserido com Sucesso!';
                    echo json_encode(array('dados'=>$json));
                    exit; 
                } else {
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Inserir Registro!';
                    echo json_encode($json);
                    exit; 
                }
            }else{
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: CPF já cadastrado!';
                echo json_encode($json);
                exit; 
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Usuário já cadastrado!';
            echo json_encode($json);
            exit;
        }
        
    }
}

function Alterar(){
    
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
    
    $opr = strtolower($G_MEC->recebePost($_POST, 'opr'));
    if(trim($opr) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Operação não informada!';
            echo json_encode($json);
            exit;
    }

    if(ValidaPost($opr)){
        
        $cd_usuario = $G_MEC->recebePost($_POST,'cd_usuario');
        $nr_tel_usu = preg_replace('/[^\d]+/i', '', $G_MEC->recebePost($_POST,'nr_tel_usu'));
        $ds_email_usu = $G_MEC->recebePost($_POST,'ds_email_usu');
        $tp_perm_usu = $G_MEC->recebePost($_POST,'tp_perm_usu');
        $st_usuario = $G_MEC->recebePost($_POST,'st_usuario');
        
        SCA_M0002::setcd_usuario($cd_usuario);
        SCA_M0002::setnr_tel_usu($nr_tel_usu);
        SCA_M0002::setds_email_usu($ds_email_usu);
        SCA_M0002::settp_perm_usu($tp_perm_usu);
        SCA_M0002::setst_usuario($st_usuario);
        if(SCA_M0002::alterar()){
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Registro Alterado com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit; 
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Alterar Registro!';
            echo json_encode($json);
            exit; 
        }
    }
}

function GerarSenha(){
    
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
    
    $opr = strtolower($G_MEC->recebePost($_POST, 'opr'));
    if(trim($opr) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Operação não informada!';
            echo json_encode($json);
            exit;
    }
    
    $cd_usuario = $G_MEC->recebePost($_POST,'cd_usuario');
    if(trim($cd_usuario) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Usuário não informado!';
        echo json_encode($json);
        exit;
    }
    
    SCA_M0002::setcd_usuario($cd_usuario);
    $rs = SCA_M0002::consultaUsuarioCodigo();
    if(count($rs)>0){
        $id_sessao = md5($rs[0]['nr_matr_usu'].$rs[0]['dg_matr_usu']);
        SCA_M0002::setid_sessao($id_sessao);
        $dt_exp_snh_usu = date('Ymd',  strtotime("60 days"));
        SCA_M0002::setdt_exp_snh_usu($dt_exp_snh_usu);
        //2-Primeiro Acesso
        $st_usuario = 2;
        SCA_M0002::setst_usuario($st_usuario);
        if(SCA_M0002::alterarSenha()){
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Senha Gerada com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit; 
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Alterar Registro!';
            echo json_encode($json);
            exit; 
        }
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Usuário não Localizado!';
        echo json_encode($json);
        exit; 
    }

}
function Excluir(){
    
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
    
    $opr = strtolower($G_MEC->recebePost($_POST, 'opr'));
    if(trim($opr) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Operação não informada!';
            echo json_encode($json);
            exit;
    }
    
    $cd_usuario = $G_MEC->recebePost($_POST,'cd_usuario');
    if(trim($cd_usuario) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Usuário não informado!';
        echo json_encode($json);
        exit;
    }
    
    SCA_M0002::setcd_usuario($cd_usuario);
    if(SCA_M0002::Excluir()){
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Usuário Excluído com Sucesso!';
        echo json_encode(array('dados'=>$json));
        exit; 
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Falha ao Excluir Registro!';
        echo json_encode($json);
        exit; 
    }
    
}

function ValidaPost($opr){
    $G_MEC = new Mecanismo();
    $form = $G_MEC->recebePost($_POST, 'form');
    switch ($opr){
        case 'incluir':	
            $nm_usuario = $G_MEC->recebePost($_POST,'nm_usuario');
            if(trim($nm_usuario) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Nome Usuário não informada!';
                    echo json_encode($json);
                    exit;
            }
            $dt_nasc_usu = $G_MEC->recebePost($_POST,'dt_nasc_usu');
            if(trim($dt_nasc_usu) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Data Nascimento não informada!';
                    echo json_encode($json);
                    exit;
            }
            $nr_tel_usu = $G_MEC->recebePost($_POST,'nr_tel_usu');
            if(trim($nr_tel_usu) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Telefone não informada!';
                    echo json_encode($json);
                    exit;
            }
            $ds_email_usu = $G_MEC->recebePost($_POST,'ds_email_usu');
            if(trim($ds_email_usu) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Email não informada!';
                    echo json_encode($json);
                    exit;
            }
            $dt_exp_snh_usu = $G_MEC->recebePost($_POST,'dt_exp_snh_usu');
            if(trim($dt_exp_snh_usu) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Data Expiração não informada!';
                    echo json_encode($json);
                    exit;
            }
            $tp_perm_usu = $G_MEC->recebePost($_POST,'tp_perm_usu');
            if(trim($tp_perm_usu) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Tipo Permissão não informada!';
                    echo json_encode($json);
                    exit;
            }
            
            $nr_cpf = $G_MEC->recebePost($_POST,'nr_cpf');
            if(trim($nr_cpf) == ''){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg']= 'Erro: Número CPF não informada!';
                    echo json_encode($json);
                    exit;
            }

            return true;
        case 'alterar':	
            
            $cd_usuario = $G_MEC->recebePost($_POST,'cd_usuario');
            if(trim($cd_usuario) == ''){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Código Usuário não informado!';
                echo json_encode($json);
                exit;
            }
            $nr_tel_usu = $G_MEC->recebePost($_POST,'nr_tel_usu');
            if(trim($nr_tel_usu) == ''){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Número Telefone não informado!';
                echo json_encode($json);
                exit;
            }
            $ds_email_usu = $G_MEC->recebePost($_POST,'ds_email_usu');
            if(trim($ds_email_usu) == ''){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: E-mail não informado!';
                echo json_encode($json);
                exit;
            }
            $tp_perm_usu = $G_MEC->recebePost($_POST,'tp_perm_usu');
            if(trim($tp_perm_usu) == ''){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Tipo Permissão não informado!';
                echo json_encode($json);
                exit;
            }
            
            $st_usuario = $G_MEC->recebePost($_POST,'st_usuario');
            if(trim($st_usuario) == ''){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Status Usuário não informado!';
                echo json_encode($json);
                exit;
            }
                    
            return true;
    default:
        return false;
    }
    return true;
}
?>
