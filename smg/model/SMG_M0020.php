<?php

class SMG_M0020 extends Mecanismo {


    Private Static $cd_pac;
    Private Static $nm_pac;
    Private Static $tp_sexo_pac;
    Private Static $dt_nasc_pac;
    Private Static $cd_munic_nasc_pac;
    Private Static $nm_mae_pac;
    Private Static $cd_munic_nasc_mae_pac;
    Private Static $cd_pais_orig_pac;
    Private Static $cd_usu_cad_pac;
    Private Static $dt_usu_cad_pac;
    Private Static $cd_usu_alt_pac;
    Private Static $dt_usu_alt_pac;
    Private Static $hr_usu_alt_pac;

    /* Metodo Set */
    Public Static function setcd_pac($cd_pac){
	self::$cd_pac = $cd_pac;
    }
    Public Static function setnm_pac($nm_pac){
        self::$nm_pac = $nm_pac;
    }
    Public Static function settp_sexo_pac($tp_sexo_pac){
        self::$tp_sexo_pac = $tp_sexo_pac;
    }
    Public Static function setdt_nasc_pac($dt_nasc_pac){
        self::$dt_nasc_pac = $dt_nasc_pac;
    }
    Public Static function setcd_munic_nasc_pac($cd_munic_nasc_pac){
        self::$cd_munic_nasc_pac = $cd_munic_nasc_pac;
    }
    Public Static function setnm_mae_pac($nm_mae_pac){
        self::$nm_mae_pac = $nm_mae_pac;
    }
    Public Static function setcd_munic_nasc_mae_pac($cd_munic_nasc_mae_pac){
        self::$cd_munic_nasc_mae_pac = $cd_munic_nasc_mae_pac;
    }
    Public Static function setcd_pais_orig_pac($cd_pais_orig_pac){
        self::$cd_pais_orig_pac = $cd_pais_orig_pac;
    }
    Public Static function setcd_usu_cad_pac($cd_usu_cad_pac){
        self::$cd_usu_cad_pac = $cd_usu_cad_pac;
    }
    Public Static function setdt_usu_cad_pac($dt_usu_cad_pac){
        self::$dt_usu_cad_pac = $dt_usu_cad_pac;
    }
    Public Static function setcd_usu_alt_pac($cd_usu_alt_pac){
        self::$cd_usu_alt_pac = $cd_usu_alt_pac;
    }
    Public Static function setdt_usu_alt_pac($dt_usu_alt_pac){
        self::$dt_usu_alt_pac = $dt_usu_alt_pac;
    }
    Public Static function sethr_usu_alt_pac($hr_usu_alt_pac){
        self::$hr_usu_alt_pac = $hr_usu_alt_pac;
    }
    
    /* Metodo Get */
    Public Static Function getcd_pac(){
	return self::$cd_pac;
    }
    Public Static Function getnm_pac(){
        return self::$nm_pac;
    }
    Public Static Function gettp_sexo_pac(){
        return self::$tp_sexo_pac;
    }
    Public Static Function getdt_nasc_pac(){
        return self::$dt_nasc_pac;
    }
    Public Static Function getcd_munic_nasc_pac(){
        return self::$cd_munic_nasc_pac;
    }
    Public Static Function getnm_mae_pac(){
        return self::$nm_mae_pac;
    }
    Public Static Function getcd_munic_nasc_mae_pac(){
        return self::$cd_munic_nasc_mae_pac;
    }
    Public Static Function getcd_pais_orig_pac(){
        return self::$cd_pais_orig_pac;
    }
    Public Static Function getcd_usu_alt_pac(){
        return self::$cd_usu_alt_pac;
    }
    Public Static Function getdt_usu_alt_pac(){
        return self::$dt_usu_alt_pac;
    }
    Public Static Function gethr_usu_alt_pac(){
        return self::$hr_usu_alt_pac;
    }

    Public Static Function Incluir(){
        
        $table = 'cerof.smg_t0020';
        $where = 'cd_pac = ' .strtoupper(self::$cd_pac);
        
        $dados["cd_pac"] = strtoupper(self::$cd_pac);
        $dados["cd_pac_inc"] = Mecanismo::geraMaximoCodigo('cd_pac_inc', $table, $where);
        $dados["nm_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["tp_sexo_pac"] = strtoupper(self::$tp_sexo_pac);
        $dados["dt_nasc_pac"] = strtoupper(self::$dt_nasc_pac);
        $dados["cd_munic_nasc_pac"] = strtoupper(self::$cd_munic_nasc_pac);
        $dados["nm_mae_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_mae_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["cd_pais_orig_pac"] = strtoupper(self::$cd_pais_orig_pac);
        (is_numeric(self::$cd_munic_nasc_mae_pac) && !is_null(self::$cd_munic_nasc_mae_pac)) ? $dados["cd_munic_nasc_mae_pac"] =  self::$cd_munic_nasc_mae_pac :  '';
        $dados["cd_usu_alt_pac"] = strtoupper(self::$cd_usu_alt_pac);
        $dados["dt_usu_alt_pac"] = strtoupper(self::$dt_usu_alt_pac);
        $dados["hr_usu_alt_pac"] = strtoupper(self::$hr_usu_alt_pac);

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return true;
        }  else {
            return FALSE;
        }
    }
    
}
?>
