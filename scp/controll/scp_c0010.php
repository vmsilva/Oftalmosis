<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'listaconfirmamovimentacaoprontuario':
            ListaConfirmaMovimentacaoProntuario();
            break;
        case 'listapacientesolicitadosnaoatendidos':
            listaPacienteSolicitadosNaoAtendidos();
            break;
        case 'confirmar':
            Confirmar();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ListaConfirmaMovimentacaoProntuario(){
   
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
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0005::setcd_empresa($cd_empresa);
    $rs = SCP_M0005::listaConfirmacaoSolicitacaoMovimentacaoProntuario(0);
    if(count($rs)>0){
        $inputBusca = 0;
        $opr = @$_POST['opr'];
        $url = @$_POST['url'];
        $Render = new renderView();
        $headers = array('nr_solic_mov'=> 'Número Solic.', 'dt_atend_solic_mov'=> 'Dt. Solic.', 'hr_atend_solic_mov'=> 'Hr. Solic.', 'nm_usu_atend'=>'Atendente');
        echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Solicitação do Prontuário Não Encontrado!';
        echo json_encode($json);
        exit();
    }
}

Function listaPacienteSolicitadosNaoAtendidos(){
   
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
    
     if($G_MEC->recebePost($_POST, 'nr_solic_mov')=== NULL || $G_MEC->recebePost($_POST, 'nr_solic_mov')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Solicitação Movimentação não Informado!';
        echo json_encode($json);
        exit();
    }    
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0006::setcd_empresa($cd_empresa);
    $nr_solic_mov = $G_MEC->recebePost($_POST, 'nr_solic_mov');
    SCP_M0006::setnr_solic_mov($nr_solic_mov);
    //st_solic_mov 0 livre
    $st_solic_mov =0;
    SCP_M0006::setst_solic_mov($st_solic_mov);
    $rs = SCP_M0006::listaSolicitacaoMovimentacaoProntuario();
    if(count($rs)>0){
        $html = '<div class="grid_cabecalho">
                    <table>
                        <thead>
                            <tr>
                                <th>Prontuário</th>
                                <th>Paciente</th>
                                <th>Confirmar</th>
                                <th>Negar</th>
                            </tr>
                        </thead>
                    </table>
                </div>';
        $html.= '<div class="grid_corpo"><table>';
        $html.= '<thead style="display: none"><tr>
            <th class="header">Prontuário</th>
            <th class="header">Paciente</th>
            <th class="header">Confirmar</th>
            <th class="header">Negar</th>
            </td></tr></thead>';
        $html.= '<tbody class="grid_corpo">';
        foreach ($rs as $key => $value){
            $html.= "<tr id='".$value['nr_prontuario']."' data-dados='".json_encode($value)."'>";
            $html.= '<td>'.$value['nr_prontuario'].'</td>';
            $html.= '<td>'.$value['nm_pac'].'</td>';
            $html.= '<td><button class="btn_add" onclick="javascript:confirmarEncontrado('."'".$value['nr_prontuario']."'".')"></button></td>';
            $html.= '<td><button class="btn_rem" onclick="javascript:negarDialog('."'".$value['nr_prontuario']."'".')"></button></td>';
            $html.= '</tr>';
        }
        $html.= '</tbody></table></div>';
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['dados'] = $html;
        echo json_encode($json);
        exit();
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Solicitação do Prontuário Não Encontrado!';
        echo json_encode($json);
        exit();
    }
}

Function Confirmar(){
    
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
    
    if($G_MEC->recebePost($_POST, 'nr_solic_mov')=== NULL || $G_MEC->recebePost($_POST, 'nr_solic_mov')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Solicitação Movimentação Prontuário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    $nr_solic_mov = $G_MEC->recebePost($_POST, 'nr_solic_mov');

    $lista = $G_MEC->recebePost($_POST, 'lista');
    if(count($lista)<1){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0006::setcd_empresa($cd_empresa);
    SCP_M0006::setnr_solic_mov($nr_solic_mov);
    $j = 1;
    $G_MEC->TransacaoInicio();
    foreach ($lista as $key => $value) {
        SCP_M0006::setnr_prontuario($value["nr_prontuario"]);
        if(strtolower($value["st_mov_prontuario"]) != strtolower('Confirmado')){
            $in_mov_prontuario = substr($value["st_mov_prontuario"],7);
            //3-Não Atendido
            $st_solic_mov = '3';
        }else{
            //1-Atendido
            $in_mov_prontuario = null;
            $st_solic_mov = '1';
        }
        SCP_M0006::setst_solic_mov($st_solic_mov);
        SCP_M0006::setdt_atend_solic_mov($G_MEC->DataHoje());
        SCP_M0006::sethr_atend_solic_mov($G_MEC->HoraHoje());
        SCP_M0006::setin_mov_prontuario($in_mov_prontuario);
        $st_solic_mov_aux = 0;
        if(SCP_M0006::alterar($st_solic_mov_aux)){
            $rs = SCP_M0006::ListarSolicitacaoProntuario();
            if(count($rs)>0){
                if($st_solic_mov == '1'){
                    //Confirmar Movimentação
                    //4-Em movimentação
                    $st_prontuario = 4;
                }else{
                    //Nega Movimentação
                    //3-Bloqueado
                    $st_prontuario = 3;
                    SCP_M0002::setst_prontuario($st_prontuario);
                    SCP_M0002::setcd_empresa($cd_empresa);
                    SCP_M0002::setcd_prateleira($rs[0]['cd_prateleira']);
                    SCP_M0002::setnr_linha($rs[0]['nr_linha']);
                    SCP_M0002::setnr_coluna($rs[0]['nr_coluna']);
                    SCP_M0002::setnr_posicao($rs[0]['nr_posicao']);
                    SCP_M0002::setcd_pac($rs[0]["cd_pac"]);
                    SCP_M0002::setst_prontuario($st_prontuario);
                    if(SCP_M0002::confirmaMovimentacaoSolicitacaoProntuario()<1){
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Confirmar Prontuário em Movimento!';
                        echo json_encode(array('dados'=>$json));
                        exit();
                    }
                }
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Localizar Atendimento da Solicitação!';
                echo json_encode(array('dados'=>$json));
                exit();
            }
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Confirmar Atendimento da Solicitação!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }
    $G_MEC->TransacaoFinaliza();
    $json['ret']=  'true';
    $json['mostra'] = 'true';
    $json['form']=  $form;
    $json['msg'] = 'Sucesso: Atendimento da Solicitação Confirmado!';
    echo json_encode(array('dados'=>$json));
    exit();
}
?>