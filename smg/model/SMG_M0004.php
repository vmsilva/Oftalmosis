<?php

class SMG_M0004 extends Mecanismo{
    
    Private Static $cd_prof;
    Private Static $nm_prof;
    Private Static $nm_mae_prof;
    Private Static $tp_sexo_prof;
    Private Static $dt_nasc_prof;
    Private Static $cd_munic_nasc_prof;
    Private Static $nr_cns_prof;
    Private Static $nr_cpf_prof;
    Private Static $nr_fone_prof;
    Private Static $cd_pais_orig_prof;
    Private Static $cd_munic_end_prof;
    Private Static $cd_bairro_end_prof;
    Private Static $nm_bairro_end_prof;
    Private Static $ds_logr_end_prof;
    Private Static $ds_compl_end_prof;
    Private Static $ds_qd_end_prof;
    Private Static $ds_lt_end_prof;
    Private Static $nr_end_prof;
    Private Static $nr_cep_end_prof;
    Private Static $st_prof;
    Private Static $cd_usu_cad_end_prof;
    Private Static $dt_usu_cad_end_prof;
    Private Static $cd_usu_alt_end_prof;
    Private Static $dt_usu_alt_end_prof;
    Private Static $ds_email_prof;

    /* Metodo Set */
    Public Static Function setcd_prof($cd_prof) {
        self::$cd_prof = $cd_prof;
    }

    Public Static Function setnm_prof($nm_prof) {
        self::$nm_prof = $nm_prof;
    }

    Public Static Function setnm_mae_prof($nm_mae_prof) {
        self::$nm_mae_prof = $nm_mae_prof;
    }

    Public Static Function settp_sexo_prof($tp_sexo_prof) {
        self::$tp_sexo_prof = $tp_sexo_prof;
    }

    Public Static Function setdt_nasc_prof($dt_nasc_prof) {
        self::$dt_nasc_prof = $dt_nasc_prof;
    }

    Public Static Function setcd_munic_nasc_prof($cd_munic_nasc_prof) {
        self::$cd_munic_nasc_prof = $cd_munic_nasc_prof;
    }

    Public Static Function setnr_cns_prof($nr_cns_prof) {
        self::$nr_cns_prof = $nr_cns_prof;
    }

    Public Static Function setnr_cpf_prof($nr_cpf_prof) {
        self::$nr_cpf_prof = $nr_cpf_prof;
    }

    Public Static Function setnr_fone_prof($nr_fone_prof) {
        self::$nr_fone_prof = $nr_fone_prof;
    }

    Public Static Function setcd_pais_orig_prof($cd_pais_orig_prof) {
        self::$cd_pais_orig_prof = $cd_pais_orig_prof;
    }

    Public Static Function setcd_munic_end_prof($cd_munic_end_prof) {
        self::$cd_munic_end_prof = $cd_munic_end_prof;
    }

    Public Static Function setnm_bairro_end_prof($nm_bairro_end_prof) {
        self::$nm_bairro_end_prof = $nm_bairro_end_prof;
    }

    Public Static Function setds_logr_end_prof($ds_logr_end_prof) {
        self::$ds_logr_end_prof = $ds_logr_end_prof;
    }

    Public Static Function setds_compl_end_prof($ds_compl_end_prof) {
        self::$ds_compl_end_prof = $ds_compl_end_prof;
    }

    Public Static Function setds_qd_end_prof($ds_qd_end_prof) {
        self::$ds_qd_end_prof = $ds_qd_end_prof;
    }

    Public Static Function setds_lt_end_prof($ds_lt_end_prof) {
        self::$ds_lt_end_prof = $ds_lt_end_prof;
    }

    Public Static Function setnr_end_prof($nr_end_prof) {
        self::$nr_end_prof = $nr_end_prof;
    }

    Public Static Function setnr_cep_end_prof($nr_cep_end_prof) {
        self::$nr_cep_end_prof = $nr_cep_end_prof;
    }

    Public Static Function setst_prof($st_prof) {
        self::$st_prof = $st_prof;
    }

