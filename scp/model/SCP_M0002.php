<?php

class SCP_M0002 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_prateleira;
    Private Static $nr_linha;
    Private Static $nr_coluna;
    Private Static $nr_posicao;
    Private Static $nr_prontuario;
    Private Static $st_prontuario;
    Private Static $cd_usu_ger_pront;
    Private Static $dt_ger_pront;
    Private Static $cd_pac;
    Private Static $nm_pac;
    Private Static $cd_usu_loc_pront;
    Private Static $dt_loc_pront;
    Private Static $hr_loc_pront;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
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
    Public Static function setnr_prontuario($nr_prontuario){
        self::$nr_prontuario = $nr_prontuario;
    }
    Public Static function setst_prontuario($st_prontuario){
        self::$st_prontuario = $st_prontuario;
    }
    Public Static function setcd_usu_ger_pront($cd_usu_ger_pront){
        self::$cd_usu_ger_pront = $cd_usu_ger_pront;
    }
    Public Static function setdt_ger_pront($dt_ger_pront){
        self::$dt_ger_pront = $dt_ger_pront;
    }
    Public Static function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
    }
    Public Static function setnm_pac($nm_pac){
        self::$nm_pac = $nm_pac;
    }
    Public Static function setcd_usu_loc_pront($cd_usu_loc_pront){
        self::$cd_usu_loc_pront = $cd_usu_loc_pront;
    }
    Public Static function setdt_loc_pront($dt_loc_pront){
        self::$dt_loc_pront = $dt_loc_pront;
    }
    Public Static function sethr_loc_pront($hr_loc_pront){
        self::$hr_loc_pront = $hr_loc_pront;
    }

    Public Static Function consultaCodigoPrateleira(){
        
        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0002.cd_usu_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.cd_pac,';
        $strsql.= ' t0002.cd_usu_loc_pront,';
        $strsql.= ' t0002.dt_loc_pront';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.sca_t0001 t0001_e on t0001_e.cd_empresa = t0002.cd_empresa';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function incluir(){

        $table = 'cerof.scp_t0002';

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_prateleira"] = self::$cd_prateleira;
        $dados["nr_linha"] = self::$nr_linha;
        $dados["nr_coluna"] =  self::$nr_coluna;
        $dados["nr_posicao"] =  self::$nr_posicao;
        $dados["nr_prontuario"] =  self::$nr_prontuario;
        $dados["st_prontuario"] =  self::$st_prontuario;
        $dados["cd_usu_ger_pront"] = self::$cd_usu_ger_pront;
        $dados["dt_ger_pront"] =  self::$dt_ger_pront;
 
        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
    }

    Public Static Function alterar(){

        $table = 'cerof.scp_t0002';

        $dados["cd_pac"] = self::$cd_pac;
        $dados["st_prontuario"] = self::$st_prontuario;
        $dados["cd_usu_loc_pront"] = self::$cd_usu_loc_pront;
        $dados["dt_loc_pront"] = self::$dt_loc_pront;
        $dados["hr_loc_pront"] = self::$hr_loc_pront;

        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="cd_prateleira = ".self::$cd_prateleira;
        $where.=" and ";
        $where.="nr_linha = ".self::$nr_linha;
        $where.=" and ";
        $where.="nr_coluna = ".self::$nr_coluna;
        $where.=" and ";
        $where.="nr_posicao = ".self::$nr_posicao;
        $where.=" and ";
        $where.="cd_pac is null";

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
        
    }
    
    Public Static Function liberarLocacao(){

        $table = 'cerof.scp_t0002';

        $dados["cd_pac"] = null;
        $dados["st_prontuario"] = self::$st_prontuario;

        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="nr_prontuario = ".Mecanismo::TrataString(self::$nr_prontuario);
        $where.=" and ";
        $where.="cd_pac = ".self::$cd_pac;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }

    Public Static Function listaTodasPrateleirasPorEmpresa(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0001.nm_prateleira';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.scp_t0001 t0001 on t0001.cd_empresa = t0002.cd_empresa and t0001.cd_prateleira = t0002.cd_prateleira';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.st_prontuario in '.Mecanismo::TrataStringEnum(self::$st_prontuario);
        $strsql.= ' Group By';
	$strsql.= ' t0001.nm_prateleira,';
        $strsql.= ' t0002.cd_prateleira';

        return Mecanismo::ConsultaMetodo($strsql);
    }


    Public Static Function montaPrateleira($tipo){
        
        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0001.nm_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.scp_t0001 t0001 on t0001.cd_empresa = t0002.cd_empresa and t0001.cd_prateleira = t0002.cd_prateleira';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        if($tipo === 'linha'){
            $strsql.= ' Group by';
            $strsql.= ' t0002.nr_linha';
        }
        if($tipo === 'coluna'){
            $strsql.= ' and';
            $strsql.= ' t0002.nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
            $strsql.= ' Group by';
            $strsql.= ' t0002.nr_coluna';
        }

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function listaLocacao(){
        
        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0001.nm_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0002.cd_usu_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.cd_pac,';
        $strsql.= ' t0002.cd_usu_loc_pront,';
        $strsql.= ' t0002.dt_loc_pront,';
        $strsql.= ' t0002.hr_loc_pront';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.scp_t0001 t0001 on t0001.cd_empresa = t0002.cd_empresa and t0001.cd_prateleira = t0002.cd_prateleira';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_coluna = '.Mecanismo::TrataString(self::$nr_coluna);
        $strsql.= ' Order by';
	$strsql.= ' t0002.cd_prateleira,';
	$strsql.= ' t0002.nr_linha,';
	$strsql.= ' t0002.nr_coluna,';
	$strsql.= ' t0002.nr_posicao,';
	$strsql.= ' t0002.cd_pac';

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function listaPosicaoLivreLocacao(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0001.nm_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0002.cd_usu_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.cd_pac,';
        $strsql.= ' t0002.cd_usu_loc_pront,';
        $strsql.= ' t0002.dt_loc_pront,';
        $strsql.= ' t0002.hr_loc_pront';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.scp_t0001 t0001 on t0001.cd_empresa = t0002.cd_empresa and t0001.cd_prateleira = t0002.cd_prateleira';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_coluna = '.Mecanismo::TrataString(self::$nr_coluna);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_pac is null';
        $strsql.= ' Order by';
	$strsql.= ' t0002.cd_prateleira,';
	$strsql.= ' t0002.nr_linha,';
	$strsql.= ' t0002.nr_coluna,';
	$strsql.= ' t0002.nr_posicao,';
	$strsql.= ' t0002.cd_pac';

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function PrimeiraPosicaoLivreLocacao(){
        
        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' min(t0002.nr_prontuario) as nr_prontuario';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.scp_t0001 t0001 on t0001.cd_empresa = t0002.cd_empresa and t0001.cd_prateleira = t0002.cd_prateleira';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0001.st_prateleira in'.Mecanismo::TrataStringEnum(self::$st_prontuario);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_pac is null';

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function PrimeiraPosicaoLivreLocacaoEspecifica(){
        
        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' min(t0002.nr_prontuario) as nr_prontuario';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_coluna = '.Mecanismo::TrataString(self::$nr_coluna);
        $strsql.= ' and';
        $strsql.= ' t0002.cd_pac is null';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function consultaNumeroProntuario(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0002.cd_usu_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.cd_pac,';
        $strsql.= ' t0002.cd_usu_loc_pront,';
        $strsql.= ' t0002_usu.nm_usuario as nm_usu_loc_pront,';
        $strsql.= ' t0002.dt_loc_pront,';
        $strsql.= ' t0002.hr_loc_pront,';
        $strsql.= ' t0014.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= " t0014.dt_nasc_pac,";
        $strsql.= " t0014.nr_cns_pac,";
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0002_n.sg_uf as sg_uf_nasc_pac,';
        $strsql.= ' t0003_n.nm_munic as nm_munic_nasc_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.cd_munic_nasc_mae_pac,';
        $strsql.= ' t0002_m.sg_uf as sg_uf_nasc_mae_pac,';
        $strsql.= ' t0003_m.nm_munic as nm_munic_nasc_mae_pac,';
        $strsql.= ' t0014.cd_pais_orig_pac,';
        $strsql.= ' t0001.nm_pais';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0002.cd_pac';
        $strsql.= ' inner join cerof.sgm_t0001 t0001 on t0001.cd_pais = t0014.cd_pais_orig_pac';
        $strsql.= ' inner join cerof.sgm_t0003 t0003_n on t0003_n.cd_munic = t0014.cd_munic_nasc_pac';
        $strsql.= ' inner join cerof.sgm_t0002 t0002_n on t0002_n.cd_uf = t0003_n.cd_uf';
        $strsql.= ' left join cerof.sgm_t0003 t0003_m on t0003_m.cd_munic = t0014.cd_munic_nasc_mae_pac';
        $strsql.= ' left join cerof.sgm_t0002 t0002_m on t0002_m.cd_uf = t0003_m.cd_uf';
        $strsql.= ' inner join cerof.sca_t0002 t0002_usu on t0002_usu.cd_usuario = t0002.cd_usu_loc_pront';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0002.nr_prontuario = '.Mecanismo::TrataString(self::$nr_prontuario);

        if(trim(self::$st_prontuario) !== ''){
            $strsql.= ' and ';
            $strsql.= ' t0002.st_prontuario in '.Mecanismo::TrataStringEnum(self::$st_prontuario);
        }
 
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function listaProntuarioPorStatus(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_prateleira,';
        $strsql.= ' t0002.nr_linha,';
        $strsql.= ' t0002.nr_coluna,';
        $strsql.= ' t0002.nr_posicao,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0002.cd_usu_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.dt_ger_pront,';
        $strsql.= ' t0002.cd_pac,';
        $strsql.= ' t0002.cd_usu_loc_pront,';
        $strsql.= ' t0002.dt_loc_pront,';
        $strsql.= ' t0002.hr_loc_pront,';
        $strsql.= ' t0014.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= " t0014.dt_nasc_pac,";
        $strsql.= " t0014.nr_cns_pac,";
        $strsql.= ' t0014.cd_munic_nasc_pac,';
        $strsql.= ' t0002_n.sg_uf as sg_uf_nasc_pac,';
        $strsql.= ' t0003_n.nm_munic as nm_munic_nasc_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.cd_munic_nasc_mae_pac,';
        $strsql.= ' t0002_m.sg_uf as sg_uf_nasc_mae_pac,';
        $strsql.= ' t0003_m.nm_munic as nm_munic_nasc_mae_pac,';
        $strsql.= ' t0014.cd_pais_orig_pac,';
        $strsql.= ' t0001.nm_pais';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0002.cd_pac';
        $strsql.= ' inner join cerof.sgm_t0001 t0001 on t0001.cd_pais = t0014.cd_pais_orig_pac';
        $strsql.= ' inner join cerof.sgm_t0003 t0003_n on t0003_n.cd_munic = t0014.cd_munic_nasc_pac';
        $strsql.= ' inner join cerof.sgm_t0002 t0002_n on t0002_n.cd_uf = t0003_n.cd_uf';
        $strsql.= ' left join cerof.sgm_t0003 t0003_m on t0003_m.cd_munic = t0014.cd_munic_nasc_mae_pac';
        $strsql.= ' left join cerof.sgm_t0002 t0002_m on t0002_m.cd_uf = t0003_m.cd_uf';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0002.st_prontuario in '.Mecanismo::TrataStringEnum(self::$st_prontuario);

        (self::$nm_pac != null) ? $strsql.= ' and t0014.nm_pac like "%'.self::$nm_pac.'%"' : '';
        $strsql.= 'Order by t0002.nr_prontuario, t0014.nm_pac';
        $strsql.= ' limit 0,100';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function confirmaSolicitacaoProntuarioAberto(){

        $table = 'cerof.scp_t0002';

        $dados["st_prontuario"] = self::$st_prontuario;
        $dados["cd_usu_conf_pront"] = self::$cd_usu_loc_pront;
        $dados["dt_conf_loc_pront"] = self::$dt_loc_pront;
        $dados["hr_conf_loc_pront"] = self::$hr_loc_pront;

        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="nr_prontuario = ".Mecanismo::TrataString(self::$nr_prontuario);
        $where.=" and ";
        $where.="cd_pac is not null";

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    Public Static Function manutencaoLinhaColunaSubtrair(){
        
        $table ='cerof.scp_t0002';
        
        $where = ' cd_empresa = '.self::$cd_empresa;
        $where.= ' and ';
        $where.= ' cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $where.= ' and';
        $where.= ' nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
        $where.= ' and';
        $where.= ' nr_coluna = '.Mecanismo::TrataString(self::$nr_coluna);
        $where.= ' and';
        $where.= ' nr_posicao = '.Mecanismo::TrataString(self::$nr_posicao);
 
        return Mecanismo::ExecutaMetodo('Delete', $table, '',$where);
    }
    
    Public Static Function consultaNumeroProntuarioMaximoVazio(){

        $strsql = 'Select';
        $strsql.= ' max(t0002.nr_posicao) nr_posicao';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.self::$cd_empresa;
        $strsql.= ' and ';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_coluna = '.Mecanismo::TrataString(self::$nr_coluna);
        $strsql.= ' and ';
        $strsql.= ' t0002.cd_pac is null';

        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    Public Static Function consultaNumeroProntuarioMaximo(){

        $strsql = 'Select';
        $strsql.= ' max(t0002.nr_posicao) nr_posicao';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.self::$cd_empresa;
        $strsql.= ' and ';
        $strsql.= ' t0002.cd_prateleira = '.Mecanismo::TrataString(self::$cd_prateleira);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_linha = '.Mecanismo::TrataString(self::$nr_linha);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_coluna = '.Mecanismo::TrataString(self::$nr_coluna);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function confirmaMovimentacaoSolicitacaoProntuario(){

        $table = 'cerof.scp_t0002';

        $dados["st_prontuario"] = self::$st_prontuario;

        $where ="cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.=" and ";
        $where.="cd_prateleira = ".Mecanismo::TrataString(self::$cd_prateleira);
        $where.=" and ";
        $where.="nr_linha = ".Mecanismo::TrataString(self::$nr_linha);
        $where.=" and ";
        $where.="nr_coluna = ".Mecanismo::TrataString(self::$nr_coluna);
        $where.=" and ";
        $where.="nr_posicao = ".Mecanismo::TrataString(self::$nr_posicao);
        $where.=" and ";
        $where.="cd_pac = ".Mecanismo::TrataString(self::$cd_pac);

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
}
?>