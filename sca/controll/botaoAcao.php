<?php
@session_start();
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_usuario = $_SESSION['cd_usuario_log'];
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();
    require_once 'validaSessao.php';
    $st_botao = 0;
    SCA_M0009::setst_botao($st_botao);
    SCA_M0009::setar_formulario($ar_formulario);
    SCA_M0009::setcd_usuario($cd_usuario);
    $rs = SCA_M0009::ListaPermissaoBotao();
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            echo '<button class="'.$value['in_id_botao'].'" id="'.$ar_formulario.'-'.$value['in_id_botao'].'" type="button">'.$value['nm_botao'].'</button>';
        }
    }
}
?>
