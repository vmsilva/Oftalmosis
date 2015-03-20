<?php

class SGA_M0013 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_procd_medc;    
    Private Static $ds_olho_dir;
    Private Static $ds_olho_esq;
    Private Static $ds_conclusao;
    
    static function getcd_empresa() {
        return self::$cd_empresa;
    }

    static function getcd_procd_medc() {
        return self::$cd_procd_medc;
    }

    static function getds_olho_dir() {
        return self::$ds_olho_dir;
    }

    static function getds_olho_esq() {
        return self::$ds_olho_esq;
    }

    static function getds_conclusao() {
        return self::$ds_conclusao;
    }
    
    static function getcd_usu() {
        return self::$cd_usu;
    }

    static function setcd_empresa($cd_empresa) {
        self::$cd_empresa = $cd_empresa;
    }

    static function setcd_procd_medc($cd_procd_medc) {
        self::$cd_procd_medc = $cd_procd_medc;
    }
    
    static function setds_olho_dir($ds_olho_dir) {
        self::$ds_olho_dir = $ds_olho_dir;
    }

    static function setds_olho_esq($ds_olho_esq) {
        self::$ds_olho_esq = $ds_olho_esq;
    }

    static function setds_conclusao($ds_conclusao) {
        self::$ds_conclusao = $ds_conclusao;
    }    
    

    Public Static Function Incluir(){}
    
    Public Static Function BuscaProcdLaudo(){
        
        $strsql  = 'Select';         
        $strsql .= ' t0013.ds_olho_dir,';
        $strsql .= ' t0013.ds_olho_esq,';
        $strsql .= ' t0013.ds_conclusao';
        $strsql .= ' From';
        $strsql .= ' cerof.sga_t0013 t0013';               
        $strsql .= ' WHERE';
        $strsql .= ' t0013.cd_empresa ='.self::$cd_empresa;
        
        if(self::$cd_procd_medc != NULL ){
            $strsql .= ' AND';
            $strsql .= ' t0013.cd_procd_medc ='.self::$cd_procd_medc;
        }
                
        //exit($strsql);
        return Mecanismo::ConsultaMetodo($strsql);
        
    }     
}

?>