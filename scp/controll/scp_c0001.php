<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch ($_POST['opr']) {
        case 'consultaCodigoPrateleira':
            consultaCodigoPrateleira();
            break;
        case 'consultaNomePrateleira':
            consultaNomePrateleira();
            break;
        case 'incluir':
            incluir();
            break;
        case 'alterar':
            alterar();
            break;
        case 'excluir':
            excluir();
            break;
        case 'gerar':
            gerar();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function consultaCodigoPrateleira(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Prateleira não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
    }
    
    if($G_MEC->recebePost($_POST, 'st_prateleira')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Prateleira não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_prateleira = $G_MEC->recebePost($_POST, 'st_prateleira');
    }
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0001::setcd_empresa($cd_empresa);
    SCP_M0001::setcd_prateleira($cd_prateleira);
    SCP_M0001::setst_prateleira($st_prateleira);
    $rs = SCP_M0001::consultaCodigo();
    if(count($rs)>0){
        if($form === 'scp_h0001'){
            $dados = array(
                'cd_empresa'=>$rs['0']['cd_empresa'],
                'nm_empresa'=>$rs['0']['nm_empresa'],
                'cd_prateleira'=>$rs['0']['cd_prateleira'],
                'nm_prateleira'=>$rs['0']['nm_prateleira'],
                'st_prateleira'=>$rs['0']['st_prateleira'],
                'nr_linha_prateleira'=>$rs['0']['nr_linha_prateleira'],
                'nr_coluna_prateleira'=>$rs['0']['nr_coluna_prateleira'],
                'nr_max_linha_coluna_item'=>$rs['0']['nr_max_linha_coluna_item'],
                'in_andar_prateleira'=>$rs['0']['in_andar_prateleira'],
                'cd_usu_cad_prat'=>$rs['0']['cd_usu_cad_prat'],
                'dt_cad_prat'=>$rs['0']['dt_cad_prat'],
                'cd_usu_alt_prat'=>$rs['0']['cd_usu_alt_prat'],
                'dt_alt_prat'=>$rs['0']['dt_alt_prat']
            );
        }else{
            $dados = array(
                'cd_empresa'=>$rs['0']['cd_empresa'],
                'nm_empresa'=>$rs['0']['nm_empresa']
            );
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Prateleira Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Prateleira não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomePrateleira(){

    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    if($_POST['st_prateleira'] != ''){
        $st_prateleira = $_POST['st_prateleira'];
    }else{
        $st_prateleira = $filtro['st_prateleira'];
    }

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    $Render = new renderView();
    $headers = array('cd_prateleira'=> 'Código', 'nm_prateleira'=>'Prateleira','nr_linha_prateleira'=>'Nr.Linhas','nr_coluna_prateleira'=>'Nr.Colunas','nr_max_linha_coluna_item'=>'Máx.Ítens');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0001::setcd_empresa($cd_empresa);
    SCP_M0001::setst_prateleira($st_prateleira);
    $rs = SCP_M0001::consultaNome();
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
    
}

function incluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0001::setcd_empresa($cd_empresa);

    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $nm_prateleira = $G_MEC->recebePost($_POST, 'nm_prateleira');
        SCP_M0001::setnm_prateleira($nm_prateleira);
        $in_andar_prateleira = $G_MEC->recebePost($_POST, 'in_andar_prateleira');
        SCP_M0001::setin_andar_prateleira($in_andar_prateleira);
        $nr_linha_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_linha_prateleira');
        SCP_M0001::setnr_linha_prateleira($nr_linha_prateleira);
        $nr_coluna_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
        SCP_M0001::setnr_coluna_prateleira($nr_coluna_prateleira);
        $nr_max_linha_coluna_item = (int)$G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item');
        SCP_M0001::setnr_max_linha_coluna_item($nr_max_linha_coluna_item);
        $st_prateleira = $G_MEC->recebePost($_POST, 'st_prateleira');
        SCP_M0001::setst_prateleira($st_prateleira);
        $cd_usu_cad_prat = $_SESSION['cd_usuario_log'];
        SCP_M0001::setcd_usu_cad_prat($cd_usu_cad_prat);
        SCP_M0001::setdt_cad_prat($G_MEC->DataHoje());
        SCP_M0001::setcd_usu_alt_prat($cd_usu_alt_prat);
        SCP_M0001::setdt_alt_prat($dt_alt_prat);
        if(count(SCP_M0001::consultaNome(true))<=0){
            SCP_M0001::incluir();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Registro Incluído com Sucesso!';
            echo json_encode($json);
            exit;
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Registro já existente na tabela!';
            echo json_encode($json);
            exit;
        }
    }
}

function alterar(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0001::setcd_empresa($cd_empresa);
    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
        SCP_M0001::setcd_prateleira($cd_prateleira);
        $nm_prateleira = $G_MEC->recebePost($_POST, 'nm_prateleira');
        SCP_M0001::setnm_prateleira($nm_prateleira);
        $in_andar_prateleira = $G_MEC->recebePost($_POST, 'in_andar_prateleira');
        SCP_M0001::setin_andar_prateleira($in_andar_prateleira);
        $nr_linha_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_linha_prateleira');
        SCP_M0001::setnr_linha_prateleira($nr_linha_prateleira);
        $nr_coluna_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
        SCP_M0001::setnr_coluna_prateleira($nr_coluna_prateleira);
        $nr_max_linha_coluna_item = (int)$G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item');
        SCP_M0001::setnr_max_linha_coluna_item($nr_max_linha_coluna_item);
        $st_prateleira = $G_MEC->recebePost($_POST, 'st_prateleira');
        SCP_M0001::setst_prateleira($st_prateleira);
        SCP_M0001::setcd_usu_cad_prat($cd_usu_cad_prat);
        SCP_M0001::setdt_cad_prat($dt_cad_prat);
        $cd_usu_alt_prat = $_SESSION['cd_usuario_log'];
        SCP_M0001::setcd_usu_alt_prat($cd_usu_alt_prat);
        SCP_M0001::setdt_alt_prat($G_MEC->DataHoje());
        if(count(SCP_M0001::consultaNome(true))<=0){
            SCP_M0001::alterar();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Registro Alterado com Sucesso!';
            echo json_encode($json);
            exit;
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Registro já existente na tabela!';
            echo json_encode($json);
            exit;
        }
    }

}

function excluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0001::setcd_empresa($cd_empresa);

    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
        SCP_M0001::setcd_prateleira($cd_prateleira);
        $nm_prateleira = $G_MEC->recebePost($_POST, 'nm_prateleira');
        SCP_M0001::setnm_prateleira($nm_prateleira);
        $in_andar_prateleira = $G_MEC->recebePost($_POST, 'in_andar_prateleira');
        SCP_M0001::setin_andar_prateleira($in_andar_prateleira);
        $nr_linha_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_linha_prateleira');
        SCP_M0001::setnr_linha_prateleira($nr_linha_prateleira);
        $nr_coluna_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
        SCP_M0001::setnr_coluna_prateleira($nr_coluna_prateleira);
        $nr_max_linha_coluna_item = (int)$G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item');
        SCP_M0001::setnr_max_linha_coluna_item($nr_max_linha_coluna_item);
        $st_prateleira = $G_MEC->recebePost($_POST, 'st_prateleira');
        SCP_M0001::setst_prateleira($st_prateleira);
        SCP_M0001::setcd_usu_cad_prat($cd_usu_cad_prat);
        SCP_M0001::setdt_cad_prat($dt_cad_prat);
        $cd_usu_alt_prat = $_SESSION['cd_usuario_log'];
        SCP_M0001::setcd_usu_alt_prat($cd_usu_alt_prat);
        SCP_M0001::setdt_alt_prat($G_MEC->DataHoje());

        SCP_M0002::setcd_empresa($cd_empresa);
        SCP_M0002::setcd_prateleira($cd_prateleira);
        if(count(SCP_M0002::consultaCodigoPrateleira())<=0){
            if(SCP_M0001::excluir()){
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Registro Excluído com Sucesso!';
                echo json_encode($json);
                exit;
            }else{
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Excluir Registro!';
                echo json_encode($json);
                exit;
            }
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Exclusão não Permitida. Existe Registro Relacionado!';
            echo json_encode($json);
            exit;
        }
    }
}

