<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'confirmasolicitacaoabertoprontuario':
            confirmaSolicitacaoAbertoProntuario();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function confirmaSolicitacaoAbertoProntuario(){
    

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

    if($G_MEC->recebePost($_POST, 'cd_usu_loc_pront')=== NULL || $G_MEC->recebePost($_POST, 'cd_usu_loc_pront')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_usuario = $G_MEC->recebePost($_POST, 'cd_usu_loc_pront');
    
    if($G_MEC->recebePost($_POST, 'ds_senha') === NULL || $G_MEC->recebePost($_POST, 'ds_senha')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Senha Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    $id_sessao = md5($G_MEC->recebePost($_POST, 'ds_senha'));
    
    //Verificar senha e Usuário
    SCA_M0002::setcd_usuario($cd_usuario);
    SCA_M0002::setid_sessao($id_sessao);
    $rs = SCA_M0002::validaSenhaUsuario();
    if(count($rs)>0){
        //Baixar Fila de prontuário
        if($G_MEC->recebePost($_POST, 'lista') === NULL || $G_MEC->recebePost($_POST, 'lista')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Prontuário(s) não Informado!';
            echo json_encode($json);
            exit();
        }
        $G_MEC->TransacaoInicio();
        foreach ($G_MEC->recebePost($_POST, 'lista') as $key => $value) {
            
            SCP_M0002::setcd_usu_loc_pront($cd_usuario);
            SCP_M0002::setdt_loc_pront($G_MEC->DataHoje());
            SCP_M0002::sethr_loc_pront($G_MEC->HoraHoje());
            $cd_empresa = $_SESSION['cd_empresa_usu'];
            SCP_M0002::setcd_empresa($cd_empresa);
            
            SCP_M0002::setnr_prontuario($value['nr_prontuario']);
            //2-Confirmado Arquivo
            $st_prontuario = 2;
            SCP_M0002::setst_prontuario($st_prontuario);

            if(!SCP_M0002::confirmaSolicitacaoProntuarioAberto()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Confirmar Prontuário! '.$value['nr_prontuario'];
                echo json_encode($json);
                exit();
            }
        }
        $G_MEC->TransacaoFinaliza();
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['dados']=  'true';
        $json['msg'] = 'Prontuário(s) confirmado com Sucesso!';
        echo json_encode($json);
        exit();
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Usuário e Senha não conferem!';
        echo json_encode($json);
        exit();
    }
}
?>
