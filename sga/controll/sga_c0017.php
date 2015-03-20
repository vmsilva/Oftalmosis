<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'incluir':
            Incluir();
            break;
        case 'excluir':
            
            break;
        case 'listar':
            Listar();
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
    
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    $form = $G_MEC->recebePost($_POST, 'form');
    $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
    $dt_exc_procd = $G_MEC->recebePost($_POST, 'dt_exc_procd');
    $ds_exc_procd = $G_MEC->recebePost($_POST, 'ds_exc_procd');
    $dt_exc_procd = Mecanismo::FormataDataSemBarra($dt_exc_procd);   
       
    
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
        $json['msg'] = 'Erro: Código do Procedimento não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $dt_exc_procd === NULL || $dt_exc_procd === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Data não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $ds_exc_procd === NULL || $ds_exc_procd === ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Descrição não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    if( $dt_exc_procd < Mecanismo::DataHoje()){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Data a ser exclusa não pode ser menor que Data de hoje!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    
    SGA_M0017::setcd_empresa($cd_empresa);    
    SGA_M0017::setcd_usu_cad_exc_procd($cd_usuario);
    SGA_M0017::setcd_procd_medc($cd_procd_medc);
    SGA_M0017::setdt_exc_procd($dt_exc_procd);
    SGA_M0017::setds_exc_procd($ds_exc_procd);
    
    Mecanismo::TransacaoInicio();
    
    $rsBusca = SGA_M0017::Listar();
   
    if(count($rsBusca)>0){
        
        Mecanismo::TransacaoAborta();
        
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Procedimento já Possui Excessão Nessa Data!';
        echo json_encode(array('dados'=>$json));
        exit();
        
    }else{
        
        $rs = SGA_M0017::Incluir();
    
        if($rs){
            
            Mecanismo::TransacaoFinaliza();
            
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Data Exclusa da Grade!';
            echo json_encode(array('dados'=>$json));
            exit(); 
        }else{
            
            Mecanismo::TransacaoAborta();
            
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Data não pode ser Exclusa!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }
        
    
}
function Excluir(){}
function Listar(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }    
    
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0017::setcd_empresa($cd_empresa);
    $rs = SGA_M0017::Listar();
    
    foreach ($rs as $key => $valor){        
       $rs[$key]['dt_exc_procd'] = Mecanismo::FormataDatacomBarra($rs[$key]['dt_exc_procd']);
    }
        
    $headers = array('cd_procd_medc'=>'Código', 'nm_procd_medc'=>'Nome Procedimento', 'dt_exc_procd'=>'Data');
    $Render = new renderView();

    $html = $Render->renderGrid($rs, $headers, '0', strtolower($_POST['url']), strtolower($_POST['opr']));
   
    $json['html'] = $html;

    echo json_encode(array('dados'=>$json));

    exit;
}

?>