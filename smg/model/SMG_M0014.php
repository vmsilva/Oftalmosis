<?php

class SMG_M0014 extends Mecanismo {

    Private Static $cd_empresa;
    Private Static $cd_pac;
    Private Static $nm_pac;
    Private Static $tp_sexo_pac;
    Private Static $dt_nasc_pac;
    Private Static $cd_munic_nasc_pac;
    Private Static $nr_cns_pac;
    Private Static $nm_mae_pac;
    Private Static $cd_munic_nasc_mae_pac;
    Private Static $cd_pais_orig_pac;
    Private Static $nr_fone_pac_01;
    Private Static $nr_fone_pac_02;
    Private Static $nr_fone_pac_03;
    Private Static $cd_munic_pac;
    Private Static $nm_bairro_pac;
    Private Static $ds_logr_pac;
    Private Static $ds_compl_pac;
    Private Static $ds_qd_pac;
    Private Static $ds_lt_pac;
    Private Static $nr_pac;
    Private Static $nr_cep_pac;
    Private Static $ds_email_pac;
    Private Static $st_pac_sms;
    Private Static $cd_usu_cad_pac;
    Private Static $dt_usu_cad_pac;
    Private Static $cd_usu_alt_pac;
    Private Static $dt_usu_alt_pac;
    Private Static $st_pac;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
	self::$cd_empresa = $cd_empresa;
    }
    Public Static function setcd_pac($cd_pac){
	self::$cd_pac = $cd_pac;
    }
    Public Static function setnm_pac($nm_pac){
        self::$nm_pac = $nm_pac;
    }
    Public Static function settp_sexo_pac($tp_sexo_pac){
        self::$tp_sexo_pac = $tp_sexo_pac;
    }
    Public Static function setdt_nasc_pac($dt_nasc_pac){
        self::$dt_nasc_pac = $dt_nasc_pac;
    }
    Public Static function setcd_munic_nasc_pac($cd_munic_nasc_pac){
        self::$cd_munic_nasc_pac = $cd_munic_nasc_pac;
    }
    Public Static function setnr_cns_pac($nr_cns_pac){
        self::$nr_cns_pac = $nr_cns_pac;
    }
    Public Static function setnm_mae_pac($nm_mae_pac){
        self::$nm_mae_pac = $nm_mae_pac;
    }
    Public Static function setcd_munic_nasc_mae_pac($cd_munic_nasc_mae_pac){
        self::$cd_munic_nasc_mae_pac = $cd_munic_nasc_mae_pac;
    }
    Public Static function setcd_pais_orig_pac($cd_pais_orig_pac){
        self::$cd_pais_orig_pac = $cd_pais_orig_pac;
    }
    Public Static function setnr_fone_pac_01($nr_fone_pac_01){
        self::$nr_fone_pac_01 = $nr_fone_pac_01;
    }
    Public Static function setnr_fone_pac_02($nr_fone_pac_02){
        self::$nr_fone_pac_02 = $nr_fone_pac_02;
    }
    Public Static function setnr_fone_pac_03($nr_fone_pac_03){
        self::$nr_fone_pac_03 = $nr_fone_pac_03;
    }
    Public Static function setcd_munic_pac($cd_munic_pac){
        self::$cd_munic_pac = $cd_munic_pac;
    }
    Public Static function setnm_bairro_pac($nm_bairro_pac){
        self::$nm_bairro_pac = $nm_bairro_pac;
    }
    Public Static function setds_logr_pac($ds_logr_pac){
        self::$ds_logr_pac = $ds_logr_pac;
    }
    Public Static function setds_compl_pac($ds_compl_pac){
        self::$ds_compl_pac = $ds_compl_pac;
    }
    Public Static function setds_qd_pac($ds_qd_pac){
        self::$ds_qd_pac = $ds_qd_pac;
    }
    Public Static function setds_lt_pac($ds_lt_pac){
        self::$ds_lt_pac = $ds_lt_pac;
    }
    Public Static function setnr_pac($nr_pac){
        self::$nr_pac = $nr_pac;
    }
    Public Static function setnr_cep_pac($nr_cep_pac){
        self::$nr_cep_pac = $nr_cep_pac;
    }
    Public Static function setds_email_pac($ds_email_pac){
        self::$ds_email_pac = $ds_email_pac;
    }
    Public Static function setst_pac_sms($st_pac_sms){
        self::$st_pac_sms = $st_pac_sms;
    }
    Public Static function setcd_usu_cad_pac($cd_usu_cad_pac){
        self::$cd_usu_cad_pac = $cd_usu_cad_pac;
    }
    Public Static function setdt_usu_cad_pac($dt_usu_cad_pac){
        self::$dt_usu_cad_pac = $dt_usu_cad_pac;
    }
    Public Static function setcd_usu_alt_pac($cd_usu_alt_pac){
        self::$cd_usu_alt_pac = $cd_usu_alt_pac;
    }
    Public Static function setdt_usu_alt_pac($dt_usu_alt_pac){
        self::$dt_usu_alt_pac = $dt_usu_alt_pac;
    }
    Public Static function setst_pac($st_pac){
        self::$st_pac = $st_pac;
    }

    Public Static Function consultaNome(){

        $strsql = 'Select';
        $strsql.= ' t0014.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= " DATE_FORMAT(Date(t0014.dt_nasc_pac),'%d/%m/%Y') as dt_nasc_pac,";
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.cd_munic_nasc_mae_pac,';
        $strsql.= ' t0014.cd_pais_orig_pac,';
        $strsql.= ' t0014.nr_fone_pac_01,';
        $strsql.= ' t0014.nr_fone_pac_02,';
        $strsql.= ' t0014.nr_fone_pac_03,';
        $strsql.= ' t0014.cd_munic_pac,';
        $strsql.= ' t0014.nm_bairro_pac,';
        $strsql.= ' t0014.ds_logr_pac,';
        $strsql.= ' t0014.ds_compl_pac,';
        $strsql.= ' t0014.ds_qd_pac,';
        $strsql.= ' t0014.ds_lt_pac,';
        $strsql.= ' t0014.nr_pac,';
        $strsql.= ' t0014.nr_cep_pac,';
        $strsql.= ' t0014.ds_email_pac,';
        $strsql.= ' t0014.st_pac_sms,';
        $strsql.= ' t0014.cd_usu_cad_pac,';
        $strsql.= ' t0014.dt_usu_cad_pac,';
        $strsql.= ' t0014.cd_usu_alt_pac,';
        $strsql.= ' t0014.dt_usu_alt_pac';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0014 t0014';
        $strsql.= ' Where';
        if(trim(self::$nr_cns_pac) !== ''){
            $strsql.= ' t0014.nr_cns_pac like "%'.self::$nr_cns_pac.'%"';
        }else{
            $strsql.= ' t0014.nm_pac like "%'.self::$nm_pac.'%"';
            if(trim(self::$tp_sexo_pac) !== ''){
                $strsql.= ' and'; 
                $strsql.= ' t0014.tp_sexo_pac = '. Mecanismo::TrataString(self::$tp_sexo_pac);
            }
//            $strsql.= ' and';
//            $strsql.= ' t0014.tp_sexo_pac = '. Mecanismo::TrataString(self::$tp_sexo_pac);
            if(trim(self::$dt_nasc_pac) !== ''){
                $strsql.= ' and';
                $strsql.= ' t0014.dt_nasc_pac = '.Mecanismo::TrataString(self::$dt_nasc_pac);
            }
            if(trim(self::$nm_mae_pac) !== ''){
                $strsql.= ' and';
                $strsql.= ' t0014.nm_mae_pac like "%'.self::$nm_mae_pac.'%"';
            }
        }
        $strsql.= ' and';
        $strsql.= ' t0014.st_pac = '.Mecanismo::TrataStringEnum(self::$st_pac);
	$strsql.= ' Limit 0,100';
        
        return Mecanismo::ConsultaMetodo($strsql);
        //exit($strsql);
    }
    Public Static Function consultaNomePacienteProntuario($st_prontuario){

        $strsql = 'Select';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0014.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= " DATE_FORMAT(Date(t0014.dt_nasc_pac),'%d/%m/%Y') as dt_nasc_pac,";
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.cd_munic_nasc_mae_pac,';
        $strsql.= ' t0014.cd_pais_orig_pac,';
        $strsql.= ' t0014.nr_fone_pac_01,';
        $strsql.= ' t0014.nr_fone_pac_02,';
        $strsql.= ' t0014.nr_fone_pac_03,';
        $strsql.= ' t0014.cd_munic_pac,';
        $strsql.= ' t0014.nm_bairro_pac,';
        $strsql.= ' t0014.ds_logr_pac,';
        $strsql.= ' t0014.ds_compl_pac,';
        $strsql.= ' t0014.ds_qd_pac,';
        $strsql.= ' t0014.ds_lt_pac,';
        $strsql.= ' t0014.nr_pac,';
        $strsql.= ' t0014.nr_cep_pac,';
        $strsql.= ' t0014.ds_email_pac,';
        $strsql.= ' t0014.st_pac_sms,';
        $strsql.= ' t0014.cd_usu_cad_pac,';
        $strsql.= ' t0014.dt_usu_cad_pac,';
        $strsql.= ' t0014.cd_usu_alt_pac,';
        $strsql.= ' t0014.dt_usu_alt_pac';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0014 t0014';
        $strsql.= ' inner join cerof.scp_t0002 t0002 on t0002.cd_pac = t0014.cd_pac';
        
        $strsql.= ' Where';
        if(trim(self::$nr_cns_pac) !== ''){
            $strsql.= ' t0014.nr_cns_pac like "%'.self::$nr_cns_pac.'%"';
        }else{
            $strsql.= ' t0014.nm_pac like "%'.self::$nm_pac.'%"';
            $strsql.= ' and';
            $strsql.= ' t0014.tp_sexo_pac = '. Mecanismo::TrataString(self::$tp_sexo_pac);
            if(trim(self::$dt_nasc_pac) !== ''){
                $strsql.= ' and';
                $strsql.= ' t0014.dt_nasc_pac = '.Mecanismo::TrataString(self::$dt_nasc_pac);
            }
            if(trim(self::$nm_mae_pac) !== ''){
                $strsql.= ' and';
                $strsql.= ' t0014.nm_mae_pac like "%'.self::$nm_mae_pac.'%"';
            }
        }
        $strsql.= ' and';
        $strsql.= ' t0014.st_pac = '.Mecanismo::TrataStringEnum(self::$st_pac);
        $strsql.= ' and';
        $strsql.= ' t0002.st_prontuario in '.Mecanismo::TrataStringEnum($st_prontuario);
        $strsql.= ' Order by t0002.st_prontuario, t0014.nm_pac, t0014.dt_nasc_pac';
	$strsql.= ' Limit 0,100';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function consultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0014.cd_pac,';
        $strsql.= ' t0002_p.nr_prontuario,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= ' t0014.dt_nasc_pac,';
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0002_n.sg_uf as sg_uf_nasc_pac,';
        $strsql.= ' t0003_n.nm_munic as nm_munic_nasc_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.cd_munic_nasc_mae_pac,';
        $strsql.= ' t0002_m.sg_uf as sg_uf_nasc_mae_pac,';
        $strsql.= ' t0003_m.nm_munic as nm_munic_nasc_mae_pac,';
        $strsql.= ' t0014.cd_pais_orig_pac,';
        $strsql.= ' t0001.nm_pais,';
        $strsql.= ' t0014.nr_fone_pac_01,';
        $strsql.= ' t0014.nr_fone_pac_02,';
        $strsql.= ' t0014.nr_fone_pac_03,';
        $strsql.= ' t0014.cd_munic_pac,';
        $strsql.= ' t0002_e.sg_uf as sg_uf_pac,';
        $strsql.= ' t0003_e.nm_munic as nm_munic_pac,';
        $strsql.= ' t0014.nm_bairro_pac,';
        $strsql.= ' t0014.ds_logr_pac,';
        $strsql.= ' t0014.ds_compl_pac,';
        $strsql.= ' t0014.ds_qd_pac,';
        $strsql.= ' t0014.ds_lt_pac,';
        $strsql.= ' t0014.nr_pac,';
        $strsql.= ' t0014.nr_cep_pac,';
        $strsql.= ' t0014.ds_email_pac,';
        $strsql.= ' t0014.st_pac_sms,';
        $strsql.= ' t0014.cd_usu_cad_pac,';
        $strsql.= ' t0014.dt_usu_cad_pac,';
        $strsql.= ' t0014.cd_usu_alt_pac,';
        $strsql.= ' t0014.dt_usu_alt_pac';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0014 t0014';
        $strsql.= ' inner join cerof.sgm_t0001 t0001 on t0001.cd_pais = t0014.cd_pais_orig_pac';
        $strsql.= ' inner join cerof.sgm_t0003 t0003_n on t0003_n.cd_munic = t0014.cd_munic_nasc_pac';
        $strsql.= ' inner join cerof.sgm_t0002 t0002_n on t0002_n.cd_uf = t0003_n.cd_uf';
        $strsql.= ' left join cerof.sgm_t0003 t0003_m on t0003_m.cd_munic = t0014.cd_munic_nasc_mae_pac';        
        $strsql.= ' left join cerof.sgm_t0002 t0002_m on t0002_m.cd_uf = t0003_m.cd_uf';
        $strsql.= ' left join cerof.sgm_t0003 t0003_e on t0003_e.cd_munic = t0014.cd_munic_pac';
        $strsql.= ' left join cerof.sgm_t0002 t0002_e on t0002_e.cd_uf = t0003_e.cd_uf';
        $strsql.= ' left join cerof.scp_t0002 t0002_p on t0002_p.cd_pac = t0014.cd_pac and t0002_p.cd_empresa = '.Mecanismo::TrataStringEnum(self::$cd_empresa);
        $strsql.= ' Where';
        $strsql.= ' t0014.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);
        $strsql.= ' and';
        $strsql.= ' t0014.st_pac = '.Mecanismo::TrataStringEnum(self::$st_pac);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function Incluir(){

        $table = 'cerof.smg_t0014';

        $dados["cd_pac"] = Mecanismo::geraMaximoCodigo('cd_pac',$table);
        if(self::$nr_cns_pac !== '') $dados["nr_cns_pac"] = strtoupper(self::$nr_cns_pac);
        $dados["nm_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["tp_sexo_pac"] = strtoupper(self::$tp_sexo_pac);
        $dados["dt_nasc_pac"] = strtoupper(self::$dt_nasc_pac);
        $dados["cd_pais_orig_pac"] = strtoupper(self::$cd_pais_orig_pac);
        $dados["cd_munic_nasc_pac"] = strtoupper(self::$cd_munic_nasc_pac);
        $dados["nm_mae_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_mae_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        (is_numeric(self::$cd_munic_nasc_mae_pac) && !is_null(self::$cd_munic_nasc_mae_pac)) ? $dados["cd_munic_nasc_mae_pac"] =  strtoupper(self::$cd_munic_nasc_mae_pac) :  '';
        $dados["cd_munic_pac"] = strtoupper(self::$cd_munic_pac);
        $dados["nm_bairro_pac"] = strtoupper(strtr(preg_replace('/\'/', '',trim(self::$nm_bairro_pac)),"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["ds_logr_pac"] = substr(strtoupper(strtr(preg_replace('/\'/', '',trim(self::$ds_logr_pac)) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ")),0,45);
        if(self::$ds_compl_pac !== '')$dados["ds_compl_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$ds_compl_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["nr_cep_pac"] = strtoupper(self::$nr_cep_pac);
        if(self::$ds_qd_pac !== '')$dados["ds_qd_pac"] = strtoupper(self::$ds_qd_pac);
        if(self::$ds_lt_pac !== '')$dados["ds_lt_pac"] = strtoupper(self::$ds_lt_pac);
        if(self::$nr_pac !== '')$dados["nr_pac"] = strtoupper(self::$nr_pac);
        if(self::$nr_fone_pac_01 !== '')$dados["nr_fone_pac_01"] = strtoupper(self::$nr_fone_pac_01);
        if(self::$nr_fone_pac_02 !== '')$dados["nr_fone_pac_02"] = strtoupper(self::$nr_fone_pac_02);
        if(self::$nr_fone_pac_03 !== '')$dados["nr_fone_pac_03"] = strtoupper(self::$nr_fone_pac_03);
        if(self::$ds_email_pac !== '')$dados["ds_email_pac"] = strtolower(self::$ds_email_pac);
        $dados["cd_usu_cad_pac"] = strtolower(self::$cd_usu_cad_pac);
        $dados["dt_usu_cad_pac"] = strtolower(self::$dt_usu_cad_pac);

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return $dados["cd_pac"];
        }  else {
            return FALSE;
        }
    }

    Public Static Function ValidaInformacaoPaciente($tipo = null){

        $strsql = 'Select';
        $strsql.= ' t0014.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= ' t0014.dt_nasc_pac,';
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.cd_munic_nasc_mae_pac,';
        $strsql.= ' t0014.cd_pais_orig_pac,';
        $strsql.= ' t0014.nr_fone_pac_01,';
        $strsql.= ' t0014.nr_fone_pac_02,';
        $strsql.= ' t0014.nr_fone_pac_03,';
        $strsql.= ' t0014.cd_munic_pac,';
        $strsql.= ' t0014.nm_bairro_pac,';
        $strsql.= ' t0014.ds_logr_pac,';
        $strsql.= ' t0014.ds_compl_pac,';
        $strsql.= ' t0014.ds_qd_pac,';
        $strsql.= ' t0014.ds_lt_pac,';
        $strsql.= ' t0014.nr_pac,';
        $strsql.= ' t0014.nr_cep_pac,';
        $strsql.= ' t0014.ds_email_pac,';
        $strsql.= ' t0014.st_pac_sms,';
        $strsql.= ' t0014.cd_usu_cad_pac,';
        $strsql.= ' t0014.dt_usu_cad_pac,';
        $strsql.= ' t0014.cd_usu_alt_pac,';
        $strsql.= ' t0014.dt_usu_alt_pac';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0014 t0014';
        $strsql.= ' Where';
        if($tipo === 'C'){
            $strsql.= ' t0014.nr_cns_pac = '.Mecanismo::TrataString(self::$nr_cns_pac);
        }else{
            $strsql.= ' t0014.nm_pac = '.Mecanismo::TrataString(self::$nm_pac);
            $strsql.= ' and';
            $strsql.= ' t0014.tp_sexo_pac = '.Mecanismo::TrataString(self::$tp_sexo_pac);
            $strsql.= ' and';
            $strsql.= ' t0014.dt_nasc_pac = '.Mecanismo::TrataString(self::$dt_nasc_pac);
            $strsql.= ' and';
            $strsql.= ' t0014.nm_mae_pac = '.Mecanismo::TrataString(self::$nm_mae_pac);
            //$strsql.= ' and';
            //$strsql.= ' t0014.cd_pais_orig_pac = '.Mecanismo::TrataString(self::$cd_pais_orig_pac);
            //$strsql.= ' and';
            //$strsql.= ' t0014.cd_munic_nasc_pac = '.Mecanismo::TrataString(self::$cd_munic_nasc_pac);
        }
        $strsql.= ' and';
        $strsql.= ' t0014.st_pac = '.Mecanismo::TrataStringEnum(self::$st_pac);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function Alterar(){
        
        $table = 'cerof.smg_t0014';

        $dados["nr_cns_pac"] = strtoupper(self::$nr_cns_pac);
        $dados["cd_munic_pac"] = strtoupper(self::$cd_munic_pac);
        $dados["nm_bairro_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_bairro_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["ds_logr_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$ds_logr_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        if(self::$ds_compl_pac !== '')$dados["ds_compl_pac"] = strtoupper(strtr(preg_replace('/\'/', '',self::$ds_compl_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados["nr_cep_pac"] = strtoupper(self::$nr_cep_pac);
        $dados["ds_qd_pac"] = strtoupper(self::$ds_qd_pac);
        $dados["ds_lt_pac"] = strtoupper(self::$ds_lt_pac);
        if(self::$nr_pac !== '')$dados["nr_pac"] = strtoupper(self::$nr_pac);
        $dados["nr_fone_pac_01"] = strtoupper(self::$nr_fone_pac_01);
        if(self::$nr_fone_pac_02 !== '')$dados["nr_fone_pac_02"] = strtoupper(self::$nr_fone_pac_02);
        if(self::$nr_fone_pac_03 !== '')$dados["nr_fone_pac_03"] = strtoupper(self::$nr_fone_pac_03);
        if(self::$ds_email_pac !== '')$dados["ds_email_pac"] = strtolower(self::$ds_email_pac);
        $dados["cd_usu_alt_pac"] = strtolower(self::$cd_usu_alt_pac);
        $dados["dt_usu_alt_pac"] = strtolower(self::$dt_usu_alt_pac);

        $where ="cd_pac = ".self::$cd_pac;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    Public Static Function AlterarPaciente(){
        
        $table = 'cerof.smg_t0014';
        
        $dados['nm_pac'] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $dados['tp_sexo_pac'] = strtoupper(self::$tp_sexo_pac);
        $dados['dt_nasc_pac'] = strtoupper(self::$dt_nasc_pac);
        $dados['cd_pais_orig_pac'] = strtoupper(self::$cd_pais_orig_pac);
        $dados['cd_munic_nasc_pac'] = strtoupper(self::$cd_munic_nasc_pac);
        $dados['nm_mae_pac'] = strtoupper(strtr(preg_replace('/\'/', '',self::$nm_mae_pac) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        
        (is_numeric(self::$cd_munic_nasc_mae_pac) && !is_null(self::$cd_munic_nasc_mae_pac)) ? $dados["cd_munic_nasc_mae_pac"] =  strtoupper(self::$cd_munic_nasc_mae_pac) :  '';
        
        $where ="cd_pac = ".self::$cd_pac;

        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return true;
        }else{
            return false;
        }
    }

    Public Static Function excluir(){

        $table = 'cerof.smg_t0014';
        $where ="cd_pac = ".self::$cd_pac;
        
        return Mecanismo::ExecutaMetodo('Delete', $table, '',$where);
    }
}
?>
