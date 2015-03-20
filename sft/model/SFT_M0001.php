<?php

class SFT_M0001 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_fatur_bpa;
    Private Static $cd_agenda;
    Private Static $cd_cnes;
    Private Static $cd_prof;
    Private Static $cd_espld_medc;
    Private Static $cd_pac;
    Private Static $dt_fatur;
    Private Static $hr_fatur;
    Private Static $dt_atend;
    Private Static $cd_usu_cad_fatur;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa) {
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_fatur_bpa($cd_fatur_bpa) {
        self::$cd_fatur_bpa = $cd_fatur_bpa;
    }
    Public Static Function setcd_agenda($cd_agenda) {
        self::$cd_agenda = $cd_agenda;
    }
    Public Static Function setcd_cnes($cd_cnes) {
        self::$cd_cnes = $cd_cnes;
    }
    Public Static Function setcd_prof($cd_prof) {
        self::$cd_prof = $cd_prof;
    }
    Public Static Function setcd_espld_medc($cd_espld_medc) {
        self::$cd_espld_medc = $cd_espld_medc;
    }
    Public Static Function setcd_pac($cd_pac) {
        self::$cd_pac = $cd_pac;
    }
    Public Static Function sethr_fatur($hr_fatur) {
        self::$hr_fatur = $hr_fatur;
    }
    Public Static Function setdt_fatur($dt_fatur) {
        self::$dt_fatur = $dt_fatur;
    }
    Public Static Function setdt_atend($dt_atend) {
        self::$dt_atend = $dt_atend;
    }
    Public Static Function setcd_usu_cad_fatur($cd_usu_cad_fatur) {
        self::$cd_usu_cad_fatur = $cd_usu_cad_fatur;
    }
    
    Public Static Function Incluir(){
        
        $table = 'cerof.sft_t0001';
        
        $codigo = 'cd_fatur_bpa';
        $where = ' cd_empresa = '.self::TrataString(self::$cd_empresa);
                
        $dados["cd_empresa"] = self::$cd_empresa;
        $cd_fatur_bpa = Mecanismo::geraMaximoCodigoYYYYMM($codigo, $table, self::DataHoje() ,$where);
        $dados["cd_fatur_bpa"] = $cd_fatur_bpa;        
        (is_numeric(self::$cd_agenda) && !is_null(self::$cd_agenda)) ? $dados["cd_agenda"] =  self::$cd_agenda : '';
        $dados["cd_cnes"] = self::$cd_cnes;
        $dados["cd_prof"] = self::$cd_prof;
        $dados["cd_espld_medc"] = self::$cd_espld_medc;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["dt_atend"] = self::$dt_atend;
        $dados['hr_fatur'] = self::$hr_fatur;
        $dados["dt_fatur"] = self::$dt_fatur;
        $dados["cd_usu_cad_fatur"] = self::$cd_usu_cad_fatur;
       
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return $cd_fatur_bpa;
        }  else {
            return FALSE;
        }
        
    }
         
}
