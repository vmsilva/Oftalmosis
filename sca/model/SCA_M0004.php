<?php
class SCA_M0004 extends Mecanismo {
    
    Private Static $cd_sistema;
    Private Static $cd_formulario;
    Private Static $nm_formulario;
    Private Static $ar_formulario;
    Private Static $st_formulario;
    Private Static $in_hier_form;
    Private Static $cd_usu_cad_form;
    Private Static $dt_usu_cad_form;
    Private Static $cd_usu_alt_form;
    Private Static $dt_usu_alt_form;

    /* Metodo Set */
    Public Static function setcd_sistema($cd_sistema){
        self::$cd_sistema = $cd_sistema;
    }
    Public Static Function setcd_formulario($cd_formulario){
        self::$cd_formulario = $cd_formulario;
    }
    
    Public Static Function setnm_formulario($nm_formulario){
        self::$nm_formulario = $nm_formulario;
    }
    Public Static Function setar_formulario($ar_formulario){
        self::$ar_formulario = $ar_formulario;
    }
    
    Public Static Function setst_formulario($st_formulario){
        self::$st_formulario = $st_formulario;
    }
    
    Public Static Function setin_hier_form($in_hier_form){
        self::$in_hier_form = $in_hier_form;
    }
    Public Static Function setcd_usu_cad_form($cd_usu_cad_form){
        self::$cd_usu_cad_form = $cd_usu_cad_form;
    }
    Public Static Function setdt_usu_cad_form($dt_usu_cad_form){
        self::$dt_usu_cad_form = $dt_usu_cad_form;
    }
    Public Static Function setcd_usu_alt_form($cd_usu_alt_form){
        self::$cd_usu_alt_form = $cd_usu_alt_form;
    }
    Public Static Function setdt_usu_alt_form($dt_usu_alt_form){
        self::$dt_usu_alt_form = $dt_usu_alt_form;
    }

    /* Metodo Get */
    Public Static Function getcd_sistema(){
        return self::$cd_sistema;
    }
    Public Static Function getcd_formulario(){
        return self::$cd_formulario;
    }
    Public Static Function getnm_formulario(){
        return self::$nm_formulario;
    }
    Public Static Function getar_formulario(){
        return self::$ar_formulario;
    }
    Public Static Function getst_formulario(){
        return self::$st_formulario;
    }
    Public Static Function getin_hier_form(){
        return self::$in_hier_form;
    }
    Public Static Function getcd_usu_cad_form(){
        return self::$cd_usu_cad_form;
    }
    Public Static Function getdt_usu_cad_form(){
        return self::$dt_usu_cad_form;
    }
    Public Static Function getcd_usu_alt_form(){
        return self::$cd_usu_alt_form;
    }
    Public Static Function getdt_usu_alt_form(){
        return self::$dt_usu_alt_form;
    }

    Public Static Function ListaFormSistema(){

        $strsql = 'Select';
        $strsql.= ' t0004.cd_sistema,';
        $strsql.= ' t0004.cd_formulario,';
        $strsql.= ' t0004.nm_formulario,';
        $strsql.= ' t0004.ar_formulario,';
        $strsql.= ' t0004.st_formulario,';
        $strsql.= ' t0004.in_hier_form,';
        $strsql.= ' t0004.cd_usu_cad_form,';
        $strsql.= ' t0004.dt_usu_cad_form,';
        $strsql.= ' t0004.cd_usu_alt_form,';
        $strsql.= ' t0004.dt_usu_alt_form';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0004 t0004';
        $strsql.= ' Where';
        $strsql.= ' t0004.cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
        $strsql.= ' and';
        $strsql.= ' t0004.st_formulario in '.Mecanismo::TrataStringEnum(self::$st_formulario);
        $strsql.= ' Order by t0004.in_hier_form';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
}
?>
