<?php

class _SGA_M0013 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_serv_painel;
    Private Static $nm_serv_painel;
    Private Static $in_serv_letra;
    Private Static $in_serv_pref;
    Private Static $st_serv_painel;
    Private Static $cd_depto;
    Private Static $cd_usuario;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_serv_painel($cd_serv_painel){
        self::$cd_serv_painel = $cd_serv_painel;
    }
    Public Static Function setnm_serv_painel($nm_serv_painel){
        self::$nm_serv_painel = $nm_serv_painel;
    }
    Public Static Function setin_serv_letra($in_serv_letra){
        self::$in_serv_letra = $in_serv_letra;
    }
    Public Static Function setin_serv_pref($in_serv_pref){
        self::$in_serv_pref = $in_serv_pref;
    }
    Public Static Function setst_serv_painel($st_serv_painel){
        self::$st_serv_painel = $st_serv_painel;
    }
    Public Static Function setcd_depto($cd_depto){
        self::$cd_depto = $cd_depto;
    }
    Public Static Function setcd_usuario($cd_usuario){
        self::$cd_usuario = $cd_usuario;
    }
        
    Public Static Function incluir(){

//        $table = 'cerof.sga_t0011';
//        $where = 'cd_empresa = '.self::$cd_empresa;
//   
//        $dados["cd_empresa"] = self::$cd_empresa;

//        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
        
    }
    
    Public Static Function ConsultaServico(){

        $strsql = 'Select';
        $strsql.= ' t0013.cd_empresa,';
        $strsql.= ' t0013.cd_serv_painel,';
        $strsql.= ' t0013.nm_serv_painel,';
        $strsql.= ' t0013.in_serv_letra,';
        $strsql.= ' t0013.in_serv_pref,';
        $strsql.= ' t0013.st_serv_painel';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0013 t0013';
        $strsql.= ' where';
        $strsql.= ' t0013.cd_empresa = '.self::TrataString(self::$cd_empresa);
        $strsql.= ' and t0013.st_serv_painel in '.self::TrataStringEnum(self::$st_serv_painel);
        
        //Buscar Codigo Serviço
        (is_numeric(self::$cd_serv_painel) && !is_null(self::$cd_serv_painel)) ? $strsql.= ' and t0013.cd_serv_painel = '.self::TrataString(self::$cd_serv_painel) : '';
        //Buscar Nome Serviço
        (!empty(self::$nm_serv_painel) && !is_null(self::$nm_serv_painel)) ? $strsql.= ' and t0013.nm_serv_painel like "%'.self::$nm_serv_painel.'%"' : '';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ConsultaNomeServicoDepto(){

        $strsql = 'Select';
        $strsql.= ' t0013.cd_empresa,';
        $strsql.= ' t0013.cd_serv_painel,';
        $strsql.= ' t0013.nm_serv_painel,';
        $strsql.= ' t0013.in_serv_letra,';
        $strsql.= ' t0013.in_serv_pref,';
        $strsql.= ' t0013.st_serv_painel';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0013 t0013';
        $strsql.= ' inner join cerof.sga_t0014 t0014 on t0014.cd_empresa = t0013.cd_empresa and t0014.cd_serv_painel = t0013.cd_serv_painel';
        $strsql.= ' inner join cerof.smt_t0001 t0001 on t0001.cd_empresa = t0014.cd_empresa and t0001.cd_depto = t0014.cd_depto';
        $strsql.= ' inner join cerof.smt_t0006 t0006 on t0006.cd_empresa = t0001.cd_empresa and t0006.cd_depto = t0001.cd_depto';
        $strsql.= ' where';
        $strsql.= ' t0013.cd_empresa = '.self::TrataString(self::$cd_empresa);
        $strsql.= ' and t0013.st_serv_painel in '.self::TrataStringEnum(self::$st_serv_painel);
        
        //Buscar Codigo Serviço
        (is_numeric(self::$cd_serv_painel) && !is_null(self::$cd_serv_painel)) ? $strsql.= ' and t0013.cd_serv_painel = '.self::TrataString(self::$cd_serv_painel) : '';
        //Buscar Codigo Departamento
        (is_numeric(self::$cd_depto) && !is_null(self::$cd_depto)) ? $strsql.= ' and t0001.cd_depto = '.self::TrataString(self::$cd_depto) : '';
        //Buscar Codigo Usuário
        (is_numeric(self::$cd_usuario) && !is_null(self::$cd_usuario)) ? $strsql.= ' and t0006.cd_usuario= '.self::TrataString(self::$cd_usuario) : '';
        //Buscar Nome Serviço
        (!empty(self::$nm_serv_painel) && !is_null(self::$nm_serv_painel)) ? $strsql.= ' and t0013.nm_serv_painel like "%'.self::$nm_serv_painel.'%"' : '';

        return Mecanismo::ConsultaMetodo($strsql);
    }
}

?>
