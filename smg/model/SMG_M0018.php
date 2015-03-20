<?php

class SMG_M0018 {
    
    Private Static $cd_empresa;
    Private Static $cd_cnes;
    Private Static $cd_espld_medc;
    Private Static $cd_espld_medc_cnes;

    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_cnes($cd_cnes){
        self::$cd_cnes = $cd_cnes;
    }
    Public Static Function setcd_espld_medc($cd_espld_medc){
        self::$cd_espld_medc = $cd_espld_medc;
    }
    Public Static Function setcd_espld_medc_cnes($cd_espld_medc_cnes){
        self::$cd_espld_medc_cnes = $cd_espld_medc_cnes;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_cnes(){
        return self::$cd_cnes;
    }
    Public Static Function getcd_espld_medc(){
        return self::$cd_espld_medc;
    }
    Public Static Function getcd_espld_medc_cnes(){
        return self::$cd_espld_medc_cnes;
    }

    Public Static Function ConsultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0018.cd_empresa,';
        $strsql.= ' t0018.cd_cnes,';
        $strsql.= ' t0018.cd_espld_medc,';
        $strsql.= ' t0018.cd_espld_medc_cnes';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0018 t0018';
        $strsql.= ' Where';
        $strsql.= ' t0018.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0018.cd_cnes = '.Mecanismo::TrataString(self::$cd_cnes);
        $strsql.= ' and';
        $strsql.= ' convert(t0018.cd_espld_medc_cnes,unsigned) = '.Mecanismo::TrataString(self::$cd_espld_medc_cnes);

        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>
