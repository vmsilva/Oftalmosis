<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'incluir':
            break;
        case 'buscar':
            BuscaLaudo();
            break;
        default: 
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function Incluir(){}

function BuscaLaudo(){
    
    $G_MEC = new Mecanismo;
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $form = $G_MEC->recebePost($_POST, 'form');
    $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
    
    if( $form === NULL || $form === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if(trim($cd_procd_medc)== ''|| trim($cd_procd_medc) == NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Procedimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    SGA_M0013::setcd_empresa($cd_empresa);
    SGA_M0013::setcd_procd_medc($cd_procd_medc);
    $rs = SGA_M0013::BuscaProcdLaudo();
    
    if(count($rs)>0){
        $json['ret'] =  'true';
        $json['dados'] = array(
            'ds_olho_dir'=>$rs[0]['ds_olho_dir'],
            'ds_olho_esq'=>$rs[0]['ds_olho_esq'],
            'ds_conclusao'=>$rs[0]['ds_conclusao'],            
        );
        
            echo json_encode($json);
            exit();
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Procedimento não Possui um Template!';
        echo json_encode(array('dados'=>$json));
        exit(); 
    }
}
