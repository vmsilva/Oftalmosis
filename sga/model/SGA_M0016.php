<?php

class SGA_M0016 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_depto;
    Private Static $cd_box;
    Private Static $nm_box;
    Private Static $st_box;
    Private Static $cd_usuario;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_depto($cd_depto){
        self::$cd_depto = $cd_depto;
    }
    Public Static Function setcd_box($cd_box){
        self::$cd_box = $cd_box;
    }
    Public Static Function setnm_box($nm_box){
        self::$nm_box = $nm_box;
    }
    Public Static Function setst_box($st_box){
        self::$st_box = $st_box;
    }
    Public Static Function setcd_usuario($cd_usuario){
        self::$cd_usuario = $cd_usuario;
    }
        
    Public Static Function ConsultaGuicheDeptoUsuario(){

        $strsql = 'Select';
        $strsql.= ' t0016.cd_empresa,';
        $strsql.= ' t0016.cd_depto,';
        $strsql.= ' t0016.cd_box,';
        $strsql.= ' t0016.nm_box,';
        $strsql.= ' t0016.st_box';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0016 t0016';
        $strsql.= ' inner join cerof.smt_t0006 t0006 on t0006.cd_empresa = t0016.cd_empresa and t0006.cd_depto = t0016.cd_depto';
        $strsql.= ' where';
        $strsql.= ' t0016.cd_empresa = '.self::TrataString(self::$cd_empresa);
        $strsql.= ' and t0016.st_box in '.self::TrataStringEnum(self::$st_box);
        
        
        //Buscar Codigo Serviço
        (is_numeric(self::$cd_box) && !is_null(self::$cd_box)) ? $strsql.= ' and t0016.cd_box = '.self::TrataString(self::$cd_box) : '';
        //Buscar Codigo Serviço
        (is_numeric(self::$cd_usuario) && !is_null(self::$cd_usuario)) ? $strsql.= ' and t0006.cd_usuario = '.self::TrataString(self::$cd_usuario) : '';
        //Buscar Nome Serviço
        (!empty(self::$nm_box) && !is_null(self::$nm_box)) ? $strsql.= ' and t0016.nm_box like "%'.self::$nm_box.'%"' : '';
      
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
}
?>
