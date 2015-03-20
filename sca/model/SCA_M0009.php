<?php
/**
 * Tabela: t0009
 * Descrição: Formulario x Botoes X Usuario
 * Data Criação: 27/11/2013
 * @author: Ronaldo Cesar dos Anjos
 * ----------- Alteração ------------
 * @author:
 * Data Alteração:
 * O que foi Alterado:
 *
 */
class SCA_M0009 extends Mecanismo {
    
        Private Static  $cd_empresa;
        Private Static  $cd_sistema;
        Private Static  $cd_formulario;
        Private Static  $ar_formulario;
        Private Static  $cd_botao;
        Private Static  $st_botao;
        Private Static  $cd_usuario;
        Private Static  $nr_matr_usu;
        Private Static  $dg_matr_usu;
	
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
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
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
    }
    Public Static Function getcd_sistema(){
        return self::$cd_sistema;
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
	
    Public Static Function ListaPermissaoBotao(){
		
            $strsql = 'Select';
            $strsql.= ' t0009.cd_sistema,';
            $strsql.= ' t0009.cd_formulario,';
            $strsql.= ' t0009.cd_botao,';
            $strsql.= ' t0009.cd_usuario,';
            $strsql.= ' t0008.in_hier_botao,';
            $strsql.= ' t0007.nm_botao,';
            $strsql.= ' t0007.in_id_botao,';
            $strsql.= ' t0007.in_metodo,';
            $strsql.= ' t0007.st_botao';
            $strsql.= ' From ';
            $strsql.= ' cerof.sca_t0009 t0009';
            $strsql.= ' inner join cerof.sca_t0008 t0008 on t0008.cd_sistema = t0009.cd_sistema and t0008.cd_formulario = t0009.cd_formulario and t0008.cd_botao = t0009.cd_botao';
            $strsql.= ' inner join cerof.sca_t0004 t0004 on t0004.cd_sistema = t0008.cd_sistema and t0004.cd_formulario = t0008.cd_formulario';
            $strsql.= ' inner join cerof.sca_t0007 t0007 on t0007.cd_botao = t0008.cd_botao';
            $strsql.= ' inner join cerof.sca_t0006 t0006 on t0006.cd_sistema = t0009.cd_sistema and t0006.cd_formulario = t0009.cd_formulario and t0006.cd_usuario = t0009.cd_usuario';
            $strsql.= ' Where';
            $strsql.= ' t0007.st_botao in ('.Mecanismo::TrataString(self::$st_botao).')';
            $strsql.= ' and';
            $strsql.= ' t0004.ar_formulario = '.Mecanismo::TrataStringMinusculo(self::$ar_formulario);
            $strsql.= ' and';
            $strsql.= ' t0006.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
            $strsql.= ' Order by';
            $strsql.= ' t0008.in_hier_botao';

            return Mecanismo::ConsultaMetodo($strsql);
	}
        
        Public Static Function ListaPermissaoUsuarioBotao(){
		
            $strsql = 'Select';
            $strsql.= ' t0009.cd_sistema,';
            $strsql.= ' t0009.cd_formulario,';
            $strsql.= ' t0009.cd_botao,';
            $strsql.= ' t0009.cd_usuario';
            $strsql.= ' From ';
            $strsql.= ' cerof.sca_t0009 t0009';
            $strsql.= ' Where';
            $strsql.= ' t0009.cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
            $strsql.= ' and';
            $strsql.= ' t0009.cd_formulario = '.Mecanismo::TrataString(self::$cd_formulario);
            $strsql.= ' and';
            $strsql.= ' t0009.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);

            return Mecanismo::ConsultaMetodo($strsql);
	}
        
        Public Static Function ExcluirPermissaoUsuarioBotao(){
            
            $table ='cerof.sca_t0009';
            
            $where = ' cd_sistema = '.Mecanismo::TrataString(self::$cd_sistema);
            $where.= ' and';
            $where.= ' cd_formulario = '.Mecanismo::TrataString(self::$cd_formulario);
            $where.= ' and';
            $where.= ' cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
            if(trim(self::$cd_botao) != ''){
                $where.= ' and';
                $where.= ' cd_botao = '.Mecanismo::TrataString(self::$cd_botao);
            }

            if(Mecanismo::ExecutaMetodo('Delete', $table, '',$where)){
                return TRUE;
            }  else {
                return FALSE;
            }
	}
        
        Public Static Function IncluirPermissaoUsuarioBotao(){
            
        $table = 'cerof.sca_t0009';

        $dados["cd_sistema"] = self::$cd_sistema;
        $dados["cd_formulario"] = self::$cd_formulario;
        $dados["cd_usuario"] = self::$cd_usuario;
        $dados["cd_botao"] = self::$cd_botao;

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
}
?>