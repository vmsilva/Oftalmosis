<?php
class SCA_M0002 extends Mecanismo {
    
    Private Static $cd_empresa;
    Private Static $cd_usuario;
    Private Static $nr_matr_usu;
    Private Static $dg_matr_usu;
    Private Static $nm_usuario;
    Private Static $ds_snh_usu;
    Private Static $dt_nasc_usu;
    Private Static $nr_tel_usu;
    Private Static $ds_email_usu;
    Private Static $tp_perm_usu;
    Private Static $st_usuario;
    Private Static $id_sessao;
    Private Static $nr_cpf;
    Private Static $dt_exp_snh_usu;

    /* Metodo Set */
    Public Static function setcd_empresa($cd_empresa){
        self::$cd_empresa = $cd_empresa;
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
    Public Static Function setnm_usuario($nm_usuario){
        self::$nm_usuario = $nm_usuario;
    }    
    Public Static Function setst_usuario($st_usuario){
        self::$st_usuario = $st_usuario;
    }
    Public Static Function setid_sessao($id_sessao){
        self::$id_sessao = $id_sessao;
    }
    Public Static Function setnr_cpf($nr_cpf){
        self::$nr_cpf = $nr_cpf;
    }
    Public Static Function setdt_exp_snh_usu($dt_exp_snh_usu){
        self::$dt_exp_snh_usu = $dt_exp_snh_usu;
    }
    Public Static Function setds_snh_usu($ds_snh_usu){
        self::$ds_snh_usu = $ds_snh_usu;
    }
    Public Static Function setdt_nasc_usu($dt_nasc_usu){
        self::$dt_nasc_usu = $dt_nasc_usu;
    }
    Public Static Function setnr_tel_usu($nr_tel_usu){
        self::$nr_tel_usu = $nr_tel_usu;
    }
    Public Static Function setds_email_usu($ds_email_usu){
        self::$ds_email_usu = $ds_email_usu;
    }
    Public Static Function settp_perm_usu($tp_perm_usu){
        self::$tp_perm_usu = $tp_perm_usu;   
    }

    /* Metodo Get */
    Public Static Function getcd_empresa(){
        return self::$cd_empresa;
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
    Public Static Function getnm_usuario(){
        return self::$nm_usuario;
    }
    Public Static Function getst_usuario(){
        return self::$st_usuario;
    }
    Public Static Function getid_sessao(){
        return self::$id_sessao;
    }
    Public Static Function getnr_cpf(){
        return self::$nr_cpf;
    }
    Public Static Function getdt_exp_snh_usu(){
        return self::$dt_exp_snh_usu;
    }
    Public Static Function getds_snh_usu(){
	return self::$ds_snh_usu;
    }
    Public Static Function getdt_nasc_usu(){
            return self::$dt_nasc_usu;
    }
    Public Static Function getnr_tel_usu(){
            return self::$nr_tel_usu;
    }
    Public Static Function getds_email_usu(){
            return self::$ds_email_usu;
    }
    Public Static Function gettp_perm_usu(){
            return self::$tp_perm_usu;
    }

    Public Static Function consultaUsuarioCodigo(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_usuario,';
        $strsql.= ' t0002.nr_matr_usu,';
        $strsql.= ' t0002.dg_matr_usu,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' t0002.ds_snh_usu,';
        $strsql.= ' t0002.dt_nasc_usu,';
        $strsql.= ' t0002.nr_tel_usu,';
        $strsql.= ' t0002.ds_email_usu,';
        $strsql.= ' t0002.dt_exp_snh_usu,';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.tp_perm_usu,';
        $strsql.= ' t0002.st_usuario,';
        $strsql.= ' t0002.id_sessao';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaUsuarioCPF(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_usuario,';
        $strsql.= ' t0002.nr_matr_usu,';
        $strsql.= ' t0002.dg_matr_usu,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' t0002.ds_snh_usu,';
        $strsql.= ' t0002.dt_nasc_usu,';
        $strsql.= ' t0002.nr_tel_usu,';
        $strsql.= ' t0002.ds_email_usu,';
        $strsql.= ' t0002.dt_exp_snh_usu,';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.tp_perm_usu,';
        $strsql.= ' t0002.st_usuario,';
        $strsql.= ' t0002.nr_cpf,';
        $strsql.= ' t0002.id_sessao';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.nr_cpf = '.Mecanismo::TrataString(self::$nr_cpf);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaUsuarioMatricula(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_usuario,';
        $strsql.= ' t0002.nr_matr_usu,';
        $strsql.= ' t0002.dg_matr_usu,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' t0002.ds_snh_usu,';
        $strsql.= ' t0002.dt_nasc_usu,';
        $strsql.= ' t0002.nr_tel_usu,';
        $strsql.= ' t0002.ds_email_usu,';
        $strsql.= ' t0002.dt_exp_snh_usu,';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.tp_perm_usu,';
        $strsql.= ' t0002.st_usuario,';
        $strsql.= ' t0002.nr_cpf,';
        $strsql.= ' t0002.id_sessao';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        $strsql.= ' and';
        $strsql.= ' t0002.nr_matr_usu = '.Mecanismo::TrataString(self::$nr_matr_usu);
        $strsql.= ' and';
        $strsql.= ' t0002.dg_matr_usu = '.Mecanismo::TrataString(self::$dg_matr_usu);
        $strsql.= ' and';
        $strsql.= ' t0002.st_usuario in '.Mecanismo::TrataStringEnum(self::$st_usuario);
        
        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function consultaUsuarioNome($tipo){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_usuario,';
        $strsql.= ' concat(t0002.nr_matr_usu,t0002.dg_matr_usu) as nr_matr_usu,';
        $strsql.= ' t0002.dg_matr_usu,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' t0002.dt_nasc_usu,';
        $strsql.= ' t0002.nr_tel_usu,';
        $strsql.= ' t0002.ds_email_usu,';
        $strsql.= ' t0002.dt_exp_snh_usu,';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.tp_perm_usu,';
        $strsql.= ' t0002.st_usuario,';
        $strsql.= ' t0002.nr_cpf,';
        $strsql.= ' t0002.id_sessao';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_empresa = '.Mecanismo::TrataString(self::$cd_empresa);
        if($tipo == 'like'){
            $strsql.= ' and';
            $strsql.= ' t0002.nm_usuario like "%'.self::$nm_usuario.'%"';
        }else{
            if($tipo == 'texto'){
                $strsql.= ' and';
                $strsql.= ' t0002.nm_usuario = '.Mecanismo::TrataString(self::$nm_usuario);
            }
        }
        
        $strsql.= ' and';
        $strsql.= ' t0002.st_usuario in '.Mecanismo::TrataStringEnum(self::$st_usuario);

        return Mecanismo::ConsultaMetodo($strsql);
    }

    Public Static Function validaSessaoUsuario(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_usuario,';
        $strsql.= ' t0002.nr_matr_usu,';
        $strsql.= ' t0002.dg_matr_usu,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' t0002.ds_snh_usu,';
        $strsql.= ' t0002.dt_nasc_usu,';
        $strsql.= ' t0002.nr_tel_usu,';
        $strsql.= ' t0002.ds_email_usu,';
        $strsql.= ' t0002.dt_exp_snh_usu,';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.tp_perm_usu,';
        $strsql.= ' t0002.st_usuario,';
        $strsql.= ' t0002.nr_cpf,';
        $strsql.= ' t0002.id_sessao';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
        $strsql.= ' and';
        $strsql.= ' t0002.id_sessao = '.Mecanismo::TrataString(self::$id_sessao);

        return Mecanismo::ConsultaMetodo($strsql);

    }
    Public Static Function validaSenhaUsuario(){

        $strsql = 'Select';
        $strsql.= ' t0002.cd_usuario,';
        $strsql.= ' t0002.nr_matr_usu,';
        $strsql.= ' t0002.dg_matr_usu,';
        $strsql.= ' t0002.nm_usuario,';
        $strsql.= ' t0002.ds_snh_usu,';
        $strsql.= ' t0002.dt_nasc_usu,';
        $strsql.= ' t0002.nr_tel_usu,';
        $strsql.= ' t0002.ds_email_usu,';
        $strsql.= ' t0002.dt_exp_snh_usu,';
        $strsql.= ' t0002.cd_empresa,';
        $strsql.= ' t0002.tp_perm_usu,';
        $strsql.= ' t0002.st_usuario,';
        $strsql.= ' t0002.nr_cpf,';
        $strsql.= ' t0002.id_sessao';
        $strsql.= ' From';
        $strsql.= ' cerof.sca_t0002 t0002';
        $strsql.= ' Where';
        $strsql.= ' t0002.cd_usuario = '.Mecanismo::TrataString(self::$cd_usuario);
        $strsql.= ' and';
        $strsql.= ' t0002.ds_snh_usu = '.Mecanismo::TrataString(self::$id_sessao);

        return Mecanismo::ConsultaMetodo($strsql);
    }
    
    Public Static Function alterarSenha(){

        $table = 'cerof.sca_t0002';
        $dados["ds_snh_usu"] = self::$id_sessao;
        $dados["dt_exp_snh_usu"] = self::$dt_exp_snh_usu;
        $dados["st_usuario"] = self::$st_usuario;

        $where ="cd_usuario = ".self::$cd_usuario;

        return Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where);
    }
    
    
    Public Static Function Excluir(){

        $table = 'cerof.sca_t0002';
        $where ="cd_usuario = ".self::$cd_usuario;

        return Mecanismo::ExecutaMetodo('Delete', $table, '',$where);
    }
    
    Public Static Function incluir(){
        
        $table = 'cerof.sca_t0002';
        
        $cd_usuario = Mecanismo::geraMaximoCodigo('cd_usuario', $table);
        $matricula = substr('E00',0,4-strlen($cd_usuario)).$cd_usuario;
        $digito = Mecanismo::CalculaDigitoMod11($cd_usuario,1,1);
        $ds_senha = md5($matricula.$digito);
        
        $dados['cd_usuario'] = $cd_usuario;
        $dados['nr_matr_usu'] = $matricula;
        $dados['dg_matr_usu'] = $digito;
        $dados['nm_usuario'] = self::$nm_usuario;
        $dados['ds_snh_usu'] = $ds_senha;
        $dados['dt_nasc_usu'] = self::$dt_nasc_usu;
        $dados['nr_tel_usu'] = self::$nr_tel_usu;
        $dados['ds_email_usu'] = self::$ds_email_usu;
        $dados['dt_exp_snh_usu'] = self::$dt_exp_snh_usu;
        $dados['cd_empresa'] = self::$cd_empresa;
        $dados['tp_perm_usu'] = self::$tp_perm_usu;
        $dados['st_usuario'] = self::$st_usuario;
        $dados['nr_cpf'] = self::$nr_cpf;
        
        if(Mecanismo::ExecutaMetodo('INSERT', $table, $dados)){
            return $matricula.$digito;
        }  else {
            return FALSE;
        }
    }
    
    Public Static Function alterar(){
        
        $table = 'cerof.sca_t0002';
        
        $dados['nr_tel_usu'] = self::$nr_tel_usu;
        $dados['ds_email_usu'] = self::$ds_email_usu;
        $dados['tp_perm_usu'] = self::$tp_perm_usu;
        $dados['st_usuario'] = self::$st_usuario;
        
        $where ="cd_usuario = ".self::$cd_usuario;
   
        if(Mecanismo::ExecutaMetodo('UPDATE', $table, $dados, $where)){
            return True;
        }  else {
            return FALSE;
        }
    }
}
?>
