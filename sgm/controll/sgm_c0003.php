<?php session_start();
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch ($_POST['opr']) {
        case 'consultaCodigoMunicipio':
            consultaCodigoMunicipio();
            break;
        case 'consultaNomeMunicipio':
            consultaNomeMunicipio();
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function consultaCodigoMunicipio(){

    $form = $_POST['form'];
    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();

    $cd_munic = $G_MEC->recebePost($_POST, 'cd_munic');
    if($G_MEC->recebePost($_POST, 'cd_munic') === NULL){
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['mostra'] = 'true';
        $json['msg'] = 'Erro: Código Município Invalido!';
        echo json_encode($json);
        exit;
    }
    
    $nm_campo = $G_MEC->recebePost($_POST, 'nm_campo');
    if($G_MEC->recebePost($_POST, 'nm_campo') === NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: É necessário Informar o nome do Campo de Retorno do Município!';
        echo json_encode($json);
        exit;
    }
    $nm_campo_aux = explode(',', $nm_campo);
    

    require_once '../../sca/controll/validaSessao.php';
    SGM_M0003::setcd_munic($cd_munic);
    $rs = SGM_M0003::consultaCodigo();
    if(count($rs)>0){
        $dados = array(
            $nm_campo_aux[0]=>$rs['0']['cd_munic'],
            $nm_campo_aux[2]=>$rs['0']['nm_munic'],
            $nm_campo_aux[1]=>$rs['0']['sg_uf']
        );
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Município Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Município não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomeMunicipio(){

    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $nm_campo_busca =  @$_POST['nm_campo_busca'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if(@$_POST['nm_munic'] != ''){
        $nm_munic = $_POST['nm_munic'];
    }else{
        $nm_munic = @$_POST['texto'];
    }
    if(@$_POST['sg_uf'] != ''){
        $sg_uf = $_POST['sg_uf'];
    }else{
        $sg_uf = $filtro['sg_uf'];
    }

    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();


    if($nm_campo_busca === ''){
        $campo1 = 'cd_munic';
        $campo2 = 'sg_uf';
        $campo3 = 'nm_munic';
    }else{
        $campo = explode(',', $nm_campo_busca);
        $campo1 = $campo[0];
        $campo2 = $campo[1];
        $campo3 = $campo[2];
    }

    SGM_M0003::setnm_munic($nm_munic);
    SGM_M0003::setsg_uf($sg_uf);
    $rs = SGM_M0003::consultaNome($campo1,$campo2,$campo3);
    $Render = new renderView();
    $headers = array($campo1=> 'Código', $campo3=>'Município', $campo2=>'UF');
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}

?>