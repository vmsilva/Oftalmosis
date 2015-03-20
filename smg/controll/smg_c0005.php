<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'consultanumeroconselho':
            ConsultaNumeroConselho();
            break;
        case 'consultaconselhonomeprofissional':
            ConsultaConselhoNomeProfissional();
            break;
        case 'listaconselhoporprofissional':
            listaConselhoporProfissional();
            break;
        case 'incluir':
            Incluir();
            break;
        case 'excluir':
            Excluir();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function ConsultaNumeroConselho(){

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
    
    if($G_MEC->recebePost($_POST, 'cd_conselho')=== NULL || $G_MEC->recebePost($_POST, 'cd_conselho')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Conselho não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'nr_conselho')=== NULL || $G_MEC->recebePost($_POST, 'nr_conselho')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Conselho não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_conselho = $G_MEC->recebePost($_POST, 'cd_conselho');
    $nr_conselho = $G_MEC->recebePost($_POST, 'nr_conselho');
    SMG_M0005::setcd_conselho($cd_conselho);
    SMG_M0005::setnr_conselho($nr_conselho);
    $cd_uf = '52';
    SMG_M0005::setcd_uf($cd_uf);   
    $rs = SMG_M0005::ConsultaCodigoConselhoCodigo();
    if(count($rs)>0){
        $dados = array(
            'cd_prof' => $rs[0]['cd_prof'],
            'nr_conselho' => $rs[0]['nr_conselho'],
            'cd_conselho' => $rs[0]['cd_conselho'],
            'nm_prof' => $rs[0]['nm_prof'],
            'sg_conselho' => $rs[0]['cd_conselho'],
            'sg_conselho_aux' => $rs[0]['sg_conselho']
        );
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = '';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Conselho não Localizada!';
        echo json_encode($json);
        exit;
    }
}

Function ConsultaConselhoNomeProfissional(){

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
    
    if($G_MEC->recebePost($_POST, 'cd_conselho')=== NULL || $G_MEC->recebePost($_POST, 'cd_conselho')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Conselho não Informado!';
        echo json_encode($json);
        exit();
    }
        
    $cd_conselho = $G_MEC->recebePost($_POST, 'cd_conselho');
    $nm_prof = $G_MEC->recebePost($_POST, 'nm_prof', NULL);
    $cd_uf = '52';
    
    SMG_M0005::setcd_conselho($cd_conselho);
    SMG_M0005::setnm_prof($nm_prof);
    SMG_M0005::setcd_uf($cd_uf);
    $rs = SMG_M0005::ConsultaCodigoConselhoNomeProfissional();
    if(count($rs)>0){
        $Render = new renderView();
        $filtro = @$_POST['filtro'];
        $opr = @$_POST['opr'];
        $url = @$_POST['url'];
        $inputBusca = @$_POST['inputBusca'];;
        
        $headers = array('sg_conselho'=> 'Sigla', 'nr_conselho'=> 'Número', 'nm_prof'=>'Profissional');
        echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Profissional Conselho não Localizada!';
        echo json_encode($json);
        exit;
    }
}
Function listaConselhoporProfissional(){

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
   
    if($G_MEC->recebePost($_POST, 'cd_prof')=== NULL || $G_MEC->recebePost($_POST, 'cd_prof')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Profissional não Informado!';
        echo json_encode($json);
        exit();
    }

    $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
    SMG_M0005::setcd_prof($cd_prof);
    $rs = SMG_M0005::ConsultaCodigoProfissional();
    $html = '<table><thead class="grid_cabecalho">';
    $html.= '<tr><th>Conselho</th><th>UF</th><th>Número</th></tr>';
    $html.= '</thead><tbody class="grid_corpo">';
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            $html.= "<tr data-data='".json_encode($rs[$key])."'>";
            $html.= '<td>'.$value['sg_conselho'].'</td>';
            $html.= '<td>'.$value['sg_uf'].'</td>';
            $html.= '<td>'.$value['nr_conselho'].'</td></tr>';
        }
    }else{
        $html.= '<tr><td>Nenhum Registro Localizado!</td></tr>';    
    }
    $html.= '</tbody></table>';

    $json['ret']=  'true';
    $json['form']=  $G_MEC->recebePost($_POST, 'form');
    $json['html'] = $html;
    echo json_encode(array('dados'=>$json));
    exit;
}

