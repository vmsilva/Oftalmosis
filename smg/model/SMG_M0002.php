<?php

class SMG_M0002 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_cnes;
    Private Static $nr_cnes;
    Private Static $nm_cnes;
   
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    
    Public Static Function setcd_cnes($cd_cnes){
        self::$cd_cnes = $cd_cnes;
    }
    
    Public Static Function setnr_cnes($nr_cnes){
        self::$nr_cnes = $nr_cnes;
    }
    
    Public Static Function setnm_cnes($nm_cnes){
        self::$nm_cnes = $nm_cnes;
    }
    

    Public Static Function ConsultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_cnes,';
        $strsql.= ' t0001.nr_cnes,';
        $strsql.= ' t0001.nm_cnes';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0002 t0002';
        $strsql.= ' inner join cerof.smg_t0001 t0001 on t0001.cd_cnes = t0002.cd_cnes';
        $strsql.= ' where';
        $strsql.= ' t0002.cd_empresa ='.Mecanismo::TrataString(self::$cd_empresa);
        (is_numeric(self::$nr_cnes) && !is_null(self::$nr_cnes)) ? $strsql.= ' and t0001.nr_cnes = '.self::$nr_cnes : '';

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function ConsultaNome(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_cnes,';
        $strsql.= ' t0001.nr_cnes,';
        $strsql.= ' t0001.nm_cnes';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0002 t0002';
        $strsql.= ' inner join cerof.smg_t0001 t0001 on t0001.cd_cnes = t0002.cd_cnes';
        $strsql.= ' where';
        $strsql.= ' t0002.cd_empresa ='.Mecanismo::TrataString(self::$cd_empresa);
        (!empty(self::$nm_cnes) && !is_null(self::$nm_cnes)) ? $strsql.= ' and t0001.nm_cnes like "%'.self::$nm_cnes.'%"' : '';
        $strsql.= ' Order by t0001.nm_cnes';

        return Mecanismo::ConsultaMetodo($strsql);
    }

}
?>
