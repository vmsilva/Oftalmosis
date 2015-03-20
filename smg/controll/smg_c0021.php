<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch ($_POST['opr']) {
        case 'confirmar':
            Confirmar();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}


function Confirmar(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(trim($G_MEC->recebePost($_POST, 'form')) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        return false;
    }
    if(trim($G_MEC->recebePost($_POST, 'cd_pac_cnes')) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente SMS não Informado!';
        echo json_encode(array('dados'=>$json));
        return false;
    }
    if(trim($G_MEC->recebePost($_POST, 'cd_pac_ant')) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente Anterior não Informado!';
        echo json_encode(array('dados'=>$json));
        return false;
    }
    if(trim($G_MEC->recebePost($_POST, 'cd_pac_novo')) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente Novo não Informado!';
        echo json_encode(array('dados'=>$json));
        return false;
    }
    if(trim($G_MEC->recebePost($_POST, 'nr_prontuario')) == ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Número Prontuário Paciente Novo não Informado!';
        echo json_encode(array('dados'=>$json));
        return false;
    }

    $cd_pac_cnes = trim($G_MEC->recebePost($_POST, 'cd_pac_cnes'));
    $cd_pac_ant = trim($G_MEC->recebePost($_POST, 'cd_pac_ant'));
    $cd_pac_novo = trim($G_MEC->recebePost($_POST, 'cd_pac_novo'));
    $nr_prontuario = trim($G_MEC->recebePost($_POST, 'nr_prontuario'));
    
    $G_MEC->TransacaoInicio();
    SMG_M0014::setcd_pac($cd_pac_ant);
    $st_pac = 0;
    SMG_M0014::setst_pac($st_pac);
    if(is_array(SMG_M0014::consultaCodigo())){
        SMG_M0014::setcd_pac($cd_pac_novo);
        $st_pac = 0;
        SMG_M0014::setst_pac($st_pac);
        if(is_array(SMG_M0014::consultaCodigo())){
            
            $cd_empresa = $_SESSION['cd_empresa_usu'];
            
            SMG_M0021::setcd_empresa($cd_empresa);
            SMG_M0021::setcd_pac_cnes($cd_pac_cnes);
            SMG_M0021::setcd_pac_ant($cd_pac_ant);
            SMG_M0021::setcd_pac_novo($cd_pac_novo);
            SMG_M0021::setnr_prontuario($nr_prontuario);
            $cd_usuario = $_SESSION['cd_usuario_log'];
            SMG_M0021::setcd_usuario($cd_usuario);
            SMG_M0021::setdt_alt_pac($G_MEC->DataHoje());
            SMG_M0021::sethr_alt_pac($G_MEC->HoraHoje());

            //Modulo SGS
            //Tabela da Agenda sga_t0006
            if(!SMG_M0021::Alterar_SGA_T0006()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao registra tabela sga/t0006! - Contate o Suporte Técnico';
                echo json_encode(array('dados'=>$json));
                return false;
            }
            
            //Tabela da Atendimento sga_t0007
            SMG_M0021::Alterar_SGA_T0007();
//            if(!SMG_M0021::Alterar_SGA_T0007()){
//                $G_MEC->TransacaoAborta();
//                $json['ret']=  'false';
//                $json['mostra'] = 'true';
//                $json['form']=  $G_MEC->recebePost($_POST, 'form');
//                $json['msg'] = 'Erro: Falha ao registra tabela sga/t0007! - Contate o Suporte Técnico';
//                echo json_encode(array('dados'=>$json));
//                return false;
//            }
            
            //Modulo SMG
            //Tabela de Paciente smg_t0014
            if(!SMG_M0021::Alterar_SMG_T0014()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao registra tabela smg/t0014! - Contate o Suporte Técnico';
                echo json_encode(array('dados'=>$json));
                return false;
            }
            
            //Tabela de Paciente Depara smg_t0019
            if(!SMG_M0021::Alterar_SMG_T0019()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao registra tabela sga/t0019! - Contate o Suporte Técnico';
                echo json_encode(array('dados'=>$json));
                return false;
            }
                        
            //Tabela de Log Unificação Paciente smg_t0021
            if(!SMG_M0021::Incluir_SMG_T0021()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao registra tabela sga/t0019! - Contate o Suporte Técnico';
                echo json_encode(array('dados'=>$json));
                return false;
            }else{
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Registro Alterado com Sucesso!';
                echo json_encode(array('dados'=>$json));
                return false;
            }
           
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Paciente com Prontuário não Localizado!';
            echo json_encode(array('dados'=>$json));
            return false;
        }
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Paciente sem Prontuário não Localizado!';
        echo json_encode(array('dados'=>$json));
        return false;
    }
}
?>
