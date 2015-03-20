<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'listamovimentacaoprontuariousuario':
            ListaMovimentacaoProntuarioUsuario();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ListaMovimentacaoProntuarioUsuario(){
    
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
                                <th>Dt.Solic.:</th>
                                <th>Hr.Solic.:</th>
                                <th>Situação</th>
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
            <th class="header">Situação</th>
            </td></tr></thead>';
        $html.= '<tbody class="grid_corpo">';
        foreach ($rs as $key => $value) {
            $html.= "<tr id='".$value['nr_prontuario']."' data-dados='".json_encode($value)."'>";
            $html.= '<td>'.$value['nr_prontuario'].'</td>';
            $html.= '<td>'.$value['nm_pac'].'</td>';
            $html.= '<td>'.$value['dt_solic_mov'].'</td>';
            $html.= '<td>'.$value['hr_solic_mov'].'</td>';
            if($rs[0]['st_solic_mov'] == 0){
                $st_solic_mov = 'Aguardando Atendimento';
            }else{
                $st_solic_mov = 'Atendida';
            }
            $html.= '<td>'.$st_solic_mov.'</td>';
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
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['html'] = 'Nenhum Registro Localizado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
}
?>
