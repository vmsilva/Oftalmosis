<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'listaprofissionaldataagenda':
            ListaProfissionalDataAgenda();
            break;
        case 'listaespecialidadeprofissionaldataagenda':
            ListaEspecialidadeProfissionalDataAgenda();
            break;
        case 'listaagendaprofissionaldia':
            listaAgendaProfissionalDia();
            break;
        case 'listaagendadia':
            listaAgendaDia();
            break;
        case 'listaagenda':
            listaAgenda();
            break;
        case 'buscaagenda':
            buscaAgenda();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function ListaProfissionalDataAgenda(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'dt_atend')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Data Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $dt_atend = $G_MEC->recebePost($_POST, 'dt_atend');
    }
    
    $dt_atend = $G_MEC->FormataDataTiraBarraInverte($dt_atend);
    
    $form = $G_MEC->recebePost($_POST, 'form');
    if($form != 'scp_h0017' && $form != 'sft_h0003'){
        if($dt_atend < $G_MEC->DataHoje()){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Data Atendimento não pode ser menor que Data Hoje!';
            echo json_encode(array('dados'=>$json));
            exit;
        }
    }
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_cnes = '5208706449409';
    SGA_M0004::setcd_empresa($cd_empresa);
    SGA_M0004::setcd_cnes($cd_cnes);
    $st_tp_grade = 0;
    SGA_M0004::setst_tp_grade($st_tp_grade);
    SGA_M0004::setnm_tp_grade('null');
    $rsTipoGrade = SGA_M0004::ConsultaNome();
    $cd_tp_grade = '';
    $barra = '';
    if(count($rsTipoGrade)){
        foreach ($rsTipoGrade as $key => $value) {
            $cd_tp_grade.= $barra.$value['cd_tp_grade'];
            $barra = '|';
        }
    }

    $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
    $where.= ' and t0006.cd_cnes = '.$G_MEC->TrataString($cd_cnes);
    $where.= ' and substr(t0006.cd_agenda,1,8) = '.$G_MEC->TrataString($dt_atend);
    $where.= ' and t0006.cd_tp_grade in '.$G_MEC->TrataStringEnum($cd_tp_grade);
    $st_fatur = 0;
    $where.= ' and t0006.st_fatur in '.$G_MEC->TrataStringEnum($st_fatur);
    $groupBy = 'Group By t0004.nm_prof';
    $rs = SGA_M0006::ListaAgendaPrestador($where,$groupBy);
    if(count($rs)>0){
        $nm_prof = '';
        $dados = array();
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_prof'] = $value['cd_prof'];
            $dados[$key]['nm_prof'] = strtoupper(trim($value['nm_prof']));
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        echo json_encode(array('dados'=>$json));
    }
}

function ListaEspecialidadeProfissionalDataAgenda(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'dt_atend')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Data Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $dt_atend = $G_MEC->recebePost($_POST, 'dt_atend');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_prof')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Profissional não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
    }
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_cnes = '5208706449409';
    SGA_M0004::setcd_empresa($cd_empresa);
    SGA_M0004::setcd_cnes($cd_cnes);
    $st_tp_grade = 0;
    SGA_M0004::setst_tp_grade($st_tp_grade);
    SGA_M0004::setnm_tp_grade('null');
    $rsTipoGrade = SGA_M0004::ConsultaNome();
    $cd_tp_grade = '';
    $barra = '';
    if(count($rsTipoGrade)){
        foreach ($rsTipoGrade as $key => $value) {
            $cd_tp_grade.= $barra.$value['cd_tp_grade'];
            $barra = '|';
        }
    }
    
    $dt_atend = $G_MEC->FormataDataTiraBarraInverte($dt_atend);
    $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
    $where.= ' and t0006.cd_cnes = '.$G_MEC->TrataString($cd_cnes);
    $where.= ' and t0006.cd_prof = '.$G_MEC->TrataString($cd_prof);
    $where.= ' and substr(t0006.cd_agenda,1,8) = '.$G_MEC->TrataString($dt_atend);
    $where.= ' and t0006.cd_tp_grade in '.$G_MEC->TrataStringEnum($cd_tp_grade);
    $st_fatur = 0;
    $where.= ' and t0006.st_fatur in '.$G_MEC->TrataStringEnum($st_fatur);
    $groupBy = 'Group By t0008.nm_espld_medc';
    
    $rs = SGA_M0006::ListaAgendaPrestador($where,$groupBy);
    if(count($rs)>0){
        $nm_prof = '';
        $dados = array();
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_espld_medc'] = $value['cd_espld_medc'];
            $dados[$key]['nm_espld_medc'] = strtoupper(trim($value['nm_espld_medc']));
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        echo json_encode(array('dados'=>$json));
    }
}

