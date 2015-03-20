<?php session_start();
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch ($_POST['opr']) {
        case 'consultaCodigoPais':
            consultaCodigoPais();
            break;
        case 'consultaNomePais':
            consultaNomePais();
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function consultaCodigoPais(){

    $form = $_POST['form'];
    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();

    $cd_pais = $G_MEC->recebePost($_POST, 'cd_pais');
    if($G_MEC->recebePost($_POST, 'cd_pais') === NULL){
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['mostra'] = 'true';
        $json['msg'] = 'Erro: Código País não Invalido!';
        echo json_encode($json);
        exit;
    }
    $nm_campo = $G_MEC->recebePost($_POST, 'nm_campo');
    if($G_MEC->recebePost($_POST, 'nm_campo') === NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: É necessário Informar o nome do Campo de Retorno do País!';
        echo json_encode($json);
        exit;
    }

    require_once '../../sca/controll/validaSessao.php';
    SGM_M0001::setcd_pais($cd_pais);
    $rs = SGM_M0001::consultaCodigo();
    if(count($rs)>0){
        $dados = array(
            'cd_pais'=>$rs['0']['cd_pais'],
            $nm_campo=>$rs['0']['nm_pais']
        );
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código País Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código País não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomePais(){

    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $nm_campo_busca =  @$_POST['nm_campo_busca'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if($_POST['nm_pais'] != ''){
        $nm_pais = $_POST['nm_pais'];
    }else{
        $nm_pais = @$_POST['texto'];
    }

    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();


    if($nm_campo_busca === ''){
        $campo1 = 'cd_pais';
        $campo2 = 'nm_pais';
    }else{
        $campo = explode(',', $nm_campo_busca);
        $campo1 = $campo[0];
        $campo2 = $campo[1];
    }

    SGM_M0001::setnm_pais($nm_pais);
    $rs = SGM_M0001::consultaNome($campo1,$campo2);
    $Render = new renderView();
    $headers = array($campo1=> 'Código', $campo2=>'País');
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}

?>