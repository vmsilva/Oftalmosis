<?php

class SCP_M0001 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_prateleira;
    Private Static $nm_prateleira;
    Private Static $st_prateleira;
    Private Static $nr_linha_prateleira;
    Private Static $nr_coluna_prateleira;
    Private Static $nr_max_linha_coluna_item;
    Private Static $in_andar_prateleira;
    Private Static $cd_usu_cad_prat;
    Private Static $dt_cad_prat;
    Private Static $cd_usu_alt_prat;
    Private Static $dt_alt_prat;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static function setcd_prateleira($cd_prateleira){
        self::$cd_prateleira = $cd_prateleira;
    }
    Public Static function setnm_prateleira($nm_prateleira){
        self::$nm_prateleira = $nm_prateleira;
    }
    Public Static function setst_prateleira($st_prateleira){
        self::$st_prateleira = $st_prateleira;
    }
    Public Static function setnr_linha_prateleira($nr_linha_prateleira){
        self::$nr_linha_prateleira = $nr_linha_prateleira;
    }
    Public Static function setnr_coluna_prateleira($nr_coluna_prateleira){
        self::$nr_coluna_prateleira = $nr_coluna_prateleira;
    }
    Public Static function setnr_max_linha_coluna_item($nr_max_linha_coluna_item){
        self::$nr_max_linha_coluna_item = $nr_max_linha_coluna_item;
    }
    Public Static function setin_andar_prateleira($in_andar_prateleira){
        self::$in_andar_prateleira = $in_andar_prateleira;
    }
    Public Static function setcd_usu_cad_prat($cd_usu_cad_prat){
        self::$cd_usu_cad_prat = $cd_usu_cad_prat;
    }
    Public Static function setdt_cad_prat($dt_cad_prat){
        self::$dt_cad_prat = $dt_cad_prat;
    }
    Public Static function setcd_usu_alt_prat($cd_usu_alt_prat){
        self::$cd_usu_alt_prat = $cd_usu_alt_prat;
    }
    Public Static function setdt_alt_prat($dt_alt_prat){
        self::$dt_alt_prat = $dt_alt_prat;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_prateleira(){
        return self::$cd_prateleira;
    }
    Public Static Function getnm_prateleira(){
        return self::$nm_prateleira;
    }
    Public Static Function getst_prateleira(){
        return self::$st_prateleira;
    }
    Public Static Function getnr_linha_prateleira(){
        return self::$nr_linha_prateleira;
    }
    Public Static Function getnr_coluna_prateleira(){
        return self::$nr_coluna_prateleira;
    }
    Public Static Function getnr_max_linha_coluna_item(){
        return self::$nr_max_linha_coluna_item;
    }
    Public Static Function getin_andar_prateleira(){
        return self::$in_andar_prateleira;
    }
    Public Static Function getcd_usu_cad_prat(){
        return self::$cd_usu_cad_prat;
    }
    Public Static Function getdt_cad_prat(){
        return self::$dt_cad_prat;
    }
    Public Static Function getcd_usu_alt_prat(){
        return self::$cd_usu_alt_prat;
    }
    Public Static Function getdt_alt_prat(){
        return self::$dt_alt_prat;
    }


    Public Static Function consultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_empresa,';
        $strsql.= ' t0001_e.nm_empresa,';
        $strsql.= ' t0001.cd_prateleira,';
        $strsql.= ' t0001.nm_prateleira,';
        $strsql.= ' t0001.st_prateleira,';
        $strsql.= ' t0001.nr_linha_prateleira,';
        $strsql.= ' t0001.nr_coluna_prateleira,';
        $strsql.= ' t0001.nr_max_linha_coluna_item,';
        $strsql.= ' t0001.in_andar_prateleira,';
        $strsql.= ' t0001.cd_usu_cad_prat,';
        $strsql.= ' t0001.dt_cad_prat,';
        $strsql.= ' t0001.cd_usu_alt_prat,';
        $strsql.= ' t0001.dt_alt_prat';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0001 t0001';
        $strsql.= ' inner join cerof.sca_t0001 t0001_e on t0001_e.cd_empresa = t0001.cd_empresa';
        $strsql.= ' Where';
        $strsql.= ' t0001.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0001.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $strsql.= ' and';
        $strsql.= " t0001.st_prateleira in ".Mecanismo::TrataStringEnum(self::$st_prateleira);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function consultaNome($nolike = false){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_empresa,';
        $strsql.= ' t0001_e.nm_empresa,';
        $strsql.= ' t0001.cd_prateleira,';
        $strsql.= ' t0001.nm_prateleira,';
        $strsql.= ' t0001.st_prateleira,';
        $strsql.= ' t0001.nr_linha_prateleira,';
        $strsql.= ' t0001.nr_coluna_prateleira,';
        $strsql.= ' t0001.nr_max_linha_coluna_item,';
        $strsql.= ' t0001.in_andar_prateleira,';
        $strsql.= ' t0001.cd_usu_cad_prat,';
        $strsql.= ' t0001.dt_cad_prat,';
        $strsql.= ' t0001.cd_usu_alt_prat,';
        $strsql.= ' t0001.dt_alt_prat';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0001 t0001';
        $strsql.= ' inner join cerof.sca_t0001 t0001_e on t0001_e.cd_empresa = t0001.cd_empresa';
        $strsql.= ' Where';
        $strsql.= ' t0001.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        if($nolike){
            $strsql.= ' t0001.nm_prateleira = "'.self::$nm_prateleira.'"';
        }else{
            $strsql.= ' t0001.nm_prateleira like "%'.self::$nm_prateleira.'%"';
        }
        $strsql.= ' and';
        $strsql.= " t0001.st_prateleira in ".Mecanismo::TrataStringEnum(self::$st_prateleira);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function incluir(){

        $table = 'cerof.scp_t0001';
   
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_prateleira"] = Mecanismo::geraMaximoCodigo('cd_prateleira',$table, $where);
        $dados["nm_prateleira"] = strtoupper(self::$nm_prateleira);
        $dados["st_prateleira"] = self::$st_prateleira;
        $dados["nr_linha_prateleira"] = self::$nr_linha_prateleira;
        $dados["nr_coluna_prateleira"] = self::$nr_coluna_prateleira;
        $dados["nr_max_linha_coluna_item"] = self::$nr_max_linha_coluna_item;
        $dados["in_andar_prateleira"] = self::$in_andar_prateleira;
        $dados["cd_usu_cad_prat"] = self::$cd_usu_cad_prat;
        $dados["dt_cad_prat"] = self::$dt_cad_prat;
        $dados["cd_usu_alt_prat"] = self::$cd_usu_alt_prat;
        $dados["dt_alt_prat"] = self::$dt_alt_prat;

        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
        
    }

    Public Static Function alterar(){

        $table = 'cerof.scp_t0001';

        $dados["st_prateleira"] = self::$st_prateleira;
        $dados["cd_usu_alt_prat"] = self::$cd_usu_alt_prat;
        $dados["dt_alt_prat"] = self::$dt_alt_prat;

        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="cd_prateleira = ".self::$cd_prateleira;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }

    Public Static Function excluir(){

        $table = 'cerof.scp_t0001';

        $where = "cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.= " and ";
        $where.= "cd_prateleira = ".Mecanismo::TrataString(self::$cd_prateleira);

        return Mecanismo::ExecutaMetodo('Delete', $table, '',$where);

    }

}
?>