<?php

class SMG_M0008 extends Mecanismo{
    
    Private Static $cd_espld_medc;
    Private Static $nm_espld_medc;
    Private Static $cd_cbo;
    Private Static $cd_espld_medc_princ;
    Private Static $st_espld_medc;

    /* Metodo Set */
    Public Static Function setcd_espld_medc($cd_espld_medc){
        self::$cd_espld_medc = $cd_espld_medc;
    }
    Public Static Function setnm_espld_medc($nm_espld_medc){
        self::$nm_espld_medc = $nm_espld_medc;
    }
    Public Static Function setcd_cbo($cd_cbo){
        self::$cd_cbo = $cd_cbo;
    }
    Public Static Function setcd_espld_medc_princ($cd_espld_medc_princ){
        self::$cd_espld_medc_princ = $cd_espld_medc_princ;
    }
    Public Static Function setst_espld_medc($st_espld_medc){
        self::$st_espld_medc = $st_espld_medc;
    }

    /* Metodo Get */
    Public Static Function getcd_espld_medc(){
        return self::$cd_espld_medc;
    }
    Public Static Function getnm_espld_medc(){
        return self::$nm_espld_medc;
    }
    Public Static Function getsetcd_cbo(){
        return self::$cd_cbo;
    }
    Public Static Function getcd_espld_medc_princ(){
        return self::$cd_espld_medc_princ;
    }
    Public Static Function getst_espld_medc(){
        return self::$st_espld_medc;
    }

    Public Static Function ConsultaCodigo(){

        $strsql = "Select";
        $strsql.= " t0008.cd_espld_medc,";
        $strsql.= " t0008.nm_espld_medc,";
        $strsql.= " t0008.cd_cbo,";
        $strsql.= " t0008.cd_espld_medc_princ";
        $strsql.= " From";
        $strsql.= " cerof.smg_t0008 t0008";
        $strsql.= " Where";
        $strsql.= " t0008.cd_espld_medc = ".Mecanismo::TrataString(self::$cd_espld_medc);
        $strsql.= " and";
        $strsql.= " t0008.st_espld_medc = ".Mecanismo::TrataString(self::$st_espld_medc);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ConsultaNome(){

        $strsql = "Select";
        $strsql.= " t0008.cd_espld_medc,";
        $strsql.= " t0008.nm_espld_medc,";
        $strsql.= " t0008.cd_cbo,";
        $strsql.= " t0008.cd_espld_medc_princ";
        $strsql.= " From";
        $strsql.= " cerof.smg_t0008 t0008";
        $strsql.= " Where";
        $strsql.= " t0008.nm_espld_medc like '%".self::$nm_espld_medc."%'";
        $strsql.= " and";
        $strsql.= " t0008.st_espld_medc = ".Mecanismo::TrataString(self::$st_espld_medc);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
}
?>
