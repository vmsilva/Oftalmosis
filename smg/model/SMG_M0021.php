<?php

class SMG_M0021 extends Mecanismo {


    Private Static $cd_empresa;
    Private Static $cd_pac_cnes;
    Private Static $cd_pac_ant;
    Private Static $cd_pac_novo;
    Private Static $nr_prontuario;
    Private Static $cd_usuario;
    Private Static $dt_alt_pac;
    Private Static $hr_alt_pac;

    

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
	self::$cd_empresa = $cd_empresa;
    }
    Public Static function setcd_pac_cnes($cd_pac_cnes){
	self::$cd_pac_cnes = $cd_pac_cnes;
    }
    Public Static function setcd_pac_ant($cd_pac_ant){
	self::$cd_pac_ant = $cd_pac_ant;
    }
    Public Static function setcd_pac_novo($cd_pac_novo){
	self::$cd_pac_novo = $cd_pac_novo;
    }
    Public Static function setnr_prontuario($nr_prontuario){
	self::$nr_prontuario = $nr_prontuario;
    }
    Public Static function setcd_usuario($cd_usuario){
	self::$cd_usuario = $cd_usuario;
    }
    Public Static function setdt_alt_pac($dt_alt_pac){
	self::$dt_alt_pac = $dt_alt_pac;
    }
    Public Static function sethr_alt_pac($hr_alt_pac){
	self::$hr_alt_pac = $hr_alt_pac;
    }
        
    //Modulo SGS
    //Tabela da Agenda sga_t0006
    Public Static Function Alterar_SGA_T0006(){
        
        $table = 'cerof.sga_t0006';

        $dados["cd_pac"] = self::$cd_pac_novo;
        
        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="cd_pac = ".self::$cd_pac_ant;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    //Tabela da Atendimento sga_t0007
    Public Static Function Alterar_SGA_T0007(){
        
        $table = 'cerof.sga_t0007';

        $dados["cd_pac"] = self::$cd_pac_novo;
        
        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where.="cd_pac = ".self::$cd_pac_ant;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    //Modulo SMG
    //Tabela de Paciente smg_t0014
    Public Static Function Alterar_SMG_T0014(){
        
        $table = 'cerof.smg_t0014';

        $dados["st_pac"] = 2; //Cancelado/Transferido

        $where ="cd_pac = ".self::$cd_pac_ant;
        
        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    //Tabela de Paciente Depara smg_t0019
    Public Static Function Alterar_SMG_T0019(){
        
        $table = 'cerof.smg_t0019';

        $dados["cd_pac"] = self::$cd_pac_novo;
        
        $where ="cd_empresa = ".self::$cd_empresa;
        $where.=" and ";
        $where ="cd_cnes = '5208706449409'";
        $where.=" and ";
        $where.="cd_pac = ".self::$cd_pac_ant;
        
        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where); 
    }
    
    //Tabela de Log Unificação Paciente smg_t0021
    Public Static Function Incluir_SMG_T0021(){
        
        $table = 'cerof.smg_t0021';
        
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_pac_cnes"] = self::$cd_pac_cnes;
        $dados["cd_pac_ant"] = self::$cd_pac_ant;
        $dados["cd_pac_novo"] = self::$cd_pac_novo;
        $dados["nr_prontuario"] = self::$nr_prontuario;
        $dados["cd_usuario"] = self::$cd_usuario;
        $dados["dt_alt_pac"] = self::$dt_alt_pac;
        $dados["hr_alt_pac"] = self::$hr_alt_pac;
        
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return true;
        }  else {
            return FALSE;
        }
    }
}
?>
