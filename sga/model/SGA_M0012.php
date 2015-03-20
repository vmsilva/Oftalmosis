<?php

/**
 * Description of SGA_M0012
 *
 * @author victor
 */

class SGA_M0012 extends Mecanismo{
        
        Private Static $nr_dia_semana;
        Private Static $cd_empresa;
        Private Static $cd_usuario_cad;
        Private Static $dt_cad_grade;
        Private Static $cd_procd_medc;
        Private Static $in_local_atend;
        Private Static $hr_ini_atend;
        Private Static $hr_fin_atend;
        Private Static $nr_id_min;
        Private Static $nr_id_max;
        Private Static $nr_qtd_atend;
        Private Static $cd_grade;
        
        
        public static function getcd_empresa() {
            return self::$cd_empresa;
        }

        public static function getcd_usuario_cad() {
            return self::$cd_usuario_cad;
        }

        public static function getdt_cad_grade() {
            return self::$dt_cad_grade;
        }

        public static function getcd_procd_medc() {
            return self::$cd_procd_medc;
        }

        public static function getin_local_atend() {
            return self::$in_local_atend;
        }

        public static function gethr_ini_atend() {
            return self::$hr_ini_atend;
        }

        public static function gethr_fin_atend() {
            return self::$hr_fin_atend;
        }

        public static function getnr_id_min() {
            return self::$nr_id_min;
        }

        public static function getnr_id_max() {
            return self::$nr_id_max;
        }

        public static function getnr_qtd_atend() {
            return self::$nr_qtd_atend;
        }

        public static function setcd_empresa($cd_empresa) {
            self::$cd_empresa = $cd_empresa;
        }

        public static function setcd_usuario_cad($cd_usuario_cad) {
            self::$cd_usuario_cad = $cd_usuario_cad;
        }

        public static function setdt_cad_grade($dt_cad_grade) {
            self::$dt_cad_grade = $dt_cad_grade;
        }

        public static function setcd_procd_medc($cd_procd_medc) {
            self::$cd_procd_medc = $cd_procd_medc;
        }

        public static function setin_local_atend($in_local_atend) {
            self::$in_local_atend = $in_local_atend;
        }

        public static function sethr_ini_atend($hr_ini_atend) {
            self::$hr_ini_atend = $hr_ini_atend;
        }

        public static function sethr_fin_atend($hr_fin_atend) {
            self::$hr_fin_atend = $hr_fin_atend;
        }

        public static function setnr_id_min($nr_id_min) {
            self::$nr_id_min = $nr_id_min;
        }

        public static function setnr_id_max($nr_id_max) {
            self::$nr_id_max = $nr_id_max;
        }

        public static function setnr_qtd_atend($nr_qtd_atend) {
            self::$nr_qtd_atend = $nr_qtd_atend;
        }
        
        public static function getnr_dia_semana() {
            return self::$nr_dia_semana;
        }

        public static function setnr_dia_semana($nr_dia_semana) {
            self::$nr_dia_semana = $nr_dia_semana;
        }
        
        public static function getcd_grade() {
            return self::$cd_grade;
        }

        public static function setcd_grade($cd_grade) {
            self::$cd_grade = $cd_grade;
        }

                        
        Public Static function incluir(){
            
            $table = 'sga_t0012';
            
            $dados['cd_empresa'] = self::$cd_empresa;
            
            $where = 'cd_empresa = '.self::$cd_empresa;
            $cd_grade = Mecanismo::geraMaximoCodigo('cd_grade', $table, $where);

            $dados['cd_grade'] = $cd_grade;
            $dados['cd_procd_medc'] = self::$cd_procd_medc;
            $dados['nr_dia_semana'] = self::$nr_dia_semana;
            $dados['in_local_atend'] = strtoupper(self::$in_local_atend);
            $dados['hr_ini_atend'] = str_replace(':', '', self::$hr_ini_atend);
            $dados['hr_fin_atend'] = str_replace(':', '', self::$hr_fin_atend);
            $dados['nr_id_min'] = self::$nr_id_min;
            $dados['nr_id_max'] = self::$nr_id_max;
            $dados['nr_qtd_atend'] = self::$nr_qtd_atend;
            
            $dados['cd_usuario_cad'] = self::$cd_usuario_cad;
            $dados['dt_cad_grade'] = self::$dt_cad_grade;
//
//            print_r($dados);
//            exit();
            return Mecanismo::ExecutaMetodo('INSERT', $table, $dados);
            
        }
        
        Public Static function excluir(){
            
            $table = 'sga_t0012';
                   
            $where  = 'cd_empresa ='.self::$cd_empresa;
            $where .= ' AND cd_procd_medc ='.self::$cd_procd_medc;
            $where .= ' AND cd_grade ='.self::$cd_grade;

            if(Mecanismo::ExecutaMetodo('DELETE', $table, '', $where)){                
                return true;
            }else{
                return false;
            }
            
        }
        