    Public Static Function setcd_usu_cad_end_prof($cd_usu_cad_end_prof) {
        self::$cd_usu_cad_end_prof = $cd_usu_cad_end_prof;
    }

    Public Static Function setdt_usu_cad_end_prof($dt_usu_cad_end_prof) {
        self::$dt_usu_cad_end_prof = $dt_usu_cad_end_prof;
    }

    Public Static Function setcd_usu_alt_end_prof($cd_usu_alt_end_prof) {
        self::$cd_usu_alt_end_prof = $cd_usu_alt_end_prof;
    }

    Public Static Function setdt_usu_alt_end_prof($dt_usu_alt_end_prof) {
        self::$dt_usu_alt_end_prof = $dt_usu_alt_end_prof;
    }

    Public Static Function setds_email_prof($ds_email_prof) {
        self::$ds_email_prof = $ds_email_prof;
    }

    Public Static Function ConsultaNome(){

        $strsql = 'Select';
        $strsql.= ' t0004.cd_prof,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0004.nm_mae_prof,';
        $strsql.= ' t0004.tp_sexo_prof,';
        $strsql.= ' t0004.dt_nasc_prof,';
        $strsql.= ' t0004.cd_munic_nasc_prof,';
        $strsql.= ' t0004.nr_cns_prof,';
        $strsql.= ' t0004.nr_cpf_prof,';
        $strsql.= ' t0004.nr_fone_prof,';
        $strsql.= ' t0004.cd_pais_orig_prof,';
        $strsql.= ' t0004.cd_munic_end_prof,';
        $strsql.= ' t0004.cd_bairro_end_prof,';
        $strsql.= ' t0004.nm_bairro_end_prof,';
        $strsql.= ' t0004.ds_logr_end_prof,';
        $strsql.= ' t0004.ds_compl_end_prof,';
        $strsql.= ' t0004.ds_qd_end_prof,';
        $strsql.= ' t0004.ds_lt_end_prof,';
        $strsql.= ' t0004.nr_end_prof,';
        $strsql.= ' t0004.nr_cep_end_prof,';
        $strsql.= ' t0004.st_prof,';
        $strsql.= ' t0004.cd_usu_cad_end_prof,';
        $strsql.= ' t0004.dt_usu_cad_end_prof,';
        $strsql.= ' t0004.cd_usu_alt_end_prof,';
        $strsql.= ' t0004.dt_usu_alt_end_prof,';
        $strsql.= ' t0004.ds_email_prof,';
        $strsql.= ' t0005.cd_conselho,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho,';
        $strsql.= ' t0005.nr_conselho,';
        $strsql.= ' t0005.cd_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0004 t0004';
        $strsql.= ' left join cerof.smg_t0005 t0005 on t0005.cd_prof = t0004.cd_prof';
        $strsql.= ' left join cerof.smg_t0003 t0003 on t0003.cd_conselho = t0005.cd_conselho';
        $strsql.= ' where';
        $strsql.= ' t0004.nm_prof like "%'.self::$nm_prof.'%"';

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ConsultaProfissionalCPF(){

        $strsql = 'Select';
        $strsql.= ' t0004.cd_prof,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0004.nm_mae_prof,';
        $strsql.= ' t0004.tp_sexo_prof,';
        $strsql.= ' t0004.dt_nasc_prof,';
        $strsql.= ' t0004.cd_munic_nasc_prof,';
        $strsql.= ' t0004.nr_cns_prof,';
        $strsql.= ' t0004.nr_cpf_prof,';
        $strsql.= ' t0004.nr_fone_prof,';
        $strsql.= ' t0004.cd_pais_orig_prof,';
        $strsql.= ' t0004.cd_munic_end_prof,';
        $strsql.= ' t0004.cd_bairro_end_prof,';
        $strsql.= ' t0004.nm_bairro_end_prof,';
        $strsql.= ' t0004.ds_logr_end_prof,';
        $strsql.= ' t0004.ds_compl_end_prof,';
        $strsql.= ' t0004.ds_qd_end_prof,';
        $strsql.= ' t0004.ds_lt_end_prof,';
        $strsql.= ' t0004.nr_end_prof,';
        $strsql.= ' t0004.nr_cep_end_prof,';
        $strsql.= ' t0004.st_prof,';
        $strsql.= ' t0004.cd_usu_cad_end_prof,';
        $strsql.= ' t0004.dt_usu_cad_end_prof,';
        $strsql.= ' t0004.cd_usu_alt_end_prof,';
        $strsql.= ' t0004.dt_usu_alt_end_prof,';
        $strsql.= ' t0004.ds_email_prof';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0004 t0004';
        $strsql.= ' where';
        $strsql.= ' t0004.nr_cpf_prof = '.Mecanismo::TrataString(self::$nr_cpf_prof);
        $strsql.= ' and';
        $strsql.= ' t0004.st_prof in '.Mecanismo::TrataStringEnum(self::$st_prof);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ValidandoRegistro(){}
    
    Public Static Function ConsultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0004.cd_prof,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0004.nr_cpf_prof,';
        $strsql.= ' t0005.cd_conselho,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho,';
        $strsql.= ' t0005.nr_conselho,';
        $strsql.= ' t0005.cd_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0004 t0004';
        $strsql.= ' inner join cerof.smg_t0005 t0005 on t0005.cd_prof = t0004.cd_prof';
        $strsql.= ' inner join cerof.smg_t0003 t0003 on t0003.cd_conselho = t0005.cd_conselho';
        $strsql.= ' where';
        $strsql.= ' t0004.cd_prof = '.Mecanismo::TrataString(self::$cd_prof);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ConsultaCodigoConselhoCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0005.cd_prof,';
        $strsql.= ' t0005.nr_conselho,';
        $strsql.= ' t0005.cd_conselho,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0004.nm_mae_prof,';
        $strsql.= ' t0004.tp_sexo_prof,';
        $strsql.= ' t0004.dt_nasc_prof,';
        $strsql.= ' t0004.cd_munic_nasc_prof,';
        $strsql.= ' t0004.nr_cns_prof,';
        $strsql.= ' t0004.nr_cpf_prof,';
        $strsql.= ' t0004.nr_fone_prof,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho,';
        $strsql.= ' t0005.cd_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0005 t0005';
        $strsql.= ' inner join cerof.smg_t0004 t0004 on t0004.cd_prof = t0005.cd_prof';
        $strsql.= ' inner join cerof.smg_t0003 t0003 on t0003.cd_conselho = t0005.cd_conselho';
        $strsql.= ' where';
        $strsql.= ' t0005.nr_conselho = '.Mecanismo::TrataString(self::$nr_conselho);
        $strsql.= ' and';
        $strsql.= ' t0003.cd_conselho = '.Mecanismo::TrataString(self::$cd_conselho);
        $strsql.= ' and';
        $strsql.= ' t0005.cd_uf = '.Mecanismo::TrataString(self::$cd_uf);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function Incluir(){
        
        $table = 'cerof.smg_t0004';
        
        $dados['cd_prof'] = Mecanismo::geraMaximoCodigo('cd_prof', 'smg_t0004');
        $dados['nr_cpf_prof'] = self::$nr_cpf_prof;
        !empty(self::$nr_cns_prof) ? $dados['nr_cns_prof'] = self::$nr_cns_prof : '';
        $dados['st_prof'] = self::$st_prof;
        $dados['nm_prof'] = strtoupper(self::$nm_prof);
        $dados['tp_sexo_prof'] = self::$tp_sexo_prof;
        $dados['dt_nasc_prof'] = self::$dt_nasc_prof;
        $dados['nm_mae_prof'] = strtoupper(self::$nm_mae_prof);
        $dados['cd_pais_orig_prof'] = self::$cd_pais_orig_prof;
        $dados['cd_munic_nasc_prof'] = self::$cd_munic_nasc_prof;
        //Endereço
        $dados['cd_munic_end_prof'] = self::$cd_munic_end_prof;
        !empty(self::$nm_bairro_end_prof) ? $dados['nm_bairro_end_prof'] = strtoupper(self::$nm_bairro_end_prof) : '';
        !empty(self::$ds_logr_end_prof) ? $dados['ds_logr_end_prof'] = strtoupper(self::$ds_logr_end_prof) : '';
        !empty(self::$ds_compl_end_prof) ? $dados['ds_compl_end_prof'] = strtoupper(self::$ds_compl_end_prof) : '';
        !empty(self::$ds_qd_end_prof) ? $dados['ds_qd_end_prof'] = strtoupper(self::$ds_qd_end_prof) : '';
        !empty(self::$ds_lt_end_prof) ? $dados['ds_lt_end_prof'] = strtoupper(self::$ds_lt_end_prof) : '';
        !empty(self::$nr_end_prof) ? $dados['nr_end_prof'] = self::$nr_end_prof : '';
        !empty(self::$nr_cep_end_prof) ? $dados['nr_cep_end_prof'] = self::$nr_cep_end_prof : '';
        !empty(self::$nr_fone_prof) ? $dados['nr_fone_prof'] = self::$nr_fone_prof : '';
        !empty(self::$ds_email_prof) ? $dados['ds_email_prof'] = strtolower(self::$ds_email_prof) : '';
        $dados['cd_usu_cad_end_prof'] = self::$cd_usu_cad_end_prof;
        $dados['dt_usu_cad_end_prof'] = self::$dt_usu_cad_end_prof;
        

        return array('sinal'=>Mecanismo::ExecutaMetodo('INSERT', $table, $dados),'cd_prof'=>$dados['cd_prof']);
    }
    
    Public Static Function Alterar(){
        
        $table = 'cerof.smg_t0004';
        $where = "cd_prof = ".self::$cd_prof;

        !empty(self::$nr_cns_prof) ? $dados['nr_cns_prof'] = self::$nr_cns_prof : '';
        $dados['st_prof'] = self::$st_prof;
        $dados['cd_munic_nasc_prof'] = self::$cd_munic_nasc_prof;
        //Endereço
        $dados['cd_munic_end_prof'] = self::$cd_munic_end_prof;
        !empty(self::$nm_bairro_end_prof) ? $dados['nm_bairro_end_prof'] = strtoupper(self::$nm_bairro_end_prof) : $dados['nm_bairro_end_prof'] = null;
        !empty(self::$ds_logr_end_prof) ? $dados['ds_logr_end_prof'] = strtoupper(self::$ds_logr_end_prof) : $dados['ds_logr_end_prof'] = null;
        !empty(self::$ds_compl_end_prof) ? $dados['ds_compl_end_prof'] = strtoupper(self::$ds_compl_end_prof) : $dados['ds_compl_end_prof'] = null;
        !empty(self::$ds_qd_end_prof) ? $dados['ds_qd_end_prof'] = strtoupper(self::$ds_qd_end_prof) : $dados['ds_qd_end_prof'] = null;
        !empty(self::$ds_lt_end_prof) ? $dados['ds_lt_end_prof'] = strtoupper(self::$ds_lt_end_prof) : $dados['ds_lt_end_prof'] = null;
        !empty(self::$nr_end_prof) ? $dados['nr_end_prof'] = self::$nr_end_prof : $dados['nr_end_prof'] = null;
        !empty(self::$nr_cep_end_prof) ? $dados['nr_cep_end_prof'] = self::$nr_cep_end_prof : $dados['nr_cep_end_prof'] = null;
        !empty(self::$nr_fone_prof) ? $dados['nr_fone_prof'] = self::$nr_fone_prof : $dados['nr_fone_prof'] = null;
        !empty(self::$ds_email_prof) ? $dados['ds_email_prof'] = strtolower(self::$ds_email_prof) : $dados['ds_email_prof'] = null;
        $dados['cd_usu_alt_end_prof'] = self::$cd_usu_alt_end_prof;
        $dados['dt_usu_alt_end_prof'] = self::$dt_usu_alt_end_prof;
        
        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    Public Static Function Excluir(){
        
        $table = 'cerof.smg_t0004';
        $where = "cd_prof = ".self::$cd_prof;

        return Mecanismo::ExecutaMetodo('DELETE', $table, '', $where);
        
    }
}
?>