function gerar(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0001::setcd_empresa($cd_empresa);
    
    $ValidaDados = ValidaDados();
    if($ValidaDados){
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
        $nm_prateleira = $G_MEC->recebePost($_POST, 'nm_prateleira');
        $nr_linha_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_linha_prateleira');
        $nr_coluna_prateleira = (int)$G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
        $nr_max_linha_coluna_item = (int)$G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item');
        $st_prontuario = 0;
        SCP_M0002::setcd_empresa($cd_empresa);
        SCP_M0002::setcd_prateleira($cd_prateleira);
        if(count(SCP_M0002::consultaCodigoPrateleira())<=0){
            $G_MEC->TransacaoInicio();
            for ($i = 1; $i <= $nr_linha_prateleira ; $i++) {
                for($j = 1; $j <= $nr_coluna_prateleira; $j++){
                    for($c = 1; $c <= $nr_max_linha_coluna_item; $c++ ){
                        SCP_M0002::setnr_linha($i);
                        SCP_M0002::setnr_coluna($j);
                        SCP_M0002::setnr_posicao($c);
                        $nr_prontuario = $nm_prateleira.str_pad($i, 2, "0", STR_PAD_LEFT).str_pad($j, 2, "0", STR_PAD_LEFT).str_pad($c, 4, "0", STR_PAD_LEFT);
                        SCP_M0002::setnr_prontuario($nr_prontuario);
                        SCP_M0002::setst_prontuario($st_prontuario);
                        $cd_usu_ger_pront = $_SESSION['cd_usuario_log'];
                        SCP_M0002::setcd_usu_ger_pront($cd_usu_ger_pront);
                        SCP_M0002::setdt_ger_pront($G_MEC->DataHoje());
                        if(SCP_M0002::incluir() <> 1){
                            $G_MEC->TransacaoAborta();
                            $json['ret']=  'false';
                            $json['mostra'] = 'true';
                            $json['form']=  $form;
                            $json['msg'] = 'Erro: Falha ao Gerar Registro!';
                            echo json_encode($json);
                            exit;
                        }
                    }
                }
            }
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Registro Gerado com Sucesso!';
            echo json_encode($json);
            exit;
        }else{
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Prateleira já Gerada!';
            echo json_encode($json);
            exit;
        }
    }
}
function ValidaDados(){

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
    
    if($_POST['opr'] != 'incluir'){
        if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'cd_prateleira')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Código Prateleira não Informado!';
            echo json_encode($json);
            return false;
        }
    }

    if($G_MEC->recebePost($_POST, 'nm_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nm_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Prateleira não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'in_andar_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'in_andar_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Andar da Prateleira não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número de Linhas Prateleira não Informado!';
            echo json_encode($json);
            return false;
    }else{
        if(!$G_MEC->ValidaNumeroInteiro($G_MEC->recebePost($_POST, 'nr_linha_prateleira'))){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Informado de Linhas Prateleira não é Válido!';
            echo json_encode($json);
            return false;
        }
    }

    if($G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número de Colunas Prateleira não Informado!';
            echo json_encode($json);
            return false;
    }else{
        if(!$G_MEC->ValidaNumeroInteiro($G_MEC->recebePost($_POST, 'nr_coluna_prateleira'))){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Informado de Colunas Prateleira não é Válido!';
            echo json_encode($json);
            return false;
        }
    }

    if($G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item')=== NULL || $G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item')=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Máximo de Ítens na Prateleira não Informado!';
            echo json_encode($json);
            return false;
    }else{
        if(!$G_MEC->ValidaNumeroInteiro($G_MEC->recebePost($_POST, 'nr_max_linha_coluna_item'))){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Número Máximo de Ítens Informado Prateleira não é Válido!';
            echo json_encode($json);
            return false;
        }
    }

    if($G_MEC->recebePost($_POST, 'st_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'st_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Prateleira não Informado!';
        echo json_encode($json);
        return false;
    }
    return true;
}

?>