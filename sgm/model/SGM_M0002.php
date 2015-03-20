<?php

class SGM_M0002 extends Mecanismo{
    
    Private Static $cd_uf;
    Private Static $nm_uf;
    Private Static $sg_uf;
    Private Static $cd_pais;

    /* Metodo Set */
    Public Static function setcd_uf($cd_uf){
	self::$cd_uf = $cd_uf;
    }
    Public Static function setnm_uf($nm_uf){
	self::$nm_uf = $nm_uf;
    }
    Public Static function setsg_uf($sg_uf){
	self::$sg_uf = $sg_uf;
    }
    Public Static function setcd_pais($cd_pais){
	self::$cd_pais = $cd_pais;
    }

    Public Static Function consultaSiglaUF(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_uf,';
        $strsql.= ' t0002.nm_uf,';
        $strsql.= ' t0002.sg_uf,';
        $strsql.= ' t0002.cd_pais';
        $strsql.= ' From';
        $strsql.= ' cerof.sgm_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.sg_uf = '.Mecanismo::TrataString(self::$sg_uf);

        return Mecanismo::ConsultaMetodo($strsql);
    }

}
?>
