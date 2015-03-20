<?php

class SCP_M0005 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $nr_solic_mov;
    Private Static $dt_solic_mov;
    Private Static $hr_solic_mov;
    Private Static $cd_usu_solic_mov;
    Private Static $dt_atend_solic_mov;
    Private Static $hr_atend_solic_mov;
    Private Static $cd_usu_atend_solic_mov;
    
    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }    
    Public Static function setnr_solic_mov($nr_solic_mov){
	self::$nr_solic_mov = $nr_solic_mov;
    }
    Public Static function setdt_solic_mov($dt_solic_mov){
        self::$dt_solic_mov = $dt_solic_mov;
    }
    Public Static function sethr_solic_mov($hr_solic_mov){
        self::$hr_solic_mov = $hr_solic_mov;
    }
    Public Static function setcd_usu_solic_mov($cd_usu_solic_mov){
        self::$cd_usu_solic_mov = $cd_usu_solic_mov;
    }
    Public Static function setdt_atend_solic_mov($dt_atend_solic_mov){
        self::$dt_atend_solic_mov = $dt_atend_solic_mov;
    }
    Public Static function sethr_atend_solic_mov($hr_atend_solic_mov){
        self::$hr_atend_solic_mov = $hr_atend_solic_mov;
    }
    Public Static function setcd_usu_atend_solic_mov($cd_usu_atend_solic_mov){
        self::$cd_usu_atend_solic_mov = $cd_usu_atend_solic_mov;
    }
    
    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_prateleira;
    }    
    Public Static Function getnr_solic_mov(){
        return self::$nr_solic_mov;
    }
    Public Static Function getdt_solic_mov(){
        return self::$dt_solic_mov;
    }
    Public Static Function gethr_solic_mov(){
        return self::$hr_solic_mov;
    }
    Public Static Function getcd_usu_solic_mov(){
        return self::$cd_usu_solic_mov;
    }
    Public Static Function getdt_atend_solic_mov(){
        return self::$dt_atend_solic_mov;
    }
    Public Static Function gethr_atend_solic_mov(){
        return self::$hr_atend_solic_mov;
    }
    Public Static Function getcd_usu_atend_solic_mov(){
        return self::$cd_usu_atend_solic_mov;
    }
    
    Public Static Function incluir(){

        $table = 'cerof.scp_t0005';
        
        $nr_solic_mov = Mecanismo::geraMaximoCodigoYYYYMM('nr_solic_mov', $table, Mecanismo::DataHoje());
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["nr_solic_mov"] = $nr_solic_mov;
        $dados["dt_solic_mov"] = self::$dt_solic_mov;
        $dados["hr_solic_mov"] =  self::$hr_solic_mov;
        $dados["cd_usu_solic_mov"] =  self::$cd_usu_solic_mov;

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return $nr_solic_mov;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function transferencia(){

        $table = 'cerof.scp_t0005';

        $nr_solic_mov = Mecanismo::geraMaximoCodigoYYYYMM('nr_solic_mov', $table, Mecanismo::DataHoje());
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["nr_solic_mov"] = $nr_solic_mov;
        $dados["dt_solic_mov"] = self::$dt_solic_mov;
        $dados["hr_solic_mov"] =  self::$hr_solic_mov;
        $dados["cd_usu_solic_mov"] =  self::$cd_usu_solic_mov;
        $dados["cd_usu_atend_solic_mov"] =  self::$cd_usu_atend_solic_mov;
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return $nr_solic_mov;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function Confirmar(){

        $table = 'cerof.scp_t0005';

        $dados["dt_atend_solic_mov"] = self::$dt_atend_solic_mov;
        $dados["hr_atend_solic_mov"] = self::$hr_atend_solic_mov;
        $dados["cd_usu_atend_solic_mov"] = self::$cd_usu_atend_solic_mov;
        
        $where = "cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.= " and ";
        $where.= "nr_solic_mov = ".Mecanismo::TrataString(self::$nr_solic_mov);

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    Public Static Function ReceberTransferencia(){

        $table = 'cerof.scp_t0005';

        $dados["dt_atend_solic_mov"] = self::$dt_atend_solic_mov;
        $dados["hr_atend_solic_mov"] = self::$hr_atend_solic_mov;
        
        $where = "cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.= " and ";
        $where.= "nr_solic_mov = ".Mecanismo::TrataString(self::$nr_solic_mov);
        $where.= " and ";
        $where.= "cd_usu_solic_mov = ".Mecanismo::TrataString(self::$cd_usu_solic_mov);

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    Public Static Function listaSolicitacaoMovimentacaoProntuario(){
        
        $strsql = 'Select';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0005.nr_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,';
        $strsql.= ' t0002_mov.nm_usuario nm_usu_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_atend_solic_mov),"%d/%m/%Y") as dt_atend_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_atend_solic_mov as TIME),4,5) as hr_atend_solic_mov,';
        $strsql.= ' t0005.cd_usu_atend_solic_mov';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0005 t0005';
        $strsql.= ' inner join cerof.sca_t0002 t0002_mov on t0002_mov.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0005.dt_atend_solic_mov is null';
        $strsql.= ' and ';
        $strsql.= ' t0005.cd_usu_atend_solic_mov is null';

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function listaConfirmacaoSolicitacaoMovimentacaoProntuario($st_solic_mov){
        
        $strsql = 'Select';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0005.nr_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_solic_mov),"%d/%m/%Y") as dt_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_solic_mov as TIME),4,5) as hr_solic_mov,';
        $strsql.= ' t0005.cd_usu_solic_mov,';
        $strsql.= ' t0002_mov.nm_usuario nm_usu_solic_mov,';
        $strsql.= ' DATE_FORMAT(Date(t0005.dt_atend_solic_mov),"%d/%m/%Y") as dt_atend_solic_mov,';
        $strsql.= ' substr(CAST(t0005.hr_atend_solic_mov as TIME),4,5) as hr_atend_solic_mov,';
        $strsql.= ' t0005.cd_usu_atend_solic_mov,';
        $strsql.= ' t0002_ate.nm_usuario nm_usu_atend';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0005 t0005';
        $strsql.= ' inner join cerof.sca_t0002 t0002_mov on t0002_mov.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' inner join cerof.sca_t0002 t0002_ate on t0002_ate.cd_usuario = t0005.cd_usu_atend_solic_mov';
        $strsql.= ' inner join cerof.scp_t0006 t0006 on t0006.cd_empresa = t0005.cd_empresa and t0006.nr_solic_mov = t0005.nr_solic_mov';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0005.dt_atend_solic_mov is not null';
        $strsql.= ' and ';
        $strsql.= " t0006.st_solic_mov in ".Mecanismo::TrataStringEnum($st_solic_mov);
        $strsql.= " Group By t0005.cd_empresa, t0005.nr_solic_mov";

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ListaMovimentacaoProntuarioUsuario($st_solic_mov){
        
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
        $strsql.= ' t0006.st_solic_mov,';
        $strsql.= ' t0006.nr_solic_mov_ant';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0005 t0005';
        $strsql.= ' inner join cerof.scp_t0006 t0006 on t0006.cd_empresa = t0005.cd_empresa and t0006.nr_solic_mov = t0005.nr_solic_mov';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' inner join cerof.sca_t0002 t0002 on t0002.cd_usuario = t0005.cd_usu_solic_mov';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0005.cd_usu_solic_mov = '.Mecanismo::TrataString(self::$cd_usu_solic_mov);
        $strsql.= ' and';
        $strsql.= ' t0006.st_solic_mov in '.Mecanismo::TrataStringEnum($st_solic_mov);
        $strsql.= ' Order by t0014.nm_pac, t0006.nr_prontuario';
 
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Function ListaProntPrincipalPeloProntAnterior(){
        
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
        $strsql.= ' t0005.cd_usu_solic_mov = '.Mecanismo::TrataString(self::$cd_usu_solic_mov);
        $strsql.= ' and';
        $strsql.= ' t0006.st_solic_mov in '.Mecanismo::TrataStringEnum($st_solic_mov);
        $strsql.= ' Order by t0006.nr_prontuario';
    }
 
}

?>
