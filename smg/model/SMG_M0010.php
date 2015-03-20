<?php

class SMG_M0010 extends Mecanismo{

    Private Static $cd_procd_medc;
    Private Static $nm_procd_medc;
    Private Static $tp_sexo;
    Private Static $vl_idade_min;
    Private Static $vl_idade_max;
    Private Static $vl_sh;
    Private Static $vl_sa;
    Private Static $vl_sp;
    Private Static $st_procd_medc;

    /* Metodo Set */
    Public Static Function setcd_procd_medc($cd_procd_medc){
        self::$cd_procd_medc = $cd_procd_medc;
    }
    Public Static Function setnm_procd_medc($nm_procd_medc){
        self::$nm_procd_medc = $nm_procd_medc;
    }
    Public Static Function settp_sexo($tp_sexo){
        self::$tp_sexo = $tp_sexo;
    }
    Public Static Function setvl_idade_min($vl_idade_min){
        self::$vl_idade_min = $vl_idade_min;
    }
    Public Static Function setvl_idade_max($vl_idade_max){
        self::$vl_idade_max = $vl_idade_max;
    }
    Public Static Function setvl_sh($vl_sh){
        self::$vl_sh = $vl_sh;
    }
    Public Static Function setvl_sa($vl_sa){
        self::$vl_sa = $vl_sa;
    }
    Public Static Function setvl_sp($vl_sp){
        self::$vl_sp = $vl_sp;
    }
    Public Static Function setst_procd_medc($st_procd_medc){
        self::$st_procd_medc = $st_procd_medc;
    }

    
    Public Static Function ConsultaProcedimento(){

        $strsql = 'Select';
        $strsql.= ' t0010.cd_procd_medc,';
        $strsql.= ' t0010.nm_procd_medc,';
        $strsql.= ' t0010.tp_sexo,';
        $strsql.= ' t0010.vl_idade_min,';
        $strsql.= ' t0010.vl_idade_max,';
        $strsql.= ' t0010.vl_sh,';
        $strsql.= ' t0010.vl_sa,';
        $strsql.= ' t0010.vl_sp,';
        $strsql.= ' t0010.st_procd_medc';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0010 t0010';
        $strsql.= ' where';
        $strsql.= ' t0010.st_procd_medc in'.self::TrataStringEnum(self::$st_procd_medc);
        
        //Buscar Codigo Procedimento
        (is_numeric(self::$cd_procd_medc) && !is_null(self::$cd_procd_medc)) ? $strsql.= ' and t0010.cd_procd_medc = '.self::TrataString(self::$cd_procd_medc) : '';
        //Buscar Nome Procedimento
        (!empty(self::$nm_procd_medc) && !is_null(self::$nm_procd_medc)) ? $strsql.= ' and t0010.nm_procd_medc like "%'.self::$nm_procd_medc.'%"' : '';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
	
	Public Static Function BuscaNome(){
        
        
        $strsql  = "Select";
        $strsql .= " cd_procd_medc,";
        $strsql .= " nm_procd_medc";
        $strsql .= " From";
        $strsql .= " cerof.smg_t0010 t0010";
        $strsql .= " Where";
        $strsql .= " t0010.nm_procd_medc like '% ".self::$nm_procd_medc."%'";
                
        return Mecanismo::ConsultaMetodo($strsql); 

    }
    
    public Static Function ConsultaNome($tipo){
        
        $strsql  = "Select";
        $strsql .= " t0010.cd_procd_medc,";
        $strsql .= " t0010.nm_procd_medc";        
        $strsql .= " From";
        $strsql .= " cerof.smg_t0010 t0010";
        
        if($tipo == 'like'){
            $strsql .= " Where";
            $strsql .= " t0010.nm_procd_medc like '%".self::$nm_procd_medc."%'";
        }else{
            if($tipo == 'texto'){
                $strsql .= " Where";
                $strsql.= ' t0010.nm_procd_medc = '.Mecanismo::TrataString(self::$nm_procd_medc);
            }
        }
        
        $strsql .= " Limit 0,50";
        
        return Mecanismo::ConsultaMetodo($strsql);       
    }
    
    Public Static Function ConsultaCodigo(){
         
        
        $strsql  = "Select";
        $strsql .= " cd_procd_medc,";
        $strsql .= " nm_procd_medc";
        $strsql .= " From";
        $strsql .= " cerof.smg_t0010 t0010";
        $strsql .= " Where";
        $strsql .= " t0010.cd_procd_medc = ".Mecanismo::TrataString(self::$cd_procd_medc);
                
        return Mecanismo::ConsultaMetodo($strsql);     
     
        
    }

}
?>
