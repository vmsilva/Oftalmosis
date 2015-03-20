var SCA_J0002 = function SCA_J0002(){
    
    var oSCA_M0002 = new pacote_SCA.Sca.m0002();
    var oSMG_M0004 = new pacote_SMG.Smg.m0004();
    
    var self = this;
    
    self.formName = 'sca_h0002';
        
    $('#sca_h0002-nr_matr_usu').addClass('isValid[required|justlength(5)]').setMask({mask:'a9999'});
    $('#sca_h0002-nr_matr_usu').blur(function(){

        if($('#sca_h0002-nr_matr_usu').val().length == 5){
            self.consultaUsuarioCodigo();   
           
        }
    })
    $('#sca_h0002-nm_usuario').addClass('isValid[required|minlength(3)|maxlength(65)]');
    $('#sca_h0002-btn_lista_usuario').click(function(){
        self.ConsultaNomeUsuario();
    });
    
    $('#sca_h0002-dt_nasc_usu').addClass('isValid[required|justlength(10)|data]').mask("99/99/9999").datepicker({
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        showOn: "button",
        maxDate: data_hoje
    });
    
    $('#sca_h0002-nr_tel_usu').addClass('isValid[required|justlength(13)]').mask("(99)9999-9999");
    $('#sca_h0002-ds_email_usu').addClass('isValid[required|email]');
    $('#sca_h0002-dt_exp_snh_usu').addClass('isValid[required|data]').mask("99/99/9999");
    $('#sca_h0002-tp_perm_usu').addClass('isValid[required|enum(0,1,2)]');
    $('#sca_h0002-st_usuario').addClass('isValid[required|enum(0,1,2)]');
    $('#sca_h0002-nr_cpf').addClass('isValid[required|justlength(14)]').mask("999.999.999-99");
    $('#sca_h0002-btn_lista_cpf').click(function(){
        self.ConsultaCPFUsuario();
    });
    
    $('#sca_h0002-btn_limpar').click(function(){
        self.limpar();
    });
    
    self.limpar = function(){
        
        $('#sca_h0002-cd_usuario').val('');
        $('#sca_h0002-nr_matr_usu').val('').attr('disabled',false).focus();
        $('#sca_h0002-nm_usuario').attr('disabled',false).val('');
        $('#sca_h0002-dt_nasc_usu').attr('disabled',false).val('');
        $('#sca_h0002-nr_tel_usu').val('');
        $('#sca_h0002-ds_email_usu').val('');
        $('#sca_h0002-tp_perm_usu').val('');
        $('#sca_h0002-st_usuario').val('');
        $('#sca_h0002-nr_cpf').attr('disabled',false).val('');
        $.fn.validar.limparErros();
    }
    
    self.consultaUsuarioCodigo = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_matr_usu = $('#sca_h0002-nr_matr_usu').val();
        oSCA_M0002.st_usuario = '0|1|2';
        oSCA_M0002.consultaMatricula(function(retorno){
            if(retorno.cd_usuario>0){
                $('#sca_h0002-cd_usuario').val(retorno.cd_usuario);
                $('#sca_h0002-nr_matr_usu').val(retorno.nr_matr_usu).attr('disabled',true);
                $('#sca_h0002-nm_usuario').val(retorno.nm_usuario).attr('disabled',true);
                $('#sca_h0002-dt_nasc_usu').val(retorno.dt_nasc_usu).attr('disabled',true);
                $('#sca_h0002-nr_cpf').val(retorno.nr_cpf).attr('disabled',true);
                $('#sca_h0002-nr_tel_usu').val(retorno.nr_tel_usu);
                $('#sca_h0002-dt_exp_snh_usu').val(retorno.dt_exp_snh_usu);
                $('#sca_h0002-ds_email_usu').val(retorno.ds_email_usu);
                $('#sca_h0002-tp_perm_usu').val(retorno.tp_perm_usu);
                $('#sca_h0002-st_usuario').val(retorno.st_usuario);
            }
        });
    };
    
    self.ConsultaNomeUsuario = function(){ 
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $("#sca_h0002-nm_usuario").val();
        oSCA_M0002.st_usuario = '0|1|2';
        oSCA_M0002.ConsultaNomeUsuario();
        setTimeout(function(){
            $('#grid-busca-sca_c0002-ConsultaNomeUsuario .grid_corpo table tbody.grid_corpo tr').click(function(){
                self.consultaUsuarioCodigo();
            });
        },200);
    };
    
    self.ConsultaCPFUsuario = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_cpf = $('#sca_h0002-nr_cpf').val();
        oSCA_M0002.st_usuario = '0|1|2';
        oSCA_M0002.ConsultaCPFUsuario(function(retorno){
            console.log(retorno.ret);
            if(retorno.ret == 'true'){
                $('#sca_h0002-cd_usuario').val(retorno.dados.cd_usuario);
                $('#sca_h0002-nr_matr_usu').val(retorno.dados.nr_matr_usu).attr('disabled',true);
                $('#sca_h0002-nm_usuario').val(retorno.dados.nm_usuario).attr('disabled',true);
                $('#sca_h0002-dt_nasc_usu').val(retorno.dados.dt_nasc_usu).attr('disabled',true);
                $('#sca_h0002-nr_cpf').val(retorno.dados.nr_cpf).attr('disabled',true);
                $('#sca_h0002-nr_tel_usu').val(retorno.dados.nr_tel_usu);
                $('#sca_h0002-dt_exp_snh_usu').val(retorno.dados.dt_exp_snh_usu);
                $('#sca_h0002-ds_email_usu').val(retorno.dados.ds_email_usu);
                $('#sca_h0002-tp_perm_usu').val(retorno.dados.tp_perm_usu);
                $('#sca_h0002-st_usuario').val(retorno.dados.st_usuario);
            }else{
                var msg = 'CPF Usuário não encontrado!\n\n';
                msg+= 'Deseja buscar na Tabela de Profissional?';
                if(confirm(msg)){
                    self.consultaCPFProfissional();
                }
            }
        });
    };
    
    self.consultaCPFProfissional = function(){
  
        oSMG_M0004.form = self.formName;
        oSMG_M0004.nr_cpf_prof = $('#sca_h0002-nr_cpf').val();
        oSMG_M0004.st_prof = '0|1';
        oSMG_M0004.ConsultaProfissionalCPF(function(retorno){
            if(retorno.ret == 'true'){
                $('#sca_h0002-nm_usuario').val(retorno.dados.nm_prof).attr('disabled',true);
                $('#sca_h0002-dt_nasc_usu').val(retorno.dados.dt_nasc_prof).attr('disabled',false);
                $('#sca_h0002-nr_cpf').val(retorno.dados.nr_cpf_prof).attr('disabled',false);
                $('#sca_h0002-nr_tel_usu').val(retorno.dados.nr_fone_prof);
                $('#sca_h0002-ds_email_usu').val(retorno.dados.ds_email_prof);
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    
    $('#sca_h0002-btn_incluir').click(function(){
        var campo = '#sca_h0002-nm_usuario,#sca_h0002-dt_nasc_usu,#sca_h0002-nr_tel_usu,#sca_h0002-ds_email_usu,#sca_h0002-dt_exp_snh_usu,#sca_h0002-tp_perm_usu,#sca_h0002-st_usuario,#sca_h0002-nr_cpf';
        if($(campo).validar(true)){
            self.incluir();
        }
    });
    
    $('#sca_h0002-btn_alterar').click(function(){
        var campo = '#sca_h0002-nr_matr_usu,#sca_h0002-nm_usuario,#sca_h0002-dt_nasc_usu,#sca_h0002-nr_tel_usu,#sca_h0002-ds_email_usu,#sca_h0002-dt_exp_snh_usu,#sca_h0002-tp_perm_usu,#sca_h0002-st_usuario,#sca_h0002-nr_cpf';
        if($(campo).validar(true)){
            self.alterar();
        }
    });
    
    $('#sca_h0002-btn_excluir').click(function(){
        var campo = '#sca_h0002-nr_matr_usu,#sca_h0002-nm_usuario,#sca_h0002-dt_nasc_usu,#sca_h0002-nr_tel_usu,#sca_h0002-ds_email_usu,#sca_h0002-dt_exp_snh_usu,#sca_h0002-tp_perm_usu,#sca_h0002-st_usuario,#sca_h0002-nr_cpf';
        if($(campo).validar(true)){
            self.excluir();
        }
    });
    
    $('#sca_h0002-btn_gerar').click(function(){
        var campo = '#sca_h0002-nr_matr_usu,#sca_h0002-nm_usuario,#sca_h0002-dt_nasc_usu,#sca_h0002-nr_tel_usu,#sca_h0002-ds_email_usu,#sca_h0002-dt_exp_snh_usu,#sca_h0002-tp_perm_usu,#sca_h0002-st_usuario,#sca_h0002-nr_cpf';
        if($(campo).validar(true)){
            self.gerarSenha();
        }
    });
        
    self.incluir = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $('#sca_h0002-nm_usuario').val();
        oSCA_M0002.dt_nasc_usu = $('#sca_h0002-dt_nasc_usu').val();
        oSCA_M0002.nr_tel_usu = $('#sca_h0002-nr_tel_usu').val();
        oSCA_M0002.ds_email_usu = $('#sca_h0002-ds_email_usu').val();
        oSCA_M0002.dt_exp_snh_usu = $('#sca_h0002-dt_exp_snh_usu').val();
        oSCA_M0002.tp_perm_usu = $('#sca_h0002-tp_perm_usu').val();
        oSCA_M0002.nr_cpf = $('#sca_h0002-nr_cpf').val();
        oSCA_M0002.st_usuario = '';
        oSCA_M0002.Incluir(function(retorno){
            if(retorno.ret){
                $('#sca_h0002-nr_matr_usu').val(retorno.nr_matr_usu);
                self.consultaUsuarioCodigo();
                msg.alertSucesso(retorno.msg);
            }
        });
    }
    
    self.alterar = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.cd_usuario = $('#sca_h0002-cd_usuario').val();
        oSCA_M0002.nr_tel_usu = $('#sca_h0002-nr_tel_usu').val();
        oSCA_M0002.ds_email_usu = $('#sca_h0002-ds_email_usu').val();
        oSCA_M0002.tp_perm_usu = $('#sca_h0002-tp_perm_usu').val();
        oSCA_M0002.st_usuario = $('#sca_h0002-st_usuario').val();;
        oSCA_M0002.Alterar(function(retorno){
            if(retorno.ret){
                self.consultaUsuarioCodigo();
                msg.alertSucesso(retorno.msg);
            }
        });
    }
    
    self.gerarSenha = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.cd_usuario = $('#sca_h0002-cd_usuario').val();
        oSCA_M0002.nr_tel_usu = $('#sca_h0002-nr_tel_usu').val();
        oSCA_M0002.ds_email_usu = $('#sca_h0002-ds_email_usu').val();
        oSCA_M0002.tp_perm_usu = $('#sca_h0002-tp_perm_usu').val();
        oSCA_M0002.st_usuario = $('#sca_h0002-st_usuario').val();
        oSCA_M0002.GerarSenha(function(retorno){
            if(retorno.ret){
                self.consultaUsuarioCodigo();
                msg.alertSucesso(retorno.msg);
            }
        });
    }
    self.excluir = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.cd_usuario = $('#sca_h0002-cd_usuario').val();
        oSCA_M0002.Excluir(function(retorno){
            if(retorno.ret){
                self.limpar();
                msg.alertSucesso(retorno.msg);
            }
        });
    }
    self.limpar();
};

$(function(){
    new SCA_J0002(); 
});