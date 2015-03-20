<?php

class SGA_M0015 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_serv_painel;
    Private Static $dt_chamada;
    Private Static $cd_senha;
    Private Static $in_serv_letra;
    Private Static $in_chamada_pref;
    Private Static $in_nome_pac;
    Private Static $st_chamada;
    Private Static $hr_chamada;
    Private Static $cd_usu_cad;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_serv_painel($cd_serv_painel){
        self::$cd_serv_painel = $cd_serv_painel;
    }
    Public Static Function setdt_chamada($dt_chamada){
        self::$dt_chamada = $dt_chamada;
    }
    Public Static Function setcd_senha($cd_senha){
        self::$cd_senha = $cd_senha;
    }
    Public Static Function setin_serv_letra($in_serv_letra){
        self::$in_serv_letra = $in_serv_letra;
    }
    Public Static Function setin_chamada_pref($in_chamada_pref){
        self::$in_chamada_pref = $in_chamada_pref;
    }
    Public Static Function setin_nome_pac($in_nome_pac){
        self::$in_nome_pac = $in_nome_pac;
    }
    Public Static Function setst_chamada($st_chamada){
        self::$st_chamada = $st_chamada;
    }
    Public Static Function sethr_chamada($hr_chamada){
        self::$hr_chamada = $hr_chamada;
    }
    Public Static Function setcd_usu_cad($cd_usu_cad){
        self::$cd_usu_cad = $cd_usu_cad;
    }
        
    Public Static Function incluir(){

        $table = 'cerof.sga_t0015';
        $where = 'cd_empresa = '.self::$cd_empresa;
        $where.= ' and cd_serv_painel = '.self::$cd_serv_painel;
        $where.= ' and dt_chamada = '.self::$dt_chamada;
   
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_serv_painel"] = self::$cd_serv_painel;
        $dados["dt_chamada"] = self::$dt_chamada;
        $dados["cd_senha"] = Mecanismo::geraMaximoCodigo('cd_senha', $table, $where);
        $dados["in_serv_letra"] = self::$in_serv_letra;
        $dados["in_chamada_pref"] = self::$in_chamada_pref;
        $dados["in_nome_pac"] = self::$in_nome_pac;
        $dados["st_chamada"] = self::$st_chamada;
        $dados["hr_chamada"] = self::$hr_chamada;
        $dados["cd_usu_cad"] = self::$cd_usu_cad;

        
        
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados, $where)){
            return $dados;
        }  else {
            return FALSE;
        }
    }
    
}
?>
