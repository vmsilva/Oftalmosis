<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    $form = 'scp_h0013';
    $cd_cnes = 5208706449409;
    
    $nm_arquivo = $_FILES['scp_h0013']['name']['realupload'];
    if(trim(substr($nm_arquivo,-3)) != 'txt'){
        $json['ret']=  'false';
        $json['msg'] = 'Erro: Extensão não permitida para Importação!';
        echo json_encode($json);
        exit;
    }
    
    $G_MEC = new Mecanismo();
    $G_UP->nm_dir_dest = $_FILES['scp_h0013'];
    $G_UP->in_sigla = 'scp';
    $linha = '';

    If($G_UP->Salva()){
        set_time_limit(0);
        $arquivo = fopen ("../../scp/dados/".trim($nm_arquivo), "r");
        $G_MEC->TransacaoInicio();
        while (!feof($arquivo)) {
            $linha = trim(fgets($arquivo));
            if ($linha==null) break;
            //Verificar se Profissinal Existe
            $cd_crm_profs = (int)(Trim(substr($linha,38,8)));
            $cd_consl_regi_trab = Trim(substr($linha,46,2));
            SMG_M0005::setnr_conselho($cd_crm_profs);
            SMG_M0005::setsg_conselho(BuscaNomeConselho($cd_consl_regi_trab));
            $cd_uf = 52;
            SMG_M0005::setcd_uf($cd_uf);
            $rsProf = SMG_M0005::ConsultaCodigoConselhoSigla();
            if(count($rsProf) > 0){
                $cd_prof = $rsProf[0]['cd_prof'];
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Pofissional não Identificado! '.BuscaNomeConselho($cd_consl_regi_trab).'-'.$cd_crm_profs;
                echo json_encode($json);
                exit;
            }
            
            //Verifica Especialidade Médica Tabela de Depara
            SMG_M0018::setcd_empresa($cd_empresa);
            SMG_M0018::setcd_cnes($cd_cnes);
            $cd_espld_medc_cnes = Trim(substr($linha,48,5));
            SMG_M0018::setcd_espld_medc_cnes($cd_espld_medc_cnes);
            $rs = SMG_M0018::ConsultaCodigo();
            if(count($rs) > 0){
                $cd_espld_medc = $rs[0]['cd_espld_medc'];
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Especialidade Médica Inexistente na Tabela de Depara!';
                echo json_encode($json);
                exit;
            }

            //Verifica se dados Paciente Existe
            $cd_pac_cnes = Trim(substr($linha,89,7));
            $nm_pac = Trim(substr($linha,96,50));
            $tp_sexo_pac = Trim(substr($linha,146,1));
            $dt_nasc_pac = Mecanismo::FormataDataTiraBarraInverte(Trim(substr($linha,147,10)));
            $nm_mae_pac = Trim(substr($linha,157,50));
            
            //Verificar se o Paciente já existe na tabela de Depara
            //Se existir, não a necessecidade de cadastrar novamente
            SMG_M0019::setcd_empresa($cd_empresa);
            SMG_M0019::setcd_cnes($cd_cnes);
            SMG_M0019::setcd_pac_cnes($cd_pac_cnes);
            $rsPacSMS = SMG_M0019::ConsultaCodigoSMS();
            if(count($rsPacSMS)<1){
                SMG_M0014::setnm_pac(utf8_encode($nm_pac));
                SMG_M0014::settp_sexo_pac($tp_sexo_pac);
                SMG_M0014::setdt_nasc_pac($dt_nasc_pac);
                SMG_M0014::setnm_mae_pac(utf8_encode($nm_mae_pac));
                $st_pac = 0;
                SMG_M0014::setst_pac($st_pac);
                $rs = SMG_M0014::ValidaInformacaoPaciente();
                if(count($rs)>0){
                    $cd_pais_orig_pac = 10; //Brasil
                    SMG_M0014::setcd_pais_orig_pac($cd_pais_orig_pac);
                    //Município Nascimento Paciente
                    $nm_munic_nasc = str_replace("'", ' ',Trim(substr($linha,582,50)));
                    $sg_uf_nasc = Trim(substr($linha,632,2));
                    SGM_M0003::setnm_munic($nm_munic_nasc);
                    SGM_M0003::setsg_uf($sg_uf_nasc);
                    $rs_nasc = SGM_M0003::ValidaNome();
                    if(count($rs_nasc) > 0){
                        $cd_munic_nasc_pac = $rs_nasc[0]['cd_munic'];
                    }else{
                        $cd_munic_nasc_pac = 520870;
                        //$G_MEC->TransacaoAborta();
    //                    $json['ret']=  'false';
    //                    $json['mostra'] = 'true';
    //                    $json['form']=  $form;
    //                    $json['msg'] = 'Erro: Município Nascimento não Localizado!'.$sg_uf_nasc.'-'.$nm_munic_nasc;
    //                    echo json_encode($json);
                        //exit;
                    }
                    SMG_M0014::setcd_munic_nasc_pac($cd_munic_nasc_pac);
                    SMG_M0014::setcd_munic_nasc_mae_pac('');
                    $cd_pac = $rs[0]['cd_pac'];
                    SMG_M0014::setcd_pac($rs[0]['cd_pac']);
                    SMG_M0014::AlterarPaciente();
                }else{
                    //Se Paciente não existe, realiza a inclusão
                    $nr_cns_pac = Trim(substr($linha,634,15)); //Cartão SUS
                    SMG_M0014::setnr_cns_pac($nr_cns_pac);
                    $cd_pais_orig_pac = 10; //Brasil
                    SMG_M0014::setcd_pais_orig_pac($cd_pais_orig_pac);
                    //Município Nascimento Paciente
                    $nm_munic_nasc = str_replace("'", ' ',Trim(substr($linha,582,50)));
                    $sg_uf_nasc = Trim(substr($linha,632,2));
                    SGM_M0003::setnm_munic($nm_munic_nasc);
                    SGM_M0003::setsg_uf($sg_uf_nasc);
                    $rs_nasc = SGM_M0003::ValidaNome();
                    if(count($rs_nasc) > 0){
                        $cd_munic_nasc_pac = $rs_nasc[0]['cd_munic'];
                    }else{
                        $cd_munic_nasc_pac = 520870;
                        //$G_MEC->TransacaoAborta();
    //                    $json['ret']=  'false';
    //                    $json['mostra'] = 'true';
    //                    $json['form']=  $form;
    //                    $json['msg'] = 'Erro: Município Nascimento não Localizado!'.$sg_uf_nasc.'-'.$nm_munic_nasc;
    //                    echo json_encode($json);
                        //exit;
                    }
                    SMG_M0014::setcd_munic_nasc_pac($cd_munic_nasc_pac);
                    SMG_M0014::setcd_munic_nasc_mae_pac('');
                    //Município Endereço Paciente
                    $nm_munic_end = Trim(substr($linha,237,50));
                    $sg_uf_end = Trim(substr($linha,287,2));
                    SGM_M0003::setnm_munic($nm_munic_end);
                    SGM_M0003::setsg_uf($sg_uf_end);
                    $rs_end = SGM_M0003::ValidaNome();
                    if(count($rs_end) > 0){
                        $cd_munic_pac = $rs_end[0]['cd_munic'];
                    }else{
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Município Endereço não Localizado!'.$sg_uf_end.'-'.$nm_munic_end;
                        echo json_encode($json);
                        exit;
                    }
                    SMG_M0014::setcd_munic_pac($cd_munic_pac);
                    $nm_bairro_end = Trim(substr($linha,289,30));
                    SMG_M0014::setnm_bairro_pac($nm_bairro_end);
                    $nm_logr_end = Trim(substr($linha,319,255));
                    SMG_M0014::setds_logr_pac($nm_logr_end);
                    SMG_M0014::setds_compl_pac('');
                    SMG_M0014::setds_qd_pac('');
                    SMG_M0014::setds_lt_pac('');
                    SMG_M0014::setnr_pac('');
                    $nr_cep_pac = Trim(substr($linha,574,8));
                    SMG_M0014::setnr_cep_pac($nr_cep_pac);
                    $nr_fone_pac_01 = Trim(substr($linha,227,10));
                    SMG_M0014::setnr_fone_pac_01($nr_fone_pac_01);
                    SMG_M0014::setnr_fone_pac_02('');
                    SMG_M0014::setnr_fone_pac_03('');
                    SMG_M0014::setcd_usu_cad_pac($cd_usuario);
                    SMG_M0014::setdt_usu_cad_pac($G_MEC->DataHoje());
                    SMG_M0014::setds_email_pac('');
                    $rsPac = SMG_M0014::Incluir();
                    if($rsPac === false){
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Inserir Paciente! '.$nm_pac;
                        echo json_encode($json);
                        exit();
                    }else{
                        $cd_pac = $rsPac;
                        //Incluir Código na Tabela de Depara SMS x Cerof
                        SMG_M0019::setcd_pac($cd_pac);
                        $cd_pac_cnes = Trim(substr($linha,89,7));
                        SMG_M0019::setcd_empresa($cd_empresa);
                        SMG_M0019::setcd_cnes($cd_cnes);
                        SMG_M0019::setcd_pac_cnes($cd_pac_cnes);
                        $rs_Dep_Con = SMG_M0019::ConsultaCodigo();
                        if(count($rs_Dep_Con)===0){
                            $rs_Dep_Pac = SMG_M0019::Incluir();
                            if(!$rs_Dep_Pac){
                                $G_MEC->TransacaoAborta();
                                $json['ret']=  'false';
                                $json['mostra'] = 'true';
                                $json['form']=  $form;
                                $json['msg'] = 'Erro: Falha ao Inserir Paciente Tabela Depara!';
                                echo json_encode($json);
                                exit();
                            }
                        }
                    }
                }
            }else{
                $cd_pac = $rsPacSMS[0]['cd_pac'];
            }

            //Realizar importação
            SGA_M0006::setcd_empresa($cd_empresa);
            SGA_M0006::setcd_cnes($cd_cnes);
            SGA_M0006::setcd_prof($cd_prof);
            SGA_M0006::setcd_espld_medc($cd_espld_medc);
            $in_local_atend = Trim(substr($linha,53,36));
            SGA_M0006::setin_local_atend($in_local_atend);
            $dt_agen_consu = Mecanismo::FormataDataTiraBarraInverte(Trim(substr($linha,23,10)));
            $date = new DateTime($dt_agen_consu);
            SGA_M0006::setdt_agenda($dt_agen_consu);
            $nr_dia_semana = $date->format('w');
            SGA_M0006::setnr_dia_semana($nr_dia_semana);
            $cd_tp_grade = TipoAgenda(Trim(substr($linha,650,1)));
            SGA_M0006::setcd_tp_grade($cd_tp_grade);
            $nr_id_min = 0;
            SGA_M0006::setnr_id_min($nr_id_min);
            $nr_id_max = 999;
            SGA_M0006::setnr_id_max($nr_id_max);
            $hr_atend = str_replace(':','',Trim(substr($linha,33,5)));
            $hr_ini_atend = '0700';
            SGA_M0006::sethr_ini_atend($hr_ini_atend);
            $hr_fin_atend = '0000';
            SGA_M0006::sethr_fin_atend($hr_fin_atend);
            SGA_M0006::sethr_atend($hr_atend);
            SGA_M0006::setcd_pac($cd_pac);
            $st_agenda = 1; //Status Agendado
            SGA_M0006::setst_agenda($st_agenda);
            $st_atend = 1;
            SGA_M0006::setst_atend($st_atend);
            $cd_usu_ger_agenda = $cd_usuario;
            SGA_M0006::setcd_usu_ger_agenda($cd_usu_ger_agenda);
            $dt_usu_ger_agenda = $G_MEC->DataHoje();
            SGA_M0006::setdt_usu_ger_agenda($dt_usu_ger_agenda);
            $cd_usu_cad_agenda = $cd_usuario;
            SGA_M0006::setcd_usu_cad_agenda($cd_usu_cad_agenda);
            $dt_usu_cad_agenda = $G_MEC->DataHoje();
            SGA_M0006::setdt_usu_cad_agenda($dt_usu_cad_agenda);
            
            $rs = SGA_M0006::VerificarPacienteImportado();
            if(count($rs) == 0){
                $where = 'cd_empresa = '.$G_MEC->TrataString($cd_empresa);
                $where.= ' and substr(cd_agenda,1,8) = '.$G_MEC->TrataString($G_MEC->FormataDataTiraBarraInverte(Trim(substr($linha,23,10))));
                $cd_agenda = $G_MEC->geraMaximoCodigo('cd_agenda', 'cerof.sga_t0006', $where);
                if((int)$cd_agenda == 1){
                    $cd_agenda = (int)$G_MEC->FormataDataTiraBarraInverte(Trim(substr($linha,23,10))).'0001';
                }
                SGA_M0006::setcd_agenda($cd_agenda);
                $rs_imp = SGA_M0006::Importacao();
                if(!$rs_imp){
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Erro ao Importar Agenda Profissional!';
                    echo json_encode($json);
                    exit();
                }
            }
        }
        $G_MEC->TransacaoFinaliza();
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Importação Atendimento Paciente Realizada com Sucesso!';
        echo json_encode($json);
        fclose($arquivo);
        exit();
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Arquivo já Importado!';
        echo json_encode($json);
        exit;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}


