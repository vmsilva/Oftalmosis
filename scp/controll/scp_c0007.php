<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'incluir':
            Incluir();
            break;
        case 'listasolicitacaoemaberto':
            listaSolicitacaoEmAberto();
            break;
        case 'consultamovimentacaoprontuariopaciente':
            consultaMovimentacaoProntuarioPaciente();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function Incluir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usu_solic_mov = $_SESSION['cd_usuario_log'];
    SCP_M0001::setcd_empresa($cd_empresa);
    
    $form = $G_MEC->recebePost($_POST, 'form');

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

Function listaSolicitacaoEmAberto(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $Render = new renderView();
    $headers = array('nr_solic_mov'=> 'Nr.Solic.','dt_solic_mov'=>'Dt.Solic.','hr_solic_mov'=>'Hr.Solic.','nm_usu_solic_mov'=>'Solic.');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0005::setcd_empresa($cd_empresa);
    $rs = SCP_M0005::listaSolicitacaoMovimentacaoProntuario();
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}

function consultaMovimentacaoProntuarioPaciente(){
    
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
    
    if($G_MEC->recebePost($_POST, 'nr_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    $nr_prontuario = $G_MEC->recebePost($_POST, 'nr_prontuario');
    
    if($G_MEC->recebePost($_POST, 'st_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'st_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    $st_prontuario = $G_MEC->recebePost($_POST, 'st_prontuario');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    if($st_prontuario != 1){
        if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Código Paciente não Informado!';
            echo json_encode($json);
            exit();
        }
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');

        
        SCP_M0006::setcd_empresa($cd_empresa);
        SCP_M0006::setnr_prontuario($nr_prontuario);
        SCP_M0006::setcd_pac($cd_pac);
        //0 - Aguardando Atendimento, 1 - Solicitação Atendida, 3 - Não Atendido
        $st_solic_mov = '1|3|5';
        SCP_M0006::setst_solic_mov($st_solic_mov);
        SCP_M0006::setst_prontuario($st_prontuario);
    
        $rs = SCP_M0006::consultaMovimentacaoProntuarioPaciente();
        if(count($rs)>0){
            if($rs[0]['st_solic_mov'] == 0){
                $st_solic_mov = 'Aguardando Atendimento';
            }else if($rs[0]['st_solic_mov'] == 3){
                $st_solic_mov = 'Não Atendido';
            }else if($rs[0]['st_solic_mov'] == 5){
                $st_solic_mov = 'Em Transferência';
            }else{
                $st_solic_mov = 'Atendida';
            }
            $html = '<div class="linha"><label>Número Solicitação:</label><label>'.$rs[0]['nr_solic_mov'].'</label></div>';
            $html.= '<div class="linha"><label>Data Solicitação:</label><label>'.$rs[0]['dt_solic_mov'].'</label></div>';
            $html.= '<div class="linha"><label>Hora Solicitação:</label><label>'.$rs[0]['hr_solic_mov'].'</label></div>';
            $html.= '<div class="linha"><label>Usuário Solicitante:</label><label>'.$rs[0]['nm_usuario'].'</label></div>';
            $html.= '<div class="linha"><label>Status Solicitação:</label><label>'.$st_solic_mov.'</label></div>';
            //Motivo Bloqueio
            if($st_prontuario == 3){
                $html.= '<div class="linha"><label>Motivo Bloqueio:</label><span>'.$rs[0]['in_mov_prontuario'].'</span></div>';
            }

            $json['dados'] = $html;
            echo json_encode($json);
            exit();
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Localizar Movimetação!';
            echo json_encode($json);
            exit; 
        }
    }  else {
        SCP_M0002::setcd_empresa($cd_empresa);
        SCP_M0002::setnr_prontuario($nr_prontuario);
        SCP_M0002::setst_prontuario($st_prontuario);
        $rs = SCP_M0002::consultaNumeroProntuario();
        if(count($rs)>0){
            $html = '<div class="linha"><label>Data Abertura:</label><label>'.$G_MEC->FormataDatacomBarra($rs[0]['dt_loc_pront']).'</label></div>';
            $html.= '<div class="linha"><label>Hora Abertura:</label><label>'.$G_MEC->FormataHora($rs[0]['hr_loc_pront']).'</label></div>';
            $html.= '<div class="linha"><label>Usuário Abertura:</label><label>'.$rs[0]['nm_usu_loc_pront'].'</label></div>';
        }
        $json['dados'] = $html;
        echo json_encode($json);
        exit();
    }
}
?>
