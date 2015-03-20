<?php

class SMG_M0019 extends Mecanismo{

    Private Static $cd_empresa;
    Private Static $cd_cnes;
    Private Static $cd_pac;
    Private Static $cd_pac_cnes;

    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_cnes($cd_cnes){
        self::$cd_cnes = $cd_cnes;
    }
    Public Static Function setcd_pac($cd_pac){
        self::$cd_pac = $cd_pac;
    }
    Public Static Function setcd_pac_cnes($cd_pac_cnes){
        self::$cd_pac_cnes = $cd_pac_cnes;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_cnes(){
        return self::$cd_cnes;
    }
    Public Static Function getcd_pac(){
        return self::$cd_pac;
    }
    Public Static Function getcd_pac_cnes(){
        return self::$cd_pac_cnes;
    }

    Public Static Function ConsultaCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0019.cd_empresa,';
        $strsql.= ' t0019.cd_cnes,';
        $strsql.= ' t0019.cd_pac,';
        $strsql.= ' t0019.cd_pac_cnes';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0019 t0019';
        $strsql.= ' Where';
        $strsql.= ' t0019.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0019.cd_cnes = '.Mecanismo::TrataString(self::$cd_cnes);
        $strsql.= ' and';
        //$strsql.= ' t0019.cd_pac_cnes = '.Mecanismo::TrataString(self::$cd_pac_cnes);
        //$strsql.= ' and';
        $strsql.= ' t0019.cd_pac = '.Mecanismo::TrataString(self::$cd_pac);

        return Mecanismo::ConsultaMetodo($strsql);

    }
    
    Public Static Function ConsultaCodigoSMS(){

        $strsql = 'Select';
        $strsql.= ' t0019.cd_empresa,';
        $strsql.= ' t0019.cd_cnes,';
        $strsql.= ' t0019.cd_pac,';
        $strsql.= ' t0019.cd_pac_cnes';
        $strsql.= ' From';
        $strsql.= ' cerof.smg_t0019 t0019';
        $strsql.= ' Where';
        $strsql.= ' t0019.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0019.cd_cnes = '.Mecanismo::TrataString(self::$cd_cnes);
        $strsql.= ' and';
        $strsql.= ' t0019.cd_pac_cnes = '.Mecanismo::TrataString(self::$cd_pac_cnes);

        return Mecanismo::ConsultaMetodo($strsql);

    }

    Public Static Function Incluir(){

        $table = 'cerof.smg_t0019';

        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_cnes"] = self::$cd_cnes;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["cd_pac_cnes"] = self::$cd_pac_cnes;

        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);        
    }
}
?>