Function Incluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
        $sg_conselho = $G_MEC->recebePost($_POST, 'cd_conselho');
        $sg_uf = $G_MEC->recebePost($_POST, 'cd_uf');
        $nr_conselho = $G_MEC->recebePost($_POST, 'nr_conselho');
        
        //Retorna Código UF pela sigla
        SGM_M0002::setsg_uf($sg_uf);
        $rsUF = SGM_M0002::consultaSiglaUF();
        if(count($rsUF)>0){
            $cd_uf = $rsUF[0]['cd_uf'];
        }
        
        //Consulta se existe mesmo conselho cadastrado para o Profissional
        SMG_M0005::setcd_prof($cd_prof);
        SMG_M0005::setsg_conselho($sg_conselho);
        SMG_M0005::setcd_uf($cd_uf);
        SMG_M0005::setnr_conselho($nr_conselho);
        $rsProf = SMG_M0005::ConsultaCodigoProfissional();
        if(count($rsProf)<1){
            //Verifica se existe Número conselho cadastrado para outro profissional
            SMG_M0005::setcd_conselho($sg_conselho);
            $rs = SMG_M0005::ConsultaCodigoConselhoCodigo();
            if(count($rs)>0){
                $json['ret'] = 'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Conselho Cadastrado para o Profissional '.$rs[0]['nm_prof'].'!';
                echo json_encode(array('dados'=>$json));
                exit();
            }else{
                //Inclusão
                if(SMG_M0005::Incluir()){
                    $json['ret'] = 'true';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Sucesso: Número Conselho Profissional Incluído com Sucesso!';
                    echo json_encode(array('dados'=>$json));
                }else{
                    $json['ret'] = 'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Inserir Número Conselho Profissional!';
                    echo json_encode(array('dados'=>$json));
                }
            }
        }else{
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Profissional já possui este Conselho Cadastrado!';
            echo json_encode(array('dados'=>$json));
            exit();
        }
    }
}
Function Excluir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
        $cd_conselho = $G_MEC->recebePost($_POST, 'cd_conselho');
        $sg_uf = $G_MEC->recebePost($_POST, 'cd_uf');
        $nr_conselho = $G_MEC->recebePost($_POST, 'nr_conselho');
        
        //Retorna Código UF pela sigla
        SGM_M0002::setsg_uf($sg_uf);
        $rsUF = SGM_M0002::consultaSiglaUF();
        if(count($rsUF)>0){
            $cd_uf = $rsUF[0]['cd_uf'];
        }
        
        SMG_M0005::setcd_prof($cd_prof);
        SMG_M0005::setcd_conselho($cd_conselho);
        SMG_M0005::setcd_uf($cd_uf);
        SMG_M0005::setnr_conselho($nr_conselho);
        if(SMG_M0005::Excluir()){
            $json['ret'] = 'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Sucesso: Número Conselho Profissional Incluído com Sucesso!';
            echo json_encode(array('dados'=>$json));
        }else{
            $json['ret'] = 'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Inserir Número Conselho Profissional!';
            echo json_encode(array('dados'=>$json));
        }
           
    }
}

Function ValidaDados(){
    $G_MEC = new Mecanismo();
    
    $form = $G_MEC->recebePost($_POST, 'form');
    if(trim($form) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Formulário não informado!';
        echo json_encode(array('dados'=>$json));
    }
    
    $cd_prof = $G_MEC->recebePost($_POST, 'cd_prof');
    if(trim($cd_prof) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Profissional não informado!';
        echo json_encode(array('dados'=>$json));
    }    
    
    $cd_conselho = $G_MEC->recebePost($_POST, 'cd_conselho');
    if(trim($cd_conselho) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Sigla Conselho Profissional não informado!';
        echo json_encode(array('dados'=>$json));
    }
    
    $cd_uf = $G_MEC->recebePost($_POST, 'cd_uf');
    if(trim($cd_uf) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Unidade Federativa Conselho Profissional não informado!';
        echo json_encode(array('dados'=>$json));
    }
    
    $nr_conselho = $G_MEC->recebePost($_POST, 'nr_conselho');
    if(trim($nr_conselho) == ''){
        $json['ret'] = 'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Conselho Profissional não informado!!';
        echo json_encode(array('dados'=>$json));
    }
    
    return true;
}
?>