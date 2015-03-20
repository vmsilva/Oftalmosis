<?php
class SGA_M0002 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private static $cd_grp_consulta;
    Private static $cd_procd_medc;
    Private static $vl_sa_cont;
    Private static $nr_qtde_procd_medc;
    private static $nm_procd_medc;
   
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
    }
    
    Public Static Function setcd_grp_consulta($cd_grp_consulta){
        self::$cd_grp_consulta = $cd_grp_consulta;
    }
    
    Public Static Function setcd_procd_medc($cd_procd_medc){
        self::$cd_procd_medc = $cd_procd_medc;
    }
    
    Public Static Function setvl_sa_cont($vl_sa_cont){
        self::$vl_sa_cont = $vl_sa_cont;
    }
    
    Public Static Function setnr_qtde_procd_medc($nr_qtde_procd_medc){
        self::$nr_qtde_procd_medc = $nr_qtde_procd_medc;
    }
    public static function getnm_procd_medc() {
        return self::$nm_procd_medc;
    }

    public static function setnm_procd_medc($nm_procd_medc) {
        self::$nm_procd_medc = $nm_procd_medc;
    }
    
    Public Static Function ConsultaCodigoVinculo(){
        
        $strsql = "Select";
        $strsql.= " t0002.cd_grp_consulta,";
        $strsql.= " t0002.cd_empresa";
        $strsql.= " From";
        $strsql.= " cerof.sga_t0002 t0002";
        $strsql.= " Where";
        $strsql.= " t0002.cd_empresa =".self::$cd_empresa;
        $strsql.= " AND t0002.cd_grp_consulta = ".self::$cd_grp_consulta;        
        
    
        return Mecanismo::ConsultaMetodo($strsql);
    }   
    
    
    Public Static Function ListaProcedimento(){        
       
        $strsql  = "Select";
        $strsql .= " t0010.cd_procd_medc,";
        $strsql .= " t0010.nm_procd_medc,";
        $strsql .= " t0002.vl_sa_cont,";
        $strsql .= " t0002.nr_qtde_procd_medc";
        $strsql .= " From";
        $strsql .= " cerof.smg_t0010 t0010";
        $strsql .= " inner join cerof.sga_t0002 t0002 on(t0010.cd_procd_medc = t0002.cd_procd_medc)";
        $strsql .= " inner join cerof.sga_t0001 t0001 on(t0001.cd_grp_consulta = t0002.cd_grp_consulta)";
        $strsql .= " Where";
        $strsql .= " t0001.cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa); 
        $strsql .= " and t0001.cd_grp_consulta = ".Mecanismo::TrataString(self::$cd_grp_consulta); 
        
        //(is_numeric(self::$cd_grp_consulta))? $strsql.= " and t0001.cd_grp_consulta = ".Mecanismo::TrataString(self::$cd_grp_consulta) : '';
        //(is_numeric(self::$cd_procd_medc))? $strsql.= " and t0002.cd_procd_medc = ".Mecanismo::TrataString(self::$cd_procd_medc) : '';
        
        return('bb');
        if(self::$cd_procd_medc != NULL){
            $strsql .= " and t0010.cd_procd_medc = ".Mecanismo::TrataString(self::$cd_procd_medc);
        }
                        
        return Mecanismo::ConsultaMetodo($strsql);
        
    }
    
    Public Static Function Incluir(){
        
        $table = 'sga_t0002';       
        
        $dados['cd_empresa'] = self::$cd_empresa;
        $dados['cd_grp_consulta'] = self::$cd_grp_consulta;
        $dados['cd_procd_medc'] = self::$cd_procd_medc;
        $dados['vl_sa_cont'] = self::$vl_sa_cont;
        $dados['nr_qtde_procd_medc'] = self::$nr_qtde_procd_medc;
        
        return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
        
    }
    
    Public Static Function Excluir(){
        
        $table = 'sga_t0002';
        
        $where  = 'cd_grp_consulta ='.self::$cd_grp_consulta;
        $where .= ' AND cd_empresa ='.self::$cd_empresa;
        $where .= ' AND cd_procd_medc ='.self::$cd_procd_medc;
        
        if(Mecanismo::ExecutaMetodo('DELETE', $table, '', $where)){
            return true;
        }else{
            return false;
        }
    }
	
	public Static Function ConsultaGrupoConsulta(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.cd_grp_consulta,';
        $strsql.= ' t0002.cd_procd_medc,';
        $strsql.= ' t0002.nr_qtde_procd_medc';
        $strsql.= ' From';
        $strsql.= ' cerof.sga_t0002 t0002';
        $strsql.= ' where';
        $strsql.= ' t0002.cd_empresa = '.self::TrataString(self::$cd_empresa);
        
        //Buscar Codigo Grupo Consulta
        (is_numeric(trim(self::$cd_grp_consulta)) && !is_null(self::$cd_grp_consulta)) ? $strsql.= ' and t0002.cd_grp_consulta = '.self::TrataString(self::$cd_grp_consulta) : '';
        
        //Buscar Codigo Procedimento
        (is_numeric(trim(self::$cd_procd_medc)) && !is_null(self::$cd_procd_medc)) ? $strsql.= ' and t0002.cd_procd_medc = '.self::TrataString(self::$cd_procd_medc) : '';

        return Mecanismo::ConsultaMetodo($strsql);
    }
   
}
?>
