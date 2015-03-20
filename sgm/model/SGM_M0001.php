<?php

class SGM_M0001 extends Mecanismo{
    Private Static $cd_pais;
    Private Static $nm_pais;

    /* Metodo Set */
    Public Static function setcd_pais($cd_pais){
	self::$cd_pais = $cd_pais;
    }
    Public Static function setnm_pais($nm_pais){
	self::$nm_pais = $nm_pais;
    }
    /* Metodo Get */
    Public Static Function getcd_pais(){
	return self::$cd_pais;
    }
    Public Static Function getnm_pais(){
	return self::$nm_pais;
    }

    Public Static Function consultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_pais,';
        $strsql.= ' t0001.nm_pais';
        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0001 t0001';
        $strsql.= ' Where';
        $strsql.= ' t0001.cd_pais = '.Mecanismo::TrataString(self::$cd_pais);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function consultaNome($cd_pais = null, $nm_pais = null){

        $strsql = 'Select';
        if($cd_pais === NULL){
            $strsql.= ' t0001.cd_pais,';
        }else{
            $strsql.= ' t0001.cd_pais as '.$cd_pais.',';
        }
        if($nm_pais === NULL){
            $strsql.= ' t0001.nm_pais';
        }else{
            $strsql.= ' t0001.nm_pais as '.$nm_pais;
        }

        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0001 t0001';
        $strsql.= ' Where';
        $strsql.= ' t0001.nm_pais like "%'.self::$nm_pais.'%"';

        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>