function listaAgendaProfissionalDia(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'dt_atend')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Data Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $dt_atend = $G_MEC->recebePost($_POST, 'dt_atend');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_prof')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Profissional não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_espld_medc')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Especialidade não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $cd_espld_medc = $G_MEC->recebePost($_POST, 'cd_espld_medc');
    }
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_cnes = '5208706449409';
    SGA_M0004::setcd_empresa($cd_empresa);
    SGA_M0004::setcd_cnes($cd_cnes);
    $st_tp_grade = 0;
    SGA_M0004::setst_tp_grade($st_tp_grade);
    SGA_M0004::setnm_tp_grade('null');
    $rsTipoGrade = SGA_M0004::ConsultaNome();
    $cd_tp_grade = '';
    $barra = '';
    if(count($rsTipoGrade)){
        foreach ($rsTipoGrade as $key => $value) {
            $cd_tp_grade.= $barra.$value['cd_tp_grade'];
            $barra = '|';
        }
    }
    
    $dt_atend = $G_MEC->FormataDataTiraBarraInverte($dt_atend);
    $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
    $where.= ' and t0006.cd_cnes = '.$G_MEC->TrataString($cd_cnes);
    $where.= ' and t0006.cd_prof = '.$G_MEC->TrataString($cd_prof);
    $where.= ' and t0006.cd_espld_medc = '.$G_MEC->TrataString($cd_espld_medc);
    $where.= ' and substr(t0006.cd_agenda,1,8) = '.$G_MEC->TrataString($dt_atend);
    $where.= ' and t0006.cd_tp_grade in '.$G_MEC->TrataStringEnum($cd_tp_grade);
    $st_fatur = 0;
    $where.= ' and t0006.st_fatur in '.$G_MEC->TrataStringEnum($st_fatur);
    $orderBy = 'Order By t0002.st_prontuario desc, t0002.nr_prontuario';
    
    $rs = SGA_M0006::ListaAgendaPrestador($where,null,$orderBy);
    if(count($rs)>0){
        $nm_prof = '';
        $html = '';
        foreach ($rs as $key => $value) {
            //0-Livre,1-Alocado sem Confirmação,2-Confirmado Arquivo,3-Bloqueado,4-Em movimentação
            switch ($value['st_prontuario']) {
                case 1:
                    $class =  'alocado';
                    break;
                case 2:
                    $class =  'liberado';
                    break;
                case 3:
                    $class =  'bloqueado';
                    break;
                case 4:
                    $class =  'movimento';
                    break;
                default :
                    $class =  'livre';
                    break;
            }
            
            if($form == 'scp_h0017'){
                $class =  'livre';
            }
            
            $html.= '<tr id="'.$value['nr_prontuario'].'" class="'.$class.'" data-data='."'".json_encode($value)."'".'>';
            if($value['nr_prontuario'] != ''){
                $html.= '<td>'.$value['nr_prontuario'].'</td>';
            }else{
                if($form != 'scp_h0017'){
                    $html.= '<td><button class="btn_edita_novo" onclick="selecionaPacienteSMS('."'".$value['cd_pac']."'".')"></button></td>';
                }else{
                    $html.= '<td>&nbsp;</td>';
                }
            }
            $html.= '<td>'.$value['nm_pac'].'</td>';
            $html.= '<td>'.substr($value['hr_atend'],0,2).':'.substr($value['hr_atend'],2,2).'</td>';
            if(StatusProntuario($value['st_prontuario'])!= ''){
                $html.= '<td>'.StatusProntuario($value['st_prontuario']).'</td>';
            }else{
                $html.= '<td>Sem Prontuário</td>';
            }

            if($form != 'scp_h0017'){
                if($value['st_prontuario'] == 3 || $value['st_prontuario'] == 4){
                    $html.= '<td><button class="btn_editar" onclick="consultaMovProntuario('."'".$value['nr_prontuario']."','".$value['cd_pac']."','".$value['st_prontuario']."'".')"></button></td>';
                }else{
                    if($value['st_prontuario'] == 2 ){
                        $html.= '<td><button class="btn_selecionar" onclick="selecionaProntuario('."'".$value['nr_prontuario']."'".')"></button></td>';
                    }else{
                        $html.= '<td>&nbsp;</td>';
                    }
                }
            }
            $html.= '</tr>';
        }
        
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $html;
        echo json_encode($json);
        exit;
    }
}

