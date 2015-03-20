<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'listaprontuariousuariostatus':
            ListaProntuarioUsuarioStatus();
            break;
        case 'listaprontuariorecepcionartransf':
            listaProntuarioRecepcionarTransf();
            break;
        case 'listaprontuariousuariosolictransf':
            ListaProntuarioUsuarioSolicTransf();
            break;
        case 'transferenciasolicitacaomovimentacao':
            TransferenciaSolicitacaoMovimentacao();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ListaProntuarioUsuarioStatus(){
    
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
    
    if($G_MEC->recebePost($_POST, 'st_solic_mov') == NULL || $G_MEC->recebePost($_POST, 'st_solic_mov')== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Movimentação Prontuário Não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    $st_solic_mov = $G_MEC->recebePost($_POST, 'st_solic_mov');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    SCP_M0005::setcd_empresa($cd_empresa);
 
    SCP_M0005::setcd_usu_solic_mov($cd_usuario);
    $rs = SCP_M0005::ListaMovimentacaoProntuarioUsuario($st_solic_mov);
    $html = '';
    if(count($rs)>0){
        $html = '<div class="grid_cabecalho">
                    <table>
                        <thead>
                            <tr>
                                <th>Prontuário</th>
                                <th>Paciente</th>
                                <th>Dt.Solic.</th>
                                <th>Hr.Solic.</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>';
        $html.= '<div class="grid_corpo"><table>';
        $html.= '<thead style="display: none"><tr>
            <th class="header">Prontuário</th>
            <th class="header">Paciente</th>
            <th class="header">Dt.Solic.:</th>
            <th class="header">Hr.Solic.:</th>
            <th class="header"></th>
            </tr></thead>';
        $html.= '<tbody class="grid_corpo">';
        foreach ($rs as $key => $value) {
            $html.= "<tr id='".$value['nr_prontuario']."' data-dados='".json_encode($value)."'>";
            $html.= '<td>'.$value['nr_prontuario'].'</td>';
            $html.= '<td>'.$value['nm_pac'].'</td>';
            $html.= '<td>'.$value['dt_solic_mov'].'</td>';
            $html.= '<td>'.$value['hr_solic_mov'].'</td>';
            $html.= '<td></td>';
            $html.= '</tr>';
        }
        $html.= '</tbody></table></div>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit();
    }else{
        $html = '<div class="grid_cabecalho">
                    <table>
                        <thead>
                            <tr>
                                <th>Prontuário</th>
                                <th>Paciente</th>
                                <th>Dt.Solic.</th>
                                <th>Hr.Solic.</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="grid_corpo">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nenhum Registro Localizado!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit();
    }
}

Function ListaProntuarioUsuarioSolicTransf(){

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
    
    if($G_MEC->recebePost($_POST, 'st_solic_mov') == NULL || $G_MEC->recebePost($_POST, 'st_solic_mov')== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Movimentação Prontuário Não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $html = '<div class="grid_cabecalho">
                <table>
                    <thead>
                        <tr>
                            <th>Prontuário</th>
                            <th>Paciente</th>
                            <th>Dt.Solic.:</th>
                            <th>Hr.Solic.:</th>
                            <th>Encaminhado</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>';
    
    $st_solic_mov = $G_MEC->recebePost($_POST, 'st_solic_mov');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    SCP_M0005::setcd_empresa($cd_empresa);
    SCP_M0005::setcd_usu_solic_mov($cd_usuario);
    $rs = SCP_M0005::ListaMovimentacaoProntuarioUsuario($st_solic_mov);
    if(is_array($rs)){
         $html.= '<div class="grid_corpo"><table>
                    <thead style="display: none"><tr>
                        <th class="header">Prontuário</th>
                        <th class="header">Paciente</th>
                        <th class="header">Dt.Solic.</th>
                        <th class="header">Hr.Solic.</th>
                        <th>Encaminhado</th>
                        <th class="header"></th>
                    </tr></thead>
                    <tbody class="grid_corpo">';
        foreach ($rs as $key => $value) {
            SCP_M0006::setcd_empresa($cd_empresa);
            SCP_M0006::setnr_solic_mov_ant($value['nr_solic_mov']);
            $st_solic_mov = 0;
            $rsProntEncam = SCP_M0006::ListaRecpTransfProntuarioUsuario($st_solic_mov);
            if(is_array($rsProntEncam)){
                foreach ($rsProntEncam as $k => $v) {
                    $html.= "<tr id='".$v['nr_prontuario']."' data-dados='".json_encode($v)."'>";
                    $html.= '<td>'.$v['nr_prontuario'].'</td>';
                    $html.= '<td>'.$v['nm_pac'].'</td>';
                    $html.= '<td>'.$v['dt_solic_mov'].'</td>';
                    $html.= '<td>'.$v['hr_solic_mov'].'</td>';
                    $html.= '<td>'.$v['nr_matr_usu'].$v['dg_matr_usu'].' - '.$v['nm_usuario'].'</td>';
                    $html.= '<td></td>';
                    $html.= '</tr>';
                }
            }else{
                $html.= '<div class="grid_corpo">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nenhum Registro Localizado!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
                $json['ret']=  'true';
                $json['form']=  $form;
                $json['html']= $html;
                echo json_encode(array('dados'=>$json));
                exit();
            }
        }
        $html.= '</tbody></table></div>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit();
    }else{
       $html.= '<div class="grid_corpo">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nenhum Registro Localizado!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit();
    }
}

Function listaProntuarioRecepcionarTransf(){
    
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
    
    if($G_MEC->recebePost($_POST, 'st_solic_mov') == NULL || $G_MEC->recebePost($_POST, 'st_solic_mov')== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Movimentação Prontuário Não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    $st_solic_mov = $G_MEC->recebePost($_POST, 'st_solic_mov');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    SCP_M0005::setcd_empresa($cd_empresa);
    SCP_M0005::setcd_usu_solic_mov($cd_usuario);
    $rs = SCP_M0005::ListaMovimentacaoProntuarioUsuario($st_solic_mov);
    if(count($rs)>0){
        $html = '<div class="grid_cabecalho">
                    <table>
                        <thead>
                            <tr>
                                <th>Prontuário</th>
                                <th>Paciente</th>
                                <th>Dt.Solic.</th>
                                <th>Hr.Solic.</th>
                                <th>Encaminhado</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>';
        $html.= '<div class="grid_corpo"><table>';
        $html.= '<thead style="display: none"><tr>
            <th class="header">Prontuário</th>
            <th class="header">Paciente</th>
            <th class="header">Dt.Solic.:</th>
            <th class="header">Hr.Solic.:</th>
            <th>Encaminhado</th>
            <th class="header"></th>
            </tr></thead>';
        $html.= '<tbody class="grid_corpo">';
        foreach ($rs as $key => $value) {
            $html.= "<tr id='".$value['nr_prontuario']."' data-dados='".json_encode($value)."'>";
            $html.= '<td>'.$value['nr_prontuario'].'</td>';
            $html.= '<td>'.$value['nm_pac'].'</td>';
            $html.= '<td>'.$value['dt_solic_mov'].'</td>';
            $html.= '<td>'.$value['hr_solic_mov'].'</td>';

            SCP_M0006::setcd_empresa($cd_empresa);
            SCP_M0006::setnr_solic_mov($value['nr_solic_mov_ant']);
            SCP_M0006::setnr_prontuario($value['nr_prontuario']);
            SCP_M0006::setst_solic_mov(5);
            $rsUsuEncam = SCP_M0006::ListarSolicitacaoProntuario();
            if(is_array($rsUsuEncam)){
                $html.= '<td>'.$rsUsuEncam[0]['nr_matr_usu_solic'].$rsUsuEncam[0]['dg_matr_usu_solic'].'-'.$rsUsuEncam[0]['nm_usu_solic'].'</td>';
            }

            $html.= '<td></td>';
            $html.= '<td><span></span></td>';
            $html.= '</tr>';
        }
        $html.= '</tbody></table></div>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit();
    }else{
        $html = '<div class="grid_cabecalho">
                    <table>
                        <thead>
                            <tr>
                                <th>Prontuário</th>
                                <th>Paciente</th>
                                <th>Dt.Solic.</th>
                                <th>Hr.Solic.</th>
                                <th>Encaminhado</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="grid_corpo">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nenhum Registro Localizado!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = $html;
        echo json_encode(array('dados'=>$json));
        exit();
    }
}

Function TransferenciaSolicitacaoMovimentacao(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form') == NULL || $G_MEC->recebePost($_POST, 'form')== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_usu_solic_mov') == NULL || $G_MEC->recebePost($_POST, 'cd_usu_solic_mov') == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Usuário para Transferência não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $cd_usu_solic_mov = $G_MEC->recebePost($_POST, 'cd_usu_solic_mov');
    
    if($G_MEC->recebePost($_POST, 'nr_prontuario') == NULL || $G_MEC->recebePost($_POST, 'nr_prontuario') == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $lista = explode('|',$G_MEC->recebePost($_POST, 'nr_prontuario'));
    $nr_prontuario = $lista[0];
    $cd_pac = $lista[1];
    $nr_solic_mov_ant = $lista[2];
    $G_MEC->TransacaoInicio();
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    //Pesquisar e Alterar o status do pedido anterior
    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setnr_prontuario($nr_prontuario);
    //4-Em movimentação
    $st_prontuario = 4;
    SCP_M0002::setst_prontuario($st_prontuario);
    $rs = SCP_M0002::consultaNumeroProntuario();
    if(count($rs)>0){
        //1-Atendido
        $st_solic_mov_aux = 1;
        //5-Transferido não Confirmado
        $st_solic_mov = 5;
        SCP_M0006::setcd_usu_devol_solic_mov($_SESSION['cd_usuario_log']);
        SCP_M0006::setdt_devol_solic_mov($G_MEC->DataHoje());
        SCP_M0006::sethr_devol_solic_mov($G_MEC->HoraHoje());
        SCP_M0006::setst_solic_mov($st_solic_mov);
        SCP_M0006::setnr_solic_mov_ant($nr_solic_mov_ant);
        SCP_M0006::setcd_empresa($cd_empresa);
        $cd_pac = $rs[0]['cd_pac'];
        SCP_M0006::setcd_pac($cd_pac);
        SCP_M0006::setnr_prontuario($nr_prontuario);
        if(SCP_M0006::AlterarDevolucao($st_solic_mov_aux)<1){
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Bloquear Solicitação Prontuário!';
            echo json_encode($json);
            exit;
        }
        SCP_M0005::setcd_empresa($cd_empresa);
        SCP_M0005::setcd_usu_solic_mov($cd_usu_solic_mov);
        SCP_M0005::setdt_solic_mov($G_MEC->DataHoje());
        SCP_M0005::sethr_solic_mov($G_MEC->HoraHoje());
        $cd_usu_atend_solic_mov = $_SESSION['cd_usuario_log'];
        SCP_M0005::setcd_usu_atend_solic_mov($cd_usu_atend_solic_mov);
        //Gerar nova solicitação
        $nr_solic_mov = SCP_M0005::transferencia();
        if((int)$nr_solic_mov>0){
            $cd_prateleira = $rs[0]["cd_prateleira"];
            $nr_linha = $rs[0]["nr_linha"];
            $nr_coluna = $rs[0]["nr_coluna"];
            $nr_posicao = $rs[0]["nr_posicao"];
            
            SCP_M0006::setnr_solic_mov($nr_solic_mov);
            SCP_M0006::setcd_prateleira($cd_prateleira);
            SCP_M0006::setnr_linha($nr_linha);
            SCP_M0006::setnr_coluna($nr_coluna);
            SCP_M0006::setnr_posicao($nr_posicao);
            SCP_M0006::setnr_solic_mov_ant($nr_solic_mov_ant);
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
            }
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Registro Transferido com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit;
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Transferir Prontuário!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }else{
        $G_MEC->TransacaoAborta();
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Prontuário não se encontra em Movimentação!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
}
?>