Function BuscaNomeConselho($cd_consl){

    switch (intval($cd_consl)) {
        case '0':
            return 'CRM'; // 0 CRM-CR de Medicina
            break;
        case '1':
            return 'CRF'; // 1 CRF-CR de Farmácia
            break;
        case '2':
            return 'CRO'; // 2 CRO-CR de Odontologia
            break;
        case '3':
            return 'CRBM'; // 3 CRBM-CR de Biomedicina
            break;
        case '4':
            return 'CRQ'; // 4 CRQ-CR de Química
            break;
        case '5':
            return 'COREN'; // 5 COREN-CR de Enfermagem
            break;
        case '6':
            return 'CRFa'; // 6 CRFa-CR de Fonoaudiologia
            break;
        case '7':
            return 'CRP'; // 7 CRP-CR de Psicologia
            break;
        case '8':
            return 'CRN'; // 8 CRN-CR de Nutrição
            break;
        case '9':
            return 'CRSS'; // 9 CRSS-CR de Serviço Social
            break;
        case '10':
            return 'CREFITO'; // 10 CREFITO-CR de Fisioterapia e Terapia ocupacional
            break;
        case '11':
            return 'COREN TE'; // 11 COREN TE-CR de Técnico de Enfermagem
            break;
        case '12':
            return 'COREN AE'; // 12 COREN AE-CR de Auxiliar de Enfermagem
            break;
        case '13':
            return 'CREF'; // 13 CREF-CR de Educação Física
            break;
        default:
            $json['ret'] =  'falso';
            $json['msg'] = 'Erro: Conselho Mèdico Não Informada!';
            echo json_encode($json);
            exit;
    }
}

Function TipoAgenda($tp_atend){

    switch ($tp_atend) {
        case '01'://1ª CONSULTA
            return '1';
            break;
        case '02'://RETORNO
            return '2';
            break;
        case '03'://INTERCONSULTA
            return '3';
            break;
        case '04'://RESERVA TÉCNICA
            return '4';
            break;
        case '08'://1ª CONSULTA ANTIGOS
            return '1';
            break;
        case '09'://RETORNO ANTIGOS
            return '2';
            break;
        default:
            $json['ret'] =  'falso';
            $json['msg'] = 'Tipo Agenda '.$tp_atend.' não Encontrado!';
            echo json_encode($json);
            exit();
            break;
    }

}
?>