function listaAgendaDia(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_cnes')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Cnes não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $cd_cnes = $G_MEC->recebePost($_POST, 'cd_cnes');
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $dt_atend = $G_MEC->DataHoje();
    $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
    $where.= ' and t0006.cd_cnes = '.$G_MEC->TrataString($cd_cnes);
    $st_agenda = '1';
    $where.= ' and t0006.st_agenda = '.$G_MEC->TrataString($st_agenda);
    $where.= ' and substr(t0006.cd_agenda,1,8) = '.$G_MEC->TrataString($dt_atend);
    $orderBy = 'Order By t0014.nm_pac, t0014.dt_nasc_pac';
    $headers = array(
       'nm_pac' => 'Paciente',
       'dt_nasc_pac' => 'Dt.Nasc.',
       'tp_sexo_pac' => 'Sexo',
       'nm_mae_pac' => 'Mãe',
       'nm_espld_medc' => 'Especialidade'
    );
    $dados = array();
    $rs = SGA_M0006::ListaAgendaPrestador($where,null,$orderBy);
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_agenda'] = $value['cd_agenda'];
            $dados[$key]['nm_pac'] = $value['nm_pac'];
            $dados[$key]['dt_nasc_pac'] = $G_MEC->FormataDatacomBarra($value['dt_nasc_pac']);
            $dados[$key]['tp_sexo_pac'] = $value['tp_sexo_pac'];
            $dados[$key]['nm_mae_pac'] = $value['nm_mae_pac'];
            $dados[$key]['nm_espld_medc'] = $value['nm_espld_medc'];
        }
    }else{
        $dados[0]['nm_pac'] = '';
        $dados[0]['dt_nasc_pac'] = '';
        $dados[0]['tp_sexo_pac'] = '';
        $dados[0]['nm_mae_pac'] = '';
        $dados[0]['nm_espld_medc'] = '';
    }
    $json['ret']=  'true';
    $json['mostra'] = 'false';
    $json['form']=  $G_MEC->recebePost($_POST, 'form');
    $json['msg'] = '';
    $Render = new renderView();
    $opr = @$_POST['opr'];
    $json['dados'] = $Render->renderGrid($dados, $headers, 0, $form, $opr);
    echo json_encode($json);
    exit;
}

