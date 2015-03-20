<?php

class SGA_M0011 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_fila;
    Private Static $cd_escola;
    Private Static $in_turno;
    Private Static $in_diabetico;
    Private Static $ds_hist_atual_doenca;
    Private Static $ds_anteced;
    Private Static $ds_ectoscopia;
    Private Static $in_av_sc_od;
    Private Static $in_av_sc_oe;
    Private Static $in_oc_od;
    Private Static $in_oc_oe;
    Private Static $in_rf_dn_od;
    Private Static $in_rf_dn_oe;
    Private Static $ds_conduta;
    Private Static $cd_usu_cad_fila_atend;
    Private Static $dt_usu_cad_fila_atend;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_fila($cd_fila){
        self::$cd_fila = $cd_fila;
    }
    Public Static Function setcd_escola($cd_escola){
        self::$cd_escola = $cd_escola;
    }
    Public Static Function setin_turno($in_turno){
        self::$in_turno = $in_turno;
    }
    Public Static Function setin_diabetico($in_diabetico){
        self::$in_diabetico = $in_diabetico;
    }
    Public Static Function setds_hist_atual_doenca($ds_hist_atual_doenca){
        self::$ds_hist_atual_doenca = $ds_hist_atual_doenca;
    }
    Public Static Function setds_anteced($ds_anteced){
        self::$ds_anteced = $ds_anteced;
    }
    Public Static Function setds_ectoscopia($ds_ectoscopia){
        self::$ds_ectoscopia = $ds_ectoscopia;
    }
    Public Static Function setin_av_sc_od($in_av_sc_od){
        self::$in_av_sc_od = $in_av_sc_od;
    }
    Public Static Function setin_av_sc_oe($in_av_sc_oe){
        self::$in_av_sc_oe = $in_av_sc_oe;
    }
    Public Static Function setin_oc_od($in_oc_od){
        self::$in_oc_od = $in_oc_od;
    }
    Public Static Function setin_oc_oe($in_oc_oe){
        self::$in_oc_oe = $in_oc_oe;
    }
    Public Static Function setin_rf_dn_od($in_rf_dn_od){
        self::$in_rf_dn_od = $in_rf_dn_od;
    }
    Public Static Function setin_rf_dn_oe($in_rf_dn_oe){
        self::$in_rf_dn_oe = $in_rf_dn_oe;
    }
    Public Static Function setds_conduta($ds_conduta){
        self::$ds_conduta = $ds_conduta;
    }
    Public Static Function setcd_usu_cad_fila_atend($cd_usu_cad_fila_atend){
        self::$cd_usu_cad_fila_atend = $cd_usu_cad_fila_atend;
    }
    Public Static Function setdt_usu_cad_fila_atend($dt_usu_cad_fila_atend){
        self::$dt_usu_cad_fila_atend = $dt_usu_cad_fila_atend;
    }
    
    /* Metodo Get */
    Public Static Function getcd_empresa(){
	return self::$cd_empresa;
    }
    Public Static Function getcd_fila(){
	return self::$cd_fila;
    }
    Public Static Function getcd_escola(){
	return self::$cd_escola;
    }
    Public Static Function getin_turno(){
	return self::$in_turno;
    }
    Public Static Function getin_diabetico(){
	return self::$in_diabetico;
    }
    Public Static Function getds_hist_atual_doenca(){
	return self::$ds_hist_atual_doenca;
    }
    Public Static Function getds_anteced(){
	return self::$ds_anteced;
    }
    Public Static Function getds_ectoscopia(){
	return self::$ds_ectoscopia;
    }
    Public Static Function getin_av_sc_od(){
	return self::$in_av_sc_od;
    }
    Public Static Function getin_av_sc_oe(){
	return self::$in_av_sc_oe;
    }
    Public Static Function getin_oc_od(){
	return self::$in_oc_od;
    }
    Public Static Function getin_oc_oe(){
	return self::$in_oc_oe;
    }
    Public Static Function getin_rf_dn_od(){
	return self::$in_rf_dn_od;
    }
    Public Static Function getin_rf_dn_oe(){
	return self::$in_rf_dn_oe;
    }
    Public Static Function getds_conduta(){
	return self::$ds_conduta;
    }
    Public Static Function getcd_usu_cad_fila_atend(){
	return self::$cd_usu_cad_fila_atend;
    }
    Public Static Function getdt_usu_cad_fila_atend(){
	return self::$dt_usu_cad_fila_atend;
    }
    
    
    Public Static Function incluir(){

        $table = 'cerof.sga_t0011';
        $where = 'cd_empresa = '.self::$cd_empresa;
   
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_fila"] = Mecanismo::geraMaximoCodigo('cd_fila',$table, $where);
        if(!is_null(self::$cd_escola)) $dados["cd_escola"] = strtoupper(self::$cd_escola);
        if(!is_null(self::$in_turno)) $dados["in_turno"] = self::$in_turno;
        if(!is_null(self::$in_diabetico)) $dados["in_diabetico"] = self::$in_diabetico;
        if((self::$ds_hist_atual_doenca)) $dados["ds_hist_atual_doenca"] = self::$ds_hist_atual_doenca;
        if(self::$ds_anteced !== '') $dados["ds_anteced"] = self::$ds_anteced;
        if(self::$ds_ectoscopia !== '') $dados["ds_ectoscopia"] = self::$ds_ectoscopia;
        if(self::$in_av_sc_od !== '') $dados["in_av_sc_od"] = self::$in_av_sc_od;
        if(self::$in_av_sc_oe !== '') $dados["in_av_sc_oe"] = self::$in_av_sc_oe;
        if(self::$in_oc_od !== '') $dados["in_oc_od"] = self::$in_oc_od;
        if(self::$in_oc_oe !== '') $dados["in_oc_oe"] = self::$in_oc_oe;
        if(self::$in_rf_dn_od !== '') $dados["in_rf_dn_od"] = self::$in_rf_dn_od;
        if(self::$in_rf_dn_oe !== '') $dados["in_rf_dn_oe"] = self::$in_rf_dn_oe;
        if(self::$ds_conduta !== '') $dados["ds_conduta"] = self::$ds_conduta;
        $dados["cd_usu_cad_fila_atend"] = self::$cd_usu_cad_fila_atend;
        $dados["dt_usu_cad_fila_atend"] = self::$dt_usu_cad_fila_atend;

        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
        
    }
}

?>
