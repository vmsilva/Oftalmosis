<?php
/**
 * Schema: envolver_sca
 * Tabela: t0005
 * Descrição: Empresas x Sistemas
 * Data Criação: 16/03/2012
 * @author: Ronaldo Cesar dos Anjos
 * ----------- Alteração ------------
 * @author:
 * Data Alteração:
 * O que foi Alterado:
 *
 */
 class SCA_M0005 extends Mecanismo {

    Private Static $cd_empresa;
    Private Static $st_empresa;
    Private Static $cd_sistema;
    Private Static $st_sistema;
    Private Static $cd_usuario;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }

    Public Static Function setst_empresa($st_empresa){
        self::$st_empresa = $st_empresa;
    }

    Public Static Function setcd_sistema($cd_sistema){
        self::$cd_sistema = $cd_sistema;
    }

    Public Static Function setst_sistema($st_sistema){
        self::$st_sistema = $st_sistema;
    }

    Public Static Function setcd_usuario($cd_usuario){
        self::$cd_usuario = $cd_usuario;
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getst_empresa(){
        return self::$st_empresa;
    }
    Public Static Function getcd_sistema(){
        return self::$cd_sistema;
    }
    Public Static Function getst_sistema(){
        return self::$st_sistema;
    }
    Public Static Function getcd_usuario(){
        return self::$cd_usuario;
    }

    Public Static Function ListaPermissaoEmpresaSistema(){

        $strsql = 'Select';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0001.nm_empresa,';
        $strsql.= ' t0005.cd_sistema,';
        $strsql.= ' t0003.sg_sistema,';
        $strsql.= ' t0003.nm_sistema';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0005 t0005';
        $strsql.= ' inner join cerof.sca_t0001 t0001 on t0001.cd_empresa = t0005.cd_empresa';
        $strsql.= ' inner join cerof.sca_t0003 t0003 on t0003.cd_sistema = t0005.cd_sistema';
        $strsql.= ' inner join cerof.sca_t0004 t0004 on t0004.cd_sistema = t0003.cd_sistema';
        $strsql.= ' inner join cerof.sca_t0006 t0006 on t0006.cd_sistema = t0004.cd_sistema and t0006.cd_formulario = t0004.cd_formulario';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0001.st_empresa = '.Mecanismo::TrataString(self::$st_empresa);
        $strsql.= ' and';
        $strsql.= ' t0003.st_sistema = '.Mecanismo::TrataString(self::$st_sistema);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
        $strsql.= ' Group by';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0001.nm_empresa,';
        $strsql.= ' t0005.cd_sistema,';
        $strsql.= ' t0003.sg_sistema,';
        $strsql.= ' t0003.nm_sistema';
        $strsql.= ' Order by';
        $strsql.= ' t0003.in_hier_sist';
        
        return Mecanismo::ConsultaMetodo($strsql);

    }
}
?>
