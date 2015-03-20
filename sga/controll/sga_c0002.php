<?php session_start();
    include '../../authentic/model/mecanismo.php';
    if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_usuario = $_SESSION['cd_usuario_log'];
        switch (strtolower($_POST['opr'])) {
            case 'listar':
                Listar();
                break;
            case 'buscanomeprocedimento':
                pesquisaNomeProcedimento();
                break;
            case 'incluir':
                incluir();
                break;
            case 'excluir':
                excluir();
                break;
            case 'buscacodigoprocedimento':
                pesquisaCodigoProcedimento();
                break;
            case 'consultacodigogrupoprocedimento':
                    consultaCodigoGrupoProcedimento();
                    break;
            case 'consultanomegrupoprocedimento':
                    consultaNomeGrupoProcedimento();
                    break;
            default:
                    break;
        }
    }else{
        require_once '../../sca/controll/validaSessao.php';
    }
    
    function pesquisaCodigoProcedimento(){
        
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
        
        if($G_MEC->recebePost($_POST, 'cd_grp_consulta')=== NULL || $G_MEC->recebePost($_POST, 'cd_grp_consulta')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Codigo Grupo não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if($G_MEC->recebePost($_POST, 'cd_procd_medc')=== NULL || $G_MEC->recebePost($_POST, 'nm_procd_medc')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Codigo Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        
        
        //SMG_M0010::setcd_empresa($cd_empresa);
        SMG_M0010::setcd_procd_medc($cd_procd_medc);
        
        $rs = SMG_M0010::ConsultaCodigo();
        
        if(count($rs)>0){
            $dados = array(
                'nm_procd_medc'=>$rs['0']['nm_procd_medc'],
            );
            
            $json['ret']=  'true';
            $json['mostra'] = 'false';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Procedimento Localizado!';
            $json['dados'] = $dados;
            echo json_encode($json);
            exit;
        }else{            
            $json['ret']=  'false';
            $json['mostra'] = 'false';
            $json['form']=  $form;
            $json['msg'] = 'Procedimento Não  Localizado!';
            $json['dados'] = $dados;
            echo json_encode($json);
            exit;            
        }
    }
    
    function pesquisaNomeProcedimento(){
        
        $G_MEC = new Mecanismo();
        require_once '../../sca/controll/validaSessao.php';
        
                          
        $form = $G_MEC->recebePost($_POST, 'form');
        $inputBusca = $G_MEC->recebePost($_POST, 'inputBusca');
        $url = $G_MEC->recebePost($_POST, 'url');
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        $nm_procd_medc = $G_MEC->recebePost($_POST, 'nm_procd_medc');
        $opr = $G_MEC->recebePost($_POST, 'opr');
        
        if($G_MEC->recebePost($_POST, 'nm_procd_medc') != ''){
            $nm_procd_medc = $G_MEC->recebePost($_POST, 'nm_procd_medc');
        }else{
            $nm_procd_medc = $G_MEC->recebePost($_POST, 'texto');
        }        
        
        $Render = new renderView();
        $headers = array('cd_procd_medc'=> 'Codigo', 'nm_procd_medc'=>'Descrição');
        
        SMG_M0010::setCd_procd_medc($cd_procd_medc);
        SMG_M0010::setNm_procd_medc($nm_procd_medc);        
        $rs = SMG_M0010::ConsultaNome('like');
        
        
        echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
      
        exit();
        
    }
    
    function Listar(){
        
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
        
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
 
        SGA_M0002::setcd_empresa($cd_empresa);
        SGA_M0002::setcd_grp_consulta($cd_grp_consulta);
        $rs = SGA_M0002::ListaProcedimento();
        
        
        $headers = array('cd_procd_medc'=>'Código', 'nm_procd_medc'=>'Descrição', 'vl_sa_cont'=>'Valor', 'nr_qtde_procd_medc'=>'Quantidade');
        $Render = new renderView();
        
        $html = $Render->renderGrid($rs, $headers, '0', strtolower($_POST['url']), strtolower($_POST['opr']));
        $json['html'] = $html;
        
        echo json_encode(array('dados'=>$json));
        
        exit;
    }
    
    function incluir(){
        
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
        
        if($G_MEC->recebePost($_POST, 'cd_grp_consulta')=== NULL || $G_MEC->recebePost($_POST, 'cd_grp_consulta')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Codigo Grupo não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if($G_MEC->recebePost($_POST, 'cd_procd_medc')=== NULL || $G_MEC->recebePost($_POST, 'nm_procd_medc')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Codigo Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if($G_MEC->recebePost($_POST, 'vl_sa_cont')=== NULL || $G_MEC->recebePost($_POST, 'vl_sa_cont')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Valor Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if($G_MEC->recebePost($_POST, 'nr_qtde_procd_medc')=== NULL || $G_MEC->recebePost($_POST, 'nr_qtde_procd_medc')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Quantidade Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        $vl_sa_cont = $G_MEC->recebePost($_POST, 'vl_sa_cont');
        $nr_qtde_procd_medc = $G_MEC->recebePost($_POST, 'nr_qtde_procd_medc');
        
        $G_MEC->TransacaoInicio();
        
        SGA_M0002::setcd_empresa($cd_empresa);
        SGA_M0002::setcd_grp_consulta($cd_grp_consulta);
        SGA_M0002::setcd_procd_medc($cd_procd_medc);
        SGA_M0002::setvl_sa_cont($vl_sa_cont);
        SGA_M0002::setnr_qtde_procd_medc($nr_qtde_procd_medc);      
        $rs = SGA_M0002::ListaProcedimento();      

        if(!$rs){
            
            SGA_M0002::Incluir();
            
            $G_MEC->TransacaoFinaliza();
            
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Sucesso:Procedimento Vinculado a Grupo!';
            echo json_encode(array('dados'=>$json));
            exit();
            
        }else{
            
            $G_MEC->TransacaoAborta();
            
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Procedimento Já Possui Vinculo com Grupo!';
            echo json_encode(array('dados'=>$json));
            exit();
            
        }        
    }
    
    function excluir(){
        
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
        
        if($G_MEC->recebePost($_POST, 'cd_grp_consulta')=== NULL || $G_MEC->recebePost($_POST, 'cd_grp_consulta')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Codigo Grupo não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if($G_MEC->recebePost($_POST, 'cd_procd_medc')=== NULL || $G_MEC->recebePost($_POST, 'nm_procd_medc')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Codigo Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_grp_consulta = $G_MEC->recebePost($_POST, 'cd_grp_consulta');
        $cd_procd_medc  = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        
        $G_MEC->TransacaoInicio();
        
        SGA_M0002::setcd_empresa($cd_empresa);
        SGA_M0002::setcd_grp_consulta($cd_grp_consulta);
        SGA_M0002::setcd_procd_medc($cd_procd_medc);
        $rs = SGA_M0002::Excluir();
        
        if($rs){
            
            $G_MEC->TransacaoFinaliza();
            
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Registro Excluído com Sucesso!';
            echo json_encode(array('dados'=>$json));
            exit();
            
        }else{
            
            $G_MEC->TransacaoAborta();
            
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form'] = $form;
            $json['msg'] = 'Erro: Registro não Pode ser Excluído!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
        
    }
    
	function consultaCodigoGrupoProcedimento(){
    
		$G_MEC = new Mecanismo();
		require_once '../../sca/controll/validaSessao.php';

		if($G_MEC->recebePost($_POST, 'cd_procd_medc')=== NULL){
			$json['ret']=  'false';
			$json['mostra'] = 'true';
			$json['form']=  $G_MEC->recebePost($_POST, 'form');
			$json['msg'] = 'Erro: Código Procedimento não Informado!';
			echo json_encode($json);
			exit;
		}else{
			$cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
		}
		
		if($G_MEC->recebePost($_POST, 'st_procd_medc')=== NULL){
			$json['ret']=  'false';
			$json['mostra'] = 'true';
			$json['form']=  $G_MEC->recebePost($_POST, 'form');
			$json['msg'] = 'Erro: Status Procedimento não Informado!';
			echo json_encode($json);
			exit;
		}else{
			$st_procd_medc = $G_MEC->recebePost($_POST, 'st_procd_medc');
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
		
		SMG_M0010::setcd_procd_medc($cd_procd_medc);
		SMG_M0010::setst_procd_medc($st_procd_medc);
		$rs = SMG_M0010::ConsultaProcedimento();
		if(count($rs)>0){
			$dados = array(
				'cd_procd_medc'=>$rs['0']['cd_procd_medc'],
				'nm_procd_medc'=>$rs['0']['nm_procd_medc'],
				'st_procd_medc'=>$rs['0']['st_procd_medc']
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
				'cd_procd_medc'=>'',
				'nm_procd_medc'=>'',
				'st_procd_medc'=>'',
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

	function consultaNomeGrupoProcedimento(){
		
		$opr = @$_POST['opr'];
		$url = @$_POST['url'];

		$inputBusca = (int)@$_POST['inputBusca'];

		$G_MEC = new Mecanismo();
		$Render = new renderView();
		$headers = array('cd_procd_medc'=>'Código','nm_procd_medc'=> 'Descrição');
		
		if(@$_POST['nm_procd_medc'] != ''){
			$nm_procd_medc = $_POST['nm_procd_medc'];
		}else{
			$nm_procd_medc = @$_POST['texto'];
		}

		if(@$_POST['st_procd_medc'] != ''){
			$st_procd_medc = $_POST['st_procd_medc'];
		}else{
			$st_procd_medc = @$_POST['filtro']['st_procd_medc'];
		}

		SMG_M0010::setnm_procd_medc($nm_procd_medc);
		SMG_M0010::setst_procd_medc($st_procd_medc);
		$rs = SMG_M0010::ConsultaProcedimento();

		echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
	}
?>