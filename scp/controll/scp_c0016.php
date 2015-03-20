<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'confirmar':
            Confirmar();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function Confirmar(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form') === NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    $lista = explode('|', $G_MEC->recebePost($_POST, 'lista'));
    
    $nr_prontuario = $lista[0];
    $cd_pac = $lista[1];
    $nr_solic_mov = $lista[2];
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    $G_MEC->TransacaoInicio();
    SCP_M0005::setdt_atend_solic_mov($G_MEC->DataHoje());
    SCP_M0005::sethr_atend_solic_mov($G_MEC->HoraHoje());
    SCP_M0005::setcd_empresa($cd_empresa);
    SCP_M0005::setnr_solic_mov($nr_solic_mov);
    $cd_usu_solic_mov = $_SESSION['cd_usuario_log'];
    SCP_M0005::setcd_usu_solic_mov($cd_usu_solic_mov);
    if(SCP_M0005::ReceberTransferencia()<1){
        $G_MEC->TransacaoAborta();
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Falha ao Receber Solicitação Prontuário!';
        echo json_encode($json);
        exit;
    }
    
    SCP_M0006::setcd_empresa($cd_empresa);
    SCP_M0006::setcd_pac($cd_pac);
    SCP_M0006::setnr_prontuario($nr_prontuario);
    $st_solic_mov = 0;
    SCP_M0006::setst_solic_mov($st_solic_mov);
    $rs = SCP_M0006::ListarSolicitacaoProntuarioStatus();
    if(count($rs)>0){
        //Mudar o status do pedido anterior 6-Transferido Confirmado
        $st_solic_mov = 6;
        SCP_M0006::setst_solic_mov($st_solic_mov);
        SCP_M0006::setdt_atend_solic_mov($G_MEC->DataHoje());
        SCP_M0006::sethr_atend_solic_mov($G_MEC->HoraHoje());
        $st_solic_mov_aux = 5;
        $nr_solic_mov_ant = $rs[0]['nr_solic_mov_ant'];
        SCP_M0006::setnr_solic_mov($nr_solic_mov_ant);
        if(SCP_M0006::alterar($st_solic_mov_aux)<0){
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Baixar Solicitação Prontuário Anterior!';
            echo json_encode($json);
            exit;
        }
        //Alterar o Pedido Atual
        $st_solic_mov = 1;
        SCP_M0006::setst_solic_mov($st_solic_mov);
        SCP_M0006::setdt_atend_solic_mov($G_MEC->DataHoje());
        SCP_M0006::sethr_atend_solic_mov($G_MEC->HoraHoje());
        $st_solic_mov_aux = 0;
        SCP_M0006::setnr_solic_mov($nr_solic_mov);
        if(SCP_M0006::alterar($st_solic_mov_aux)<0){
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Baixar Solicitação Prontuário!';
            echo json_encode($json);
            exit;
        }
        
        $G_MEC->TransacaoFinaliza();
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Recepção de Transferência realizada com Sucesso!';
        echo json_encode(array('dados'=>$json));
        exit;
    }
}

?>
