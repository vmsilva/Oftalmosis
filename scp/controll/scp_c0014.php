<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'incluirsolicitacaomovimentacaoagenda':
            IncluirSolicitacaoMovimentacaoAgenda();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function IncluirSolicitacaoMovimentacaoAgenda(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $form = $G_MEC->recebePost($_POST, 'form');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usu_solic_mov = $G_MEC->recebePost($_POST, 'cd_usu_solic_mov');
    
    SMG_M0004::setcd_prof($cd_usu_solic_mov);
    $rs = SMG_M0004::ConsultaCodigo();
    if(count($rs)>0){
        SCA_M0002::setnr_cpf(preg_replace('/[^\d]+/i', '', $rs[0]['nr_cpf_prof']));
        $rs = SCA_M0002::consultaUsuarioCPF();
        if(count($rs)>0){
            $cd_usu_solic_mov = $rs[0]['cd_usuario'];
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Usuário não cadastrado!';
            echo json_encode($json);
            exit;   
        }
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Profissional não cadastrado!';
        echo json_encode($json);
        exit;   
    }
    
    SCP_M0001::setcd_empresa($cd_empresa);
    
    

    $lista = $G_MEC->recebePost($_POST, 'lista');

    if(count($lista)>0){
        $G_MEC->TransacaoInicio();
        SCP_M0005::setcd_empresa($cd_empresa);
        SCP_M0005::setdt_solic_mov($G_MEC->DataHoje());
        SCP_M0005::sethr_solic_mov($G_MEC->HoraHoje());
        SCP_M0005::setcd_usu_solic_mov($cd_usu_solic_mov);
        $nr_solic_mov = SCP_M0005::incluir();
        if((int)$nr_solic_mov>0){
            foreach ($lista as $key => $value) {
               SCP_M0002::setcd_empresa($cd_empresa);
               $nr_prontuario = $value['nr_prontuario'];
               SCP_M0002::setnr_prontuario($nr_prontuario);
               $st_prontuario = 2;
               SCP_M0002::setst_prontuario($st_prontuario);
               $rs = SCP_M0002::consultaNumeroProntuario();
               if(count($rs)>0){
                    $cd_prateleira = $rs[0]["cd_prateleira"];
                    $nr_linha = $rs[0]["nr_linha"];
                    $nr_coluna = $rs[0]["nr_coluna"];
                    $nr_posicao = $rs[0]["nr_posicao"];
                    SCP_M0006::setcd_empresa($cd_empresa);
                    SCP_M0006::setnr_solic_mov($nr_solic_mov);
                    $cd_pac = $value['cd_pac'];
                    SCP_M0006::setcd_pac($cd_pac);
                    SCP_M0006::setcd_prateleira($cd_prateleira);
                    SCP_M0006::setnr_linha($nr_linha);
                    SCP_M0006::setnr_coluna($nr_coluna);
                    SCP_M0006::setnr_posicao($nr_posicao);
                    SCP_M0006::setnr_prontuario($nr_prontuario);
                    $st_solic_mov = 0;
                    SCP_M0006::setst_solic_mov($st_solic_mov);
                    if(SCP_M0006::incluir() === FALSE){
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Inserir Solicitação!';
                        echo json_encode($json);
                        exit;
                    }else{
                        SCP_M0002::setcd_prateleira($cd_prateleira);
                        SCP_M0002::setnr_linha($nr_linha);
                        SCP_M0002::setnr_coluna($nr_coluna);
                        SCP_M0002::setnr_posicao($nr_posicao);
                        SCP_M0002::setcd_pac($cd_pac);
                        $st_prontuario =  4;
                        SCP_M0002::setst_prontuario($st_prontuario);
                        if(SCP_M0002::confirmaMovimentacaoSolicitacaoProntuario()<1){
                            $G_MEC->TransacaoAborta();
                            $json['ret']=  'false';
                            $json['mostra'] = 'true';
                            $json['form']=  $form;
                            $json['msg'] = 'Erro: Falha ao Bloquear Solicitação Prontuário!';
                            echo json_encode($json);
                            exit;
                        }
                    }
               }else{
                   $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Prontuário não se Encontra Disponível para Movimentação! '.$nr_prontuario;
                    echo json_encode($json);
                    exit;
               }
            }
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Registro Incluído com Sucesso! Código Solicitação ->'.$nr_solic_mov;
            echo json_encode($json);
            exit;
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Gerar Solicitação de Movimentação Prontuário!';
            echo json_encode($json);
            exit;
        }
    }
    
}
?>
