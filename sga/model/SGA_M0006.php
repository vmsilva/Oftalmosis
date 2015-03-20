<?php
class SGA_M0006 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_emp_prestador;
    Private Static $cd_agenda;
    Private Static $cd_cnes;
    Private Static $cd_prof;
    Private Static $nm_prof;
    Private Static $sg_conselho;
    Private Static $nr_conselho;
    Private Static $cd_espld_medc;
    Private Static $nm_espld_medc;
    Private Static $in_local_atend;
    Private Static $nr_dia_semana;
    Private Static $cd_tp_grade;
    Private Static $nr_id_min;
    Private Static $nr_id_max;
    Private Static $hr_ini_atend;
    Private Static $hr_fin_atend;
    Private Static $hr_atend;
    Private Static $cd_pac;
    Private Static $st_agenda;
    Private Static $st_atend;
    Private Static $st_fatur;
    Private Static $dt_agenda;
    Private Static $dt_inicio;
    Private Static $dt_fim;
    Private Static $cd_usu_ger_agenda;
    Private Static $dt_usu_ger_agenda;
    Private Static $cd_usu_cad_agenda;
    Private Static $dt_usu_cad_agenda;
    Private Static $cd_usu_alt_agenda;
    Private Static $dt_usu_alt_agenda;

    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
	self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_emp_prestador($cd_emp_prestador){
	self::$cd_emp_prestador = $cd_emp_prestador;
    }
    Public Static Function setcd_agenda($cd_agenda){
        self::$cd_agenda = $cd_agenda;
    }
    Public Static Function setcd_cnes($cd_cnes){
        self::$cd_cnes = $cd_cnes;
    }
    Public Static Function setcd_prof($cd_prof){
        self::$cd_prof = $cd_prof;
    }
    Public Static Function setnm_prof($nm_prof){
        self::$nm_prof = $nm_prof;
    }
    Public Static Function setsg_conselho($sg_conselho){
        self::$sg_conselho = $sg_conselho;
    }
    Public Static Function setnr_conselho($nr_conselho){
        self::$nr_conselho = $nr_conselho;
    }
    Public Static Function setcd_espld_medc($cd_espld_medc){
        self::$cd_espld_medc = $cd_espld_medc;
    }
    Public Static Function setnm_espld_medc($nm_espld_medc){
        self::$nm_espld_medc = $nm_espld_medc;
    }
    Public Static Function setin_local_atend($in_local_atend){
        self::$in_local_atend = $in_local_atend;
    }
    Public Static Function setnr_dia_semana($nr_dia_semana){
        self::$nr_dia_semana = $nr_dia_semana;
    }
    Public Static Function setcd_tp_grade($cd_tp_grade){
        self::$cd_tp_grade = $cd_tp_grade;
    }
    Public Static Function setnr_id_min($nr_id_min){
        self::$nr_id_min = $nr_id_min;
    }
    Public Static Function setnr_id_max($nr_id_max){
        self::$nr_id_max = $nr_id_max;
    }
    Public Static Function sethr_ini_atend($hr_ini_atend){
        self::$hr_ini_atend = $hr_ini_atend;
    }
    Public Static Function sethr_fin_atend($hr_fin_atend){
        self::$hr_fin_atend = $hr_fin_atend;
    }
    Public Static Function sethr_atend($hr_atend){
        self::$hr_atend = $hr_atend;
    }
    Public Static Function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
    }
    Public Static Function setst_agenda($st_agenda){
        self::$st_agenda = $st_agenda;
    }
    Public Static Function setst_fatur($st_fatur){
        self::$st_fatur = $st_fatur;
    }
    Public Static Function setst_atend($st_atend){
        self::$st_atend = $st_atend;
    }
    Public Static Function setdt_agenda($dt_agenda){
        self::$dt_agenda = $dt_agenda;
    }
    Public Static Function setdt_inicio($dt_inicio){
        self::$dt_inicio = $dt_inicio;
    }
    Public Static Function setdt_fim($dt_fim){
        self::$dt_fim = $dt_fim;
    }
    Public Static Function setcd_usu_ger_agenda($cd_usu_ger_agenda){
        self::$cd_usu_ger_agenda = $cd_usu_ger_agenda;
    }
    Public Static Function setdt_usu_ger_agenda($dt_usu_ger_agenda){
        self::$dt_usu_ger_agenda = $dt_usu_ger_agenda;
    }
    Public Static Function setcd_usu_cad_agenda($cd_usu_cad_agenda){
        self::$cd_usu_cad_agenda = $cd_usu_cad_agenda;
    }
    Public Static Function setdt_usu_cad_agenda($dt_usu_cad_agenda){
        self::$dt_usu_cad_agenda = $dt_usu_cad_agenda;
    }
    Public Static Function setcd_usu_alt_agenda($cd_usu_alt_agenda){
        self::$cd_usu_alt_agenda = $cd_usu_alt_agenda;
    }
    Public Static Function setdt_usu_alt_agenda($dt_usu_alt_agenda){
        self::$dt_usu_alt_agenda = $dt_usu_alt_agenda;
    }
    
    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_agenda(){
        return self::$cd_agenda;
    }
    Public Static Function getcd_cnes(){
        return self::$cd_cnes;
    }
    Public Static Function getcd_prof(){
        return self::$cd_prof;
    }
    Public Static Function getnm_prof(){
        return self::$nm_prof;
    }
    Public Static Function getsg_conselho(){
        return self::$sg_conselho;
    }
    Public Static Function getnr_conselho(){
        return self::$nr_conselho;
    }
    Public Static Function getcd_espld_medc(){
        return self::$cd_espld_medc;
    }
    Public Static Function getnm_espld_medc(){
        return self::$nm_espld_medc;
    }
    Public Static Function getin_local_atend(){
        return self::$in_local_atend;
    }
    Public Static Function getnr_dia_semana(){
	return self::$nr_dia_semana;
    }
    Public Static Function getcd_tp_grade(){
        return self::$cd_tp_grade;
    }
    Public Static Function getnr_id_min(){
        return self::$nr_id_min;
    }
    Public Static Function getnr_id_max(){
        return self::$nr_id_max;
    }
    Public Static Function gethr_ini_atend(){
        return self::$hr_ini_atend;
    }
    Public Static Function gethr_fin_atend(){
        return self::$hr_fin_atend;
    }
    Public Static Function gethr_atend(){
        return self::$hr_atend;
    }
    Public Static Function getcd_pac(){
        return self::$cd_pac;
    }
    Public Static Function getst_agenda(){
        return self::$st_agenda;
    }
    Public Static Function getst_atend(){
        return self::$st_atend;
    }
    Public Static Function getdt_agenda(){
        return self::$dt_agenda;
    }
    Public Static Function getcd_usu_ger_agenda(){
        return self::$cd_usu_ger_agenda;
    }
    Public Static Function getdt_usu_ger_agenda(){
        return self::$dt_usu_ger_agenda;
    }
    Public Static Function getcd_usu_cad_agenda(){
        return self::$cd_usu_cad_agenda;
    }
    Public Static Function getdt_usu_cad_agenda(){
        return self::$dt_usu_cad_agenda;
    }
    Public Static Function getcd_usu_alt_agenda(){
        return self::$cd_usu_alt_agenda;
    }
    Public Static Function getdt_usu_alt_agenda(){
        return self::$dt_usu_alt_agenda;
    }

    Public Static Function VerificaDataImportaAgendaPrestador(){

        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.cd_agenda,';
        $strsql.= ' t0006.cd_cnes,';
        $strsql.= ' t0006.cd_prof,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0006.cd_espld_medc,';
        $strsql.= ' t0006.cd_tp_grade,';
        $strsql.= ' t0006.hr_ini_atend,';
        $strsql.= ' t0006.hr_fin_atend,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0006.st_agenda';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0006 t0006';
        $strsql.= ' inner join cerof.smg_t0004 t0004 on t0004.cd_prof = t0006.cd_prof';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_cnes = '.Mecanismo::TrataString(self::$cd_cnes);
        $strsql.= ' and';
        $strsql.= ' substr(t0006.cd_agenda,1,8) = '.Mecanismo::TrataString(self::$dt_agenda);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_tp_grade in '.Mecanismo::TrataStringEnum(self::$cd_tp_grade);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function Importacao(){
        
        $table = 'cerof.sga_t0006';

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_agenda"] = self::$cd_agenda;
        $dados["cd_cnes"] = self::$cd_cnes;
        $dados["cd_prof"] = self::$cd_prof;
        $dados["cd_espld_medc"] = self::$cd_espld_medc;
        $dados["in_local_atend"] = self::$in_local_atend;
        $dados["nr_dia_semana"] = self::$nr_dia_semana;
        $dados["cd_tp_grade"] = self::$cd_tp_grade;
        $dados["nr_id_min"] = self::$nr_id_min;
        $dados["nr_id_max"] = self::$nr_id_max;
        $dados["hr_ini_atend"] = self::$hr_ini_atend;
        $dados["hr_fin_atend"] = self::$hr_fin_atend;
        $dados["hr_atend"] = self::$hr_atend;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["st_agenda"] = self::$st_agenda;
        $dados["st_atend"] = self::$st_atend;
        $dados["cd_usu_ger_agenda"] = self::$cd_usu_ger_agenda;
        $dados["dt_usu_ger_agenda"] = self::$dt_usu_ger_agenda;
        $dados["cd_usu_cad_agenda"] = self::$cd_usu_cad_agenda;
        $dados["dt_usu_cad_agenda"] = self::$dt_usu_cad_agenda;
        $dados["cd_usu_alt_agenda"] = self::$cd_usu_alt_agenda;
        $dados["dt_usu_alt_agenda"] = self::$dt_usu_alt_agenda;
      
        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
    }
    
    Public Static Function VerificarPacienteImportado(){
        
        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.cd_agenda,';
        $strsql.= ' t0006.cd_cnes,';
        $strsql.= ' t0006.cd_prof,';
        $strsql.= ' t0006.cd_espld_medc,';
        $strsql.= ' t0006.cd_tp_grade,';
        $strsql.= ' t0006.hr_ini_atend,';
        $strsql.= ' t0006.hr_fin_atend,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0006.st_agenda';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0006 t0006';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_cnes = '.Mecanismo::TrataString(self::$cd_cnes);
        $strsql.= ' and';
        $strsql.= ' substr(t0006.cd_agenda,1,8) = '.Mecanismo::TrataString(self::$dt_agenda);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_tp_grade = '.Mecanismo::TrataString(self::$cd_tp_grade);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_prof = '.Mecanismo::TrataString(self::$cd_prof);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_espld_medc = '.Mecanismo::TrataString(self::$cd_espld_medc);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);
        
        return Mecanismo::ConsultaMetodo($strsql);

    } 
    
    Public Static Function ListaAgendaPrestador($where = null, $groupBy = null, $orderBy = null){

        $strsql = 'Select';
        $strsql.= ' t0006.cd_empresa,';
        $strsql.= ' t0006.cd_agenda,';
        $strsql.= ' t0006.cd_cnes,';
        $strsql.= ' t0006.cd_prof,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0005.nr_conselho,';
        $strsql.= ' t0003.cd_conselho,';
        $strsql.= ' t0003.sg_conselho,';
        $strsql.= ' t0006.cd_espld_medc,';
        $strsql.= ' t0008.nm_espld_medc,';
        $strsql.= ' t0006.cd_tp_grade,';
        $strsql.= ' t0006.hr_ini_atend,';
        $strsql.= ' t0006.hr_fin_atend,';
        $strsql.= ' t0006.hr_atend,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0002.st_prontuario,';
        $strsql.= ' t0006.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= ' t0014.dt_nasc_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0006.st_agenda';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0006 t0006';
        $strsql.= ' inner join cerof.smg_t0004 t0004 on t0004.cd_prof = t0006.cd_prof';
        $strsql.= ' inner join cerof.smg_t0005 t0005 on t0005.cd_prof = t0004.cd_prof';
        $strsql.= ' inner join cerof.smg_t0003 t0003 on t0003.cd_conselho = t0005.cd_conselho';
        $strsql.= ' inner join cerof.smg_t0008 t0008 on t0008.cd_espld_medc = t0006.cd_espld_medc';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0006.cd_pac';
        $strsql.= ' left join cerof.scp_t0002 t0002 on t0002.cd_pac = t0014.cd_pac';
        if($where != null){$strsql.= ' Where '.$where;}
        if($groupBy != null){$strsql.= ' '.$groupBy;}
        if($orderBy != null){$strsql.= ' '.$orderBy;} 

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
     Public Static Function mudarStatusFatur(){
         
        $table = 'cerof.sga_t0006';
        $where =  'cd_empresa = '.self::$cd_empresa;
        $where.=  ' and cd_agenda = '.self::$cd_agenda;

        $dados["st_fatur"] = self::$st_fatur;
        
        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return TRUE;
        }  else {
            return FALSE;
        }
     }
     
     Public Static Function mudarStatusAgenda(){
         
        $table = 'cerof.sga_t0006';
        $where =  'cd_empresa = '.self::$cd_empresa;
        $where.=  ' and cd_agenda = '.self::$cd_agenda;

        $dados["st_agenda"] = self::$st_agenda;
        $dados["cd_usu_alt_agenda"] = self::$cd_usu_alt_agenda;
        $dados["dt_usu_alt_agenda"] = self::$dt_usu_alt_agenda;
        
        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return TRUE;
        }  else {
            return FALSE;
        }
     }
}
?>