function listaAgenda(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    if($G_MEC->recebePost($_POST, 'dt_atend')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Data Agenda não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $dt_atend = $G_MEC->recebePost($_POST, 'dt_atend');
    }
    
    if($G_MEC->recebePost($_POST, 'st_agenda')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Agenda não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $st_agenda = $G_MEC->recebePost($_POST, 'st_agenda');
    }
    
    if($G_MEC->recebePost($_POST, 'st_fatur')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Faturamento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $st_fatur = $G_MEC->recebePost($_POST, 'st_fatur');
    }
        
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
    $where.= ' and t0006.st_agenda in '.$G_MEC->TrataStringEnum($st_agenda);
    $where.= ' and t0006.st_fatur in '.$G_MEC->TrataStringEnum($st_fatur);
    $where.= ' and substr(t0006.cd_agenda,1,8) = '.$G_MEC->TrataString($G_MEC->FormataDataTiraBarraInverte($dt_atend));
    
    if($G_MEC->recebePost($_POST, 'cd_prof') != NULL){
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
        $where.= ' and t0006.cd_prof = '.$G_MEC->TrataStringEnum($cd_prof);
    }
    
    if($G_MEC->recebePost($_POST, 'cd_espld_medc') != NULL){
        $cd_espld_medc = $G_MEC->recebePost($_POST, 'cd_espld_medc');
        $where.= ' and t0006.cd_espld_medc = '.$G_MEC->TrataStringEnum($cd_espld_medc);
    }

    $orderBy = 'Order By t0014.nm_pac, t0014.dt_nasc_pac';

    $headers = array(
       'nm_pac' => 'Paciente',
       'dt_nasc_pac' => 'Dt.Nasc.',
       'tp_sexo_pac' => 'Sexo',
       'nm_mae_pac' => 'Mãe',
       'nm_espld_medc' => 'Especialidade'
    );
    $dados = array();
    $rs = SGA_M0006::ListaAgendaPrestador($where,null,$orderBy);
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_agenda'] = $value['cd_agenda'];
            $dados[$key]['nm_pac'] = $value['nm_pac'];
            $dados[$key]['dt_nasc_pac'] = $G_MEC->FormataDatacomBarra($value['dt_nasc_pac']);
            $dados[$key]['tp_sexo_pac'] = $value['tp_sexo_pac'];
            $dados[$key]['nm_mae_pac'] = $value['nm_mae_pac'];
            $dados[$key]['nm_espld_medc'] = $value['nm_espld_medc'];
        }
    }else{
        $dados[0]['nm_pac'] = '';
        $dados[0]['dt_nasc_pac'] = '';
        $dados[0]['tp_sexo_pac'] = '';
        $dados[0]['nm_mae_pac'] = '';
        $dados[0]['nm_espld_medc'] = '';
    }
    $json['ret']=  'true';
    $json['mostra'] = 'false';
    $json['form']=  $G_MEC->recebePost($_POST, 'form');
    $json['msg'] = '';
    $Render = new renderView();
    $opr = @$_POST['opr'];
    $json['dados'] = $Render->renderGrid($dados, $headers, 0, $form, $opr);
    echo json_encode($json);
    exit;        
  
}

function buscaAgenda(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_agenda')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Agenda não Informado!';
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $cd_agenda = $G_MEC->recebePost($_POST, 'cd_agenda');
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
    $where.= ' and t0006.cd_agenda = '.$G_MEC->TrataString($cd_agenda);
    $st_agenda = '1|2';
    $where.= ' and t0006.st_agenda in '.$G_MEC->TrataStringEnum($st_agenda);
    $rs = SGA_M0006::ListaAgendaPrestador($where,null,null);
    if(count($rs)>0){
        $dados = array(
            'cd_agenda'=>$rs[0]['cd_agenda'],
            'cd_espld_medc'=>$rs[0]['cd_espld_medc'],
            'nm_espld_medc'=>$rs[0]['nm_espld_medc'],
            'cd_conselho'=>$rs[0]['cd_conselho'],
            'sg_conselho'=>$rs[0]['sg_conselho'],
            'nr_conselho'=>$rs[0]['nr_conselho'],
            'cd_prof'=>$rs[0]['cd_prof'],
            'nm_prof'=>$rs[0]['nm_prof'],
            'nm_pac'=>$rs[0]['nm_pac'],
            'cd_pac'=>$rs[0]['cd_pac'],
            'tp_sexo_pac'=>$G_MEC->EnumSexo($rs[0]['tp_sexo_pac']),
            'dt_nasc_pac'=>$G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_pac']),
            'nm_mae_pac'=>$rs[0]['nm_mae_pac'],
            'nr_cns_pac'=>$rs[0]['nr_cns_pac']
        );
 
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $dados;
        echo json_encode(array('dados'=>$json));
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Agendamento não Localizado';
        echo json_encode(array('dados'=>$json));
        exit;
    }
    
}

function StatusProntuario($st_prontuario){
    //1-Alocado sem Confirmação,2-Confirmado Arquivo,3-Bloqueado,4-Em movimentação
    switch ($st_prontuario) {
        case 1:
            return 'Não Alocado';
            break;
        case 2:
            return 'Liberado';
            break;
        case 3 :
            return 'Bloqueado';
            break;
        case 4:
            return 'Em movimentação';
            break;
    }
}

?>