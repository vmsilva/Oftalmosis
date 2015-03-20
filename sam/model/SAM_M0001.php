<?php

class SAM_M0001 extends Mecanismo{
    Private Static $cd_escola;
    Private Static $nm_escola;
    Private Static $nm_resp_esc;
    Private Static $cd_munic_esc;
    Private Static $nm_bairro_esc;
    Private Static $ds_logr_esc;
    Private Static $ds_compl_esc;
    Private Static $ds_qd_esc;
    Private Static $ds_lt_esc;
    Private Static $nr_end_esc;
    Private Static $nr_cep_esc;
    Private Static $nr_fone_01;
    Private Static $nr_fone_02;
    Private Static $nr_fone_03;
    Private Static $st_escola;
    Private Static $ds_email_esc;
    Private Static $cd_usu_cad_esc;
    Private Static $dt_usu_cad_esc;
    Private Static $cd_usu_alt_esc;
    Private Static $dt_usu_alt_esc;
    
    
    Public Static function setcd_escola($cd_escola){ 
        self::$cd_escola = $cd_escola;
    }
    Public Static function setnm_escola($nm_escola){ 
        self::$nm_escola = $nm_escola;
    }
    Public Static function setnm_resp_esc($nm_resp_esc){ 
        self::$nm_resp_esc = $nm_resp_esc;
    }
    Public Static function setcd_munic_esc($cd_munic_esc){ 
        self::$cd_munic_esc = $cd_munic_esc;
    }
    Public Static function setnm_bairro_esc($nm_bairro_esc){ 
        self::$nm_bairro_esc = $nm_bairro_esc;
    }
    Public Static function setds_logr_esc($ds_logr_esc){ 
        self::$ds_logr_esc = $ds_logr_esc;
    }
    Public Static function setds_compl_esc($ds_compl_esc){ 
        self::$ds_compl_esc = $ds_compl_esc;
    }
    Public Static function setds_qd_esc($ds_qd_esc){ 
        self::$ds_qd_esc = $ds_qd_esc;
    }
    Public Static function setds_lt_esc($ds_lt_esc){ 
        self::$ds_lt_esc = $ds_lt_esc;
    }
    Public Static function setnr_end_esc($nr_end_esc){ 
        self::$nr_end_esc = $nr_end_esc;
    }
    Public Static function setnr_cep_esc($nr_cep_esc){ 
        self::$nr_cep_esc = $nr_cep_esc;
    }
    Public Static function setnr_fone_01($nr_fone_01){ 
        self::$nr_fone_01 = $nr_fone_01;
    }
    Public Static function setnr_fone_02($nr_fone_02){ 
        self::$nr_fone_02 = $nr_fone_02;
    }
    Public Static function setnr_fone_03($nr_fone_03){ 
        self::$nr_fone_03 = $nr_fone_03;
    }
    Public Static function setst_escola($st_escola){ 
        self::$st_escola = $st_escola;
    }
    Public Static function setds_email_esc($ds_email_esc){ 
        self::$ds_email_esc = $ds_email_esc;
    }
    Public Static function setcd_usu_cad_esc($cd_usu_cad_esc){ 
        self::$cd_usu_cad_esc = $cd_usu_cad_esc;
    }
    Public Static function setdt_usu_cad_esc($dt_usu_cad_esc){ 
        self::$dt_usu_cad_esc = $dt_usu_cad_esc;
    }
    Public Static function setcd_usu_alt_esc($cd_usu_alt_esc){ 
        self::$cd_usu_alt_esc = $cd_usu_alt_esc;
    }
    Public Static function setdt_usu_alt_esc($dt_usu_alt_esc){ 
        self::$dt_usu_alt_esc = $dt_usu_alt_esc;
    }
    
    
    Public Static Function getcd_escola(){ 
        return self::$cd_escola;
    }
    Public Static Function getnm_escola(){ 
        return self::$nm_escola;
    }
    Public Static Function getnm_resp_esc(){ 
        return self::$nm_resp_esc;
    }
    Public Static Function getcd_munic_esc(){ 
        return self::$cd_munic_esc;
    }
    Public Static Function getnm_bairro_esc(){ 
        return self::$nm_bairro_esc;
    }
    Public Static Function getds_logr_esc(){ 
        return self::$ds_logr_esc;
    }
    Public Static Function getds_compl_esc(){
        return self::$ds_compl_esc;
    }
    Public Static Function getds_qd_esc(){ 
        return self::$ds_qd_esc;
    }
    Public Static Function getds_lt_esc(){ 
        return self::$ds_lt_esc;
    }
    Public Static Function getnr_end_esc(){ 
        return self::$nr_end_esc;
    }
    Public Static Function getnr_cep_esc(){ 
        return self::$nr_cep_esc;
    }
    Public Static Function getnr_fone_01(){ 
        return self::$nr_fone_01;
    }
    Public Static Function getnr_fone_02(){ 
        return self::$nr_fone_02;
    }
    Public Static Function getnr_fone_03(){ 
        return self::$nr_fone_03;
    }
    Public Static Function getst_escola(){ 
        return self::$st_escola;
    }
    Public Static Function getds_email_esc(){ 
        return self::$ds_email_esc;
    }
    Public Static Function getcd_usu_cad_esc(){ 
        return self::$cd_usu_cad_esc;
    }
    Public Static Function getdt_usu_cad_esc(){ 
        return self::$dt_usu_cad_esc;
    }
    Public Static Function getcd_usu_alt_esc(){ 
        return self::$cd_usu_alt_esc;
    }
    Public Static Function getdt_usu_alt_esc(){ 
        return self::$dt_usu_alt_esc;
    }
    
