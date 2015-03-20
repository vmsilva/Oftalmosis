<?php

class SGA_M0004 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_cnes;
    Private Static $cd_tp_grade;
    Private Static $nm_tp_grade;
    Private Static $st_tp_grade;
    Private Static $st_agendamento;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_cnes($cd_cnes){
        self::$cd_cnes = $cd_cnes;
    }
    Public Static Function setcd_tp_grade($cd_tp_grade){
        self::$cd_tp_grade = $cd_tp_grade;
    }
    Public Static Function setnm_tp_grade($nm_tp_grade){
        self::$nm_tp_grade = $nm_tp_grade;
    }
    Public Static Function setst_tp_grade($st_tp_grade){
        self::$st_tp_grade = $st_tp_grade;
    }
    Public Static Function setst_agendamento($st_agendamento){
        self::$st_agendamento = $st_agendamento;
    }
    
    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_cnes(){
        return self::$cd_cnes;
    }
    Public Static Function getcd_tp_grade(){
        return self::$cd_tp_grade;
    }
    Public Static Function getnm_tp_grade(){
        return self::$nm_tp_grade;
    }
    Public Static Function getcst_tp_grade(){
        return self::$st_tp_grade;
    }
    Public Static Function getst_agendamento(){
        return self::$st_agendamento;
    }
    
    
    Public Static Function ConsultaNome(){

        $strsql = "Select";
        $strsql.= " t0004.cd_empresa,";
        $strsql.= " t0004.cd_cnes,";
        $strsql.= " t0004.cd_tp_grade,";
        $strsql.= " t0004.nm_tp_grade,";
        $strsql.= " t0004.st_tp_grade,";
        $strsql.= " t0004.st_agendamento";
        $strsql.= " From";
        $strsql.= " cerof.sga_t0004 t0004";
        $strsql.= " Where";
        $strsql.= " t0004.cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= " and";
        $strsql.= " t0004.cd_cnes = ".Mecanismo::TrataString(self::$cd_cnes);
        $strsql.= " and";
        $strsql.= " t0004.st_tp_grade = ".Mecanismo::TrataString(self::$st_tp_grade);
        if(is_null(self::$nm_tp_grade)){
            $strsql.= " and";
            $strsql.= " t0004.nm_tp_grade like '%".self::$nm_tp_grade."%'";
        }

        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>