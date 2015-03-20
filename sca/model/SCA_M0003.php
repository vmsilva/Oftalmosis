<?php
class SCA_M0003 extends Mecanismo {
    
    Private Static $cd_sistema;
    Private Static $nm_sistema;
    Private Static $st_sistema;
    Private Static $sg_sistema;
    Private Static $in_hier_sist;
    Private Static $cd_usu_cad_sist;
    Private Static $dt_usu_cad_sist;
    Private Static $cd_usu_alt_sist;
    Private Static $dt_usu_alt_sist;

    /* Metodo Set */
    Public Static function setcd_sistema($cd_sistema){
        self::$cd_sistema = $cd_sistema;
    }
    Public Static Function setnm_sistema($nm_sistema){
        self::$nm_sistema = $nm_sistema;
    }
    
    Public Static Function setst_sistema($st_sistema){
        self::$st_sistema = $st_sistema;
    }
    Public Static Function setsg_sistema($sg_sistema){
        self::$sg_sistema = $sg_sistema;
    }
    
    Public Static Function setin_hier_sist($in_hier_sist){
        self::$in_hier_sist = $in_hier_sist;
    }
    
    Public Static Function setcd_usu_cad_sist($cd_usu_cad_sist){
        self::$cd_usu_cad_sist = $cd_usu_cad_sist;
    }
    Public Static Function setdt_usu_cad_sist($dt_usu_cad_sist){
        self::$dt_usu_cad_sist = $dt_usu_cad_sist;
    }
    Public Static Function setcd_usu_alt_sist($cd_usu_alt_sist){
        self::$cd_usu_alt_sist = $cd_usu_alt_sist;
    }
    Public Static Function setdt_usu_alt_sist($dt_usu_alt_sist){
        self::$dt_usu_alt_sist = $dt_usu_alt_sist;
    }

    /* Metodo Get */
    Public Static Function getcd_sistema(){
        return self::$cd_sistema;
    }
    Public Static Function getnm_sistema(){
        return self::$nm_sistema;
    }
    Public Static Function getst_sistema(){
        return self::$st_sistema;
    }
    Public Static Function getsg_sistema(){
        return self::$sg_sistema;
    }
    Public Static Function getin_hier_sist(){
        return self::$in_hier_sist;
    }
    Public Static Function getcd_usu_cad_sist(){
        return self::$cd_usu_cad_sist;
    }
    Public Static Function getdt_usu_cad_sist(){
        return self::$dt_usu_cad_sist;
    }
    Public Static Function getcd_usu_alt_sist(){
        return self::$cd_usu_alt_sist;
    }
    Public Static Function getdt_usu_alt_sist(){
        return self::$dt_usu_alt_sist;
    }

    Public Static Function consultaSistemaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_sistema,';
        $strsql.= ' t0003.nm_sistema,';
        $strsql.= ' t0003.st_sistema,';
        $strsql.= ' t0003.sg_sistema,';
        $strsql.= ' t0003.in_hier_sist,';
        $strsql.= ' t0003.cd_usu_cad_sist,';
        $strsql.= ' t0003.dt_usu_cad_sist,';
        $strsql.= ' t0003.cd_usu_alt_sist,';
        $strsql.= ' t0003.dt_usu_alt_sist';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0003 t0003';
        $strsql.= ' Where';
        $strsql.= ' t0003.cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
        $strsql.= ' and';
        $strsql.= ' t0003.st_sistema in '.Mecanismo::TrataStringEnum(self::$st_sistema);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaSistemaNome(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_sistema,';
        $strsql.= ' t0003.nm_sistema,';
        $strsql.= ' t0003.st_sistema,';
        $strsql.= ' t0003.sg_sistema,';
        $strsql.= ' t0003.in_hier_sist,';
        $strsql.= ' t0003.cd_usu_cad_sist,';
        $strsql.= ' t0003.dt_usu_cad_sist,';
        $strsql.= ' t0003.cd_usu_alt_sist,';
        $strsql.= ' t0003.dt_usu_alt_sist';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0003 t0003';
        $strsql.= ' Where';
        $strsql.= ' t0003.nm_sistema like "%'.self::$nm_sistema.'%"';
        $strsql.= ' and';
        $strsql.= ' t0003.st_sistema in '.Mecanismo::TrataStringEnum(self::$st_sistema);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>
