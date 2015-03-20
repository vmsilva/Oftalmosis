<?php
class SGA_M0001 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private static $cd_grp_consulta;
    Private static $nm_grp_consulta;
    Private static $st_grp_consulta;
    Private static $cd_usu_cad_grp_consulta;
    Private static $dt_usu_cad_grp_consulta;
    Private static $cd_usu_alt_grp_consulta;
    Private static $dt_usu_alt_grp_consulta;
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    
    Public Static Function setcd_grp_consulta($cd_grp_consulta){
        self::$cd_grp_consulta = $cd_grp_consulta;
    }
    
    Public Static Function setnm_grp_consulta($nm_grp_consulta){
        self::$nm_grp_consulta = $nm_grp_consulta;
    }
    
    Public Static Function setst_grp_consulta($st_grp_consulta){
        self::$st_grp_consulta = $st_grp_consulta;
    }
    
    Public Static Function setcd_usu_cad_grp_consulta($cd_usu_cad_grp_consulta){
        self::$cd_usu_cad_grp_consulta = $cd_usu_cad_grp_consulta;
    }
    
    Public Static Function setdt_usu_cad_grp_consulta($dt_usu_cad_grp_consulta){
        self::$dt_usu_cad_grp_consulta = $dt_usu_cad_grp_consulta;
    }
    
    Public Static Function setcd_usu_alt_grp_consulta($cd_usu_alt_grp_consulta){
        self::$cd_usu_alt_grp_consulta = $cd_usu_alt_grp_consulta;
    }
    
    Public Static Function setdt_usu_alt_grp_consulta($dt_usu_alt_grp_consulta){
        self::$dt_usu_alt_grp_consulta = $dt_usu_alt_grp_consulta;
    }
    
    Public Static Function ConsultaNome(){

        $strsql = "Select";
        $strsql.= " t0001.cd_empresa,";
        $strsql.= " t0001.cd_grp_consulta,";
        $strsql.= " t0001.nm_grp_consulta,";
        $strsql.= " t0001.st_grp_consulta";
        $strsql.= " From";
        $strsql.= " cerof.sga_t0001 t0001";
        $strsql.= " Where";
        $strsql.= " t0001.cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= " and t0001.st_grp_consulta  in ".Mecanismo::TrataStringEnum(self::$st_grp_consulta);

        if(!is_null(self::$nm_grp_consulta)){
            $strsql.= " and";
            $strsql.= " t0001.nm_grp_consulta like '%".self::$nm_grp_consulta."%'";
        }
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function ConsultaCodigoGrupo(){
        
        $strsql  = "Select";
        $strsql .= " t0001.cd_empresa,";
        $strsql .= " t0001.cd_grp_consulta,";
        $strsql .= " t0001.nm_grp_consulta,";
        $strsql .= " t0001.st_grp_consulta";
        $strsql .= " From";
        $strsql .= " cerof.sga_t0001 t0001";
        $strsql .= " where";
        $strsql .= " t0001.cd_empresa =".Mecanismo::TrataString(self::$cd_empresa);
        $strsql .= " and";
        $strsql .= " t0001.cd_grp_consulta =".Mecanismo::TrataString(self::$cd_grp_consulta);
        
        if(self::$st_grp_consulta !== NULL){
            $strsql .= " and";
            $strsql .= " t0001.st_grp_consulta in ".Mecanismo::TrataStringEnum(self::$st_grp_consulta);
        }
     
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static function Incluir(){
        
        
        $table = 'sga_t0001';
        $where = 'cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        
        $cd_grp_consulta = Mecanismo::geraMaximoCodigo('cd_grp_consulta', $table, $where);
        
        $dados['cd_empresa'] = self::$cd_empresa;
        $dados['cd_grp_consulta'] = $cd_grp_consulta;
        $dados['nm_grp_consulta'] = strtoupper(self::$nm_grp_consulta);
        $dados['st_grp_consulta'] = self::$st_grp_consulta;
        $dados['cd_usu_cad_grp_consulta'] = self::$cd_usu_cad_grp_consulta;
        $dados['dt_usu_cad_grp_consulta'] = self::$dt_usu_cad_grp_consulta;
        
        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
        
    }
    
    
    Public Static function alterar(){
        
        $table = 'sga_t0001';
    
        $dados['st_grp_consulta'] = self::$st_grp_consulta;
        
        $where = ' cd_empresa = '.self::$cd_empresa;
        $where.= ' and cd_grp_consulta = '.self::$cd_grp_consulta;
  
        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return true;
        }else{
            return FALSE;
        }       
    }
    
    public Static function excluir(){        
        
        $oper = 'DELETE';
        $table = 'sga_t0001';

        $where  = 'cd_grp_consulta ='.self::$cd_grp_consulta;
        $where .= ' AND cd_empresa ='.Mecanismo::TrataString(self::$cd_empresa);

         $rs = Mecanismo::ExecutaMetodo($oper, $table, '', $where);

        

        if($rs){
            return true;
        }else{
            return false;
        }
    }
	
	Public Static Function ConsultaGrupoConsulta(){

        $strsql = 'Select';
        $strsql.= ' t0001.cd_empresa,';
        $strsql.= ' t0001.cd_grp_consulta,';
        $strsql.= ' t0001.nm_grp_consulta,';
        $strsql.= ' t0001.st_grp_consulta,';
        $strsql.= ' t0001.cd_usu_cad_grp_consulta,';
        $strsql.= ' t0001.dt_usu_cad_grp_consulta,';
        $strsql.= ' t0001.cd_usu_alt_grp_consulta,';
        $strsql.= ' t0001.dt_usu_alt_grp_consulta';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0001 t0001';
        $strsql.= ' where';
        $strsql.= ' t0001.cd_empresa = '.self::TrataString(self::$cd_empresa);
        $strsql.= ' and t0001.st_grp_consulta in '.self::TrataStringEnum(self::$st_grp_consulta);
        
        //Buscar Codigo Procedimento
        (is_numeric(self::$cd_grp_consulta) && !is_null(self::$cd_grp_consulta)) ? $strsql.= ' and t0001.cd_grp_consulta = '.self::TrataString(self::$cd_grp_consulta) : '';
        //Buscar Nome Procedimento
        (!empty(self::$nm_grp_consulta) && !is_null(self::$nm_grp_consulta)) ? $strsql.= ' and t0001.nm_grp_consulta like "%'.self::$nm_grp_consulta.'%"' : '';
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
}
?>
