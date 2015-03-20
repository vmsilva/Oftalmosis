<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch (strtolower($_POST['opr'])) {
        case 'consultacodigogrupoconsulta':
            consultaCodigoGrupoConsulta();
            break;
        case 'consultanomegrupoconsulta':
            consultaNomeGrupoConsulta();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}