    Public Static Function consultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_escola,';
        $strsql.= ' t0001.nm_escola,';
        $strsql.= ' t0001.nm_resp_esc,';
        $strsql.= ' t0001.cd_munic_esc,';
        $strsql.= ' t0003.nm_munic,';
        $strsql.= ' t0002.sg_uf,';
        $strsql.= ' t0001.nm_bairro_esc,';
        $strsql.= ' t0001.ds_logr_esc,';
        $strsql.= ' t0001.ds_compl_esc,';
        $strsql.= ' t0001.ds_qd_esc,';
        $strsql.= ' t0001.ds_lt_esc,';
        $strsql.= ' t0001.nr_end_esc,';
        $strsql.= ' t0001.nr_cep_esc,';
        $strsql.= ' t0001.nr_fone_01,';
        $strsql.= ' t0001.nr_fone_02,';
        $strsql.= ' t0001.nr_fone_03,';
        $strsql.= ' t0001.st_escola,';
        $strsql.= ' t0001.ds_email_esc,';
        $strsql.= ' t0001.cd_usu_cad_esc,';
        $strsql.= ' t0001.dt_usu_cad_esc,';
        $strsql.= ' t0001.cd_usu_alt_esc,';
        $strsql.= ' t0001.dt_usu_alt_esc';
        $strsql.= ' From';
        $strsql.= ' cerof.sam_t0001 t0001';
        $strsql.= ' inner join cerof.sgm_t0003 t0003 on t0003.cd_munic = t0001.cd_munic_esc';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0003.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0001.cd_escola = '.Mecanismo::TrataString(self::$cd_escola);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function consultaNome(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_escola,';
        $strsql.= ' t0001.nm_escola,';
        $strsql.= ' t0001.nm_resp_esc,';
        $strsql.= ' t0001.cd_munic_esc,';
        $strsql.= ' t0003.nm_munic,';
        $strsql.= ' t0002.sg_uf,';
        $strsql.= ' t0001.nm_bairro_esc,';
        $strsql.= ' t0001.ds_logr_esc,';
        $strsql.= ' t0001.ds_compl_esc,';
        $strsql.= ' t0001.ds_qd_esc,';
        $strsql.= ' t0001.ds_lt_esc,';
        $strsql.= ' t0001.nr_end_esc,';
        $strsql.= ' t0001.nr_cep_esc,';
        $strsql.= ' t0001.nr_fone_01,';
        $strsql.= ' t0001.nr_fone_02,';
        $strsql.= ' t0001.nr_fone_03,';
        $strsql.= ' t0001.st_escola,';
        $strsql.= ' t0001.ds_email_esc,';
        $strsql.= ' t0001.cd_usu_cad_esc,';
        $strsql.= ' t0001.dt_usu_cad_esc,';
        $strsql.= ' t0001.cd_usu_alt_esc,';
        $strsql.= ' t0001.dt_usu_alt_esc';
        $strsql.= ' From';
        $strsql.= ' cerof.sam_t0001 t0001';
        $strsql.= ' inner join cerof.sgm_t0003 t0003 on t0003.cd_munic = t0001.cd_munic_esc';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0003.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0001.nm_escola like "%'.self::$nm_escola.'%"';

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function Incluir(){
        
        $table = 'cerof.sam_t0001';

        //Obrigatórios
        //$dados["cd_escola"] = Mecanismo::geraMaximoCodigo('cd_escola',$table);
        $dados["cd_escola"] = strtoupper(self::$cd_escola);
        $dados["nm_escola"] = strtoupper(self::$nm_escola);
        $dados["nm_resp_esc"] = strtoupper(self::$nm_resp_esc);
        $dados["cd_munic_esc"] = strtoupper(self::$cd_munic_esc);
        $dados["nr_fone_01"] = strtoupper(self::$nr_fone_01);
        $dados["cd_usu_cad_esc"] = strtoupper(self::$cd_usu_cad_esc);
        $dados["dt_usu_cad_esc"] = strtoupper(self::$dt_usu_cad_esc);
        
        //Opcionais
        if(self::$nm_bairro_esc !== '')$dados["nm_bairro_esc"] = strtoupper(self::$nm_bairro_esc);
        if(self::$ds_logr_esc !== '')$dados["ds_logr_esc"] = strtoupper(self::$ds_logr_esc);
        if(self::$ds_compl_esc !== '')$dados["ds_compl_esc"] = strtoupper(self::$ds_compl_esc);
        if(self::$ds_qd_esc !== '')$dados["ds_qd_esc"] = strtoupper(self::$ds_qd_esc);
        if(self::$ds_lt_esc !== '')$dados["ds_lt_esc"] = strtoupper(self::$ds_lt_esc);
        if(self::$nr_end_esc !== '')$dados["nr_end_esc"] = strtoupper(self::$nr_end_esc);
        if(self::$nr_cep_esc !== '')$dados["nr_cep_esc"] = strtoupper(self::$nr_cep_esc);
        if(self::$nr_fone_02 !== '')$dados["nr_fone_02"] = strtoupper(self::$nr_fone_02);
        if(self::$nr_fone_03 !== '')$dados["nr_fone_03"] = strtoupper(self::$nr_fone_03);
        if(self::$st_escola !== '')$dados["st_escola"] = strtoupper(self::$st_escola);
        if(self::$ds_email_esc !== '')$dados["ds_email_esc"] = strtoupper(self::$ds_email_esc);       

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return $dados["cd_escola"];
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function alterar(){

        $table = 'cerof.sam_t0001';

        $dados["nm_escola"] = strtoupper(self::$nm_escola);
        $dados["nm_resp_esc"] = strtoupper(self::$nm_resp_esc);
        $dados["cd_munic_esc"] = strtoupper(self::$cd_munic_esc);
        $dados["nr_fone_01"] = strtoupper(self::$nr_fone_01);
        $dados["cd_usu_cad_esc"] = strtoupper(self::$cd_usu_cad_esc);
        $dados["dt_usu_cad_esc"] = strtoupper(self::$dt_usu_cad_esc);
        
        //Opcionais
        if(self::$nm_bairro_esc !== '')$dados["nm_bairro_esc"] = strtoupper(self::$nm_bairro_esc);
        if(self::$ds_logr_esc !== '')$dados["ds_logr_esc"] = strtoupper(self::$ds_logr_esc);
        if(self::$ds_compl_esc !== '')$dados["ds_compl_esc"] = strtoupper(self::$ds_compl_esc);
        if(self::$ds_qd_esc !== '')$dados["ds_qd_esc"] = strtoupper(self::$ds_qd_esc);
        if(self::$ds_lt_esc !== '')$dados["ds_lt_esc"] = strtoupper(self::$ds_lt_esc);
        if(self::$nr_end_esc !== '')$dados["nr_end_esc"] = strtoupper(self::$nr_end_esc);
        if(self::$nr_cep_esc !== '')$dados["nr_cep_esc"] = strtoupper(self::$nr_cep_esc);
        if(self::$nr_fone_02 !== '')$dados["nr_fone_02"] = strtoupper(self::$nr_fone_02);
        if(self::$nr_fone_03 !== '')$dados["nr_fone_03"] = strtoupper(self::$nr_fone_03);
        if(self::$st_escola !== '')$dados["st_escola"] = strtoupper(self::$st_escola);
        if(self::$ds_email_esc !== '')$dados["ds_email_esc"] = strtoupper(self::$ds_email_esc);

        $where ="cd_escola = ".self::$cd_escola;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    Public Static Function excluir(){

        $table = 'cerof.sam_t0001';
        $where ="cd_escola = ".self::$cd_escola;

        return Mecanismo::ExecutaMetodo('Delete', $table, '',$where);

    }
}

?>
