<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch ($_POST['opr']) {
        case 'ListaFormBotao':
            ListaFormBotao();
            break;
        case 'ListaPermissaoFormBotao':
            ListaPermissaoFormBotao();
            break;
        case 'IncluirForm':
            IncluirForm();
            break;
        case 'ExcluirForm':
            ExcluirForm();
            break;
        case 'IncluirFormBotao':
            IncluirForm();
        case 'ExcluirFormBotao':
            ExcluirForm();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function ListaFormBotao(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
  
    if($_SESSION['st_usuario_log'] == 2){
        if($G_MEC->recebePost($_POST, 'cd_empresa')=== NULL){
            $json['ret']=  'false';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Empresa não Informado!';
            echo json_encode($json);
            exit;
        }else{
            $cd_empresa = $G_MEC->recebePost($_POST, 'cd_empresa');
        }
    }else{
        $cd_empresa = $_SESSION['cd_empresa_usu'];
    }
    
    if($G_MEC->recebePost($_POST, 'cd_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Sistema não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_sistema = $G_MEC->recebePost($_POST, 'cd_sistema');
    }
    
    if($G_MEC->recebePost($_POST, 'st_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Sistema não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_sistema = $G_MEC->recebePost($_POST, 'st_sistema');
    }
    
    if($G_MEC->recebePost($_POST, 'cd_usuario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Usuário não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_usuario = $G_MEC->recebePost($_POST, 'cd_usuario');
    }
    
    if($G_MEC->recebePost($_POST, 'st_usuario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Usuário não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_usuario = $G_MEC->recebePost($_POST, 'st_usuario');
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
    
    SCA_M0004::setcd_sistema($cd_sistema);
    $st_formulario = 0; //Somente Formulário Ativo
    SCA_M0004::setst_formulario($st_formulario);
    
    $Form = SCA_M0004::ListaFormSistema();
    if(count($Form)>0){
        $html = '';
        foreach ($Form as $key => $value) {
            $class = 'nivel';
            $ar_formulario = '';
            if($value['ar_formulario'] != ''){
                $ar_formulario = '('.$value['ar_formulario'].')';
                $class = 'formulario';
            }
            $html.= '<div class="s'.strlen($value['in_hier_form']).'">';
            $html.= "<input type='checkbox' id='".$value['cd_formulario']."' onclick='operacaoForm(".$value['cd_formulario'].",this)'/>";
            $html.= '<span class="'.$class.'"><label for="'.$value['cd_formulario'].'" class="'.$value['in_hier_form'].'">'.$value['nm_formulario'].$ar_formulario.'</label></span>';
            if($ar_formulario != ''){
                $class = 'botao';
                SCA_M0008::setcd_sistema($cd_sistema);
                SCA_M0008::setcd_formulario($value['cd_formulario']);
                $Botao = SCA_M0008::ListaFormBotao();
                foreach ($Botao as $k => $v) {
                    $html.= '<div class="s'.strlen($value['in_hier_form'].$v['in_hier_botao']).'">';
                    $html.= "<input type='checkbox' id='btn_".$value['cd_formulario'].'-'.$v['cd_botao']."' onclick='operacaoFormBotao(".$value['cd_formulario'].','.$v['cd_botao'].",this)'/>";
                    $html.= '<span class="'.$class.'"><label for="btn_'.$v['cd_botao'].'" class="'.$value['in_hier_form'].$v['in_hier_botao'].'">'.$v['nm_botao'].'</label></span>';
                    $html.= '</div>';
                }
            }
            $html.= '</div>';
        }
    }  else {
        $html = '<div class="linha" style="display:inline-block; width:500px; text-align:center">Nenhum Registro Encontrado!</div>';
    }
    $json['ret']=  'true';
    $json['mostra'] = 'false';
    $json['form']=  $form;
    $json['msg'] = 'Sucesso: Código Sistema Localizada com Sucesso!';
    $json['dados'] = $html;
    echo json_encode($json);
    exit;

}

function ListaPermissaoFormBotao(){
    
   $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
  
    if($_SESSION['st_usuario_log'] == 2){
        if($G_MEC->recebePost($_POST, 'cd_empresa')=== NULL){
            $json['ret']=  'false';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Empresa não Informado!';
            echo json_encode($json);
            exit;
        }else{
            $cd_empresa = $G_MEC->recebePost($_POST, 'cd_empresa');
        }
    }else{
        $cd_empresa = $_SESSION['cd_empresa_usu'];
    }
    
    if($G_MEC->recebePost($_POST, 'cd_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Sistema não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_sistema = $G_MEC->recebePost($_POST, 'cd_sistema');
    }
    
    if($G_MEC->recebePost($_POST, 'st_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Status Sistema não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $st_sistema = $G_MEC->recebePost($_POST, 'st_sistema');
    }
           
    if($G_MEC->recebePost($_POST, 'cd_usuario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Usuário não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_usuario = $G_MEC->recebePost($_POST, 'cd_usuario');
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
    
    SCA_M0006::setcd_empresa($cd_empresa);
    $st_empresa = 0;
    SCA_M0006::setst_empresa($st_empresa);
    SCA_M0006::setcd_sistema($cd_sistema);
    SCA_M0006::setst_sistema($st_sistema);
    SCA_M0006::setcd_usuario($cd_usuario);
    $FormPermissao = SCA_M0006::ListaPermissaoUsuarioEmpresaSistema();
    $dados = Array();
    $botoes = Array();
    if(count($FormPermissao)>0){
        foreach ($FormPermissao as $key => $value) {
            $dados[$key] = $value['cd_formulario'];
            if(trim($value['ar_formulario']) != ''){
                SCA_M0009::setcd_sistema($cd_sistema);
                SCA_M0009::setcd_formulario($value['cd_formulario']);
                SCA_M0009::setcd_usuario($cd_usuario);
                $FormPermissaoBotao = SCA_M0009::ListaPermissaoUsuarioBotao();
                if(count($FormPermissaoBotao)>0){
                    foreach ($FormPermissaoBotao as $k => $v) {
                        $botoes[$key.$k] = 'btn_'.$value['cd_formulario'].'-'.$v['cd_botao'];
                    }
                }
                
            }
        }
    }
    $json['ret']=  'true';
    $json['mostra'] = 'false';
    $json['form']=  $form;
    $json['msg'] = '';
    $json['dados'] = array_merge($dados,$botoes);
    echo json_encode(array('dados'=>$json));
    exit();
}

function IncluirForm(){
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit;
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Sistema não Informado!';
        echo json_encode($json);
        exit;
    }
    $cd_sistema = $G_MEC->recebePost($_POST, 'cd_sistema');
    
    if($G_MEC->recebePost($_POST, 'cd_formulario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Formulário não Informado!';
        echo json_encode($json);
        exit;
    }
    $cd_formulario = $G_MEC->recebePost($_POST, 'cd_formulario');
    
    if($G_MEC->recebePost($_POST, 'cd_usuario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Usário não Informado!';
        echo json_encode($json);
        exit;
    }
    $cd_usuario = $G_MEC->recebePost($_POST, 'cd_usuario');
    
    if($G_MEC->recebePost($_POST, 'opr')=== 'IncluirFormBotao'){
        if($G_MEC->recebePost($_POST, 'cd_botao')=== NULL){
            $json['ret']=  'false';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Botão não Informado!';
            echo json_encode($json);
            exit;
        }
        $cd_botao = $G_MEC->recebePost($_POST, 'cd_botao');
    }
    
    $opr = $G_MEC->recebePost($_POST, 'opr');
    $G_MEC->TransacaoInicio();
    if(trim(strtolower($opr)) === strtolower('IncluirFormBotao')){
        SCA_M0006::setcd_sistema($cd_sistema);
        SCA_M0006::setcd_formulario($cd_formulario);
        SCA_M0006::setcd_usuario($cd_usuario);
        $VerificaAcessoForm = SCA_M0006::ListaPermissaoSistemaFormUsuario();
        if(count($VerificaAcessoForm) < 1){
            SCA_M0006::setcd_sistema($cd_sistema);
            SCA_M0006::setcd_formulario($cd_formulario);
            SCA_M0006::setcd_usuario($cd_usuario);
            if(!SCA_M0006::IncluirPermissaoUsuarioForm()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra']=  'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao Incluir Permissão Formulário!';
                echo json_encode($json);
                exit;
            }
        }
        
        SCA_M0009::setcd_sistema($cd_sistema);
        SCA_M0009::setcd_formulario($cd_formulario);
        SCA_M0009::setcd_botao($cd_botao);
        SCA_M0009::setcd_usuario($cd_usuario);
        if(SCA_M0009::IncluirPermissaoUsuarioBotao()){
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra']=  'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Sucesso: Permissão Incluída com Sucesso!';
            echo json_encode($json);
            exit;
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra']=  'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Falha ao Incluír Permissão Botão!';
            echo json_encode($json);
            exit;
        }
    }else{

        $VerificaAcessoForm = SCA_M0006::ListaPermissaoSistemaFormUsuario();
        if(count($VerificaAcessoForm) < 1){
            SCA_M0006::setcd_sistema($cd_sistema);
            SCA_M0006::setcd_formulario($cd_formulario);
            SCA_M0006::setcd_usuario($cd_usuario);
            if(SCA_M0006::IncluirPermissaoUsuarioForm()){
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra']=  'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Sucesso: Permissão Formulário Incluída com Sucesso!';
                echo json_encode($json);
                exit;
            }  else {
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra']=  'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao Incluir Permissão Formulário!';
                echo json_encode($json);
                exit;
            }
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra']=  'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Usuário já possui Permissão Formulário!';
            echo json_encode($json);
            exit;
        }
    }
}

function ExcluirForm(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit;
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_sistema')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Sistema não Informado!';
        echo json_encode($json);
        exit;
    }
    $cd_sistema = $G_MEC->recebePost($_POST, 'cd_sistema');
    
    if($G_MEC->recebePost($_POST, 'cd_formulario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Formulário não Informado!';
        echo json_encode($json);
        exit;
    }
    $cd_formulario = $G_MEC->recebePost($_POST, 'cd_formulario');
    
    if($G_MEC->recebePost($_POST, 'cd_usuario')=== NULL){
        $json['ret']=  'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Usário não Informado!';
        echo json_encode($json);
        exit;
    }
    $cd_usuario = $G_MEC->recebePost($_POST, 'cd_usuario');
    
    if($G_MEC->recebePost($_POST, 'opr')=== 'ExcluirFormBotao'){
        if($G_MEC->recebePost($_POST, 'cd_botao')=== NULL){
            $json['ret']=  'false';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Botão não Informado!';
            echo json_encode($json);
            exit;
        }
        $cd_botao = $G_MEC->recebePost($_POST, 'cd_botao');
    }
    
    $opr = $G_MEC->recebePost($_POST, 'opr');
    
    if(trim(strtolower($opr)) === strtolower('ExcluirForm')){
         
        $G_MEC->TransacaoInicio();
        //Verifica se existe Botão Vinculado
        SCA_M0009::setcd_sistema($cd_sistema);
        SCA_M0009::setcd_formulario($cd_formulario);
        SCA_M0009::setcd_usuario($cd_usuario);
        //Verifica se tem botão no Formulário que está sendo excluído
        $VerificaAcessoBotao = SCA_M0009::ListaPermissaoUsuarioBotao();
        if(count($VerificaAcessoBotao)>0){
            if(!SCA_M0009::ExcluirPermissaoUsuarioBotao()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra']=  'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao Excluir Permissão Botão!';
                echo json_encode($json);
                exit;
            }
        }
        SCA_M0006::setcd_sistema($cd_sistema);
        SCA_M0006::setcd_formulario($cd_formulario);
        SCA_M0006::setcd_usuario($cd_usuario);
        $VerificaAcessoForm = SCA_M0006::ListaPermissaoSistemaFormUsuario();
        if(count($VerificaAcessoForm)>0){
            if(!SCA_M0006::ExcluirPermissaoUsuarioForm()){
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra']=  'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Falha ao Excluir Permissão Botão!';
                echo json_encode($json);
                exit;
            }else{
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra']=  'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Sucesso: Permissão Excluída com Sucesso!';
                echo json_encode($json);
                exit;
            }
        }
    }else{
        //ExcluirFormBotao
        $G_MEC->TransacaoInicio();
        
        //Verifica se existe Botão Vinculado
        SCA_M0009::setcd_sistema($cd_sistema);
        SCA_M0009::setcd_formulario($cd_formulario);
        SCA_M0009::setcd_usuario($cd_usuario);
        SCA_M0009::setcd_botao($cd_botao);
        if(!SCA_M0009::ExcluirPermissaoUsuarioBotao()){
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra']=  'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Falha ao Excluir Permissão Botão!';
            echo json_encode($json);
            exit;
        }else{
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra']=  'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Sucesso: Permissão Excluída com Sucesso!';
            echo json_encode($json);
            exit;
        }

    }

}
?>