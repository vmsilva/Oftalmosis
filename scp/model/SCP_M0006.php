<?php

class SCP_M0006 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $nr_solic_mov;
    Private Static $cd_pac;
    Private Static $cd_prateleira;
    Private Static $nr_linha;
    Private Static $nr_coluna;
    Private Static $nr_posicao;
    Private Static $nr_prontuario;
    Private Static $st_prontuario;
    Private Static $st_solic_mov;
    Private Static $dt_atend_solic_mov;
    Private Static $hr_atend_solic_mov;
    Private Static $in_mov_prontuario;
    Private Static $cd_usu_devol_solic_mov;
    Private Static $dt_devol_solic_mov;
    Private Static $hr_devol_solic_mov;
    Private Static $nr_solic_mov_ant;
    
    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }    
    Public Static function setnr_solic_mov($nr_solic_mov){
	self::$nr_solic_mov = $nr_solic_mov;
    }
    Public Static function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
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
    Public Static function setst_solic_mov($st_solic_mov){
        self::$st_solic_mov = $st_solic_mov;
    }
    
    Public Static function setdt_atend_solic_mov($dt_atend_solic_mov){
        self::$dt_atend_solic_mov = $dt_atend_solic_mov;
    }
    
    Public Static function sethr_atend_solic_mov($hr_atend_solic_mov){
        self::$hr_atend_solic_mov = $hr_atend_solic_mov;
    }
    
    Public Static function setin_mov_prontuario($in_mov_prontuario){
        self::$in_mov_prontuario = $in_mov_prontuario;
    }
    
    Public Static function setcd_usu_devol_solic_mov($cd_usu_devol_solic_mov){
        self::$cd_usu_devol_solic_mov = $cd_usu_devol_solic_mov;
    }
    
    Public Static function setdt_devol_solic_mov($dt_devol_solic_mov){
        self::$dt_devol_solic_mov = $dt_devol_solic_mov;
    }
    
    Public Static function sethr_devol_solic_mov($hr_devol_solic_mov){
        self::$hr_devol_solic_mov = $hr_devol_solic_mov;
    }
    Public Static function setnr_solic_mov_ant($nr_solic_mov_ant){
        self::$nr_solic_mov_ant = $nr_solic_mov_ant;
    }
    
    Public Static Function incluir(){

        $table = 'cerof.scp_t0006';

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["nr_solic_mov"] = self::$nr_solic_mov;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["cd_prateleira"] = self::$cd_prateleira;
        $dados["nr_linha"] = self::$nr_linha;
        $dados["nr_coluna"] = self::$nr_coluna;
        $dados["nr_posicao"] = self::$nr_posicao;
        $dados["nr_prontuario"] =  self::$nr_prontuario;
        $dados["st_solic_mov"] =  self::$st_solic_mov;
        (is_numeric(self::$nr_solic_mov_ant) && !is_null(self::$nr_solic_mov_ant)) ? $dados["nr_solic_mov_ant"] =  self::$nr_solic_mov_ant : '';
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function listaSolicitacaoMovimentacaoProntuario(){
        
        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.nr_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,';
        $strsql.= ' t0002_sol.nm_usuario as nm_usu_solic,';
        $strsql.= ' t0002_ate.nm_usuario as nm_usu_atend,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_atend_solic_mov),"%d/%m/%Y") as dt_atend_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_atend_solic_mov as TIME),4,5) as hr_atend_solic_mov,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0006.nr_linha,';
        $strsql.= ' t0006.nr_coluna,';
        $strsql.= ' t0006.nr_posicao,';
        $strsql.= ' t0006.nr_prontuario,';
        $strsql.= ' t0006.st_solic_mov,';
        $strsql.= ' t0006.dt_atend_solic_mov as dt_atend_solic_mov_t6,';
        $strsql.= ' t0006.hr_atend_solic_mov as hr_atend_solic_mov_t6';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0006 t0006';
        $strsql.= ' inner join cerof.scp_t0005 t0005 on t0005.cd_empresa = t0006.cd_empresa and t0005.nr_solic_mov = t0006.nr_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_sol on t0002_sol.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_ate on t0002_ate.cd_usuario = t0005.cd_usu_atend_solic_mov';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0006.nr_solic_mov = '.Mecanismo::TrataString(self::$nr_solic_mov);
        $strsql.= ' and ';
        $strsql.= ' t0006.st_solic_mov = '.Mecanismo::TrataString(self::$st_solic_mov);
        $strsql.= ' Order by t0006.nr_prontuario';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function alterar($st_solic_mov_aux){

        $table = 'cerof.scp_t0006';

        $dados["st_solic_mov"] = self::$st_solic_mov;
        $dados["dt_atend_solic_mov"] = self::$dt_atend_solic_mov;
        $dados["hr_atend_solic_mov"] = self::$hr_atend_solic_mov;
        if(trim(self::$in_mov_prontuario) != '') $dados["in_mov_prontuario"] = self::$in_mov_prontuario;
        
        $where ="cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.=" and ";
        $where.="nr_solic_mov = ".Mecanismo::TrataString(self::$nr_solic_mov);
        $where.=" and ";
        $where.="nr_prontuario = ".Mecanismo::TrataString(self::$nr_prontuario);
        $where.=" and ";
        $where.="st_solic_mov = ".Mecanismo::TrataString($st_solic_mov_aux);

        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return true;
        }else{
            return false;
        }
    }
    
    Public Static Function AlterarDevolucao($st_solic_mov_aux){

        $table = 'cerof.scp_t0006';

        $dados["st_solic_mov"] = self::$st_solic_mov;
        $dados["cd_usu_devol_solic_mov"] = self::$cd_usu_devol_solic_mov;
        $dados["dt_devol_solic_mov"] = self::$dt_devol_solic_mov;
        $dados["hr_devol_solic_mov"] = self::$hr_devol_solic_mov;
        
        $where ="cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.=" and ";
        $where.="cd_pac = ".Mecanismo::TrataString(self::$cd_pac);
        $where.=" and ";
        $where.="nr_prontuario = ".Mecanismo::TrataString(self::$nr_prontuario);
        $where.=" and ";
        $where.="st_solic_mov = ".Mecanismo::TrataString($st_solic_mov_aux);

        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return true;
        }else{
            return false;
        }
    }
    
    Public Static Function ListarSolicitacaoProntuario(){
        
        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.nr_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,';
        $strsql.= ' t0002_sol.nr_matr_usu as nr_matr_usu_solic,';
        $strsql.= ' t0002_sol.dg_matr_usu as dg_matr_usu_solic,';
        $strsql.= ' t0002_sol.nm_usuario as nm_usu_solic,';
        $strsql.= ' t0002_ate.nm_usuario as nm_usu_atend,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_atend_solic_mov),"%d/%m/%Y") as dt_atend_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_atend_solic_mov as TIME),4,5) as hr_atend_solic_mov,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0006.cd_prateleira,';
        $strsql.= ' t0006.nr_linha,';
        $strsql.= ' t0006.nr_coluna,';
        $strsql.= ' t0006.nr_posicao,';
        $strsql.= ' t0006.nr_prontuario,';
        $strsql.= ' t0006.st_solic_mov,';
        $strsql.= ' t0006.dt_atend_solic_mov,';
        $strsql.= ' t0006.hr_atend_solic_mov';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0006 t0006';
        $strsql.= ' inner join cerof.scp_t0005 t0005 on t0005.cd_empresa = t0006.cd_empresa and t0005.nr_solic_mov = t0006.nr_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_sol on t0002_sol.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_ate on t0002_ate.cd_usuario = t0005.cd_usu_atend_solic_mov';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0006.nr_solic_mov = '.Mecanismo::TrataString(self::$nr_solic_mov);
        $strsql.= ' and ';
        $strsql.= ' t0006.nr_prontuario = '.Mecanismo::TrataString(self::$nr_prontuario);
        $strsql.= ' and ';
        $strsql.= ' t0006.st_solic_mov = '.Mecanismo::TrataString(self::$st_solic_mov);

        return Mecanismo::ConsultaMetodo($strsql);
        
    }
    
    Public Static Function ListarSolicitacaoProntuarioStatus(){
        
        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.nr_solic_mov,';
        $strsql.= ' t0006.nr_solic_mov_ant,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,';
        $strsql.= ' t0002_sol.nm_usuario as nm_usu_solic,';
        $strsql.= ' t0002_ate.nm_usuario as nm_usu_atend,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_atend_solic_mov),"%d/%m/%Y") as dt_atend_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_atend_solic_mov as TIME),4,5) as hr_atend_solic_mov,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0006.cd_prateleira,';
        $strsql.= ' t0006.nr_linha,';
        $strsql.= ' t0006.nr_coluna,';
        $strsql.= ' t0006.nr_posicao,';
        $strsql.= ' t0006.nr_prontuario,';
        $strsql.= ' t0006.st_solic_mov,';
        $strsql.= ' t0006.in_mov_prontuario,';
        $strsql.= ' t0006.dt_atend_solic_mov dt_atend_solic_mov_t6,';
        $strsql.= ' t0006.hr_atend_solic_mov hr_atend_solic_mov_t6';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0006 t0006';
        $strsql.= ' inner join cerof.scp_t0005 t0005 on t0005.cd_empresa = t0006.cd_empresa and t0005.nr_solic_mov = t0006.nr_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_sol on t0002_sol.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_ate on t0002_ate.cd_usuario = t0005.cd_usu_atend_solic_mov';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0006.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);
        $strsql.= ' and ';
        $strsql.= ' t0006.nr_prontuario = '.Mecanismo::TrataString(self::$nr_prontuario);
        $strsql.= ' and ';
        $strsql.= ' t0006.st_solic_mov = '.Mecanismo::TrataString(self::$st_solic_mov);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaMovimentacaoProntuarioPaciente(){
        
        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.nr_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,';
        $strsql.= ' t0002_u.nm_usuario,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_atend_solic_mov),"%d/%m/%Y") as dt_atend_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_atend_solic_mov as TIME),4,5) as hr_atend_solic_mov,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0006.cd_prateleira,';
        $strsql.= ' t0006.nr_linha,';
        $strsql.= ' t0006.nr_coluna,';
        $strsql.= ' t0006.nr_posicao,';
        $strsql.= ' t0006.nr_prontuario,';
        $strsql.= ' t0006.st_solic_mov,';
        $strsql.= ' t0006.in_mov_prontuario,';
        $strsql.= ' t0006.dt_atend_solic_mov,';
        $strsql.= ' t0006.hr_atend_solic_mov,';
        $strsql.= ' t0002.st_prontuario';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0006 t0006';
        $strsql.= ' inner join cerof.scp_t0005 t0005 on t0005.cd_empresa = t0006.cd_empresa and t0005.nr_solic_mov = t0006.nr_solic_mov';
        $strsql.= ' inner join cerof.scp_t0002 t0002 on t0002.cd_empresa = t0006.cd_empresa And t0002.cd_prateleira = t0006.cd_prateleira And t0002.nr_linha = t0006.nr_linha And t0002.nr_coluna = t0006.nr_coluna And t0002.nr_posicao = t0006.nr_posicao';
        $strsql.= ' inner join cerof.sca_t0002 t0002_u on t0002_u.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0006.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);
        $strsql.= ' and ';
        $strsql.= ' t0006.nr_prontuario = '.Mecanismo::TrataString(self::$nr_prontuario);
        $strsql.= ' and ';
        $strsql.= ' t0006.st_solic_mov in '.Mecanismo::TrataStringEnum(self::$st_solic_mov);
        $strsql.= ' and ';
        $strsql.= ' t0002.st_prontuario in '.Mecanismo::TrataStringEnum(self::$st_prontuario);
    
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    
    Public Static Function ListaRecpTransfProntuarioUsuario($st_solic_mov){
        
        $strsql = 'Select';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0005.nr_solic_mov,'; 
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,'; 
        $strsql.= ' t0002.nr_matr_usu,'; 
        $strsql.= ' t0002.dg_matr_usu,'; 
        $strsql.= ' t0002.nm_usuario,'; 
        $strsql.= ' t0006.nr_prontuario,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0006.in_mov_prontuario,';
        $strsql.= ' t0006.st_solic_mov';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0005 t0005';
        $strsql.= ' inner join cerof.scp_t0006 t0006 on t0006.cd_empresa = t0005.cd_empresa and t0006.nr_solic_mov = t0005.nr_solic_mov';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' inner join cerof.sca_t0002 t0002 on t0002.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0006.nr_solic_mov_ant = '.Mecanismo::TrataString(self::$nr_solic_mov_ant);
        $strsql.= ' and';
        $strsql.= ' t0006.st_solic_mov in '.Mecanismo::TrataStringEnum($st_solic_mov);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function historicoProntuario(){
        
        $strsql = 'Select';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0005.nr_solic_mov,'; 
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,'; 
        $strsql.= ' t0002.nr_matr_usu,'; 
        $strsql.= ' t0002.dg_matr_usu,'; 
        $strsql.= ' t0002.nm_usuario,'; 
        $strsql.= ' t0006.nr_prontuario,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0006.in_mov_prontuario,';
        $strsql.= ' t0006.cd_usu_devol_solic_mov,';
        $strsql.= ' t0002_d.nm_usuario as nm_usuario_d,';
        $strsql.= ' t0002_d.nr_matr_usu as nr_matr_usu_d,'; 
        $strsql.= ' t0002_d.dg_matr_usu as dg_matr_usu_d,'; 
        $strsql.= ' DATE_FORMAT(Date(t0006.dt_devol_solic_mov),"%d/%m/%Y") as dt_devol_solic_mov,';
        $strsql.= ' substr(CAST(t0006.hr_devol_solic_mov as TIME),4,5) as hr_devol_solic_mov,';
        $strsql.= ' t0006.st_solic_mov,';
        $strsql.= ' case t0006.st_solic_mov when "0" then "Pendente" else';
        $strsql.= '(case t0006.st_solic_mov when "1" then "Atendido" else';
        $strsql.= '(case t0006.st_solic_mov when "2" then "Devolvido" else';
        $strsql.= '(case t0006.st_solic_mov when "3" then "Não Atendido" else';
        $strsql.= '(case t0006.st_solic_mov when "4" then "Devolvido Não Atendido" else ';
        $strsql.= '(case t0006.st_solic_mov when "5" then "Transferido não Confirmado" else';
        $strsql.= '(case t0006.st_solic_mov when "6" then "Transferido Confirmado" else "Não Informado"';
        $strsql.= ' end)end)end)end)end)end)end as in_solic_mov';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0005 t0005';
        $strsql.= ' inner join cerof.scp_t0006 t0006 on t0006.cd_empresa = t0005.cd_empresa and t0006.nr_solic_mov = t0005.nr_solic_mov';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' inner join cerof.sca_t0002 t0002 on t0002.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' left join cerof.sca_t0002 t0002_d on t0002_d.cd_usuario = t0006.cd_usu_devol_solic_mov';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0006.nr_prontuario = '.Mecanismo::TrataString(self::$nr_prontuario);
        $strsql.= ' Order by';
        $strsql.= ' t0005.nr_solic_mov desc';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
}
?>
