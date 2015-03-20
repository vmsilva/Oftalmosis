<?php session_start();

include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'listanome':
            listaNome();
            break;
        case 'consultanome':
            ConsultaNome();
            break;
        case 'incluir':
            Incluir();
            break;
        case 'alterar':
            Alterar();
            break;
        case 'excluir':
            Excluir();
            break;
        case 'buscacodigo':
            pesquisaCodigoGrupoConsulta();
            break;
		case 'consultacodigogrupoconsulta':
            consultaCodigoGrupoConsulta();
            break;
        case 'consultanomegrupoconsulta':
            consultaNomeGrupoConsulta();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function listaNome(){
    
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
    
    if($G_MEC->recebePost($_POST, 'st_grp_consulta')=== NULL || $G_MEC->recebePost($_POST, 'st_grp_consulta')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Grupo Consulta não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');
     
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    
    $rs = SGA_M0001::ConsultaNome();
    $headers = array('cd_grp_consulta'=>'Código', 'nm_grp_consulta'=>'Descrição');
    $Render = new renderView();
    
    $html = $Render->renderGrid($rs, $headers, '0', strtolower($_POST['url']), strtolower($_POST['opr']));
    $json['html'] = $html;
    echo json_encode(array('dados'=>$json));
    
    exit();
}

function consultaNome(){
    
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
    
    if($G_MEC->recebePost($_POST, 'st_grp_consulta')=== NULL || $G_MEC->recebePost($_POST, 'st_grp_consulta')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Grupo Consulta não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');
    $opr = $G_MEC->recebePost($_POST, 'opr');
     
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    
    $rs = SGA_M0001::ConsultaNome();
    $headers = array('cd_grp_consulta'=>'Código', 'nm_grp_consulta'=>'Descrição');
    $Render = new renderView();
    
    echo $Render->renderGrid($rs, $headers, $inputBusca, $form, $opr);

    exit();
}

// Função Incluir Grupo Consulta!

function Incluir(){
    
    $G_MEC = new Mecanismo();
    
    if($G_MEC->recebePost($_POST, 'form') === NULL || $G_MEC->recebePost($_POST, 'form')===''){
        $json['ret']= 'false';
        $json['mostra']= 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    $nm_grp_consulta = $G_MEC->recebePost($_POST, 'nm_grp_consulta');
    if(trim($nm_grp_consulta)== ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Nome Grupo não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');
    if(trim($st_grp_consulta)== ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Status Grupo não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setnm_grp_consulta($nm_grp_consulta);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    
    $cd_usu_cad_grp_consulta = $_SESSION['cd_usuario_log'];
    SGA_M0001::setcd_usu_cad_grp_consulta($cd_usu_cad_grp_consulta);
    $dt_usu_cad_grp_consulta = $G_MEC->DataHoje();
    SGA_M0001::setdt_usu_cad_grp_consulta($dt_usu_cad_grp_consulta);
    $rsConsulta = SGA_M0001::ConsultaNome();
    if(count($rsConsulta)>0){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Nome Grupo de Consulta já existe na Base de Dados!';
        echo json_encode(array('dados'=>$json));
        exit();
    }else{
        $rs = SGA_M0001::Incluir();
        if($rs){
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Sucesso: Grupo de Consulta Incluído com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit();
        }else{
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Falha ao Inserir Grupo de Consulta!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }

}

// Função Alterar Grupo Consulta
function Alterar(){
    
    $G_MEC = new Mecanismo();
    
    if($G_MEC->recebePost($_POST, 'form') === NULL || $G_MEC->recebePost($_POST, 'form')===''){
        $json['ret']= 'false';
        $json['mostra']= 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
    if(trim($cd_grp_consulta) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Código Grupo não Pode ser Vazio!';
        echo json_encode(array('dados'=>$json));
        exit();
    } 
    
    
    $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');
    if(trim($st_grp_consulta) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Status Grupo não Pode ser Vazio!';
        echo json_encode(array('dados'=>$json));
        exit();
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usu_alt_grp_consulta = $_SESSION['cd_usuario_log'];
    $dt_usu_alt_grp_consulta = $G_MEC->DataHoje();
    
    $G_MEC->TransacaoInicio();
    
    SGA_M0002::setcd_empresa($cd_empresa);
    SGA_M0002::setcd_grp_consulta($cd_grp_consulta);
    $rsGrupo = SGA_M0002::ConsultaCodigoVinculo();
    
    if($rsGrupo == true && $st_grp_consulta == '1'){
        
        $G_MEC->TransacaoAborta();
        
        $json['ret'] = 'false';
        $json['mostra']= 'true';
        $json['form']= $form;
        $json['msg']='Erro: Grupo Possui Vinculo!';
        echo json_encode(array('dados'=>$json));
        exit();
        
    }else{
        
        SGA_M0001::setcd_empresa($cd_empresa);
        SGA_M0001::setcd_grp_consulta($cd_grp_consulta);
        SGA_M0001::setst_grp_consulta($st_grp_consulta);       
        SGA_M0001::setcd_usu_alt_grp_consulta($cd_usu_alt_grp_consulta);        
        SGA_M0001::setdt_usu_alt_grp_consulta($dt_usu_alt_grp_consulta);
        
        if(SGA_M0001::alterar()){
            
            $G_MEC->TransacaoFinaliza();
            
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Registro Alterado com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit; 
            
        }else{
            
            $G_MEC->TransacaoAborta();
            
            $json['ret'] = 'false';
            $json['mostra']= 'true';
            $json['form']= $form;
            $json['msg']='Erro: Registro não Pode ser Alterado!';
            echo json_encode(array('dados'=>$json));
            exit();
            
        }
    }
    
}

function Excluir(){
    
    $G_MEC = new Mecanismo();
    
    if($G_MEC->recebePost($_POST, 'form') === NULL || $G_MEC->recebePost($_POST, 'form') === ''){
        
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Nome Formulario não Informado!';
        echo json_encode($json);
        exit();        
    }
    
    $opr = $G_MEC->recebePost($_POST, 'opr');
    if(trim($opr) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Operação não Informada!';
        echo json_encode($json);
        exit();
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
    if(trim($cd_grp_consulta) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Codigo do Grupo não Pode ser Vazio!';
        echo json_encode($json);
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    SGA_M0002::setcd_empresa($cd_empresa);
    SGA_M0002::setcd_grp_consulta($cd_grp_consulta);
    $rsGrupo = SGA_M0002::ConsultaCodigoVinculo();
    
    
    if($rsGrupo){
        
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form'] = $form;
        $json['msg'] = 'Erro: Registro não Pode ser Excluído! - Registro Relacionado tabela sga.t0002.';
        echo json_encode(array('dados'=>$json));
        exit();
        
    }else{
        
        SGA_M0001::setcd_empresa($cd_empresa);
        SGA_M0001::setcd_grp_consulta($cd_grp_consulta);
        
        $rs = SGA_M0001::excluir();

        if(count($rs)>0){
            
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Registro Excluído com Sucesso!';
            echo json_encode(array('dados'=>$json));
            //echo json_encode($json);
            exit();
            
        }else{
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Registro não Pode ser Excluído!';            
            echo json_encode(array('dados'=>$json));
            exit();
        }   
    }

    
}

function pesquisaCodigoGrupoConsulta(){
    
    $G_MEC = new Mecanismo();
    
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_grp_consulta')=== NULL || $G_MEC->recebePost($_POST, 'cd_grp_consulta')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Codigo Grupo não Informado!';
        echo json_encode($json);
        exit();
    }
    
        
    $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');

    $cd_empresa = $_SESSION['cd_empresa_usu'];

    $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');

    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setcd_grp_consulta($cd_grp_consulta);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    
    $rs = SGA_M0001::ConsultaCodigoGrupo();
    if(count($rs)>0){
        $dados = array(
            'cd_grp_consulta'=>$rs['0']['cd_grp_consulta'],
            'nm_grp_consulta'=>$rs['0']['nm_grp_consulta'],
            'st_grp_consulta'=>$rs['0']['st_grp_consulta']
        );
        
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Grupo Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
        
    }else{
        
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Codigo Grupo não Localizada!';
        echo json_encode($json);
        exit;
    }    
}

function consultaCodigoGrupoConsulta(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'cd_grp_consulta')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Grupo Consulta não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
    }
    
    if($G_MEC->recebePost($_POST, 'st_grp_consulta')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Grupo Consulta não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_grp_consulta = $G_MEC->recebePost($_POST, 'st_grp_consulta');
    }

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
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setcd_grp_consulta($cd_grp_consulta);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    $rs = SGA_M0001::ConsultaGrupoConsulta();
    if(count($rs)>0){
        $dados = array(
            'cd_grp_consulta'=>$rs['0']['cd_grp_consulta'],
            'nm_grp_consulta'=>$rs['0']['nm_grp_consulta'],
            'st_grp_consulta'=>$rs['0']['st_grp_consulta']
        );

        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Procedimento Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
         $dados = array(
            'cd_grp_consulta'=>'',
            'nm_grp_consulta'=>'',
            'st_grp_consulta'=>'',
        );

        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['dados'] = $dados;
        $json['msg'] = 'Erro: Código Procedimento não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomeGrupoConsulta(){
    
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('cd_grp_consulta'=>'Código','nm_grp_consulta'=> 'Descrição');
    
    if(@$_POST['nm_procd_medc'] != ''){
        $nm_grp_consulta = $_POST['nm_grp_consulta'];
    }else{
        $nm_grp_consulta = @$_POST['texto'];
    }

    if(@$_POST['st_grp_consulta'] != ''){
        $st_grp_consulta = $_POST['st_grp_consulta'];
    }else{
        $st_grp_consulta = @$_POST['filtro']['st_grp_consulta'];
    }

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SGA_M0001::setcd_empresa($cd_empresa);
    SGA_M0001::setnm_grp_consulta($nm_grp_consulta);
    SGA_M0001::setst_grp_consulta($st_grp_consulta);
    $rs = SGA_M0001::ConsultaGrupoConsulta();

    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
?>