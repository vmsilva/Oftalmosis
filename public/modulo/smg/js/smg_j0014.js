setTimeout(function SMG_J0014(){

    var SMG_M0014 = new pacote_SMG.Smg.m0014;
    var SGM_M0001 = new pacote_SGM.Sgm.m0001;
    var SGM_M0003 = new pacote_SGM.Sgm.m0003;
    var self = this;
    self.formName = 'smg_h0014';
    
    self.inicializacao = function(){

        $('.ui-dialog-buttonpane').css('display', 'none');
        $('#smg_h0014-f0014').css('display', 'none');
        $('#smg_h0014-botao-acao').css('display', 'none');
        
        $('#dv_dados_pac_loc-tp_sexo_pac_loc').addClass('isValid[required|listEnum(M,F)]');
        $('#dv_dados_pac_loc-nm_pac_loc').addClass('isValid[required]');
        $('#dv_dados_pac_loc-dt_nasc_pac_loc').addClass('isValid[data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button",
            maxDate: data_hoje
        });
        
        $("#smg_h0014-nr_prontuario_pac").attr('disabled', true);
        $("#smg_h0014-nr_cns_pac").addClass('isValid[required|integer|justlength(15)]');
        $("#smg_h0014-nm_pac").addClass('isValid[required]');
        $("#smg_h0014-tp_sexo_pac").addClass('isValid[required|listEnum(M,F)]');
        $("#smg_h0014-dt_nasc_pac").addClass('isValid[required|data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button",
            maxDate: data_hoje
        });
        $("#smg_h0014-cd_pais_orig_pac").addClass('isValid[required|integer|minlength(2)|maxlength(3)]');
        $("#smg_h0014-nm_pais_orig_pac").addClass('isValid[required]');
        $("#smg_h0014-cd_munic_nasc_pac").addClass('isValid[required|integer|justlength(6)]');
        $("#smg_h0014-sg_uf_nasc_pac").addClass('isValid[required|listEnum(AC,AL,AM,AP,BA,CE,DF,ES,FN,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO)]');
        $("#smg_h0014-nm_munic_nasc_pac").addClass('isValid[required]');
        $("#smg_h0014-nm_mae_pac").addClass('isValid[required]');
        $("#smg_h0014-cd_munic_nasc_mae_pac").addClass('isValid[integer|justlength(6)]');
        $("#smg_h0014-sg_uf_nasc_mae_pac").addClass('isValid[listEnum(AC,AL,AM,AP,BA,CE,DF,ES,FN,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO)]');
        $("#smg_h0014-nm_munic_nasc_mae_pac");
        $("#smg_h0014-cd_munic_pac").addClass('isValid[required|integer|justlength(6)]');
        $("#smg_h0014-sg_uf_pac").addClass('isValid[required|listEnum(AC,AL,AM,AP,BA,CE,DF,ES,FN,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO)]');
        $("#smg_h0014-nm_munic_pac").addClass('isValid[required]');
        $("#smg_h0014-nm_bairro_pac").addClass('isValid[required]');
        $("#smg_h0014-ds_logr_pac").addClass('isValid[required]');
        $("#smg_h0014-ds_compl_pac");
        $("#smg_h0014-nr_cep_pac").addClass('isValid[required|justlength(10)]').mask("99.999-999");
        $("#smg_h0014-ds_qd_pac").addClass('isValid[required|minlength(1)]');
        $("#smg_h0014-ds_lt_pac").addClass('isValid[required|minlength(1)]');
        $("#smg_h0014-nr_pac").addClass('isValid[integer]');
        $("#smg_h0014-nr_fone_pac_01").addClass('isValid[required|justlength(13)]').mask("(99)9999-9999");
        $("#smg_h0014-nr_fone_pac_02").addClass('isValid[justlength(13)]').mask("(99)9999-9999");
        $("#smg_h0014-nr_fone_pac_03").addClass('isValid[justlength(13)]').mask("(99)9999-9999");
        $("#smg_h0014-ds_email_pac").addClass('isValid[email]');
    }

    //Dados da Pesquisa Paciente
    $('#dv_dados_pac_loc-tp_sexo_pac_loc').click(function(){
        self.consultaDadosPaciente();
    });
    
    $('#dv_dados_pac_loc-dt_nasc_pac_loc').change(function(){
        self.consultaDadosPaciente();
    });
    
    $('#dv_dados_pac_loc-dt_nasc_pac_loc').focus(function(){
        self.consultaDadosPaciente();
    });

    $('#dv_dados_pac_loc-nm_pac_loc,#dv_dados_pac_loc-nm_mae_pac_loc').keyup(function(){
        self.consultaDadosPaciente();
    });

    $('#dv_dados_pac_loc-nr_cns_pac').keyup(function(){
        self.consultaDadosPaciente();
    });

    $('#dv_dados_pac_loc-btn_novo_pesq_pac').click(function(){
        self.NovoDadosPaciente();
    });
    $('#dv_dados_pac_loc-btn_limpar_pesq_pac').click(function(){
        self.limpaDadosPacientePesquisa();
    });

    self.habilitarBotoes = function(flag) {
        $('#smg_h0014-btn_incluir').attr('disabled', !flag);
        $('#smg_h0014-btn_alterar').attr('disabled', flag);
        $('#smg_h0014-btn_excluir').attr('disabled', flag);
        $('#smg_h0014-btn_gerar').attr('disabled', flag);
    };

    self.consultaDadosPaciente = function(){

        if($('#dv_dados_pac_loc-nr_cns_pac').val() == ''){
            var campo = '#dv_dados_pac_loc-tp_sexo_pac_loc,#dv_dados_pac_loc-nm_pac_loc';
            if($(campo).validar(true)){
                SMG_M0014.form = self.formName;
                SMG_M0014.nm_pac = $('#dv_dados_pac_loc-nm_pac_loc').val();
                SMG_M0014.tp_sexo_pac = $('#dv_dados_pac_loc-tp_sexo_pac_loc').val();
                SMG_M0014.dt_nasc_pac = $('#dv_dados_pac_loc-dt_nasc_pac_loc').val();
                SMG_M0014.nm_mae_pac = $('#dv_dados_pac_loc-nm_mae_pac_loc').val();
                SMG_M0014.nr_cns_pac = '';
                SMG_M0014.consultaNomePaciente('#smg_h0014-tbl_result',0,function(data){
                    self.consultaCodigoPaciente(data.cd_pac);
                    $('#smg_h0014-f0014').css('display', 'inline-block');
                    $('#smg_h0014-botao-acao').css('display', 'inline-block');
                    $('.ui-dialog-buttonpane').css('display', 'block');
                    $('#dv_busca_pac_loc').css('display', 'none');
                    $('#smg_h0014-tbl_result').css('display', 'none');
                });
            }
        }else{
            $.fn.validar.limparErros();
            SMG_M0014.form = self.formName;
            SMG_M0014.nr_cns_pac = $('#dv_dados_pac_loc-nr_cns_pac').val();
            SMG_M0014.nm_pac = '';
            SMG_M0014.tp_sexo_pac = '';
            SMG_M0014.dt_nasc_pac = '';
            SMG_M0014.nm_mae_pac = '';
            SMG_M0014.consultaNomePaciente('#smg_h0014-tbl_result',0,function(data){
                self.consultaCodigoPaciente(data.cd_pac);
                $('#smg_h0014-f0014').css('display', 'inline-block');
                $('#smg_h0014-botao-acao').css('display', 'inline-block');
                $('.ui-dialog-buttonpane').css('display', 'block');
                $('#dv_busca_pac_loc').css('display', 'none');
                $('#smg_h0014-tbl_result').css('display', 'none');
            });
        }

        self.habilitarBotoes(false);
    }

    self.consultaCodigoPaciente = function(cd_pac){

            SMG_M0014.form = self.formName;
            SMG_M0014.cd_pac = cd_pac;
            SMG_M0014.consultaCodigoPaciente();

            $("#smg_h0014-nr_prontuario_pac").attr('disabled', true);
            $("#smg_h0014-nr_cns_pac").attr('disabled', true);
            $("#smg_h0014-nm_pac").attr('disabled', true);
            $("#smg_h0014-tp_sexo_pac").attr('disabled', true);
            $("#smg_h0014-dt_nasc_pac").attr('disabled', true);
            $("#smg_h0014-cd_pais_orig_pac").attr('disabled', true);
            $("#smg_h0014-nm_pais_orig_pac").attr('disabled', true);
            $("#smg_h0014-cd_munic_nasc_pac").attr('disabled', true);
            $("#smg_h0014-sg_uf_nasc_pac").attr('disabled', true);
            $("#smg_h0014-nm_munic_nasc_pac").attr('disabled', true);
            $("#smg_h0014-nm_mae_pac").attr('disabled', true);
            $("#smg_h0014-cd_munic_nasc_mae_pac").attr('disabled', true);
            $("#smg_h0014-sg_uf_nasc_mae_pac").attr('disabled', true);
            $("#smg_h0014-nm_munic_nasc_mae_pac").attr('disabled', true);
            $('.ui-dialog-buttonpane').css('display', 'block');
            if($("#smg_h0014-nr_cns_pac").val() == ''){
                $("#smg_h0014-nr_cns_pac").attr('disabled', false);
            }
            
            self.habilitarBotoes(false);

    }

    self.NovoDadosPaciente = function(){

        $('#smg_h0014-f0014').css('display', 'inline-block');
        $('#smg_h0014-botao-acao').css('display', 'inline-block');
        $('#dv_busca_pac_loc').css('display', 'none');
        $('#smg_h0014-tbl_result').css('display', 'none');

        $("#smg_h0014-nr_prontuario_pac").attr('disabled', false);
        $("#smg_h0014-nr_cns_pac").attr('disabled', false);
        $("#smg_h0014-nm_pac").attr('disabled', false);
        $("#smg_h0014-tp_sexo_pac").attr('disabled', false);
        $("#smg_h0014-dt_nasc_pac").attr('disabled', false);
        $("#smg_h0014-cd_pais_orig_pac").attr('disabled', false);
        $("#smg_h0014-nm_pais_orig_pac").attr('disabled', false);
        $("#smg_h0014-cd_munic_nasc_pac").attr('disabled', false);
        $("#smg_h0014-sg_uf_nasc_pac").attr('disabled', false);
        $("#smg_h0014-nm_munic_nasc_pac").attr('disabled', false);
        $("#smg_h0014-nm_mae_pac").attr('disabled', false);
        $("#smg_h0014-cd_munic_nasc_mae_pac").attr('disabled', false);
        $("#smg_h0014-sg_uf_nasc_mae_pac").attr('disabled', false);
        $("#smg_h0014-nm_munic_nasc_mae_pac").attr('disabled', false);

        $("#smg_h0014-tp_sexo_pac").val($('#dv_dados_pac_loc-tp_sexo_pac_loc').val());
        $("#smg_h0014-dt_nasc_pac").val($('#dv_dados_pac_loc-dt_nasc_pac_loc').val());
        $("#smg_h0014-nm_pac").val($('#dv_dados_pac_loc-nm_pac_loc').val());
        $("#smg_h0014-nm_mae_pac").val($('#dv_dados_pac_loc-nm_mae_pac_loc').val());
        $("#smg_h0014-nr_cns_pac").val($('#dv_dados_pac_loc-nr_cns_pac').val());
        $("#smg_h0014-nr_prontuario_pac").attr('disabled', true);

        self.habilitarBotoes(true);
        
    }

    self.limpaDadosPacientePesquisa = function(){

        $('#dv_dados_pac_loc-tp_sexo_pac_loc').val('');
        $('#dv_dados_pac_loc-dt_nasc_pac_loc').val('');
        $('#dv_dados_pac_loc-nm_pac_loc').val('');
        $('#dv_dados_pac_loc-nm_mae_pac_loc').val('');
        $('#dv_dados_pac_loc-nr_cns_pac').val('');
        $('#smg_h0014-tbl_result').html('');
        
    }


    //Dados da Tela de Inclusão/Alteração

    //Busca Nacionalidade Paciente
    $("#smg_h0014-cd_pais_orig_pac").blur(function(){
        var campo = '#smg_h0014-cd_pais_orig_pac';
            if($(campo).validar(true)){
                self.ConsultaCodigoPais();
            }
    });

    self.ConsultaCodigoPais = function(){
        
        SGM_M0001.form = self.formName;
        SGM_M0001.cd_pais = $("#smg_h0014-cd_pais_orig_pac").val();
        SGM_M0001.consultaCodigoPais('nm_pais_orig_pac');
    }
    
    $('#smg_h0014-btn_pais_orig_pac').click(function(){
        nm_campo_busca = 'cd_pais_orig_pac,nm_pais_orig_pac'
        self.ConsultaNomePais(nm_campo_busca);
    });
    
    self.ConsultaNomePais = function(){

        SGM_M0001.form = self.formName;
        SGM_M0001.nm_pais = $("#smg_h0014-nm_pais_orig_pac").val();
        nm_campo_busca = 'cd_pais_orig_pac,nm_pais_orig_pac';
        SGM_M0001.ConsultaNomePais(nm_campo_busca);
        
    }
    //Busca Município de Nascimento Paciente
    $("#smg_h0014-cd_munic_nasc_pac").blur(function(){
        var campo = '#smg_h0014-cd_munic_nasc_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.cd_munic = $("#smg_h0014-cd_munic_nasc_pac").val();
                nm_campo = 'cd_munic_nasc_pac,sg_uf_nasc_pac,nm_munic_nasc_pac';
                SGM_M0003.consultaCodigoMunicipio(nm_campo);
            }else{
                $("#smg_h0014-cd_munic_nasc_pac").val('');
            }
    });

    $('#smg_h0014-btn_munic_nasc_pac').click(function(){
        var campo = '#smg_h0014-sg_uf_nasc_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.sg_uf = $("#smg_h0014-sg_uf_nasc_pac").val();
                nm_campo_busca = 'cd_munic_nasc_pac,sg_uf_nasc_pac,nm_munic_nasc_pac';
                SGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0014-nm_munic_nasc_pac").val('');
            }

    });

    //Busca Município de Nascimento da Mãe Paciente
    $("#smg_h0014-cd_munic_nasc_mae_pac").blur(function(){
        var campo = '#smg_h0014-cd_munic_nasc_mae_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.cd_munic = $("#smg_h0014-cd_munic_nasc_mae_pac").val();
                nm_campo = 'cd_munic_nasc_mae_pac,sg_uf_nasc_mae_pac,nm_munic_nasc_mae_pac';
                SGM_M0003.consultaCodigoMunicipio(nm_campo);
            }else{
                $("#smg_h0014-cd_munic_nasc_mae_pac").val('');
            }
    });

    $('#smg_h0014-btn_munic_nasc_mae_pac').click(function(){
        var campo = '#smg_h0014-sg_uf_nasc_mae_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.sg_uf = $("#smg_h0014-sg_uf_nasc_mae_pac").val();
                nm_campo_busca = 'cd_munic_nasc_mae_pac,sg_uf_nasc_mae_pac,nm_munic_nasc_mae_pac';
                SGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0014-nm_munic_nasc_mae_pac").val('');
            }
    });

    //Busca Município de Endereço do Paciente
    $("#smg_h0014-cd_munic_pac").blur(function(){
        var campo = '#smg_h0014-cd_munic_pac';
            if($(campo).validar(true)){
                $('#smg_h0014-nm_bairro_pac').val('');
                $('#smg_h0014-ds_logr_pac').val('');
                $('#smg_h0014-nr_cep_pac').val('');
                $('#smg_h0014-ds_compl_pac').val('');
                $('#smg_h0014-ds_qd_pac').val('');
                $('#smg_h0014-ds_lt_pac').val('');
                $('#smg_h0014-nr_pac').val('');
                SGM_M0003.form = self.formName;
                SGM_M0003.cd_munic = $("#smg_h0014-cd_munic_pac").val();
                nm_campo = 'cd_munic_pac,sg_uf_pac,nm_munic_pac';
                SGM_M0003.consultaCodigoMunicipio(nm_campo);
            }else{
                $("#smg_h0014-cd_munic_pac").val('');
            }
    });

    $('#smg_h0014-btn_munic_pac').click(function(){
        var campo = '#smg_h0014-sg_uf_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.sg_uf = $("#smg_h0014-sg_uf_pac").val();
                nm_campo_busca = 'cd_munic_pac,sg_uf_pac,nm_munic_pac';
                SGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0014-nm_munic_pac").val('');
            }
    });

    //Busca por cep web
    $('#smg_h0014-btn_nr_cep_pac').click(function(){
        var campo = '#smg_h0014-nr_cep_pac';
        if($(campo).validar(true)){
            $('#smg_h0014-cd_munic_pac').val('');
            $('#smg_h0014-sg_uf_pac').val('');
            $('#smg_h0014-nm_munic_pac').val('');
            $('#smg_h0014-nm_bairro_pac').val('');
            $('#smg_h0014-ds_logr_pac').val('');
            $('#smg_h0014-ds_compl_pac').val('');
            $('#smg_h0014-ds_qd_pac').val('');
            $('#smg_h0014-ds_lt_pac').val('');
            $('#smg_h0014-nr_pac').val('');
            $.post('default/view/buscaCEP.php',{
                'form': self.formName,
                'nr_cep': $('#smg_h0014-nr_cep_pac').val()
                },
                function(retorno){
                    if(retorno.ret == 'true'){
                        $('#smg_h0014-cd_munic_pac').val(retorno.dados["smg_h0014-cd_munic"]);
                        $('#smg_h0014-sg_uf_pac').val(retorno.dados["smg_h0014-uf"]);
                        $('#smg_h0014-nm_munic_pac').val(retorno.dados["smg_h0014-nm_munic"]);
                        $('#smg_h0014-nm_bairro_pac').val(retorno.dados["smg_h0014-bairro"]);
                        $('#smg_h0014-ds_logr_pac').val(retorno.dados["smg_h0014-tipo_logradouro_logradouro"]);
                    }else{
                        msg.alertErro(retorno.msg);
                    }
                },
            'json');
        }
    });
    
    //Operações    
    $('#smg_h0014-btn_incluir').click(function(){
        //#smg_h0014-nr_cns_pac,#smg_h0014-nr_fone_pac_01
        var campo = '#smg_h0014-nm_pac,#smg_h0014-tp_sexo_pac,#smg_h0014-dt_nasc_pac,#smg_h0014-cd_pais_orig_pac,#smg_h0014-nm_pais_orig_pac,#smg_h0014-cd_munic_nasc_pac,#smg_h0014-sg_uf_nasc_pac,#smg_h0014-nm_munic_nasc_pac,#smg_h0014-nm_mae_pac,#smg_h0014-cd_munic_pac,#smg_h0014-sg_uf_pac,#smg_h0014-nm_munic_pac,#smg_h0014-nm_bairro_pac,#smg_h0014-ds_logr_pac,#smg_h0014-nr_cep_pac,#smg_h0014-ds_qd_pac,#smg_h0014-ds_lt_pac';
        if($(campo).validar(true)){
            SMG_M0014.form = self.formName;
            SMG_M0014.nr_cns_pac = $("#smg_h0014-nr_cns_pac").val();
            SMG_M0014.nm_pac = $("#smg_h0014-nm_pac").val();
            SMG_M0014.tp_sexo_pac = $("#smg_h0014-tp_sexo_pac").val();
            SMG_M0014.dt_nasc_pac = $("#smg_h0014-dt_nasc_pac").val();
            SMG_M0014.cd_pais_orig_pac = $("#smg_h0014-cd_pais_orig_pac").val();
            SMG_M0014.nm_pais_orig_pac = $("#smg_h0014-nm_pais_orig_pac").val();
            SMG_M0014.cd_munic_nasc_pac = $("#smg_h0014-cd_munic_nasc_pac").val();
            SMG_M0014.sg_uf_nasc_pac = $("#smg_h0014-sg_uf_nasc_pac").val();
            SMG_M0014.nm_munic_nasc_pac = $("#smg_h0014-nm_munic_nasc_pac").val();
            SMG_M0014.nm_mae_pac = $("#smg_h0014-nm_mae_pac").val();
            SMG_M0014.cd_munic_nasc_mae_pac = $("#smg_h0014-cd_munic_nasc_mae_pac").val();
            SMG_M0014.sg_uf_nasc_mae_pac = $("#smg_h0014-sg_uf_nasc_mae_pac").val();
            SMG_M0014.nm_munic_nasc_mae_pac = $("#smg_h0014-nm_munic_nasc_mae_pac").val();
            SMG_M0014.cd_munic_pac = $("#smg_h0014-cd_munic_pac").val();
            SMG_M0014.sg_uf_pac = $("#smg_h0014-sg_uf_pac").val();
            SMG_M0014.nm_munic_pac = $("#smg_h0014-nm_munic_pac").val();
            SMG_M0014.nm_bairro_pac = $("#smg_h0014-nm_bairro_pac").val();
            SMG_M0014.ds_logr_pac = $("#smg_h0014-ds_logr_pac").val();
            SMG_M0014.ds_compl_pac = $("#smg_h0014-ds_compl_pac").val();
            SMG_M0014.nr_cep_pac = $("#smg_h0014-nr_cep_pac").val();
            SMG_M0014.ds_qd_pac = $("#smg_h0014-ds_qd_pac").val();
            SMG_M0014.ds_lt_pac = $("#smg_h0014-ds_lt_pac").val();
            SMG_M0014.nr_pac = $("#smg_h0014-nr_pac").val();
            SMG_M0014.nr_fone_pac_01 = $("#smg_h0014-nr_fone_pac_01").val();
            SMG_M0014.nr_fone_pac_02 = $("#smg_h0014-nr_fone_pac_02").val();
            SMG_M0014.nr_fone_pac_03 = $("#smg_h0014-nr_fone_pac_03").val();
            SMG_M0014.ds_email_pac = $("#smg_h0014-ds_email_pac").val();
            SMG_M0014.incluir(function(retorno){
                if(retorno){
                    self.consultaCodigoPaciente($("#smg_h0014-cd_pac").val());
                }
            });
        }
    });
    
    $('#smg_h0014-btn_alterar').click(function(){
        if($("#smg_h0014-cd_pac").val() != ''){
            //#smg_h0014-nr_cns_pac,,#smg_h0014-nr_fone_pac_01
            var campo = '#smg_h0014-nm_pac,#smg_h0014-tp_sexo_pac,#smg_h0014-dt_nasc_pac,#smg_h0014-cd_pais_orig_pac,#smg_h0014-nm_pais_orig_pac,#smg_h0014-cd_munic_nasc_pac,#smg_h0014-sg_uf_nasc_pac,#smg_h0014-nm_munic_nasc_pac,#smg_h0014-nm_mae_pac,#smg_h0014-cd_munic_pac,#smg_h0014-sg_uf_pac,#smg_h0014-nm_munic_pac,#smg_h0014-nm_bairro_pac,#smg_h0014-ds_logr_pac,#smg_h0014-nr_cep_pac,#smg_h0014-ds_qd_pac,#smg_h0014-ds_lt_pac';
            if($(campo).validar(true)){
                SMG_M0014.form = self.formName;
                SMG_M0014.nr_cns_pac = $("#smg_h0014-nr_cns_pac").val();
                SMG_M0014.cd_munic_pac = $("#smg_h0014-cd_munic_pac").val();
                SMG_M0014.sg_uf_pac = $("#smg_h0014-sg_uf_pac").val();
                SMG_M0014.nm_munic_pac = $("#smg_h0014-nm_munic_pac").val();
                SMG_M0014.nm_bairro_pac = $("#smg_h0014-nm_bairro_pac").val();
                SMG_M0014.ds_logr_pac = $("#smg_h0014-ds_logr_pac").val();
                SMG_M0014.ds_compl_pac = $("#smg_h0014-ds_compl_pac").val();
                SMG_M0014.nr_cep_pac = $("#smg_h0014-nr_cep_pac").val();
                SMG_M0014.ds_qd_pac = $("#smg_h0014-ds_qd_pac").val();
                SMG_M0014.ds_lt_pac = $("#smg_h0014-ds_lt_pac").val();
                SMG_M0014.nr_pac = $("#smg_h0014-nr_pac").val();
                SMG_M0014.nr_fone_pac_01 = $("#smg_h0014-nr_fone_pac_01").val();
                SMG_M0014.nr_fone_pac_02 = $("#smg_h0014-nr_fone_pac_02").val();
                SMG_M0014.nr_fone_pac_03 = $("#smg_h0014-nr_fone_pac_03").val();
                SMG_M0014.ds_email_pac = $("#smg_h0014-ds_email_pac").val();
                SMG_M0014.cd_pac = $("#smg_h0014-cd_pac").val();
                SMG_M0014.alterar(function(retorno){
                    if(retorno){
                        self.consultaCodigoPaciente($("#smg_h0014-cd_pac").val())
                    }
                });
                
            }
        }
    });
    
    $('#smg_h0014-btn_excluir').click(function(){
        if($("#smg_h0014-cd_pac").val() != ''){
            //#smg_h0014-nr_cns_pac,
            var campo = '#smg_h0014-nm_pac,#smg_h0014-tp_sexo_pac,#smg_h0014-dt_nasc_pac,#smg_h0014-cd_pais_orig_pac,#smg_h0014-nm_pais_orig_pac,#smg_h0014-cd_munic_nasc_pac,#smg_h0014-sg_uf_nasc_pac,#smg_h0014-nm_munic_nasc_pac,#smg_h0014-nm_mae_pac';
            if($(campo).validar(true)){
                SMG_M0014.form = self.formName;
                SMG_M0014.cd_munic_pac = $("#smg_h0014-cd_munic_pac").val();
                SMG_M0014.sg_uf_pac = $("#smg_h0014-sg_uf_pac").val();
                SMG_M0014.nm_munic_pac = $("#smg_h0014-nm_munic_pac").val();
                SMG_M0014.nm_bairro_pac = $("#smg_h0014-nm_bairro_pac").val();
                SMG_M0014.ds_logr_pac = $("#smg_h0014-ds_logr_pac").val();
                SMG_M0014.ds_compl_pac = $("#smg_h0014-ds_compl_pac").val();
                SMG_M0014.nr_cep_pac = $("#smg_h0014-nr_cep_pac").val();
                SMG_M0014.ds_qd_pac = $("#smg_h0014-ds_qd_pac").val();
                SMG_M0014.ds_lt_pac = $("#smg_h0014-ds_lt_pac").val();
                SMG_M0014.nr_pac = $("#smg_h0014-nr_pac").val();
                SMG_M0014.nr_fone_pac_01 = $("#smg_h0014-nr_fone_pac_01").val();
                SMG_M0014.nr_fone_pac_02 = $("#smg_h0014-nr_fone_pac_02").val();
                SMG_M0014.nr_fone_pac_03 = $("#smg_h0014-nr_fone_pac_03").val();
                SMG_M0014.ds_email_pac = $("#smg_h0014-ds_email_pac").val();
                SMG_M0014.cd_pac = $("#smg_h0014-cd_pac").val();
                SMG_M0014.excluir();
                $("#smg_h0014-cd_pac").val('');
                self.limpar();
            }
        }
    });
    
    $('#smg_h0014-btn_limpar').click(function(){
        self.limpar();
    });

    self.limpar = function(){
        
        $('.ui-dialog-buttonpane').css('display', 'none');
        $('#smg_h0014-f0014').css('display', 'none');
        $('#smg_h0014-botao-acao').css('display', 'none');
        $('#dv_busca_pac_loc').css('display', 'inline-block');
        $('#smg_h0014-tbl_result').css('display', 'inline-block');
        $("#smg_h0014-nr_prontuario_pac").val('');
        $("#smg_h0014-nr_cns_pac").val('');
        $("#smg_h0014-nm_pac").val('');
        $("#smg_h0014-tp_sexo_pac").val('');
        $("#smg_h0014-dt_nasc_pac").val('');
        $("#smg_h0014-cd_pais_orig_pac").val('');
        $("#smg_h0014-nm_pais_orig_pac").val('');
        $("#smg_h0014-cd_munic_nasc_pac").val('');
        $("#smg_h0014-sg_uf_nasc_pac").val('');
        $("#smg_h0014-nm_munic_nasc_pac").val('');
        $("#smg_h0014-nm_mae_pac").val('');
        $("#smg_h0014-cd_munic_nasc_mae_pac").val('');
        $("#smg_h0014-sg_uf_nasc_mae_pac").val('');
        $("#smg_h0014-nm_munic_nasc_mae_pac").val('');
        $("#smg_h0014-cd_munic_pac").val('');
        $("#smg_h0014-sg_uf_pac").val('');
        $("#smg_h0014-nm_munic_pac").val('');
        $("#smg_h0014-nm_bairro_pac").val('');
        $("#smg_h0014-ds_logr_pac").val('');
        $("#smg_h0014-ds_compl_pac").val('');
        $("#smg_h0014-nr_cep_pac").val('');
        $("#smg_h0014-ds_qd_pac").val('');
        $("#smg_h0014-ds_lt_pac").val('');
        $("#smg_h0014-nr_pac").val('');
        $("#smg_h0014-nr_fone_pac_01").val('');
        $("#smg_h0014-nr_fone_pac_02").val('');
        $("#smg_h0014-nr_fone_pac_03").val('');
        $("#smg_h0014-ds_email_pac").val('');
        self.limpaDadosPacientePesquisa();
    }

    self.inicializacao();

},250)