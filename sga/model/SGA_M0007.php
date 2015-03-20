<?php

class SGA_M0007 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_fila;
    Private Static $cd_cnes;
    Private Static $cd_espld_medc;
    Private Static $cd_prof;
    Private Static $cd_agenda;
    Private Static $tp_atend;
    Private Static $in_servico;
    Private Static $cd_pac;
    Private Static $dt_atend;
    Private Static $hr_cheg;
    Private Static $hr_ini_atend;
    Private Static $hr_fin_atend;
    Private Static $st_fila;
    Private Static $cd_empresa_pai;
    Private Static $cd_fila_pai;
    Private Static $cd_usu_cad_fila;
    Private Static $dt_usu_cad_fila;
    Private Static $cd_usu_atend;
    Private Static $dt_usu_atend;

    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
	self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_fila($cd_fila){
	self::$cd_fila = $cd_fila;
    }
    Public Static Function setcd_cnes($cd_cnes){
        self::$cd_cnes = $cd_cnes;
    }
    Public Static Function setcd_espld_medc($cd_espld_medc){
        self::$cd_espld_medc = $cd_espld_medc;
    }
    Public Static Function setcd_prof($cd_prof){
        self::$cd_prof = $cd_prof;
    }
    Public Static Function setcd_agenda($cd_agenda){
        self::$cd_agenda = $cd_agenda;
    }
    Public Static Function settp_atend($tp_atend){
        self::$tp_atend = $tp_atend;
    }
    Public Static Function setin_servico($in_servico){
        self::$in_servico = $in_servico;
    }
    Public Static Function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
    }
    Public Static Function setdt_atend($dt_atend){
        self::$dt_atend = $dt_atend;
    }
    Public Static Function sethr_cheg($hr_cheg){
        self::$hr_cheg = $hr_cheg;
    }
    Public Static Function sethr_ini_atend($hr_ini_atend){
        self::$hr_ini_atend = $hr_ini_atend;
    }
    Public Static Function sethr_fin_atend($hr_fin_atend){
        self::$hr_fin_atend = $hr_fin_atend;
    }
    Public Static Function setst_fila($st_fila){
        self::$st_fila = $st_fila;
    }
    Public Static Function setcd_empresa_pai($cd_empresa_pai){
        self::$cd_empresa_pai = $cd_empresa_pai;
    }
    Public Static Function setcd_fila_pai($cd_fila_pai){
        self::$cd_fila_pai = $cd_fila_pai;
    }
    Public Static Function setcd_usu_cad_fila($cd_usu_cad_fila){
        self::$cd_usu_cad_fila = $cd_usu_cad_fila;
    }
    Public Static Function setdt_usu_cad_fila($dt_usu_cad_fila){
        self::$dt_usu_cad_fila = $dt_usu_cad_fila;
    }
    Public Static Function setcd_usu_atend($cd_usu_atend){
        self::$cd_usu_atend = $cd_usu_atend;
    }
    Public Static Function setdt_usu_atend($dt_usu_atend){
        self::$dt_usu_atend = $dt_usu_atend;
    }
    
    Public Static Function Incluir(){
        
        $table = 'cerof.sga_t0007';
        $where =  'cd_empresa = '.self::$cd_empresa;

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_fila"] = Mecanismo::geraMaximoCodigo('cd_fila', $table, $where);
        $dados["cd_cnes"] = self::$cd_cnes;
        $dados["cd_espld_medc"] = self::$cd_espld_medc;        
        (is_numeric(self::$cd_prof) && !is_null(self::$cd_prof)) ? $dados["cd_prof"] =  self::$cd_prof : '';
        (is_numeric(self::$cd_agenda) && !is_null(self::$cd_agenda)) ? $dados["cd_agenda"] =  self::$cd_agenda : '';
        $dados["tp_atend"] = self::$tp_atend;
        $dados["in_servico"] = self::$in_servico;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["dt_atend"] = self::$dt_atend;
        $dados["hr_cheg"] = self::$hr_cheg;
        (is_numeric(self::$hr_ini_atend) && !is_null(self::$hr_ini_atend)) ? $dados["hr_ini_atend"] =  self::$hr_ini_atend : '';
        (is_numeric(self::$hr_fin_atend) && !is_null(self::$hr_fin_atend)) ? $dados["hr_fin_atend"] =  self::$hr_fin_atend : '';
        $dados["st_fila"] = self::$st_fila;
        (is_numeric(self::$cd_empresa_pai) && !is_null(self::$cd_empresa_pai)) ? $dados["cd_empresa_pai"] =  self::$cd_empresa_pai : '';
        (is_numeric(self::$cd_fila_pai) && !is_null(self::$cd_fila_pai)) ? $dados["cd_fila_pai"] =  self::$cd_fila_pai : '';
        $dados["cd_usu_cad_fila"] = self::$cd_usu_cad_fila;
        $dados["dt_usu_cad_fila"] = self::$dt_usu_cad_fila;

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function Excluir(){
        
        $table = 'cerof.sga_t0007';

        $where = "cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $where.= " and ";
        $where.= "cd_fila = ".Mecanismo::TrataString(self::$cd_fila);
        
        if(Mecanismo::ExecutaMetodo('DELETE', $table, '', $where)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function listaFilaStatus(){
        
        $strsql = 'Select';
        $strsql.= ' t0007.cd_empresa,';
        $strsql.= ' t0007.cd_fila,';
        $strsql.= ' t0007.cd_cnes,';
        $strsql.= ' t0001.nm_cnes,';
        $strsql.= ' t0001.nm_cnes_red,';
        $strsql.= ' t0007.cd_espld_medc,';
        $strsql.= ' t0008.nm_espld_medc,';
        $strsql.= ' t0007.cd_prof,';
        $strsql.= ' t0004.nm_prof,';
        $strsql.= ' t0005.nr_conselho,';
        $strsql.= ' t0003_con.sg_conselho,';
        $strsql.= ' t0007.cd_agenda,';
        $strsql.= ' t0007.tp_atend,';
        $strsql.= ' t0007.in_servico,';
        $strsql.= ' t0007.cd_pac,';
        $strsql.= ' t0014.nm_pac,';
        $strsql.= ' t0014.nm_mae_pac,';
        $strsql.= ' t0014.nr_cns_pac,';
        $strsql.= ' t0014.tp_sexo_pac,';
        $strsql.= ' t0014.dt_nasc_pac,';
        $strsql.= ' t0014.ds_logr_pac,';
        $strsql.= ' t0014.nm_bairro_pac,';
        $strsql.= ' t0014.ds_qd_pac,';
        $strsql.= ' t0014.ds_lt_pac,';
        $strsql.= ' t0014.nr_pac,';
        $strsql.= ' t0003.nm_munic as nm_munic_pac,';
        $strsql.= ' t0002_uf.sg_uf as sg_uf_pac,';
        $strsql.= ' t0014.nr_cep_pac,';
        $strsql.= ' t0014.nr_fone_pac_01,';
        $strsql.= ' t0014.nr_fone_pac_02,';
        $strsql.= ' t0014.nr_fone_pac_03,';
        $strsql.= ' t0002.nr_prontuario,';
        $strsql.= ' t0007.dt_atend,';
        $strsql.= ' t0007.hr_cheg,';
        $strsql.= ' t0007.hr_ini_atend,';
        $strsql.= ' t0007.hr_fin_atend,';
        $strsql.= ' t0007.st_fila,';
        $strsql.= ' t0007.cd_empresa_pai,';
        $strsql.= ' t0007.cd_fila_pai,';
        $strsql.= ' t0007.cd_usu_cad_fila,';
        $strsql.= ' t0007.dt_usu_cad_fila,';
        $strsql.= ' t0007.cd_usu_atend,';
        $strsql.= ' t0002_usu.nm_usuario,';
        $strsql.= ' t0002_usu.nr_matr_usu,';
        $strsql.= ' t0002_usu.dg_matr_usu,';
        $strsql.= ' t0007.dt_usu_atend';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0007 t0007';
        $strsql.= ' inner join cerof.smg_t0014 t0014 on t0014.cd_pac = t0007.cd_pac';
        $strsql.= ' inner join cerof.sgm_t0003 t0003 on t0003.cd_munic = t0014.cd_munic_pac';
        $strsql.= ' inner join cerof.sgm_t0002 t0002_uf on t0002_uf.cd_uf = t0003.cd_uf';
        $strsql.= ' left join cerof.scp_t0002 t0002 on t0002.cd_pac = t0014.cd_pac and t0002.cd_pac = t0007.cd_pac and t0002.cd_empresa = t0007.cd_empresa';
        $strsql.= ' inner join cerof.smg_t0008 t0008 on t0008.cd_espld_medc = t0007.cd_espld_medc';
        $strsql.= ' left join cerof.smg_t0004 t0004 on t0004.cd_prof = t0007.cd_prof';
        $strsql.= ' left join cerof.smg_t0005 t0005 on t0005.cd_prof = t0004.cd_prof';
        $strsql.= ' left join cerof.smg_t0003 t0003_con on t0003_con.cd_conselho = t0005.cd_conselho';
        $strsql.= ' inner join cerof.smg_t0001 t0001 on t0001.cd_cnes = t0007.cd_cnes';
        $strsql.= ' inner join cerof.sca_t0002 t0002_usu on t0002_usu.cd_usuario = t0007.cd_usu_cad_fila';
        $strsql.= ' where';
        $strsql.= ' t0007.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and t0007.st_fila in '.Mecanismo::TrataStringEnum(self::$st_fila);
     
        //Código Fila de Atendimento
        (!empty(self::$cd_fila) && !is_null(self::$cd_fila)) ? $strsql.= ' and t0007.cd_fila = '.Mecanismo::TrataString(self::$cd_fila) : '';
        
        //Código Paciente
        (!empty(self::$cd_pac) && !is_null(self::$cd_pac)) ? $strsql.= ' and t0007.cd_pac = '.Mecanismo::TrataString(self::$cd_pac) : '';
        
        //Data de Atendimento
        (!empty(self::$dt_atend) && !is_null(self::$dt_atend)) ? $strsql.= ' and t0007.dt_atend = '.Mecanismo::TrataString(self::$dt_atend) : '';
        
        //Código Serviço
        (!empty(self::$in_servico) && !is_null(self::$in_servico)) ? $strsql.= ' and t0007.in_servico = '.Mecanismo::TrataString(self::$in_servico) : '';
        
        //Hora de chegada
        (!empty(self::$hr_cheg) && !is_null(self::$hr_cheg)) ? $strsql.= " and t0007.hr_cheg > SUBSTR(replace(DATE_ADD(CURTIME(), INTERVAL - 60 MINUTE),':',''),1,4)" : '';
        
        $strsql.= ' Order By t0007.hr_cheg desc';

        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>