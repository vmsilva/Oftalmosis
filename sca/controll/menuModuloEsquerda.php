<?php
    if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
        //Listar Modulo Menu Esquerdo
        $cd_usuario = $_SESSION['cd_usuario_log'];
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        SCA_M0005::setcd_empresa($cd_empresa);
        SCA_M0005::setcd_usuario($cd_usuario);
        $st_empresa = 0;
        SCA_M0005::setst_empresa($st_empresa);
        $st_sistema = 2;
        SCA_M0005::setst_sistema($st_sistema);
        $rs = SCA_M0005::ListaPermissaoEmpresaSistema();
        if($rs > 0){
            $i = 0;
            foreach ($rs as $key => $value) {
                echo '<a title="Sistema - '.$rs[$i]['nm_sistema'].'" onclick="getMenuModuloUsuario('.$rs[$i]['cd_sistema'].');" >'.$rs[$i]['nm_sistema'].'</a>';
                $i++;
            }
        }else{
            echo '<a>Nenhum Registro Localizado!</a>';
        }
    }else{
        include_once 'validaSessao.php';
    }
?>
