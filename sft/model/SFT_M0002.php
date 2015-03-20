<?php

class SFT_M0002 extends Mecanismo{
    
    Private Static $cd_empresa;
    Private Static $cd_fatur_bpa;
    Private Static $cd_fatur_procd;
    Private Static $cd_procd_medc;
    
    
    /* Metodo Set */
    Public Static Function setcd_empresa($cd_empresa) {
        self::$cd_empresa = $cd_empresa;
    }
    Public Static Function setcd_fatur_bpa($cd_fatur_bpa) {
        self::$cd_fatur_bpa = $cd_fatur_bpa;
    }
    Public Static Function setcd_fatur_procd($cd_fatur_procd) {
        self::$cd_fatur_procd = $cd_fatur_procd;
    }
    Public Static Function setcd_procd_medc($cd_procd_medc) {
        self::$cd_procd_medc = $cd_procd_medc;
    }
    
    Public Static Function Incluir(){
        
        $table = 'cerof.sft_t0002';
        
        $codigo = 'cd_fatur_procd';
        $where = ' cd_empresa = '.self::TrataString(self::$cd_empresa);
        $where.= ' and cd_fatur_bpa = '.self::TrataString(self::$cd_fatur_bpa);
                
        $dados["cd_empresa"] = self::$cd_empresa;
        $dados["cd_fatur_bpa"] = self::$cd_fatur_bpa; 
        $cd_fatur_procd = Mecanismo::geraMaximoCodigo($codigo, $table, $where);
        $dados["cd_fatur_procd"] = $cd_fatur_procd;        
        $dados["cd_procd_medc"] = self::$cd_procd_medc;   

        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return True;
        }  else {
            return FALSE;
        }
        
    }
     
}
