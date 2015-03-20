var SMG_J0004 = function SMG_J0004(){
    
    var oSMG_M0004 = new pacote_SMG.Smg.m0004();
    var oSGM_M0001 = new pacote_SGM.Sgm.m0001();
    var oSGM_M0003 = new pacote_SGM.Sgm.m0003();
    var oSMG_M0003 = new pacote_SMG.Smg.m0003();
    var oSMG_M0005 = new pacote_SMG.Smg.m0005();
    
    var self = this;
    self.formName = 'smg_h0004';
    
    self.init = function(){
        
        self.adicionarClass();
        self.limpar();
        
        $('#smg_h0004-tabs').tabs();
        
        $('#smg_h0004-id-vinculo').click(function(){
            if($('#smg_h0004-cd_prof').val() == ''){
                $('#smg_h0004-tabs').tabs({ active: 0 });
                alert('Você deve informar o Profissional!');
            }else{
                self.listaConselho();
                self.listaConselhoProfissional();
                //console.log('listaEspecialidade');
            }
        });
        
        $('#smg_h0004-btn_cpf_prof').click(function(){
            if($('#smg_h0004-nr_cpf_prof').validar(true)){
                self.consultaCPF();
            }
        });
        
        $('#smg_h0004-btn_nm_prof').click(function(){
            self.consultaNomeProfissional();
        });
        
        $("#smg_h0004-cd_pais_orig_prof").blur(function(){
            if($('#smg_h0004-cd_pais_orig_prof').val() != ''){
                self.ConsultaCodigoPais();
            }
        });
        
        $('#smg_h0004-btn_pais_orig_prof').click(function(){
            self.ConsultaNomePais();
        });
        
        
        //Busca Município de Nascimento Profissional
        $("#smg_h0004-cd_munic_nasc_prof").blur(function(){
            if($('#smg_h0004-cd_munic_nasc_prof').val() != ''){
                var campo = '#smg_h0004-cd_munic_nasc_prof';
                if($(campo).validar(true)){
                    oSGM_M0003.form = self.formName;
                    oSGM_M0003.cd_munic = $("#smg_h0004-cd_munic_nasc_prof").val();
                    nm_campo = 'cd_munic_nasc_prof,sg_uf_nasc_prof,nm_munic_nasc_prof';
                    oSGM_M0003.consultaCodigoMunicipio(nm_campo);
                }else{
                    $("#smg_h0004-cd_munic_nasc_prof").val('');
                }
            }
        });

        $('#smg_h0004-btn_munic_nasc_prof').click(function(){
            var campo = '#smg_h0004-sg_uf_nasc_prof';
            if($(campo).validar(true)){
                oSGM_M0003.form = self.formName;
                oSGM_M0003.sg_uf = $("#smg_h0004-sg_uf_nasc_prof").val();
                nm_campo_busca = 'cd_munic_nasc_prof,sg_uf_nasc_prof,nm_munic_nasc_prof';
                oSGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0004-nm_munic_nasc_prof").val('');
            }
        });
        
        //Busca Município de Endereço Profissional
        $("#smg_h0004-cd_munic_end_prof").blur(function(){
            if($('#smg_h0004-cd_munic_end_prof').val() != ''){
                var campo = '#smg_h0004-cd_munic_end_prof';
                if($(campo).validar(true)){
                    oSGM_M0003.form = self.formName;
                    oSGM_M0003.cd_munic = $("#smg_h0004-cd_munic_end_prof").val();
                    nm_campo = 'cd_munic_end_prof,sg_uf_end_prof,nm_munic_end_prof';
                    oSGM_M0003.consultaCodigoMunicipio(nm_campo);
                }else{
                    $("#smg_h0004-cd_munic_end_prof").val('');
                }
            }
        });

        $('#smg_h0004-btn_munic_end_prof').click(function(){
            var campo = '#smg_h0004-sg_uf_end_prof';
            if($(campo).validar(true)){
                oSGM_M0003.form = self.formName;
                oSGM_M0003.sg_uf = $("#smg_h0004-sg_uf_end_prof").val();
                nm_campo_busca = 'cd_munic_end_prof,sg_uf_end_prof,nm_munic_end_prof';
                oSGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0004-nm_munic_end_prof").val('');
            }
        });
        
        //Busca por cep web
        $('#smg_h0004-btn_nr_cep_prof').click(function(){
            var campo = '#smg_h0004-nr_cep_end_prof';
            if($(campo).validar(true)){
                $('#smg_h0004-cd_munic_end_prof').val('');
                $('#smg_h0004-sg_uf_end_prof').val('');
                $('#smg_h0004-nm_munic_end_prof').val('');
                $('#smg_h0004-nm_bairro_end_prof').val('');
                $('#smg_h0004-ds_logr_end_prof').val('');
                $('#smg_h0004-ds_compl_end_prof').val('');
                $('#smg_h0004-ds_qd_end_prof').val('');
                $('#smg_h0004-ds_lt_end_prof').val('');
                $('#smg_h0004-nr_end_prof').val('');
                $.post('default/view/buscaCEP.php',{
                    'form': self.formName,
                    'nr_cep': $('#smg_h0004-nr_cep_end_prof').val()
                    },
                    function(retorno){
                        if(retorno.ret == 'true'){
                            $('#smg_h0004-cd_munic_end_prof').val(retorno.dados["smg_h0004-cd_munic"]);
                            $('#smg_h0004-sg_uf_end_prof').val(retorno.dados["smg_h0004-uf"]);
                            $('#smg_h0004-nm_munic_end_prof').val(retorno.dados["smg_h0004-nm_munic"]);
                            $('#smg_h0004-nm_bairro_end_prof').val(retorno.dados["smg_h0004-bairro"]);
                            $('#smg_h0004-ds_logr_end_prof').val(retorno.dados["smg_h0004-tipo_logradouro_logradouro"]);
                        }else{
                            msg.alertErro(retorno.msg);
                        }
                    },
                'json');
            }
        });
        
        $('#smg_h0004-btn_incluir').click(function(){
            var campo = '#smg_h0004-nr_cpf_prof,#smg_h0004-st_prof,#smg_h0004-nm_prof,#smg_h0004-tp_sexo_prof,#smg_h0004-dt_nasc_prof,#smg_h0004-cd_pais_orig_prof,#smg_h0004-nm_pais_orig_prof,#smg_h0004-cd_munic_nasc_prof,#smg_h0004-sg_uf_nasc_prof,#smg_h0004-nm_munic_nasc_prof,#smg_h0004-cd_munic_end_prof,#smg_h0004-sg_uf_end_prof,#smg_h0004-nm_munic_end_prof';
            if($(campo).validar(true)){
                self.incluir();
            }
        });
        
        $('#smg_h0004-btn_alterar').click(function(){
            if($('#smg_h0004-cd_prof').val() != ''){
                var campo = '#smg_h0004-nr_cpf_prof,#smg_h0004-st_prof,#smg_h0004-nm_prof,#smg_h0004-tp_sexo_prof,#smg_h0004-dt_nasc_prof,#smg_h0004-cd_pais_orig_prof,#smg_h0004-nm_pais_orig_prof,#smg_h0004-cd_munic_nasc_prof,#smg_h0004-sg_uf_nasc_prof,#smg_h0004-nm_munic_nasc_prof,#smg_h0004-cd_munic_end_prof,#smg_h0004-sg_uf_end_prof,#smg_h0004-nm_munic_end_prof';
                if($(campo).validar(true)){
                    self.alterar();
                }
            }else{
                msg.alertErro('Selecione um Profissional para realizar está operação!');
            }
        });
        
        $('#smg_h0004-btn_excluir').click(function(){
            if($('#smg_h0004-cd_prof').val() != ''){
                var campo = '#smg_h0004-nr_cpf_prof,#smg_h0004-st_prof,#smg_h0004-nm_prof,#smg_h0004-tp_sexo_prof,#smg_h0004-dt_nasc_prof,#smg_h0004-cd_pais_orig_prof,#smg_h0004-nm_pais_orig_prof,#smg_h0004-cd_munic_nasc_prof,#smg_h0004-sg_uf_nasc_prof,#smg_h0004-nm_munic_nasc_prof,#smg_h0004-cd_munic_end_prof,#smg_h0004-sg_uf_end_prof,#smg_h0004-nm_munic_end_prof';
                if($(campo).validar(true)){
                    self.excluir();
                }
            }else{
                msg.alertErro('Selecione um Profissional para realizar está operação!');
            }
        });
        
        $('#smg_h0004-btn_limpar').click(function(){
            $('#smg_h0004-tabs').tabs({ active: 0 });
            self.limpar();
        });
        
        $('#smg_h0004-btn-conselho-add').click(function(){
            var campo = '#smg_h0004-sg_conselho,#smg_h0004-cd_uf_conselho,#smg_h0004-nr_conselho';
            if($(campo).validar(true)){
                self.adicionarConselho();
            }
        });
        
        $('#smg_h0004-btn-conselho-rem').click(function(){
            var campo = '#smg_h0004-sg_conselho,#smg_h0004-cd_uf_conselho,#smg_h0004-nr_conselho';
            if($(campo).validar(true)){
                self.removerConselho();
            }
        });
    }
    
    
    
    self.adicionarClass = function(){
        
        $('#smg_h0004-cd_prof').addClass('isValid[required]');
        $('#smg_h0004-nm_prof').addClass('isValid[required]');
        $('#smg_h0004-nm_mae_prof').addClass('isValid[required]');
        $('#smg_h0004-tp_sexo_prof').addClass('isValid[required]');
        $('#smg_h0004-dt_nasc_prof').addClass('isValid[required|data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button",
            maxDate: data_hoje
        });
        
        $('#smg_h0004-cd_munic_nasc_prof').addClass('isValid[required|justlength(6)]');
        $('#smg_h0004-sg_uf_nasc_prof').addClass('isValid[required]');
        $('#smg_h0004-nm_munic_nasc_prof').addClass('isValid[required]');
        $('#smg_h0004-nr_cns_prof').addClass('isValid[required|justlength(19)]').mask('999.999.999.999.999');
        $('#smg_h0004-nr_cpf_prof').addClass('isValid[required|justlength(14)]').mask('999.999.999-99');
        $('#smg_h0004-nr_fone_prof').addClass('isValid[required|justlength(13)]').mask('(99)9999-9999');
        $('#smg_h0004-cd_pais_orig_prof').addClass('isValid[required|minlength(2)]');
        $('#smg_h0004-nm_pais_orig_prof').addClass('isValid[required]');
        $('#smg_h0004-cd_munic_end_prof').addClass('isValid[required|justlength(6)]');
        $('#smg_h0004-sg_uf_end_prof').addClass('isValid[required]');
        $('#smg_h0004-nm_munic_end_prof').addClass('isValid[required]');
        $('#smg_h0004-cd_bairro_end_prof').addClass('isValid[required]');
        $('#smg_h0004-ds_logr_end_prof').addClass('isValid[required]');
        $('#smg_h0004-ds_compl_end_prof').addClass('isValid[required]');
        $('#smg_h0004-ds_qd_end_prof').addClass('isValid[required]');
        $('#smg_h0004-ds_lt_end_prof').addClass('isValid[required]');
        $('#smg_h0004-nr_end_prof').addClass('isValid[required|integer]');
        $('#smg_h0004-nr_cep_end_prof').addClass('isValid[required]').mask('99.999-999');
        $('#smg_h0004-ds_email_prof').addClass('isValid[required|email]');
        $('#smg_h0004-st_prof').addClass('isValid[required|enum(0,1)]');
        
        
        $('#smg_h0004-sg_conselho').addClass('isValid[required]');
        $('#smg_h0004-cd_uf_conselho').addClass('isValid[required]');
        $('#smg_h0004-nr_conselho').addClass('isValid[required|integer]');
  
    }
    
    self.limpar = function(){
        
        $('#smg_h0004-cd_prof').val('');
        $('#smg_h0004-nm_prof').val('');
        $('#smg_h0004-nm_mae_prof').val('');
        $('#smg_h0004-tp_sexo_prof').val('');
        $('#smg_h0004-dt_nasc_prof').val('');
        $('#smg_h0004-cd_munic_nasc_prof').val('');
        $('#smg_h0004-sg_uf_nasc_prof').val('');
        $('#smg_h0004-nm_munic_nasc_prof').val('');
        $('#smg_h0004-nr_cns_prof').val('');
        $('#smg_h0004-nr_cpf_prof').val('');
        $('#smg_h0004-nr_fone_prof').val('');
        $('#smg_h0004-cd_pais_orig_prof').val('');
        $('#smg_h0004-nm_pais_orig_prof').val('');
        $('#smg_h0004-cd_munic_end_prof').val('');
        $('#smg_h0004-sg_uf_end_prof').val('');
        $('#smg_h0004-nm_munic_end_prof').val('');
        $('#smg_h0004-nm_bairro_end_prof').val('');
        $('#smg_h0004-ds_logr_end_prof').val('');
        $('#smg_h0004-ds_compl_end_prof').val('');
        $('#smg_h0004-ds_qd_end_prof').val('');
        $('#smg_h0004-ds_lt_end_prof').val('');
        $('#smg_h0004-nr_end_prof').val('');
        $('#smg_h0004-nr_cep_end_prof').val('');
        $('#smg_h0004-ds_email_prof').val('');
        $('#smg_h0004-st_prof').val('');
        
        //Dados Conselho
        $('#smg_h0004-sg_conselho').html('');
        $('#smg_h0004-cd_uf_conselho').val('');
        $('#smg_h0004-nr_conselho').val('');
        $('#smg_h0004-dv_result_conselho').html('');
        
        $.fn.validar.limparErros();
        msg.limparMensagem();
    }
    
    self.consultaCPF = function(){
  
        oSMG_M0004.form = self.formName;
        oSMG_M0004.nr_cpf_prof = $('#smg_h0004-nr_cpf_prof').val();
        oSMG_M0004.st_prof = '0|1';
        oSMG_M0004.ConsultaProfissionalCPF(function(retorno){
            if(retorno.ret == 'true'){
                $('#smg_h0004-cd_prof').val(retorno.dados.cd_prof);
                $('#smg_h0004-nm_prof').val(retorno.dados.nm_prof);
                $('#smg_h0004-nm_mae_prof').val(retorno.dados.nm_mae_prof);
                $('#smg_h0004-tp_sexo_prof').val(retorno.dados.tp_sexo_prof);
                $('#smg_h0004-dt_nasc_prof').val(retorno.dados.dt_nasc_prof);
                $('#smg_h0004-cd_munic_nasc_prof').val(retorno.dados.cd_munic_nasc_prof);
                $('#smg_h0004-sg_uf_nasc_prof').val(retorno.dados.sg_uf_nasc_prof);
                $('#smg_h0004-nm_munic_nasc_prof').val(retorno.dados.nm_munic_nasc_prof);
                $('#smg_h0004-nr_cns_prof').val(retorno.dados.nr_cns_prof).mask('999.999.999.999.999');
                $('#smg_h0004-nr_cpf_prof').val(retorno.dados.nr_cpf_prof);
                $('#smg_h0004-nr_fone_prof').val(retorno.dados.nr_fone_prof);
                $('#smg_h0004-cd_pais_orig_prof').val(retorno.dados.cd_pais_orig_prof);
                $('#smg_h0004-nm_pais_orig_prof').val(retorno.dados.nm_pais_orig_prof);
                $('#smg_h0004-cd_munic_end_prof').val(retorno.dados.cd_munic_end_prof);
                $('#smg_h0004-sg_uf_end_prof').val(retorno.dados.sg_uf_end_prof);
                $('#smg_h0004-nm_munic_end_prof').val(retorno.dados.nm_munic_end_prof);
                $('#smg_h0004-nm_bairro_end_prof').val(retorno.dados.nm_bairro_end_prof);
                $('#smg_h0004-ds_logr_end_prof').val(retorno.dados.ds_logr_end_prof);
                $('#smg_h0004-ds_compl_end_prof').val(retorno.dados.ds_compl_end_prof);
                $('#smg_h0004-ds_qd_end_prof').val(retorno.dados.ds_qd_end_prof);
                $('#smg_h0004-ds_lt_end_prof').val(retorno.dados.ds_lt_end_prof);
                $('#smg_h0004-nr_end_prof').val(retorno.dados.nr_end_prof);
                $('#smg_h0004-nr_cep_end_prof').val(retorno.dados.nr_cep_end_prof);
                $('#smg_h0004-ds_email_prof').val(retorno.dados.ds_email_prof);
                $('#smg_h0004-st_prof').val(retorno.dados.st_prof);
                self.ConsultaCodigoPais();
                $("#smg_h0004-cd_munic_nasc_prof").blur();
                $("#smg_h0004-cd_munic_end_prof").blur();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.consultaNomeProfissional = function(){

        oSMG_M0004.form = self.formName;
        oSMG_M0004.nm_prof = $('#smg_h0004-nm_prof').val();
        oSMG_M0004.st_prof = '0|1';
        oSMG_M0004.ConsultaNomeProfissional();
        setTimeout(function(){
            $('#grid-busca-smg_c0004-ConsultaNomeProfissional').find('.grid_corpo table tbody tr').click(function(){
                self.consultaCPF();
            });
        },500);
    }
    
    //Busca Nacionalidade Profissional
    self.ConsultaCodigoPais = function(){
        oSGM_M0001.form = self.formName;
        oSGM_M0001.cd_pais = $("#smg_h0004-cd_pais_orig_prof").val();
        oSGM_M0001.consultaCodigoPais('nm_pais_orig_prof');
    }
    
    self.ConsultaNomePais = function(){

        oSGM_M0001.form = self.formName;
        oSGM_M0001.nm_pais = $("#smg_h0004-nm_pais_orig_prof").val();
        nm_campo_busca = 'cd_pais_orig_prof,nm_pais_orig_prof';
        oSGM_M0001.ConsultaNomePais(nm_campo_busca);
        
    }
    
    self.listaConselho = function(){
        oSMG_M0003.form = self.formName;
        oSMG_M0003.st_conselho = 0;
        oSMG_M0003.ConsultaNomeConselho('smg_h0004-sg_conselho', 0, function(retorno){
            var $option = '<option value=""></option>';
            for (var i=0;i<retorno.dados.length;i++){
                $option+='<option value="'+retorno.dados[i].cd_conselho+'">'+retorno.dados[i].sg_conselho+'</option>';
            }
            $('#smg_h0004-sg_conselho').html($option);
        });
    }
    
    self.listaConselhoProfissional = function(){
        oSMG_M0005.form = self.formName;
        oSMG_M0005.cd_prof = $('#smg_h0004-cd_prof').val();
        oSMG_M0005.listaConselhoporProfissional(function(retorno){
            $('#smg_h0004-dv_result_conselho').html(retorno.html);
            $('#smg_h0004-dv_result_conselho').find('table tbody.grid_corpo tr').click(function(){
                if($(this).data().data == undefined) return;
                $('#smg_h0004-sg_conselho').val($(this).data().data.cd_conselho);
                $('#smg_h0004-cd_uf_conselho').val($(this).data().data.sg_uf);
                $('#smg_h0004-nr_conselho').val($(this).data().data.nr_conselho);
                $.fn.validar.limparErros();
                msg.limparMensagem();
            });
            $('#smg_h0004-dv_result_conselho').tamanhocolunatabela();
        });
    }
    
    self.incluir = function(){
        
        oSMG_M0004.form = self.formName;
        oSMG_M0004.nr_cpf_prof = $('#smg_h0004-nr_cpf_prof').val();
        oSMG_M0004.nr_cns_prof = $('#smg_h0004-nr_cns_prof').val();
        oSMG_M0004.st_prof = $('#smg_h0004-st_prof').val();
        oSMG_M0004.nm_prof = $('#smg_h0004-nm_prof').val();
        oSMG_M0004.tp_sexo_prof = $('#smg_h0004-tp_sexo_prof').val();
        oSMG_M0004.dt_nasc_prof = $('#smg_h0004-dt_nasc_prof').val();
        oSMG_M0004.cd_pais_orig_prof = $('#smg_h0004-cd_pais_orig_prof').val();
        oSMG_M0004.cd_munic_nasc_prof = $('#smg_h0004-cd_munic_nasc_prof').val();
        oSMG_M0004.nm_mae_prof = $('#smg_h0004-nm_mae_prof').val();
        //Endereço
        oSMG_M0004.cd_munic_end_prof = $('#smg_h0004-cd_munic_end_prof').val();
        oSMG_M0004.nm_bairro_end_prof = $('#smg_h0004-nm_bairro_end_prof').val();
        oSMG_M0004.ds_logr_end_prof = $('#smg_h0004-ds_logr_end_prof').val();
        oSMG_M0004.nr_cep_end_prof = $('#smg_h0004-nr_cep_end_prof').val();
        oSMG_M0004.ds_compl_end_prof = $('#smg_h0004-ds_compl_end_prof').val();
        oSMG_M0004.ds_qd_end_prof = $('#smg_h0004-ds_qd_end_prof').val();
        oSMG_M0004.ds_lt_end_prof = $('#smg_h0004-ds_lt_end_prof').val();
        oSMG_M0004.nr_end_prof = $('#smg_h0004-nr_end_prof').val();
        //Contato
        oSMG_M0004.nr_fone_prof = $('#smg_h0004-nr_fone_prof').val();
        oSMG_M0004.ds_email_prof = $('#smg_h0004-ds_email_prof').val();
        oSMG_M0004.incluir(function(retorno){
            if(retorno.ret != 'false'){
                msg.alertSucesso(retorno.msg);
                $('#smg_h0004-cd_prof').val(retorno.dados.cd_prof);
                self.consultaCPF();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.alterar = function(){
        
        oSMG_M0004.form = self.formName;
        oSMG_M0004.cd_prof = $('#smg_h0004-cd_prof').val();
        oSMG_M0004.nr_cpf_prof = $('#smg_h0004-nr_cpf_prof').val();
        oSMG_M0004.nr_cns_prof = $('#smg_h0004-nr_cns_prof').val();
        oSMG_M0004.st_prof = $('#smg_h0004-st_prof').val();
        oSMG_M0004.cd_munic_nasc_prof = $('#smg_h0004-cd_munic_nasc_prof').val();

        //Endereço
        oSMG_M0004.cd_munic_end_prof = $('#smg_h0004-cd_munic_end_prof').val();
        oSMG_M0004.nm_bairro_end_prof = $('#smg_h0004-nm_bairro_end_prof').val();
        oSMG_M0004.ds_logr_end_prof = $('#smg_h0004-ds_logr_end_prof').val();
        oSMG_M0004.nr_cep_end_prof = $('#smg_h0004-nr_cep_end_prof').val();
        oSMG_M0004.ds_compl_end_prof = $('#smg_h0004-ds_compl_end_prof').val();
        oSMG_M0004.ds_qd_end_prof = $('#smg_h0004-ds_qd_end_prof').val();
        oSMG_M0004.ds_lt_end_prof = $('#smg_h0004-ds_lt_end_prof').val();
        oSMG_M0004.nr_end_prof = $('#smg_h0004-nr_end_prof').val();
        //Contato
        oSMG_M0004.nr_fone_prof = $('#smg_h0004-nr_fone_prof').val();
        oSMG_M0004.ds_email_prof = $('#smg_h0004-ds_email_prof').val();
        oSMG_M0004.alterar(function(retorno){
            if(retorno.ret != 'false'){
                msg.alertSucesso(retorno.msg);
                self.consultaCPF();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
      self.excluir = function(){
        
        oSMG_M0004.form = self.formName;
        oSMG_M0004.cd_prof = $('#smg_h0004-cd_prof').val();
        oSMG_M0004.excluir(function(retorno){
            self.limpar();
            if(retorno.ret != 'false'){
                msg.alertSucesso(retorno.msg);
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.adicionarConselho = function(){
        
        oSMG_M0005.form = self.formName;
        oSMG_M0005.cd_prof = $('#smg_h0004-cd_prof').val();
        oSMG_M0005.cd_conselho = $('#smg_h0004-sg_conselho').val();
        oSMG_M0005.cd_uf = $('#smg_h0004-cd_uf_conselho').val();
        oSMG_M0005.nr_conselho = $('#smg_h0004-nr_conselho').val();
        oSMG_M0005.incluir(function(retorno){
            if(retorno.ret == 'true'){
                self.listaConselhoProfissional();
                $('#smg_h0004-sg_conselho').val('');
                $('#smg_h0004-cd_uf_conselho').val('');
                $('#smg_h0004-nr_conselho').val('');
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.removerConselho = function(){
        
        oSMG_M0005.form = self.formName;
        oSMG_M0005.cd_prof = $('#smg_h0004-cd_prof').val();
        oSMG_M0005.cd_conselho = $('#smg_h0004-sg_conselho').val();
        oSMG_M0005.cd_uf = $('#smg_h0004-cd_uf_conselho').val();
        oSMG_M0005.nr_conselho = $('#smg_h0004-nr_conselho').val();
        oSMG_M0005.excluir(function(retorno){
            if(retorno.ret == 'true'){
                self.listaConselhoProfissional();
                $('#smg_h0004-sg_conselho').val('');
                $('#smg_h0004-cd_uf_conselho').val('');
                $('#smg_h0004-nr_conselho').val('');
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.init();
};

$(function() {
    new SMG_J0004();
});
