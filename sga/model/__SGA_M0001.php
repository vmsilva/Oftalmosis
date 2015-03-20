<?php

class SGA_M0001 extends Mecanismo{
   
Private Static $cd_empresa;
Private Static $cd_grp_consulta;
Private Static $nm_grp_consulta;
Private Static $st_grp_consulta;
Private Static $cd_usu_cad_grp_consulta;
Private Static $dt_usu_cad_grp_consulta;
Private Static $cd_usu_alt_grp_consulta;
Private Static $dt_usu_alt_grp_consulta;


    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_grp_consulta($cd_grp_consulta){
        self::$cd_grp_consulta = $cd_grp_consulta;
    }
    Public Static Function setnm_grp_consulta($nm_grp_consulta){
        self::$nm_grp_consulta = $nm_grp_consulta;
    }
    Public Static Function setst_grp_consulta($st_grp_consulta){
        self::$st_grp_consulta = $st_grp_consulta;
    }
    Public Static Function setcd_usu_cad_grp_consulta($cd_usu_cad_grp_consulta){
        self::$cd_usu_cad_grp_consulta = $cd_usu_cad_grp_consulta;
    }
    Public Static Function setdt_usu_cad_grp_consulta($dt_usu_cad_grp_consulta){
        self::$dt_usu_cad_grp_consulta = $dt_usu_cad_grp_consulta;
    }
    Public Static Function setcd_usu_alt_grp_consulta($cd_usu_alt_grp_consulta){
        self::$cd_usu_alt_grp_consulta = $cd_usu_alt_grp_consulta;
    }
    Public Static Function setdt_usu_alt_grp_consulta($dt_usu_alt_grp_consulta){
        self::$dt_usu_alt_grp_consulta = $dt_usu_alt_grp_consulta;
    }
    
    Public Static Function ConsultaGrupoConsulta(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_empresa,';
        $strsql.= ' t0001.cd_grp_consulta,';
        $strsql.= ' t0001.nm_grp_consulta,';
        $strsql.= ' t0001.st_grp_consulta,';
        $strsql.= ' t0001.cd_usu_cad_grp_consulta,';
        $strsql.= ' t0001.dt_usu_cad_grp_consulta,';
        $strsql.= ' t0001.cd_usu_alt_grp_consulta,';
        $strsql.= ' t0001.dt_usu_alt_grp_consulta';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0001 t0001';
        $strsql.= ' where';
        $strsql.= ' t0001.cd_empresa = '.self::TrataString(self::$cd_empresa);
        $strsql.= ' and t0001.st_grp_consulta in '.self::TrataStringEnum(self::$st_grp_consulta);
        
        //Buscar Codigo Procedimento
        (is_numeric(self::$cd_grp_consulta) && !is_null(self::$cd_grp_consulta)) ? $strsql.= ' and t0001.cd_grp_consulta = '.self::TrataString(self::$cd_grp_consulta) : '';
        //Buscar Nome Procedimento
        (!empty(self::$nm_grp_consulta) && !is_null(self::$nm_grp_consulta)) ? $strsql.= ' and t0001.nm_grp_consulta like "%'.self::$nm_grp_consulta.'%"' : '';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }

}
?>
