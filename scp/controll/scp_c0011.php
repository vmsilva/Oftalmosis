<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'desbloquearprontuario':
            desbloquearProntuario();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function desbloquearProntuario(){
    
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
    
    if($G_MEC->recebePost($_POST, 'cd_usu_loc_pront') === NULL || $G_MEC->recebePost($_POST, 'cd_usu_loc_pront')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Usuário não Informado!';
        echo json_encode(array('dados'=>$json));
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
        if($G_MEC->recebePost($_POST, 'nr_prontuario') === NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Prontuário não Informado!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
        $nr_prontuario = $G_MEC->recebePost($_POST, 'nr_prontuario');

        $cd_empresa = $_SESSION['cd_empresa_usu'];
        SCP_M0002::setcd_empresa($cd_empresa);
        SCP_M0002::setnr_prontuario($nr_prontuario);
        //Prontuário Bloqueado
        $st_prontuario = 3;
        SCP_M0002::setst_prontuario($st_prontuario);
        $rs = SCP_M0002::consultaNumeroProntuario();
        if(count($rs)>0){
            $G_MEC->TransacaoInicio();
            SCP_M0002::setcd_empresa($rs[0]['cd_empresa']);
            SCP_M0002::setcd_prateleira($rs[0]['cd_prateleira']);
            SCP_M0002::setnr_linha($rs[0]['nr_linha']);
            SCP_M0002::setnr_coluna($rs[0]['nr_coluna']);
            SCP_M0002::setnr_posicao($rs[0]['nr_posicao']);
            SCP_M0002::setcd_pac($rs[0]['cd_pac']);
            //2 - Liberando Prontuário para Movimentação
            SCP_M0002::setst_prontuario(2);
            if(SCP_M0002::confirmaMovimentacaoSolicitacaoProntuario()<1){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Confirmar Prontuário em Movimento!';
                echo json_encode(array('dados'=>$json));
                exit();
            }else{
                //Mudando status Tabela de Solicitação
                //Status informando que Prontuário foi devolvido sem Liberação
                $st_solic_mov = 4;
                SCP_M0006::setst_solic_mov($st_solic_mov);
                SCP_M0006::setcd_usu_devol_solic_mov($cd_usuario);
                SCP_M0006::setdt_devol_solic_mov($G_MEC->DataHoje());
                SCP_M0006::sethr_devol_solic_mov($G_MEC->HoraHoje());
                SCP_M0006::setcd_empresa($cd_empresa);
                SCP_M0006::setcd_pac($rs[0]['cd_pac']);
                SCP_M0006::setnr_prontuario($nr_prontuario);
                //Status de Bloqueio
                $st_solic_mov_aux = 3;
                if(SCP_M0006::AlterarDevolucao($st_solic_mov_aux)<1){
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Liberar Prontuário para Movimentação!';
                    echo json_encode(array('dados'=>$json));
                    exit();
                }else{
                    $G_MEC->TransacaoFinaliza();
                    $json['ret']=  'true';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Prontuário Liberado para Movimentação!';
                    echo json_encode(array('dados'=>$json));
                    exit();
                }
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Prontuário Bloqueado Não Localizado!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Usuário e Senha não conferem!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
}
?>