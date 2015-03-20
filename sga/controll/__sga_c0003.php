<?php session_start();

    include '../../authentic/model/mecanismo.php';
    if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_usuario = $_SESSION['cd_usuario_log'];
        switch (strtolower($_POST['opr'])) {
            case 'incluir':
                incluir();
                break;
            case 'excluir':
                excluir();
                break;
            case 'listar':
                listaGrade();
            default:
        }
    }else{
        require_once '../../sca/controll/validaSessao.php';
    }
    
    function incluir(){
        
        $G_MEC = new Mecanismo();
        require_once '../../sca/controll/validaSessao.php';
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_usuario_cad = $_SESSION['cd_usuario_log'];
        $dt_cad_grade = $G_MEC->DataHoje();
        
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        $nr_dia_semana = $G_MEC->recebePost($_POST, 'nr_dia_semana');
        $in_local_atend = $G_MEC->recebePost($_POST, 'in_local_atend');
        $hr_ini_atend = $G_MEC->recebePost($_POST, 'hr_ini_atend');
        $hr_fin_atend = $G_MEC->recebePost($_POST, 'hr_fin_atend');
        $nr_id_min = $G_MEC->recebePost($_POST, 'nr_id_min');
        $nr_id_max = $G_MEC->recebePost($_POST, 'nr_id_max');
        $nr_qtd_atend = $G_MEC->recebePost($_POST, 'nr_qtd_atend');
        
        
        
        if(trim($form) == NULL || trim($form) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Nome Formulário não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($cd_procd_medc) == NULL || trim($cd_procd_medc) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Código Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($nr_dia_semana) == NULL || trim($nr_dia_semana) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Dia da Semana não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($in_local_atend) == NULL || trim($in_local_atend) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Local de Atendimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($hr_ini_atend) == NULL || trim($hr_ini_atend) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Hora Inicial não Informada!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($hr_fin_atend) == NULL || trim($hr_fin_atend) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Hora Final não Informada!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($nr_id_min) == NULL || trim($nr_id_min) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Minimo não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($nr_id_max) == NULL || trim($nr_id_max) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Máximo não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($nr_qtd_atend) == NULL || trim($nr_qtd_atend) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Quantidade não Informado!';
            echo json_encode($json);
            exit();
        }
        
        SGA_M0012::setnr_dia_semana($nr_dia_semana);
        SGA_M0012::setcd_empresa($cd_empresa);        
        SGA_M0012::setcd_usuario_cad($cd_usuario_cad);        
        SGA_M0012::setdt_cad_grade($dt_cad_grade);
        SGA_M0012::setcd_procd_medc($cd_procd_medc);
        SGA_M0012::setin_local_atend($in_local_atend);
        SGA_M0012::sethr_ini_atend($hr_ini_atend);
        SGA_M0012::sethr_fin_atend($hr_fin_atend);
        SGA_M0012::setnr_id_min($nr_id_min);
        SGA_M0012::setnr_id_max($nr_id_max);
        SGA_M0012::setnr_qtd_atend($nr_qtd_atend);      
        
        $G_MEC->TransacaoInicio();
        
        $rsConsulta = SGA_M0012::listar();
      

        if(!$rsConsulta){           
            
                $rs = SGA_M0012::incluir();                
            
                if($rs){
                    
                    $G_MEC->TransacaoFinaliza();

                    $json['ret']=  'true';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Sucesso: Grade Lançada com Sucesso!';
                    $dados['dados'];
                    echo json_encode(array('dados'=>$json));
                    exit();
                
                }else{
                    
                    $G_MEC->TransacaoAborta();
            
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Grade não Lançada!';
                    $dados['dados'];
                    echo json_encode(array('dados'=>$json));
                    exit();
                }
                
        }else{
      
            $G_MEC->TransacaoAborta();
            
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Grade já Cadastrada!';
            $dados['dados'];
            echo json_encode(array('dados'=>$json));
            exit();
            
        }
    }
    
    function excluir(){
        
        $G_MEC = new Mecanismo();
        require_once '../../sca/controll/validaSessao.php';
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        $cd_grade = $G_MEC->recebePost($_POST, 'cd_grade');
        
        
        if(trim($form) == NULL || trim($form) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Nome Formulário não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($cd_procd_medc) == NULL || trim($cd_procd_medc) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Código Procedimento não Informado!';
            echo json_encode($json);
            exit();
        }
        
        if(trim($cd_grade) == NULL || trim($cd_grade) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Código Grade não Informado!';
            echo json_encode($json);
            exit();
        }
        
        SGA_M0012::setcd_empresa($cd_empresa);
        SGA_M0012::setcd_procd_medc($cd_procd_medc);
        SGA_M0012::setcd_grade($cd_grade);
        
        $G_MEC->TransacaoInicio();
        
        $rsConsulta = SGA_M0012::listar();
        
        if($rsConsulta){
            
                $rs = SGA_M0012::excluir();                
            
                if($rs){
                    
                    $G_MEC->TransacaoFinaliza();

                    $json['ret']=  'true';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Sucesso: Grade Exclusa!';
                    $dados['dados'];
                    echo json_encode(array('dados'=>$json));
                    exit();
                
                }else{
                    
                    $G_MEC->TransacaoAborta();
            
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Grade não Exclusa!';
                    $dados['dados'];
                    echo json_encode(array('dados'=>$json));
                    exit();
                }
                
        }else{
      
            $G_MEC->TransacaoAborta();
            
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Grade não Selecionada!';
            $dados['dados'];
            echo json_encode(array('dados'=>$json));
            exit();
            
        }
    }
    
    function listaGrade(){
        
        $G_MEC = new Mecanismo();
        require_once '../../sca/controll/validaSessao.php';
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_procd_medc = $G_MEC->recebePost($_POST, 'cd_procd_medc');
        
        if(trim($form) == NULL || trim($form) == ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Nome Formulário não Informado!';
            echo json_encode($json);
            exit();
        }
        
        SGA_M0012::setcd_empresa($cd_empresa);
        SGA_M0012::setcd_procd_medc($cd_procd_medc);
        $rs = SGA_M0012::listar();

        foreach ($rs as $key => $value) {
            $dados[$key]['cd_procd_medc'] = $value['cd_procd_medc'];
            $dados[$key]['nm_procd_medc'] = $value['nm_procd_medc'];
            $dados[$key]['nr_dia_semana'] = $value['nr_dia_semana'];
            $dados[$key]['nm_dia_semana'] = $G_MEC->EnumDiaSemana($value['nr_dia_semana']);
            $dados[$key]['hr_ini_atend'] = $G_MEC->FormataHora($value['hr_ini_atend']);
            $dados[$key]['hr_fin_atend'] = $G_MEC->FormataHora($value['hr_fin_atend']);
            $dados[$key]['nr_id_min'] = $value['nr_id_min'];
            $dados[$key]['nr_id_max'] = $value['nr_id_max'];
            $dados[$key]['in_local_atend'] = $value['in_local_atend'];
            $dados[$key]['nr_qtd_atend'] = $value['nr_qtd_atend'];
            $dados[$key]['cd_grade'] = $value['cd_grade'];
        }
                
        $headers = array('nm_dia_semana'=>'Dia Semana', 'hr_ini_atend'=>'Hora Inicial', 'hr_fin_atend'=>'Hora Final', 
            'nr_id_min'=>'Idade Min' , 'nr_id_max'=>'Idade Máx' , 'in_local_atend'=>'Local Atendimento');
        
        $Render = new renderView();
        
        $html = $Render->renderGrid($dados, $headers, '0', strtolower($_POST['url']), strtolower($_POST['opr']));
        $json['html'] = $html;
        $json['dados'] = $rs;
        
        echo json_encode(array('dados'=>$json));
                
        exit;
    }
    
?>