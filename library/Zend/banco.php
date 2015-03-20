<?php

if(getcwd() === '/var/www/sistema'){
    set_include_path(get_include_path() . PATH_SEPARATOR . './library/');
    require_once realpath('./library/Zend/Db/Adapter/Pdo/Mysql.php');
    require_once realpath('./library/Zend/Db/Table.php');
}else{
    set_include_path(get_include_path() . PATH_SEPARATOR . './../../library/');
    require_once realpath('./../../library/Zend/Db/Adapter/Pdo/Mysql.php');
    require_once realpath('./../../library/Zend/Db/Table.php');
}

class Banco extends Zend_Db_Adapter_Pdo_Mysql{

    private $host;
    private $banco;
    private $usuario;
    private $senha;
    public $conexao;

    public function sethost($host){
        $this->host = $host;
    }

    public function setbanco($banco){
        $this->banco = $banco;
    }

    public function setusuario($usuario){
        $this->usuario = $usuario;
    }

    public function setsenha($senha){
        $this->senha = $senha;
    }

    public function gethost(){
        return $this->host;
    }

    public function getbanco(){
        return $this->banco;
    }

    public function getusuario(){
        return $this->usuario;
    }

    public function getsenha(){
        return $this->senha;
    }

    public function __construct(){

        if($_SERVER['HTTP_HOST'] === 'localhost'){
            $this->host = $_SERVER['HTTP_HOST'];
            $this->banco = "cerof";
            $this->usuario = "root";
            $this->senha = "victor";
        }else{
            $this->host = '10.5.5.105';
            $this->banco = "cerof";
            $this->usuario = "root";
            $this->senha = "12345";
        }

        $pdoParams = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;');

        $banco = array(
            'host'     => $this->host,
            'username' => $this->usuario,
            'password' => $this->senha,
            'dbname'   => $this->banco,
            'driver_options' => $pdoParams
        );
        parent::__construct($banco);
    }
	
}

$db = new Banco();
Zend_Db_Table::setDefaultAdapter($db);

?>