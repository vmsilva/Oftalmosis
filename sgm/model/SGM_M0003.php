<?php

class SGM_M0003 extends Mecanismo{

    Private Static $cd_munic;
    Private Static $nm_munic;
    Private Static $cd_uf;
    Private Static $sg_uf;

    /* Metodo Set */
    Public Static function setcd_munic($cd_munic){
	self::$cd_munic = $cd_munic;
    }
    Public Static function setnm_munic($nm_munic){
	self::$nm_munic = $nm_munic;
    }
    Public Static function setcd_uf($cd_uf){
	self::$cd_uf = $cd_uf;
    }
    Public Static function setsg_uf($sg_uf){
	self::$sg_uf = $sg_uf;
    }
    /* Metodo Get */
    Public Static Function getcd_munic(){
	return self::$cd_munic;
    }
    Public Static Function getnm_munic(){
	return self::$nm_munic;
    }
    Public Static Function getcd_uf(){
	return self::$cd_uf;
    }
    Public Static Function getsg_uf(){
	return self::$sg_uf;
    }

    Public Static Function consultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_munic,';
        $strsql.= ' t0003.nm_munic,';
        $strsql.= ' t0003.cd_uf,';
        $strsql.= ' t0002.sg_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0003 t0003';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0003.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0003.cd_munic = '.Mecanismo::TrataString(self::$cd_munic);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function consultaNome($cd_munic = null, $sg_uf = null, $nm_munic = null){

        $strsql = 'Select';
        if($cd_munic === NULL){
            $strsql.= ' t0003.cd_munic,';
        }else{
            $strsql.= ' t0003.cd_munic as '.$cd_munic.',';
        }
        if($nm_munic === NULL){
            $strsql.= ' t0003.nm_munic,';
        }else{
            $strsql.= ' t0003.nm_munic as '.$nm_munic.',';
        }
        $strsql.= ' t0003.cd_uf,';
        if($sg_uf === NULL){
            $strsql.= ' t0002.sg_uf';
        }else{
            $strsql.= ' t0002.sg_uf as '.$sg_uf;
        }
        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0003 t0003';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0003.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0003.nm_munic like "%'.self::$nm_munic.'%"';
        $strsql.= ' and';
        $strsql.= ' t0002.sg_uf = '.Mecanismo::TrataString(self::$sg_uf);
		$strsql.= ' Limit 0,50';


        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function ValidaNome(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_munic,';
        $strsql.= ' t0003.nm_munic,';
        $strsql.= ' t0003.cd_uf,';
        $strsql.= ' t0002.sg_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0003 t0003';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0003.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0003.nm_munic = '.Mecanismo::TrataString(self::$nm_munic);
        $strsql.= ' and';
        $strsql.= ' t0002.sg_uf = '.Mecanismo::TrataString(self::$sg_uf);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function validaNomeCEP(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_munic,';
        $strsql.= ' t0003.nm_munic,';
        $strsql.= ' t0003.cd_uf,';
        $strsql.= ' t0002.sg_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0003 t0003';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0003.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0003.nm_munic = '.iconv("UTF-8", "ISO-8859-1//TRANSLIT", Mecanismo::TrataString(self::$nm_munic));
        $strsql.= ' and'; 
        $strsql.= ' t0002.sg_uf = '.Mecanismo::TrataString(self::$sg_uf);

        return Mecanismo::ConsultaMetodo($strsql);
    }

}
?>