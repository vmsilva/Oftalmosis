<?php

class SCA_M0001 extends Mecanismo {
    Private Static $cd_empresa;
    Private Static $nm_empresa;
    Private Static $st_empresa;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }

    Public Static function setnm_empresa($nm_empresa){
        self::$nm_empresa = $nm_empresa;
    }

    Public Static function setst_empresa($st_empresa){
        self::$st_empresa = $st_empresa;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }

    Public Static Function getnm_empresa(){
        return self::$nm_empresa;
    }

    Public Static Function getst_empresa(){
        return self::$st_empresa;
    }

    Public Static Function consultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_empresa,';
        $strsql.= ' t0001.nm_empresa,';
        $strsql.= ' t0001.in_logomarca,';
        $strsql.= ' t0001.st_empresa';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0001 t0001';
        $strsql.= ' Where';
        $strsql.= ' t0001.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= " t0001.st_empresa in ".Mecanismo::TrataStringEnum(self::$st_empresa);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaNome(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_empresa,';
        $strsql.= ' t0001.nm_empresa,';
        $strsql.= ' t0001.in_logomarca,';
        $strsql.= ' t0001.st_empresa';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0001 t0001';
        $strsql.= ' Where';
        $strsql.= ' t0001.nm_empresa like "%'.self::$nm_empresa.'%"';
        $strsql.= ' and';
        $strsql.= " t0001.st_empresa in ".Mecanismo::TrataStringEnum(self::$st_empresa);

        return Mecanismo::ConsultaMetodo($strsql);
    }

}
?>
