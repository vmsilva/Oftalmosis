<?php

class SCP_M0004 extends Mecanismo{

    Private Static $cd_empresa;
    Private Static $cd_pac;
    Private Static $nr_prontuario;
    Private Static $cd_usu_pront;
    Private Static $dt_usu_pront;
    Private Static $hr_usu_pront;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
    }
    Public Static function setnr_prontuario($nr_prontuario){
        self::$nr_prontuario = $nr_prontuario;
    }
    Public Static function setcd_usu_pront($cd_usu_pront){
        self::$cd_usu_pront = $cd_usu_pront;
    }
    Public Static function setdt_usu_pront($dt_usu_pront){
        self::$dt_usu_pront = $dt_usu_pront;
    }
    Public Static function sethr_usu_pront($hr_usu_pront){
        self::$hr_usu_pront = $hr_usu_pront;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_pac(){
        return self::$cd_pac;
    }
    Public Static Function getnr_prontuario(){
        return self::$nr_prontuario;
    }
    Public Static Function getcd_usu_pront(){
        return self::$cd_usu_pront;
    }
    Public Static Function getdt_usu_pront(){
        return self::$dt_usu_pront;
    }
    Public Static Function gethr_usu_pront(){
        return self::$hr_usu_pront;
    }

    Public Static Function consultaNumeroProntuario(){
        
        $strsql = 'Select';
        $strsql.= ' t0004.cd_empresa,';
        $strsql.= ' t0004.cd_pac,';
        $strsql.= ' t0004.nr_prontuario,';
        $strsql.= ' t0004.cd_usu_pront,';
        $strsql.= ' t0004.dt_usu_pront,';
        $strsql.= ' t0004.hr_usu_pront';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0004 t0004';
        $strsql.= ' Where';
        $strsql.= ' t0004.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0004.nr_prontuario = '.Mecanismo::TrataString(self::$nr_prontuario);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaNumeroProntuarioPaciente(){
        
        $strsql = 'Select';
        $strsql.= ' t0004.cd_empresa,';
        $strsql.= ' t0004.cd_pac,';
        $strsql.= ' t0004.nr_prontuario,';
        $strsql.= ' t0004.cd_usu_pront,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' DATE_FORMAT(Date(t0004.dt_usu_pront),"%d/%m/%Y") as dt_usu_pront,';
        $strsql.= ' substr(DATE_FORMAT(CAST(hr_usu_pront as TIME),"%H:%i:%s"),4,5) as hr_usu_pront';
        $strsql.= ' From';
        $strsql.= ' cerof.scp_t0004 t0004';
        $strsql.= ' inner join cerof.sca_t0002 t0002 on t0002.cd_usuario = t0004.cd_usu_pront';
        $strsql.= ' Where';
        $strsql.= ' t0004.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and ';
        $strsql.= ' t0004.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);
        $strsql.= ' Order by ';
        $strsql.= ' t0004.dt_usu_pront desc,';
        $strsql.= ' t0004.hr_usu_pront desc';
        return Mecanismo::ConsultaMetodo($strsql);
        
    }

    Public Static Function incluir(){

        $table = 'cerof.scp_t0004';

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["nr_prontuario"] = self::$nr_prontuario;
        $dados["cd_usu_pront"] = self::$cd_usu_pront;
        $dados["dt_usu_pront"] = self::$dt_usu_pront;
        $dados["hr_usu_pront"] = self::$hr_usu_pront;

         return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
    }
}
?>
