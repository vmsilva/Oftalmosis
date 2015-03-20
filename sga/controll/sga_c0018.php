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

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }
    
    if($G_MEC->recebePost($_POST, 'cd_serv_painel')=== NULL || $G_MEC->recebePost($_POST, 'cd_serv_painel')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Serviço não Informado!';
        echo json_encode($json);
        return false;
    }
    

    if($G_MEC->recebePost($_POST, 'in_chamada_pref')=== NULL || $G_MEC->recebePost($_POST, 'in_chamada_pref')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Situação do Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    
    if($G_MEC->recebePost($_POST, 'in_nome_pac')=== NULL || $G_MEC->recebePost($_POST, 'in_nome_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_serv_painel = $G_MEC->recebePost($_POST, 'cd_serv_painel');
    $in_chamada_pref = $G_MEC->recebePost($_POST, 'in_chamada_pref');
    $in_nome_pac = $G_MEC->recebePost($_POST, 'in_nome_pac');
    //Verificar última senha gerada
    
    $G_MEC->TransacaoInicio();
    SGA_M0013::setcd_empresa($cd_empresa);
    $st_serv_painel = 0;
    SGA_M0013::setst_serv_painel($st_serv_painel);
    SGA_M0013::setcd_serv_painel($cd_serv_painel);
    $rs = SGA_M0013::ConsultaServico();
    if(count($rs)){
        SGA_M0015::setcd_empresa($cd_empresa);
        SGA_M0015::setcd_serv_painel($cd_serv_painel);
        SGA_M0015::setdt_chamada($G_MEC->DataHoje());
        $in_serv_letra = $rs[0]['in_serv_letra'];
        SGA_M0015::setin_serv_letra($in_serv_letra);
        SGA_M0015::setin_chamada_pref($in_chamada_pref);
        SGA_M0015::setin_nome_pac($in_nome_pac);
        $st_chamada = 0;
        SGA_M0015::setst_chamada($st_chamada);
        $hr_chamada = $G_MEC->HoraHoje();
        SGA_M0015::sethr_chamada($hr_chamada);
        $cd_usu_cad = $_SESSION['cd_usuario_log'];
        SGA_M0015::setcd_usu_cad($cd_usu_cad);
        $rsInc = SGA_M0015::incluir();
        if(is_array($rsInc)){

            $G_MEC->TransacaoFinaliza();
        
            $dados['sistema'] = $rsInc['in_serv_letra'];
            $dados['senha'] = $rsInc['in_chamada_pref'].str_pad($rsInc['cd_senha'], 4, 0, STR_PAD_LEFT);
        
            $dados['ret']=  'true';
            $dados['mostra'] = 'true';
            $dados['form']=  $form;
            $json['dados'] = $dados;
            echo json_encode($json);
            exit();

        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Incluir Chamada!';
            echo json_encode($json);
            exit();
        }
    }else{
        $G_MEC->TransacaoAborta();
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Serviço não localizado!';
        echo json_encode($json);
        exit();
    }
    

}