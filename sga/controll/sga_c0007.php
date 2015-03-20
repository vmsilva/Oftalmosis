<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'incluir':
            Incluir();
            break;
        case 'excluir':
            Excluir();
            break;
        case 'listafilaatendimento':
            listaFilaAtendimento();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function Incluir(){
    
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
    
    if($G_MEC->recebePost($_POST, 'tp_atend') === NULL || $G_MEC->recebePost($_POST, 'tp_atend')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Tipo Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'in_servico') === NULL || $G_MEC->recebePost($_POST, 'in_servico')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Serviço do Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'cd_cnes') === NULL || $G_MEC->recebePost($_POST, 'cd_cnes')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Unidade não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'cd_espld_medc') === NULL || $G_MEC->recebePost($_POST, 'cd_espld_medc')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Especialidade não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'cd_pac') === NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $G_MEC->TransacaoInicio();
 
    $tp_atend  = $G_MEC->recebePost($_POST, 'tp_atend');
    $in_servico  = $G_MEC->recebePost($_POST, 'in_servico');
    $cd_cnes  = $G_MEC->recebePost($_POST, 'cd_cnes');
    $cd_espld_medc  = $G_MEC->recebePost($_POST, 'cd_espld_medc');
    $cd_pac  = $G_MEC->recebePost($_POST, 'cd_pac');
    if(($tp_atend == 0) && ($in_servico == 0)){
        if($G_MEC->recebePost($_POST, 'cd_prof') === NULL || $G_MEC->recebePost($_POST, 'cd_prof')=== ''){
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Profissional não Informado!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
        $cd_prof  = $G_MEC->recebePost($_POST, 'cd_prof');
        SGA_M0007::setcd_prof($cd_prof);
        $cd_agenda = $G_MEC->recebePost($_POST, 'cd_agenda');
        SGA_M0007::setcd_agenda($cd_agenda);
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usu_cad_fila = $_SESSION['cd_usuario_log'];
    SGA_M0007::setcd_empresa($cd_empresa);
    //Verificar se o Paciente se encontra na fila em atendimento
    $st_fila = '0|1';//Aguardando Atendimento
    SGA_M0007::setst_fila($st_fila);
    SGA_M0007::setcd_pac($cd_pac);
    SGA_M0007::setdt_atend($G_MEC->DataHoje());
    $rs = SGA_M0007::listaFilaStatus();
    if(count($rs)<1){
        //Inclusão na Fila
        SGA_M0007::setcd_cnes($cd_cnes);
        SGA_M0007::setcd_espld_medc($cd_espld_medc);
        SGA_M0007::settp_atend($tp_atend);
        SGA_M0007::setin_servico($in_servico);
        SGA_M0007::sethr_cheg($G_MEC->HoraHoje());
        $st_fila = 0;//Aguardando Atendimento
        SGA_M0007::setst_fila($st_fila);
        SGA_M0007::setcd_usu_cad_fila($cd_usu_cad_fila);
        SGA_M0007::setdt_usu_cad_fila($G_MEC->DataHoje());
        if(SGA_M0007::Incluir()){
            if($G_MEC->recebePost($_POST, 'cd_agenda') != NULL || is_numeric($G_MEC->recebePost($_POST, 'cd_agenda'))){
                SGA_M0006::setcd_empresa($cd_empresa);
                $cd_agenda = $G_MEC->recebePost($_POST, 'cd_agenda');
                SGA_M0006::setcd_agenda($cd_agenda);
                $st_agenda = '2'; //Confirmado
                SGA_M0006::setst_agenda($st_agenda);
                SGA_M0006::setcd_usu_alt_agenda($cd_usu_cad_fila);
                SGA_M0006::setdt_usu_alt_agenda($G_MEC->DataHoje());
                if(!SGA_M0006::mudarStatusAgenda()){
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Falha ao Baixar Registro da Agenda!';
                    echo json_encode(array('dados'=>$json));
                    exit();
                }
            }
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Registro Incluído com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit();
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Falha ao Incluír Registro!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }else{
        $G_MEC->TransacaoAborta();
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Paciente já se encontra na Fila!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
}

function Excluir(){
    
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
    
    if($G_MEC->recebePost($_POST, 'cd_fila') === NULL || $G_MEC->recebePost($_POST, 'cd_fila')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Fila de Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    
    if($G_MEC->recebePost($_POST, 'cd_pac') === NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
 
    $cd_fila  = $G_MEC->recebePost($_POST, 'cd_fila');
    $cd_pac  = $G_MEC->recebePost($_POST, 'cd_pac');  
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usu_cad_fila = $_SESSION['cd_usuario_log'];
    $G_MEC->TransacaoInicio();
    //Verificar se o Paciente se encontra na fila em atendimento
    SGA_M0007::setcd_empresa($cd_empresa);
    SGA_M0007::setcd_fila($cd_fila);
    $st_fila = '0';//Aguardando Atendimento
    SGA_M0007::setst_fila($st_fila);
    SGA_M0007::setcd_pac($cd_pac);
    SGA_M0007::setdt_atend($G_MEC->DataHoje());
    $rs = SGA_M0007::listaFilaStatus();
    if(count($rs)>0){
        //Paciente Urgência
        if($rs[0]['tp_atend'] == 1){
            if(SGA_M0007::Excluir()){
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Paciente Excluído com Sucesso da Fila de Atendimento!';
                echo json_encode(array('dados'=>$json));
                exit();
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Excluir Paciente da Fila de Atendimento!';
                echo json_encode(array('dados'=>$json));
                exit();
            }
        }else{
            SGA_M0006::setcd_empresa($cd_empresa);
            $cd_agenda = $rs[0]['cd_agenda'];
            SGA_M0006::setcd_agenda($cd_agenda);
            $st_agenda = '1'; //Agendado
            SGA_M0006::setst_agenda($st_agenda);
            SGA_M0006::setcd_usu_alt_agenda($cd_usu_cad_fila);
            SGA_M0006::setdt_usu_alt_agenda($G_MEC->DataHoje());
            if(!SGA_M0006::mudarStatusAgenda()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Falha ao Baixar Registro da Agenda!';
                echo json_encode(array('dados'=>$json));
                exit();
            }
            if(SGA_M0007::Excluir()){
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Paciente Excluído com Sucesso da Fila de Atendimento!';
                echo json_encode(array('dados'=>$json));
                exit();
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Excluir Paciente da Fila de Atendimento!';
                echo json_encode(array('dados'=>$json));
                exit();
            }
        }
    //Paciente Ambulatório
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Paciente não se encontra na Fila!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
}

Function listaFilaAtendimento(){
    
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
        
    if($G_MEC->recebePost($_POST, 'in_servico') === NULL || $G_MEC->recebePost($_POST, 'in_servico')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Serviço do Atendimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $in_servico  = $G_MEC->recebePost($_POST, 'in_servico');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usu_cad_fila = $_SESSION['cd_usuario_log'];
    SGA_M0007::setcd_empresa($cd_empresa);
    //Verificar se o Paciente se encontra na fila em atendimento
    $st_fila = '0|1';//Aguardando Atendimento
    SGA_M0007::setst_fila($st_fila);
    SGA_M0007::setdt_atend($G_MEC->DataHoje());

    $opr = @$_POST['opr'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $Render = new renderView();
    $headers = array(
        'tp_atend'=>'Atendimento',
        'nm_pac_red'=>'Paciente',
        'tp_sexo_pac_red'=>'Sexo',
        'dt_nasc_pac'=>'Dt.Nasc.',
        'hr_cheg'=>'Hora',
        'nm_espld_medc'=>'Especialidade',
        );
    $dados = array();
    $rs = SGA_M0007::listaFilaStatus();
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            $dados[$key]['cd_fila'] = $value['cd_fila'];
            if($value['tp_atend'] == 0){
                $dados[$key]['tp_atend'] = 'Ambulatório';
            }else{
                $dados[$key]['tp_atend'] = 'Urgência';
            }
            if(strlen($value['nm_pac'])>30){
                $dados[$key]['nm_pac_red'] = substr($value['nm_pac'],0,32).'...';
            }else{
                $dados[$key]['nm_pac_red'] = $value['nm_pac'];
            }
            $dados[$key]['cd_pac'] = $value['cd_pac'];
            $dados[$key]['nm_pac'] = $value['nm_pac'];
            $dados[$key]['nm_mae_pac'] = $value['nm_mae_pac'];
            $dados[$key]['tp_sexo_pac_red'] = $value['tp_sexo_pac'];
            ($value['tp_sexo_pac'] == 'M') ? $dados[$key]['tp_sexo_pac'] = 'Masculino' : $dados[$key]['tp_sexo_pac'] = 'Feminino';
            $dados[$key]['dt_nasc_pac'] = $G_MEC->FormataDatacomBarra($value['dt_nasc_pac']);
            $dados[$key]['nr_cns_pac'] = $value['nr_cns_pac'];
            $dados[$key]['hr_cheg'] = $G_MEC->FormataHora($value['hr_cheg']);
            if(strlen($value['nm_espld_medc'])>30){
                $dados[$key]['nm_espld_medc'] = $value['cd_espld_medc'].'-'.substr($value['nm_espld_medc'],0,35).'...';
            }else{
                $dados[$key]['nm_espld_medc'] = $value['cd_espld_medc'].'-'.$value['nm_espld_medc'];
            }
        }
    }else{
        $dados[0] = array(
        'tp_atend'=>'',
        'nm_pac_red'=>'',
        'tp_sexo_pac_red'=>'',
        'dt_nasc_pac'=>'',
        'hr_cheg'=>'',
        'nm_espld_medc'=>'',
        );
    }
    echo $Render->renderGrid($dados, $headers, $inputBusca, $form, $opr);
}