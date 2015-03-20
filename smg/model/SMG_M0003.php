<?php

class SMG_M0003 extends Mecanismo{
    
    Private Static $cd_conselho;
    Private Static $nm_conselho;
    Private Static $sg_conselho;
    Private Static $st_conselho;

    /* Metodo Set */
    Public Static Function setcd_conselho($cd_conselho){
        self::$cd_conselho = $cd_conselho;
    }
    Public Static Function setnm_conselho($nm_conselho){
        self::$nm_conselho = $nm_conselho;
    }
    Public Static Function setsg_conselho($sg_conselho){
        self::$sg_conselho = $sg_conselho;
    }
    Public Static Function setst_conselho($st_conselho){
        self::$st_conselho = $st_conselho;
    }

    /* Metodo Get */
    Public Static Function getcd_conselho(){
        return self::$cd_conselho;
    }
    Public Static Function getnm_conselho(){
        return self::$nm_conselho;
    }
    Public Static Function getsg_conselho(){
        return self::$sg_conselho;
    }
    Public Static Function getst_conselho(){
        return self::$st_conselhoo;
    }
    
    

    Public Static Function ConsultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_conselho,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho';
        $strsql.= ' From';
        $strsql.= ' envolver_smg.t0003 t0003';
        $strsql.= ' where';
        $strsql.= ' t0003.cd_conselho ='.Mecanismo::TrataString(self::$cd_conselho);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function ConsultaNome(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_conselho,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0003 t0003';
        $strsql.= ' where';
        if(self::$nm_conselho != ''){
            $strsql.= ' t0003.nm_conselho like "%'.self::$nm_conselho.'%"';
            $strsql.= ' and';
        }
        $strsql.= ' t0003.st_conselho = '.Mecanismo::TrataString(self::$st_conselho);
        $strsql.= ' Order by t0003.sg_conselho';

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function ConsultaSigla(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_conselho,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0003 t0003';
        $strsql.= ' where';
        $strsql.= ' t0003.sg_conselho = '.Mecanismo::TrataString(self::$sg_conselho);

        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>
