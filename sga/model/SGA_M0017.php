<?php

class SGA_M0017 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_procd_medc;
    Private Static $dt_exc_procd;
    Private Static $ds_exc_procd;
    Private Static $cd_usu_cad_exc_procd;
    Private Static $dt_cad_exc_procd;
    
    
    static function getcd_empresa() {
        return self::$cd_empresa;
    }

    static function getcd_procd_medc() {
        return self::$cd_procd_medc;
    }

    static function getdt_exc_procd() {
        return self::$dt_exc_procd;
    }

    static function getds_exc_procd() {
        return self::$ds_exc_procd;
    }

    static function getcd_usu_cad_exc_procd() {
        return self::$cd_usu_cad_exc_procd;
    }

    static function getdt_cad_exc_procd() {
        return self::$dt_cad_exc_procd;
    }

    static function setcd_empresa($cd_empresa) {
        self::$cd_empresa = $cd_empresa;
    }

    static function setcd_procd_medc($cd_procd_medc) {
        self::$cd_procd_medc = $cd_procd_medc;
    }

    static function setdt_exc_procd($dt_exc_procd) {
        self::$dt_exc_procd = $dt_exc_procd;
    }

    static function setds_exc_procd($ds_exc_procd) {
        self::$ds_exc_procd = $ds_exc_procd;
    }

    static function setcd_usu_cad_exc_procd($cd_usu_cad_exc_procd) {
        self::$cd_usu_cad_exc_procd = $cd_usu_cad_exc_procd;
    }

    static function setdt_cad_exc_procd($dt_cad_exc_procd) {
        self::$dt_cad_exc_procd = $dt_cad_exc_procd;
    }


        
    static public function Incluir(){
        
        $table = 'sga_t0017';       
        
        $dados['cd_empresa'] = self::$cd_empresa;       
        $dados['cd_procd_medc'] = self::$cd_procd_medc;       
        $dados['dt_exc_procd'] = self::$dt_exc_procd;
        $dados['ds_exc_procd'] = self::$ds_exc_procd;
        $dados['cd_usu_cad_exc_procd'] = self::$cd_usu_cad_exc_procd;
        $dados['dt_cad_exc_procd'] = Mecanismo::DataHoje();
        
        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
    }
    
    static public function Excluir(){}
    
    static public function Listar(){
        
        $strsql  = "Select";
        $strsql .= " t0017.cd_procd_medc,";
        $strsql .= " t0017.dt_exc_procd,";
        $strsql .= " t0017.ds_exc_procd,";
        $strsql .= " t0010.nm_procd_medc,";
        $strsql .= " t0002.nm_usuario";
        $strsql .= " From";
        $strsql .= " cerof.sga_t0017 t0017";
        $strsql .= " inner join cerof.sca_t0002 t0002 on(t0017.cd_usu_cad_exc_procd = t0002.cd_usuario)";
        $strsql .= " inner join cerof.smg_t0010 t0010 on(t0010.cd_procd_medc = t0017.cd_procd_medc)";
        $strsql .= " Where";
        $strsql .= " t0017.cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa); 
        
        if(trim(self::$cd_procd_medc) != ''|| trim(self::$cd_procd_medc) != NULL){
            $strsql .= " and t0017.cd_procd_medc = ".self::$cd_procd_medc;        
        }
        if(trim(self::$dt_exc_procd) != ''|| trim(self::$dt_exc_procd) != NULL){
            $strsql .= " and t0017.dt_exc_procd = ".self::$dt_exc_procd;        
        }
        
        //exit($strsql);
        return Mecanismo::ConsultaMetodo($strsql);
        
    }
}
?>
