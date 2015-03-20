<?php

class SGA_M0008 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_procd_medc;
    Private Static $cd_pac;
    Private Static $cd_ex_laudo;
    Private Static $ds_olho_dir;
    Private Static $ds_olho_esq;
    Private Static $ds_conclusao;
    Private Static $cd_usu;
    
    static function getcd_empresa() {
        return self::$cd_empresa;
    }

    static function getcd_procd_medc() {
        return self::$cd_procd_medc;
    }

    static function getcd_pac() {
        return self::$cd_pac;
    }

    static function getcd_ex_laudo() {
        return self::$cd_ex_laudo;
    }

    static function getds_olho_dir() {
        return self::$ds_olho_dir;
    }

    static function getds_olho_esq() {
        return self::$ds_olho_esq;
    }

    static function getds_conclusao() {
        return self::$ds_conclusao;
    }
    
    static function getcd_usu() {
        return self::$cd_usu;
    }

    static function setcd_empresa($cd_empresa) {
        self::$cd_empresa = $cd_empresa;
    }

    static function setcd_procd_medc($cd_procd_medc) {
        self::$cd_procd_medc = $cd_procd_medc;
    }

    static function setcd_pac($cd_pac) {
        self::$cd_pac = $cd_pac;
    }

    static function setcd_ex_laudo($cd_ex_laudo) {
        self::$cd_ex_laudo = $cd_ex_laudo;
    }

    static function setds_olho_dir($ds_olho_dir) {
        self::$ds_olho_dir = $ds_olho_dir;
    }

    static function setds_olho_esq($ds_olho_esq) {
        self::$ds_olho_esq = $ds_olho_esq;
    }

    static function setds_conclusao($ds_conclusao) {
        self::$ds_conclusao = $ds_conclusao;
    }
    
    static function setcd_usu($cd_usu) {
        self::$cd_usu = $cd_usu;
    }

    Public Static Function Incluir(){

        $table = 'cerof.sga_t0008';
        $where =  'cd_empresa = '.self::$cd_empresa;

        $dados["cd_empresa"] = self::$cd_empresa;

        $dados["cd_ex_laudo"] = Mecanismo::geraMaximoCodigoYYYYMMDD('cd_ex_laudo', $table, Mecanismo::DataHoje(),$where);
        $dados["cd_procd_medc"] = self::$cd_procd_medc;
        $dados["cd_pac"] = self::$cd_pac;
        $dados["ds_olho_dir"] = self::$ds_olho_dir;
        $dados["ds_olho_esq"] = self::$ds_olho_esq;
        $dados["ds_conclusao"] = self::$ds_conclusao;        

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            $dados['sinal'] = true;
            return $dados;
        }  else {
            $dados['sinal'] = false;
            return $dados;
        }
    }
    
    Public Static Function buscaLaudo(){
        
        $strsql  = 'Select';
        $strsql .= ' t0008.ds_olho_dir,';
        $strsql .= ' t0008.ds_olho_esq,';
        $strsql .= ' t0008.ds_conclusao,';
        $strsql .= ' t0014.nm_pac,';
        $strsql .= ' t0014.nm_mae_pac,';
        $strsql .= ' t0014.dt_nasc_pac,';
        $strsql .= ' t0014.nr_cns_pac,';
        $strsql .= ' t0014.tp_sexo_pac,';
        $strsql .= ' t0002.nr_prontuario,';
        $strsql .= ' t0010.nm_procd_medc,';
        $strsql .= ' st0002.nm_usuario,';       
        $strsql .= ' t0005.nr_conselho';       
        $strsql .= ' From';
        $strsql .= ' cerof.sga_t0008 t0008';
        $strsql .= ' inner join cerof.smg_t0014 t0014 on( t0008.cd_pac = t0014.cd_pac)';
        $strsql .= ' inner join cerof.smg_t0010 t0010 on( t0008.cd_procd_medc = t0010.cd_procd_medc)';
        $strsql .= ' inner join cerof.sca_t0002 st0002';
        $strsql .= ' left join cerof.smg_t0004 t0004 on( st0002.nr_cpf = t0004.nr_cpf_prof)';        
        $strsql .= ' left join cerof.smg_t0005 t0005 on( t0005.cd_prof = t0004.cd_prof)';        
        $strsql .= ' left join cerof.scp_t0002 t0002 on( t0008.cd_pac = t0002.cd_pac)';        
        $strsql .= ' WHERE';
        $strsql .= ' t0008.cd_empresa ='.self::$cd_empresa;
        
        if(self::$cd_procd_medc != NULL ){
            $strsql .= ' AND';
            $strsql .= ' t0008.cd_procd_medc ='.self::$cd_procd_medc;
        }
        
        if(self::$cd_pac != NULL){
            $strsql .= ' AND';
            $strsql .= ' t0008.cd_pac ='.self::$cd_pac;
        }
        
        if(self::$cd_ex_laudo != NULL){
            $strsql .= ' AND';
            $strsql .= ' t0008.cd_ex_laudo ='.self::$cd_ex_laudo;
        }
        
        if(self::$ds_olho_dir != NULL){
            $strsql .= ' AND';
            $strsql .= ' t0008.ds_olho_dir ='.Mecanismo::TrataString(self::$ds_olho_dir);
        }
        
        if(self::$ds_olho_esq != NULL){
            $strsql .= ' AND';
            $strsql .= ' t0008.ds_olho_esq ='.Mecanismo::TrataString(self::$ds_olho_esq);
        }
        
        if(self::$ds_conclusao != NULL){
            $strsql .= ' AND';
            $strsql .= ' t0008.ds_conclusao ='.Mecanismo::TrataString(self::$ds_conclusao);
        }
        
        if(self::$cd_usu != NULL){
            $strsql .= ' AND';
            $strsql .= ' st0002.cd_usuario ='.self::$cd_usu;
        }
               
        //exit($strsql);
        return Mecanismo::ConsultaMetodo($strsql);
    }     
}

?>