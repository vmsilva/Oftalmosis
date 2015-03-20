<?php
/**
 * Schema: envolver_sca
 * Tabela: t0006
 * Descrição: Empresas x Sistemas
 * Data Criação: 16/03/2012
 * @author: Ronaldo Cesar dos Anjos
 * ----------- Alteração ------------
 * @author:
 * Data Alteração:
 * O que foi Alterado:
 *
 */
 class SCA_M0006 extends Mecanismo {

    Private Static $cd_empresa;
    Private Static $st_empresa;
    Private Static $cd_sistema;
    Private Static $st_sistema;
    Private Static $cd_formulario;
    Private Static $cd_usuario;
    Private Static $in_hier_form;
    Private Static $in_hier_form_lenght;
    

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
    
    Public Static Function setcd_formulario($cd_formulario){
        self::$cd_formulario = $cd_formulario;
    }

    Public Static Function setcd_usuario($cd_usuario){
        self::$cd_usuario = $cd_usuario;
    }
    Public Static Function setin_hier_form($in_hier_form){
        self::$in_hier_form = $in_hier_form;
    }
    Public Static Function setin_hier_form_lenght($in_hier_form_lenght){
        self::$in_hier_form_lenght = $in_hier_form_lenght;
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
    Public Static Function getcd_formulario(){
        return self::$cd_formulario;
    }
    Public Static Function getcd_usuario(){
        return self::$cd_usuario;
    }
    Public Static Function getin_hier_form(){
        return self::$in_hier_form;
    }
    Public Static Function getin_hier_form_lenght(){
        return self::$in_hier_form_lenght;
    }

    Public Static Function ListaPermissaoUsuarioEmpresaSistema(){

        $strsql = 'Select';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0001.nm_empresa,';
        $strsql.= ' t0005.cd_sistema,';
        $strsql.= ' t0003.sg_sistema,';
        $strsql.= ' t0003.nm_sistema,';
        $strsql.= ' t0006.cd_formulario,';
        $strsql.= ' t0004.nm_formulario,';
        $strsql.= ' t0004.ar_formulario,';
        $strsql.= ' t0004.in_hier_form';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0005 t0005';
        $strsql.= ' inner join cerof.sca_t0001 t0001 on t0001.cd_empresa = t0005.cd_empresa';
        $strsql.= ' inner join cerof.sca_t0003 t0003 on t0003.cd_sistema = t0005.cd_sistema';
        $strsql.= ' inner join cerof.sca_t0004 t0004 on t0004.cd_sistema = t0003.cd_sistema';
        $strsql.= ' inner join cerof.sca_t0006 t0006 on t0006.cd_sistema = t0004.cd_sistema and t0006.cd_formulario = t0004.cd_formulario';
        $strsql.= ' Where';
        $strsql.= ' t0005.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0001.st_empresa in '.Mecanismo::TrataStringEnum(self::$st_empresa);
        $strsql.= ' and';
        $strsql.= ' t0003.cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
        $strsql.= ' and';
        $strsql.= ' t0003.st_sistema in '.Mecanismo::TrataStringEnum(self::$st_sistema);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
        if(Mecanismo::TrataString(self::$in_hier_form_lenght) != 'null'){
            $strsql.= ' and';
            $strsql.= ' Length(t0004.in_hier_form) = '.Mecanismo::TrataString(self::$in_hier_form_lenght);
            if(self::$in_hier_form_lenght > 2){
                $strsql.= ' and';
                $strsql.= ' substr(t0004.in_hier_form,1,'.(self::$in_hier_form_lenght - 2).') = '.Mecanismo::TrataString(self::$in_hier_form);
            }
        }
        $strsql.= ' Group by';
        $strsql.= ' t0005.cd_empresa,';
        $strsql.= ' t0001.nm_empresa,';
        $strsql.= ' t0005.cd_sistema,';
        $strsql.= ' t0003.sg_sistema,';
        $strsql.= ' t0003.nm_sistema,';
        $strsql.= ' t0006.cd_formulario';
        $strsql.= ' Order by';
        $strsql.= ' t0003.in_hier_sist,';
        $strsql.= ' t0004.in_hier_form';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ListaPermissaoSistemaFormUsuario(){

        $strsql = 'Select';
        $strsql.= ' t0006.cd_sistema,';
        $strsql.= ' t0006.cd_formulario,';
        $strsql.= ' t0006.cd_usuario';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0006 t0006';
        $strsql.= ' Where';
        $strsql.= ' t0006.cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_formulario = '.Mecanismo::TrataString(self::$cd_formulario);
        $strsql.= ' and';
        $strsql.= ' t0006.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
  
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ExcluirPermissaoUsuarioForm(){
            
        $table ='cerof.sca_t0006';

        $where = ' cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
        $where.= ' and';
        $where.= ' cd_formulario = '.Mecanismo::TrataString(self::$cd_formulario);
        $where.= ' and';
        $where.= ' cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);

        if(Mecanismo::ExecutaMetodo('Delete', $table, '',$where)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function IncluirPermissaoUsuarioForm(){
            
        $table = 'cerof.sca_t0006';

        $dados["cd_sistema"] = self::$cd_sistema;
        $dados["cd_formulario"] = self::$cd_formulario;
        $dados["cd_usuario"] = self::$cd_usuario;
  
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
}
?>
