<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'incluir':
            Incluir();
            break;
        case 'buscalaudo':
            BuscaLaudo();
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
        
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $form = $G_MEC->recebePost($_POST, 'form');    
    $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
    $cd_pac  = $G_MEC->recebePost($_POST, 'cd_pac');
    $cd_ex_laudo = $G_MEC->recebePost($_POST, 'cd_ex_laudo');
    $ds_olho_dir = $G_MEC->recebePost($_POST, 'ds_olho_dir');
    $ds_olho_esq = $G_MEC->recebePost($_POST, 'ds_olho_esq');
    $ds_conclusao = $G_MEC->recebePost($_POST, 'ds_conclusao');
    
    
    if( $form === NULL || $form === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $cd_procd_medc === NULL || $cd_procd_medc === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Procedimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $cd_pac === NULL || $cd_pac === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Paciente não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
        
    
    if( $ds_olho_dir === NULL || $ds_olho_dir === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Olho Direito não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $ds_olho_esq === NULL || $ds_olho_esq === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Olho Esquerdo não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $ds_conclusao === NULL || $ds_conclusao === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Conclusão não Informada!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    SGA_M0008::setcd_empresa($cd_empresa);
    SGA_M0008::setcd_procd_medc($cd_procd_medc);
    SGA_M0008::setcd_pac($cd_pac);
    SGA_M0008::setds_olho_dir($ds_olho_dir);
    SGA_M0008::setds_olho_esq($ds_olho_esq);
    SGA_M0008::setds_conclusao($ds_conclusao);  
    
    
    $G_MEC->TransacaoInicio();
    
    $rs = SGA_M0008::Incluir();
    if($rs['sinal']){                
        $G_MEC->TransacaoFinaliza();
        $json['ret']=  'true';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Laudo Cadastrado com Sucesso!';
        $json['dados'] = $rs;
        
        echo json_encode(array('dados'=>$json));
        exit();
    }else{
        $G_MEC->TransacaoAborta();
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Laudo não Cadastrado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
}

function BuscaLaudo(){
//    
//    $G_MEC = new Mecanismo();
//    require_once '../../sca/controll/validaSessao.php';
//    
//            
//    $cd_empresa = $_SESSION['cd_empresa_usu'];
//    $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
//    $cd_ex_laudo = $G_MEC->recebePost($_POST, 'cd_ex_laudo');
//    $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
//    $ds_olho_dir = $G_MEC->recebePost($_POST, 'ds_olho_dir');
//    $ds_olho_esq = $G_MEC->recebePost($_POST, 'ds_olho_esq');
//    $ds_conclusao = $G_MEC->recebePost($_POST, 'ds_conclusao');
//    
//    
//    if(trim($cd_empresa) == NULL || trim($cd_empresa) == ''){
//        $json['ret']=  'false';
//        $json['mostra'] = 'true';
//        $json['form']=  $form;
//        $json['msg'] = 'Erro: Código Empresa não Informado!';
//        echo json_encode(array('dados'=>$json));
//        exit();    
//    }
//    if(trim($cd_pac) == NULL || trim($cd_pac) == ''){
//        $json['ret']=  'false';
//        $json['mostra'] = 'true';
//        $json['form']=  $form;
//        $json['msg'] = 'Erro: Código Paciente não Informado!';
//        echo json_encode(array('dados'=>$json));
//        exit(); 
//    }    
//    if(trim($cd_procd_medc) == NULL || trim($cd_procd_medc) == ''){
//        $json['ret']=  'false';
//        $json['mostra'] = 'true';
//        $json['form']=  $form;
//        $json['msg'] = 'Erro: Código Procedimento não Informado!';
//        echo json_encode(array('dados'=>$json));
//        exit(); 
//    }
//    
//    SGA_M0008::setcd_empresa($cd_empresa);
//    SGA_M0008::setcd_procd_medc($cd_procd_medc);
//    SGA_M0008::setcd_pac($cd_pac);
//    SGA_M0008::setds_olho_dir($ds_olho_dir);
//    SGA_M0008::setds_olho_esq($ds_olho_esq);
//    SGA_M0008::setds_conclusao($ds_conclusao);
//    
//    $rs = SGA_M0008::buscarLaudo();
//    
//    
//    if(count($rs)>0){
//        $dados = array(
//            'cd_pac'=>$rs['0']['cd_pac'],
//            'cd_procd_medc'=>$rs['0']['cd_procd_medc'],
//            'cd_ex_laudo'=>$rs['0']['cd_ex_laudo'],
//            'ds_olho_dir'=>$rs['0']['ds_olho_dir'],
//            'ds_olho_esq'=>$rs['0']['ds_olho_esq'],
//            'ds_conclusao'=>$rs['0']['ds_conclusao']            
//        );
//        
//        $json['ret']=  'true';
//        $json['mostra'] = 'false';
//        $json['form']=  $form;
//        $json['msg'] = 'Sucesso: Grupo Localizada com Sucesso!';
//        $json['dados'] = $dados;
//        echo json_encode($json);
//        exit;
//    }else{
//        $json['ret']=  'false';
//        $json['mostra'] = 'true';
//        $json['form']=  $form;
//        $json['msg'] = 'Erro: Laudo não Localizado!';
//        echo json_encode(array('dados'=>$json));
//        exit();
//    }    
}
