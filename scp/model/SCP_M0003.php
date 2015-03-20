<?php

class SCP_M0003 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_solic_abert;
    Private Static $cd_pac;
    Private Static $cd_usu_solic;
    Private Static $dt_solic;
    Private Static $hr_solic;
    Private Static $cd_usu_atend;
    Private Static $dt_atend;
    Private Static $hr_atend;
    Private Static $cd_prateleira;
    Private Static $nr_linha;
    Private Static $nr_coluna;
    Private Static $nr_posicao;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static function setcd_solic_abert($cd_solic_abert){
        self::$cd_solic_abert = $cd_solic_abert;
    }
    Public Static function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
    }
    Public Static function setcd_usu_solic($cd_usu_solic){
        self::$cd_usu_solic = $cd_usu_solic;
    }
    Public Static function setdt_solic($dt_solic){
        self::$dt_solic = $dt_solic;
    }
    Public Static function sethr_solic($hr_solic){
        self::$hr_solic = $hr_solic;
    }
    Public Static function setcd_usu_atend($cd_usu_atend){
        self::$cd_usu_atend = $cd_usu_atend;
    }
    Public Static function setdt_atend($dt_atend){
        self::$dt_atend = $dt_atend;
    }
    Public Static function sethr_atend($hr_atend){
        self::$hr_atend = $hr_atend;
    }
    Public Static function setcd_prateleira($cd_prateleira){
        self::$cd_prateleira = $cd_prateleira;
    }
    Public Static function setnr_linha($nr_linha){
        self::$nr_linha = $nr_linha;
    }
    Public Static function setnr_coluna($nr_coluna){
        self::$nr_coluna = $nr_coluna;
    }
    Public Static function setnr_posicao($nr_posicao){
        self::$nr_posicao = $nr_posicao;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_prateleira;
    }
    Public Static Function getcd_solic_abert(){
        return self::$cd_solic_abert;
    }
    Public Static Function getcd_pac(){
        return self::$cd_pac;
    }
    Public Static Function getcd_usu_solic(){
        return self::$cd_usu_solic;
    }
    Public Static Function getdt_solic(){
        return self::$dt_solic;
    }
    Public Static Function gethr_solic(){
        return self::$hr_solic;
    }
    Public Static Function getcd_usu_atend(){
        return self::$cd_usu_atend;
    }
    Public Static Function getdt_atend(){
        return self::$dt_atend;
    }
    Public Static Function gethr_atend(){
        return self::$hr_atend;
    }
    Public Static Function getcd_prateleira(){
        return self::$cd_prateleira;
    }
    Public Static Function getnr_linha(){
        return self::$nr_linha;
    }
    Public Static Function getnr_coluna(){
        return self::$nr_coluna;
    }
    Public Static Function getnr_posicao(){
        return self::$nr_posicao;
    }

    Public Static Function consultaPacienteSolicitacao(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_empresa,';
        $strsql.= ' t0003.cd_pac,';
        $strsql.= ' t0003.cd_usu_solic,';
        $strsql.= ' t0003.dt_solic,';
        $strsql.= ' t0003.hr_solic,';
        $strsql.= ' t0003.cd_usu_atend,';
        $strsql.= ' t0003.dt_atend,';
        $strsql.= ' t0003.hr_atend,';
        $strsql.= ' t0003.cd_prateleira,';
        $strsql.= ' t0003.nr_linha,';
        $strsql.= ' t0003.nr_coluna,';
        $strsql.= ' t0003.nr_posicao';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0003 t0003';
        $strsql.= ' Where';
        $strsql.= ' t0003.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0003.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function listaSolicitacaoAberturaProntuario(){

        $strsql = 'Select';
        $strsql.= ' t0003.cd_empresa,';
        $strsql.= ' t0003.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= " DATE_FORMAT(Date(t0014.dt_nasc_pac),'%d/%m/%Y') as dt_nasc_pac,";
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0003.cd_usu_solic,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= " DATE_FORMAT(Date(t0003.dt_solic),'%d/%m/%Y') as dt_solic,";
        $strsql.= " Substring(TIME_FORMAT(t0003.hr_solic, '%T'),4,5) as hr_solic,";
        $strsql.= ' t0003.cd_usu_atend,';
        $strsql.= ' t0003.dt_atend,';
        $strsql.= ' t0003.hr_atend,';
        $strsql.= ' t0003.cd_prateleira,';
        $strsql.= ' t0003.nr_linha,';
        $strsql.= ' t0003.nr_coluna,';
        $strsql.= ' t0003.nr_posicao';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0003 t0003';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0003.cd_pac';
        $strsql.= ' inner join cerof.sca_t0002 t0002 on t0002.cd_usuario = t0003.cd_usu_solic';
        $strsql.= ' Where';
        $strsql.= ' t0003.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0003.dt_atend is null';
      
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function Incluir(){

        $table = 'cerof.scp_t0003';

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["cd_usu_solic"] = self::$cd_usu_solic;
        $dados["dt_solic"] = self::$dt_solic;
        $dados["hr_solic"] = self::$hr_solic;

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }

    Public Static Function excluir(){

        $table = 'cerof.scp_t0003';

        $where = "cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.= " and ";
        $where.= "cd_pac = ".Mecanismo::TrataString(self::$cd_pac);

        if(Mecanismo::ExecutaMetodo('Delete', $table, '',$where)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }

    Public Static Function alterar(){

        $table = 'cerof.scp_t0003';

        $dados["cd_usu_atend"] = self::$cd_usu_atend;
        $dados["dt_atend"] = self::$dt_atend;
        $dados["hr_atend"] = self::$hr_atend;
        $dados["cd_prateleira"] = self::$cd_prateleira;
        $dados["nr_linha"] = self::$nr_linha;
        $dados["nr_coluna"] = self::$nr_coluna;
        $dados["nr_posicao"] = self::$nr_posicao;

        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="cd_pac = ".self::$cd_pac;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
}
?>