        Public Static function listar(){
            
            $strsql  = "Select";
            $strsql .= " t0012.nr_dia_semana,";
            $strsql .= " t0012.hr_ini_atend,";
            $strsql .= " t0012.hr_fin_atend,";
            $strsql .= " t0012.nr_id_min,";
            $strsql .= " t0012.nr_id_max,";
            $strsql .= " t0012.in_local_atend,";
            $strsql .= " t0010.cd_procd_medc,";
            $strsql .= " t0010.nm_procd_medc,";
            $strsql .= " t0012.nr_qtd_atend,";
            $strsql .= " t0012.cd_grade";
            $strsql .= " From";
            $strsql .= " cerof.sga_t0012 t0012";
            $strsql .= " inner join cerof.smg_t0010 t0010 on (t0010.cd_procd_medc = t0012.cd_procd_medc)";
            $strsql .= " Where";
            $strsql .= " t0012.cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
            $strsql .= " and t0012.cd_procd_medc = ".Mecanismo::TrataString(self::$cd_procd_medc);
            
            
            if(trim(self::$cd_grade) != '' || trim(self::$cd_grade) != NULL){
                $strsql .= " and t0012.cd_grade = ".Mecanismo::TrataString(self::$cd_grade);
            }            
            if(trim(self::$nr_dia_semana) != '' || trim(self::$nr_dia_semana) != NULL){
                $strsql .= " and t0012.nr_dia_semana = ".Mecanismo::TrataString(self::$nr_dia_semana);            
            }
            if(trim(self::$hr_ini_atend) != '' || trim(self::$hr_ini_atend) != NULL){
                $strsql .= " and t0012.hr_ini_atend = ".Mecanismo::TrataString(self::$hr_ini_atend);            
            }            
            if(trim(self::$hr_fin_atend) != '' || trim(self::$hr_ini_atend) != NULL){
                $strsql .= " and t0012.hr_fin_atend = ".Mecanismo::TrataString(self::$hr_fin_atend);            
            }

        
           return Mecanismo::ConsultaMetodo($strsql);
 
        }
        Public Static function validarIntervaloHora(){
            
            $strsql  = "Select";
            $strsql .= " t0012.nr_dia_semana,";
            $strsql .= " t0012.hr_ini_atend,";
            $strsql .= " t0012.hr_fin_atend,";
            $strsql .= " t0012.nr_id_min,";
            $strsql .= " t0012.nr_id_max,";
            $strsql .= " t0012.in_local_atend,";
            $strsql .= " t0010.cd_procd_medc,";
            $strsql .= " t0010.nm_procd_medc,";
            $strsql .= " t0012.nr_qtd_atend,";
            $strsql .= " t0012.cd_grade";
            $strsql .= " From";
            $strsql .= " cerof.sga_t0012 t0012";
            $strsql .= " inner join cerof.smg_t0010 t0010 on (t0010.cd_procd_medc = t0012.cd_procd_medc)";
            $strsql .= " Where";
            $strsql .= " t0012.cd_empresa = ".Mecanismo::TrataString(self::$cd_empresa);
            $strsql .= " and t0012.cd_procd_medc = ".Mecanismo::TrataString(self::$cd_procd_medc);
            $strsql .= " and t0012.nr_dia_semana = ".Mecanismo::TrataString(self::$nr_dia_semana);            
            
            if(trim(self::$hr_ini_atend) != NULL && trim(self::$hr_fin_atend) != NULL){
                $strsql .= " and (t0012.hr_ini_atend between".Mecanismo::TrataString(self::$hr_ini_atend)." and ".Mecanismo::TrataString(self::$hr_fin_atend);
                $strsql .= " or t0012.hr_fin_atend between".Mecanismo::TrataString(self::$hr_ini_atend)." and ".Mecanismo::TrataString(self::$hr_fin_atend).')';

            }else{
                if(trim(self::$hr_ini_atend) != '' || trim(self::$hr_ini_atend) != NULL){
                    $strsql .= " and ".Mecanismo::TrataString(self::$hr_ini_atend)." between t0012.hr_ini_atend and t0012.hr_fin_atend";
                }

                if(trim(self::$hr_fin_atend) != '' || trim(self::$hr_fin_atend) != NULL){
                    $strsql .= " and ".Mecanismo::TrataString(self::$hr_fin_atend)." between t0012.hr_ini_atend and t0012.hr_fin_atend";
                }
            }

           return Mecanismo::ConsultaMetodo($strsql);
 
        }
       
}

?>
