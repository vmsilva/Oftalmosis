<?php
abstract class App_Util {

	/** verifica se request aceita somente json response*/
	public static function isJson(){
		//testa se a requisicao é json
                            $reqType = @$_SERVER['HTTP_ACCEPT'];
                    if($reqType){
                    if(
                    strpos($reqType,'application/json')!==false ||
                    strpos($reqType,'text/javascript')!==false){
                            return true;
		}
	}
		return false;
	}
}
//Verifica se o usuário possui um ID válido para logar na sessão
//Só é permitida uma conexão por usuário, não e permitido conexão simultanea
if(getcwd() === '/home/envolverti/www/sistema'){
    define('DESLOGA','./');
}else{
    define('DESLOGA','./../../');
}
if(isset($_SESSION['Envolverti'])){
        $cd_usuario = $_SESSION['cd_usuario_log'];
        SCA_M0002::setcd_usuario($cd_usuario);
        SCA_M0002::setid_sessao($_SESSION['Envolverti']);
        $rs = SCA_M0002::validaSessaoUsuario();
        if(count($rs) === 0){
            session_destroy();
            header('Location:'.DESLOGA.'logout.php');
        }
    }else{		
		/* se json redireciona via javascript*/
		if(App_Util::isJson()){
			echo json_encode(array(
				'ret'=>'false',
				'msg'=>'<script>window.location.href="/"</script>'
			));
			exit;
		
		}
	
        header('Location:'.DESLOGA.'logout.php');
        session_destroy();
    }
?>