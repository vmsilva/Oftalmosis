<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'confirmamovimentacaoprontuario':
            ConfirmaMovimentacaoProntuario();
            break;
        case 'listaprontuariosolicitacao':
            listaProntuarioSolicitacao();
            break;
        case 'consultamovimentacaoprontuario':
            consultaMovimentacaoProntuario();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConfirmaMovimentacaoProntuario(){
    
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
    
    if($G_MEC->recebePost($_POST, 'cd_usuario')=== NULL || $G_MEC->recebePost($_POST, 'cd_usuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'nm_usuario')=== NULL || $G_MEC->recebePost($_POST, 'nm_usuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'nr_matr_usu')=== NULL || $G_MEC->recebePost($_POST, 'nr_matr_usu')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Matrícula Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    $cd_usu_atend_solic_mov = $G_MEC->recebePost($_POST, 'cd_usuario');
    
    if($G_MEC->recebePost($_POST, 'ds_snh_usu')=== NULL || $G_MEC->recebePost($_POST, 'ds_snh_usu')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Senha Usuário não Informado!';
        echo json_encode($json);
        exit();
    }
    $ds_snh_usu = md5($G_MEC->recebePost($_POST, 'ds_snh_usu'));
    
    if($G_MEC->recebePost($_POST, 'nr_solic_mov')=== NULL || $G_MEC->recebePost($_POST, 'nr_solic_mov')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Solicitação Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    $nr_solic_mov = $G_MEC->recebePost($_POST, 'nr_solic_mov');
    
    //Verificar senha e Usuário
    SCA_M0002::setcd_usuario($cd_usu_atend_solic_mov);
    SCA_M0002::setid_sessao($ds_snh_usu);
    $rs = SCA_M0002::validaSenhaUsuario();
    if(count($rs)>0){
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        SCP_M0005::setcd_empresa($cd_empresa);
        SCP_M0005::sethr_atend_solic_mov($G_MEC->HoraHoje());
        SCP_M0005::setdt_atend_solic_mov($G_MEC->DataHoje());
        SCP_M0005::setcd_usu_atend_solic_mov($cd_usu_atend_solic_mov);
        SCP_M0005::setnr_solic_mov($nr_solic_mov);

        $G_MEC->TransacaoInicio();
        $rs = SCP_M0005::Confirmar();
        if(is_integer($rs) > 0){
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Solicitação Confirmada com Sucesso!';
            echo json_encode($json);
            exit;
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Confirmar Solicitação!';
            echo json_encode($json);
            exit;
        }
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Usuário e Senha não conferem!';
        echo json_encode($json);
        exit();
    }
}

Function listaProntuarioSolicitacao(){
   
    $nr_solic_mov = (int)@$_POST['nr_solic_mov'];

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0006::setcd_empresa($cd_empresa);
    SCP_M0006::setnr_solic_mov($nr_solic_mov);
    //Status 0 indica livre
    $st_solic_mov = 0;
    SCP_M0006::setst_solic_mov($st_solic_mov);
    $rs = SCP_M0006::listaSolicitacaoMovimentacaoProntuario();
    $html = '<div id="dv_tabela_imp">';
        $html.= '<div class="linha">';
        $html.= '<label id="nr_solic">Nr.Solic.:</label>'.$nr_solic_mov;
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="dt_solic">Dt.Solic.:</label>'.$rs[0]['dt_solic_mov'];
        $html.= '<label id="hr_solic">Hr.Solic.:</label>'.$rs[0]['hr_solic_mov'];
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="nm_solic">Solic.:</label>'.$rs[0]['nm_usu_solic'];
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="dt_atend">Dt.Atend.:</label>'.$rs[0]['dt_atend_solic_mov'];
        $html.= '<label id="hr_atend">Hr.Atend.:</label>'.$rs[0]['hr_atend_solic_mov'];
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="nm_atend">Atend.:</label>'.$rs[0]['nm_usu_atend'];
        $html.= '</div>';
        $html.= '<div class="linha">';
            $html.= '<table>';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>Prontuário</th>';
            $html.= '<th>Paciente</th>';
            $html.= '</tr>';
            $html.= '</thead>';
            $html.= '<tbody>';
            foreach ($rs as $key => $value) {
                $html.= '<tr><td>'.$rs[$key]['nr_prontuario'].'</td><td>'.$rs[$key]['nm_pac'].'</td></tr>';
            }
            $html.= '</tbody>';
            $html.= '</table>';
        $html.= '</div>';
    $html.= '</div>';
    
    echo $html;

}

Function consultaMovimentacaoProntuario(){
   
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
    SCP_M0006::setcd_empresa($cd_empresa);
    SCP_M0006::setnr_prontuario($nr_prontuario);
    
    SCP_M0006::setst_solic_mov($st_solic_mov);
    $rs = SCP_M0006::listaSolicitacaoMovimentacaoProntuario();
    $html = '<div id="dv_tabela_imp">';
        $html.= '<div class="linha">';
        $html.= '<label id="nr_solic">Nr.Solic.:</label>'.$nr_solic_mov;
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="dt_solic">Dt.Solic.:</label>'.$rs[0]['dt_solic_mov'];
        $html.= '<label id="hr_solic">Hr.Solic.:</label>'.$rs[0]['hr_solic_mov'];
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="nm_solic">Solic.:</label>'.$rs[0]['nm_usu_solic'];
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="dt_atend">Dt.Atend.:</label>'.$rs[0]['dt_atend_solic_mov'];
        $html.= '<label id="hr_atend">Hr.Atend.:</label>'.$rs[0]['hr_atend_solic_mov'];
        $html.= '</div>';
        $html.= '<div class="linha">';
        $html.= '<label id="nm_atend">Atend.:</label>'.$rs[0]['nm_usu_atend'];
        $html.= '</div>';
        $html.= '<div class="linha">';
            $html.= '<table>';
            $html.= '<thead>';
            $html.= '<tr>';
            $html.= '<th>Prontuário</th>';
            $html.= '<th>Paciente</th>';
            $html.= '</tr>';
            $html.= '</thead>';
            $html.= '<tbody>';
            foreach ($rs as $key => $value) {
                $html.= '<tr><td>'.$rs[$key]['nr_prontuario'].'</td><td>'.$rs[$key]['nm_pac'].'</td></tr>';
            }
            $html.= '</tbody>';
            $html.= '</table>';
        $html.= '</div>';
    $html.= '</div>';
    
    echo $html;

}
?>
