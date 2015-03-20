<?php

class SMG_M0005 extends Mecanismo{
    
    Private Static $cd_prof;
    Private Static $nm_prof;
    Private Static $cd_conselho;
    Private Static $cd_uf;
    Private Static $nr_conselho;
    Private Static $sg_conselho;

    /* Metodo Set */
    Public Static Function setcd_prof($cd_prof){
        self::$cd_prof = $cd_prof;
    }
    Public Static Function setnm_prof($nm_prof){
        self::$nm_prof = $nm_prof;
    }
    Public Static Function setcd_conselho($cd_conselho){
        self::$cd_conselho = $cd_conselho;
    }
    Public Static Function setcd_uf($cd_uf){
        self::$cd_uf= $cd_uf;
    }
    Public Static Function setnr_conselho($nr_conselho){
        self::$nr_conselho = $nr_conselho;
    }
    Public Static Function setsg_conselho($sg_conselho){
        self::$sg_conselho = $sg_conselho;
    }

    Public Static Function ConsultaCodigoConselhoSigla(){

        $strsql = 'Select';
        $strsql.= ' t0005.cd_prof,';
        $strsql.= ' t0005.nr_conselho,';
        $strsql.= ' t0005.cd_conselho,';
        $strsql.= ' t0003.nm_conselho,';
        $strsql.= ' t0003.sg_conselho,';
        $strsql.= ' t0005.cd_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0005 t0005';
        $strsql.= ' inner join cerof.smg_t0003 t0003 on t0003.cd_conselho = t0005.cd_conselho';
        $strsql.= ' where';
        $strsql.= ' t0005.nr_conselho = '.Mecanismo::TrataString(self::$nr_conselho);
        $strsql.= ' and';
        $strsql.= ' t0003.sg_conselho = '.Mecanismo::TrataString(self::$sg_conselho);
        $strsql.= ' and';
        $strsql.= ' t0005.cd_uf = '.Mecanismo::TrataString(self::$cd_uf);

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
    
    Public Static Function ConsultaCodigoConselhoNomeProfissional(){

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
        $strsql.= ' t0004.nm_prof like "%'.self::$nm_prof.'%"';
        $strsql.= ' and';
        $strsql.= ' t0003.cd_conselho = '.Mecanismo::TrataString(self::$cd_conselho);
        $strsql.= ' and';
        $strsql.= ' t0005.cd_uf = '.Mecanismo::TrataString(self::$cd_uf);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ConsultaCodigoProfissional(){

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
        $strsql.= ' t0005.cd_uf,';
        $strsql.= ' t0002.sg_uf';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0005 t0005';
        $strsql.= ' inner join cerof.smg_t0004 t0004 on t0004.cd_prof = t0005.cd_prof';
        $strsql.= ' inner join cerof.smg_t0003 t0003 on t0003.cd_conselho = t0005.cd_conselho';
        $strsql.= ' inner join cerof.sgm_t0002 t0002 on t0002.cd_uf = t0005.cd_uf';
        $strsql.= ' where';
        $strsql.= ' t0005.cd_prof = '.Mecanismo::TrataString(self::$cd_prof);
        
        !empty(self::$sg_conselho) ? $strsql.=' and t0005.cd_conselho = ' .Mecanismo::TrataString(self::$sg_conselho) : '';
        !empty(self::$cd_uf) ? $strsql.=' and t0005.cd_uf = ' .Mecanismo::TrataString(self::$cd_uf) : '';
  
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function Incluir(){
        
        $table = 'cerof.smg_t0005';
        
        $dados['cd_prof'] = self::$cd_prof;
        $dados['cd_conselho'] = self::$cd_conselho;
        $dados['cd_uf'] = self::$cd_uf;
        $dados['nr_conselho'] = self::$nr_conselho;
  
        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
    }
    
    Public Static Function excluir(){

         $table = 'cerof.smg_t0005';

        $where = "cd_prof = ".Mecanismo::TrataString(self::$cd_prof);
        $where.= " and ";
        $where.= "cd_conselho = ".Mecanismo::TrataString(self::$cd_conselho);
        $where.= " and ";
        $where.= "cd_uf = ".Mecanismo::TrataString(self::$cd_uf);
        $where.= " and ";
        $where.= "nr_conselho = ".Mecanismo::TrataString(self::$nr_conselho);

        return Mecanismo::ExecutaMetodo('Delete', $table, '',$where);

    }
}
?>
