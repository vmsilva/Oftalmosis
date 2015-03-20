<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'incluir':
            Incluir();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function Incluir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

   if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    if($G_MEC->recebePost($_POST, 'dt_atend')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'dt_atend');
        $json['msg'] = 'Erro: Data de Atendimento não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $dt_atend = $G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_atend'));
    }
    
    //Verificando se foi digitado Grupo de Consulta ou Procedimento
    $DadosGrupoConsulta = $G_MEC->recebePost($_POST, 'DadosGrupoConsulta');
    $DadosProcedimento = $G_MEC->recebePost($_POST, 'DadosProcedimento');
    if(!(count($DadosGrupoConsulta)>0) && !(count($DadosProcedimento)>0)){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Grupo de Consulta ou Procedimento não Informado!';
        echo json_encode($json);
        exit;
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_agenda = $G_MEC->recebePost($_POST, 'cd_agenda');
    $cd_usu_cad_fatur = $_SESSION['cd_usuario_log'];
    $dt_fatur = $G_MEC->DataHoje();
    $hr_fatur = $G_MEC->HoraHoje();
    
    //Montar o Array de Procedimentos a ser Incluído
    //1 - Verificar se há grupo de consulta, e quais seus procedimentos
    $Procedimentos = Array();
    $p = 0;
    if((count($DadosGrupoConsulta)>0)){
        foreach ($DadosGrupoConsulta as $key => $value) {
            $aux = explode('-',$value);
            SGA_M0002::setcd_empresa($cd_empresa);
            $cd_grp_consulta = $aux[0];
            SGA_M0002::setcd_grp_consulta($cd_grp_consulta);
            $rsGrpCons = SGA_M0002::ConsultaGrupoConsulta();
            foreach ($rsGrpCons as $k => $v) {
                $i = 1;
                $sinal = TRUE;
                while ($sinal){
                    $Procedimentos['cd_procd_medc'][$p] = $v['cd_procd_medc'];
                    if($v['nr_qtde_procd_medc'] == $i){
                        $sinal = false;
                    }
                    $i++;
                    $p++;
                }
            }
        }
    }

    //2 - Verificar se há procedimento
    if((count($DadosProcedimento)>0)){
        foreach ($DadosProcedimento as $key => $value) {
            $aux = explode('-',$value);
            $Procedimentos['cd_procd_medc'][$p] = $aux[0];
            $p++;
        }
    }
    
    ///Futuramente essa regra deve ser alterada para pacientes Atendidos e não agendado
    if(is_numeric($cd_agenda)){
        //Realizar a Inclusão de Agendamento
        ///Buscar Agendamento
        $where = 't0006.cd_empresa = '.$G_MEC->TrataString($cd_empresa);
        $where.= ' and t0006.cd_agenda = '.$G_MEC->TrataString($cd_agenda);
        $where.= ' and t0006.st_fatur in '.$G_MEC->TrataStringEnum('0');
        $rs = SGA_M0006::ListaAgendaPrestador($where);
        if(count($rs)>0){
            $G_MEC->TransacaoInicio();
            //Incluir Tabela sft.t0001 -> Cabeçalho do faturamento
            SFT_M0001::setcd_empresa($cd_empresa);
            SFT_M0001::setcd_agenda($cd_agenda);
            SFT_M0001::setcd_cnes($rs[0]['cd_cnes']);
            SFT_M0001::setcd_prof($rs[0]['cd_prof']);
            SFT_M0001::setcd_espld_medc($rs[0]['cd_espld_medc']);
            SFT_M0001::setcd_pac($rs[0]['cd_pac']);
            SFT_M0001::setdt_atend($dt_atend);
            SFT_M0001::setdt_fatur($dt_fatur);
            SFT_M0001::sethr_fatur($hr_fatur);
            SFT_M0001::setcd_usu_cad_fatur($cd_usu_cad_fatur);
            $rsIncluir = SFT_M0001::Incluir();
            if($rsIncluir != false){
                //Incluir Tabela sft.t0002 -> Procedimentos do faturamento
                SFT_M0002::setcd_empresa($cd_empresa);
                SFT_M0002::setcd_fatur_bpa($rsIncluir);
                $i = 0;
                foreach ($Procedimentos['cd_procd_medc'] as $key => $value) {
                    SFT_M0002::setcd_procd_medc($value);
                    if(!SFT_M0002::Incluir()){
                       $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Inserir Registro na tabela sft-t0002!';
                        echo json_encode($json);
                        exit; 
                    }
                    $i++;
                }
                //Baixar Pedido da Agenda
                SGA_M0006::setcd_empresa($cd_empresa);
                SGA_M0006::setcd_agenda($cd_agenda);
                $st_fatur = 1;
                SGA_M0006::setst_fatur($st_fatur);
                if(!SGA_M0006::mudarStatusFatur()){
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Alterar Status Faturado na tabela sga-t0006!';
                    echo json_encode($json);
                    exit; 
                }
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Sucesso: Registro Incluído com Sucesso!';
                echo json_encode(array('dados'=>$json));
                $G_MEC->TransacaoFinaliza();
                exit; 
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Inserir Registro na tabela sft-t0001!';
                echo json_encode($json);
                exit;
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Registro já Faturado ou não Encontrado na tabela!';
            echo json_encode($json);
            exit;
        }
    }else{
        //Realizar a Inclusão de Não Agendados
        //Incluir Tabela sft.t0001 -> Cabeçalho do faturamento
        $G_MEC->TransacaoInicio();
        $cd_cnes = $G_MEC->recebePost($_POST, 'cd_cnes');
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
        $cd_espld_medc = $G_MEC->recebePost($_POST, 'cd_espld_medc');
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
        SFT_M0001::setcd_empresa($cd_empresa);
        if(!is_numeric($cd_cnes)){
            $cd_cnes = '5208706449409';
        }
        SFT_M0001::setcd_cnes($cd_cnes);
        SFT_M0001::setcd_prof($cd_prof);
        SFT_M0001::setcd_espld_medc($cd_espld_medc);
        SFT_M0001::setcd_pac($cd_pac);
        SFT_M0001::setdt_atend($dt_atend);
        SFT_M0001::setdt_fatur($dt_fatur);
        SFT_M0001::sethr_fatur($hr_fatur);
        SFT_M0001::setcd_usu_cad_fatur($cd_usu_cad_fatur);
        $rsIncluir = SFT_M0001::Incluir();
        if($rsIncluir != false){
            //Incluir Tabela sft.t0002 -> Procedimentos do faturamento
            SFT_M0002::setcd_empresa($cd_empresa);
            SFT_M0002::setcd_fatur_bpa($rsIncluir);
            $i = 0;
            foreach ($Procedimentos['cd_procd_medc'] as $key => $value) {
                SFT_M0002::setcd_procd_medc($value);
                if(!SFT_M0002::Incluir()){
                   $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Inserir Registro na tabela sft-t0002!';
                    echo json_encode($json);
                    exit; 
                }
                $i++;
            }

            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Registro Incluído com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit; 
        }
    }
}
