<?php
/**
 * Tabela: t0008
 * Descrição: Formulario X Usuario
 * Data Criação: 16/03/2012
 * @author: Ronaldo Cesar dos Anjos
 * ----------- Alteração ------------
 * @author:
 * Data Alteração:
 * O que foi Alterado:
 *
 */
class SCA_M0008 extends Mecanismo {
    
        Private Static  $cd_sistema;
        Private Static  $st_sistema;
        Private Static  $cd_formulario;
        Private Static  $ar_formulario;
        Private Static  $cd_botao;
        Private Static  $st_botao;
        Private Static  $cd_usuario;
        Private Static  $nr_matr_usu;
        Private Static  $dg_matr_usu;
        Private Static  $st_formulario;
	
    /* Metodo Set */
        
    Public Static Function setst_sistema($st_sistema){
        self::$st_sistema = $st_sistema;
    }
    Public Static Function setst_formulario($st_formulario){
        self::$st_formulario = $st_formulario;
    }
	
    Public Static Function setcd_sistema($cd_sistema){
        self::$cd_sistema = $cd_sistema;
    }
    Public Static Function setcd_formulario($cd_formulario){
        self::$cd_formulario = $cd_formulario;
    }
    Public Static Function setar_formulario($ar_formulario){
        self::$ar_formulario = $ar_formulario;
    }
    Public Static Function setcd_botao($cd_botao){
        self::$cd_botao = $cd_botao;
    }
    Public Static Function setst_botao($st_botao){
        self::$st_botao = $st_botao;
    }
    Public Static Function setcd_usuario($cd_usuario){
        self::$cd_usuario = $cd_usuario;
    }
	
    Public Static Function setnr_matr_usu($nr_matr_usu){
        self::$nr_matr_usu = $nr_matr_usu;
    }
    
    Public Static Function setdg_matr_usu($dg_matr_usu){
        self::$dg_matr_usu = $dg_matr_usu;
    }

    /* Metodo Get */
    Public Static Function getcd_sistema(){
        return self::$cd_sistema;
    }
    Public Static Function getst_sistema(){
        return self::$st_sistema;
    }
    Public Static Function getcd_formulario(){
        return self::$cd_formulario;
    }
    Public Static Function getar_formulario(){
        return self::$ar_formulario;
    }
    Public Static Function getcd_botao(){
        return self::$cd_botao;
    }
    Public Static Function getst_botao(){
        return self::$st_botao;
    }
    Public Static Function getcd_usuario(){
        return self::$cd_usuario;
    }
    Public Static Function getnr_matr_usu(){
        return self::$nr_matr_usu;
    }
    Public Static Function getdg_matr_usu(){
        return self::$dg_matr_usu;
    }
    Public Static Function getst_formulario(){
        return self::$st_formulario;
    }
	
		
    Public Static Function ListaFormBotao(){
		
            $strsql = 'Select';
            $strsql.= ' t0008.cd_sistema,';
            $strsql.= ' t0008.cd_formulario,';
            $strsql.= ' t0008.cd_botao,';
            $strsql.= ' t0008.in_hier_botao,';
            $strsql.= ' t0007.nm_botao';
            $strsql.= ' From ';
            $strsql.= ' cerof.sca_t0008 t0008';
            $strsql.= ' Inner Join cerof.sca_t0007 t0007 on t0007.cd_botao = t0008.cd_botao';
            $strsql.= ' Where';
            $strsql.= ' t0008.cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
            $strsql.= ' and';
            $strsql.= ' t0008.cd_formulario = '.Mecanismo::TrataString(self::$cd_formulario);
            $strsql.= ' Order by';
            $strsql.= ' t0008.in_hier_botao';

            return Mecanismo::ConsultaMetodo($strsql);
	}
}
?>