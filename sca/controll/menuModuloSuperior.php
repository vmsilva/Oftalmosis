<?php
    session_start();
    if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
        if(isset ($_POST['cd_modulo'])){
            $cd_usuario = $_SESSION['cd_usuario_log'];
            $cd_empresa = $_SESSION['cd_empresa_usu'];
            $cd_sistema = $_POST['cd_modulo'];
            include '../../authentic/model/mecanismo.php';
            $G_MEC = new Mecanismo();
            require_once 'validaSessao.php';
            SCA_M0006::setcd_empresa($cd_empresa);
            $st_empresa = 0;
            SCA_M0006::setst_empresa($st_empresa);
            SCA_M0006::setcd_sistema($cd_sistema);
            $st_sistema = 2;
            SCA_M0006::setst_sistema($st_sistema);
            SCA_M0006::setcd_usuario($cd_usuario);
            $in_hier_form_lenght = 2;
            SCA_M0006::setin_hier_form_lenght($in_hier_form_lenght);
            $rs_sup = SCA_M0006::ListaPermissaoUsuarioEmpresaSistema();
            if(count($rs_sup)>0){
                //Inicializa a ul do menu superior
                $stMenuNivel = 0;
                foreach ($rs_sup as $key => $value) {
                    //Verifica se o Menu é Superior, hierárquia tamanho igual a 2
                    if(strlen(trim($value['in_hier_form'])) === 2){
                        echo '<div class="menuSuperior"><a><label>'.$value['nm_formulario'].'</label></a>';
                        $in_hier_form_lenght = 4;
                        SCA_M0006::setin_hier_form_lenght($in_hier_form_lenght);
                        SCA_M0006::setin_hier_form($value['in_hier_form']);
                        $rs_prim_niv = SCA_M0006::ListaPermissaoUsuarioEmpresaSistema();
                        if(count($rs_prim_niv)>0){
                            if($stMenuNivel === 0){
                                echo '<ul id="menu">';
                            }else{
                                echo '<ul>';
                            }
                            $stMenuNivel = 1;
                            $stMenuIni = 0;
                            foreach ($rs_prim_niv as $k => $v) {
                                $link = '';
                                if(trim($v['ar_formulario']) != ''){
                                    $Arq = "'".$v['ar_formulario']."'";
                                    $Nom = "'".$v['nm_formulario']."'";
                                    $link = 'onclick="abrirController('.$Arq.',\'\','.$Nom.')"';
                                }
                                echo '<li><a href="#" '.$link.'>'.$v['nm_formulario'].'</a>';
                                $in_hier_form_lenght = 6;
                                SCA_M0006::setin_hier_form_lenght($in_hier_form_lenght);
                                SCA_M0006::setin_hier_form($v['in_hier_form']);
                                $rs_secu_niv = SCA_M0006::ListaPermissaoUsuarioEmpresaSistema();
                                if(count($rs_secu_niv)>0){
                                    echo '<ul>';
                                    foreach ($rs_secu_niv as $ke => $va) {
                                        $linka = '';
                                        if(trim($va['ar_formulario']) != ''){
                                            $Arqa = "'".$va['ar_formulario']."'";
                                            $Noma = "'".$va['nm_formulario']."'";
                                            $linka = 'onclick="abrirController('.$Arqa.',\'\','.$Noma.')"';
                                        }
                                        echo '<li><a href="#" '.$linka.'>'.$va['nm_formulario'].'</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</div>';
                    }
                }
            }else{
                echo '<ul><a>Nenhum Registro Localizado!</a></ul>';
            }
        }       
    }else{
        include_once 'validaSessao.php';
    }
?>
