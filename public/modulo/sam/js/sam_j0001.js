$(function SCA_J0001(){

    var SGM_M0003 = new pacote_SGM.Sgm.m0003;
    var SAM_M0001 = new pacote_SAM.Sam.m0001;
    var self = this;
    self.formName = 'sam_h0001';
    
    self.inicializacao = function(){
        
        $("#sam_h0001-cd_escola").addClass('isValid[required|integer]');
        $('#sam_h0001-cd_escola').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEscola();
            }
        });
        
        $("#sam_h0001-nm_escola").addClass('isValid[required');
        $('#sam_h0001-btn_lista_escola').click(function(){
            self.consultaNomeEscola();
        });
        $("#sam_h0001-cd_munic_esc").addClass('isValid[required|integer|justlength(6)]');
        $("#sam_h0001-sg_uf").addClass('isValid[required|listEnum(AC,AL,AM,AP,BA,CE,DF,ES,FN,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO)]');
        $("#sam_h0001-nm_munic").addClass('isValid[required]');
        $("#sam_h0001-nm_bairro_esc").addClass('isValid[required]');
        $("#sam_h0001-ds_logr_esc").addClass('isValid[required]');
        $("#sam_h0001-ds_compl_esc").addClass('isValid[]');
        $("#sam_h0001-nr_cep_esc").addClass('isValid[required|justlength(10)]').mask("99.999-999");
        $("#sam_h0001-ds_qd_esc").addClass('isValid[required|minlength(1)]');
        $("#sam_h0001-ds_lt_esc").addClass('isValid[required|minlength(1)]');
        $("#sam_h0001-nr_end_esc").addClass('isValid[integer]');
        $("#sam_h0001-nm_resp_esc").addClass('isValid[required');
        $("#sam_h0001-nr_fone_01").addClass('isValid[required|justlength(13)]').mask("(99)9999-9999");
        $("#sam_h0001-nr_fone_02").addClass('isValid[justlength(13)]').mask("(99)9999-9999");
        $("#sam_h0001-nr_fone_03").addClass('isValid[justlength(13)]').mask("(99)9999-9999");
        $("#sam_h0001-ds_email_esc").addClass('isValid[email]');
    }


    self.habilitarBotoes = function(flag) {
        $('#sam_h0001-btn_incluir').attr('disabled', !flag);
        //$('#sam_h0001-btn_alterar').attr('disabled', flag);
        //$('#sam_h0001-btn_excluir').attr('disabled', flag);
    };

    //Busca Município de Endereço do Escola
    $("#sam_h0001-cd_munic_esc").blur(function(){
        var campo = '#sam_h0001-cd_munic_esc';
            if($(campo).validar(true)){
                $('#sam_h0001-nm_bairro_esc').val('');
                $('#sam_h0001-ds_logr_esc').val('');
                $('#sam_h0001-nr_cep_esc').val('');
                $('#sam_h0001-ds_compl_esc').val('');
                $('#sam_h0001-ds_qd_esc').val('');
                $('#sam_h0001-ds_lt_esc').val('');
                $('#sam_h0001-nr_end_esc').val('');
                SGM_M0003.form = self.formName;
                SGM_M0003.cd_munic = $("#sam_h0001-cd_munic_esc").val();
                nm_campo = 'cd_munic_esc,sg_uf,nm_munic';
                SGM_M0003.consultaCodigoMunicipio(nm_campo);
            }else{
                $("#sam_h0001-cd_munic_esc").val('');
            }
    });

    $('#sam_h0001-btn_munic').click(function(){
        var campo = '#sam_h0001-sg_uf';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.sg_uf = $("#sam_h0001-sg_uf").val();
                nm_campo_busca = 'cd_munic_esc,sg_uf,nm_munic';
                SGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#sam_h0001-nm_munic").val('');
            }
    });

    //Busca por cep web
    $('#sam_h0001-btn_nr_cep').click(function(){
        var campo = '#sam_h0001-nr_cep_esc';
        if($(campo).validar(true)){
            $('#sam_h0001-cd_munic_esc').val('');
            $('#sam_h0001-sg_uf').val('');
            $('#sam_h0001-nm_munic').val('');
            $('#sam_h0001-nm_bairro_esc').val('');
            $('#sam_h0001-ds_logr_esc').val('');
            $('#sam_h0001-ds_compl_esc').val('');
            $('#sam_h0001-ds_qd_esc').val('');
            $('#sam_h0001-ds_lt_esc').val('');
            $('#sam_h0001-nr_end_esc').val('');
            $.post('default/view/buscaCEP.php',{
                'form': self.formName,
                'nr_cep': $('#sam_h0001-nr_cep_esc').val()
                },
                function(retorno){
                    if(retorno.ret == 'true'){
                        $('#sam_h0001-cd_munic_esc').val(retorno.dados["sam_h0001-cd_munic"]);
                        $('#sam_h0001-sg_uf').val(retorno.dados["sam_h0001-uf"]);
                        $('#sam_h0001-nm_munic').val(retorno.dados["sam_h0001-nm_munic"]);
                        $('#sam_h0001-nm_bairro_esc').val(retorno.dados["sam_h0001-bairro"]);
                        $('#sam_h0001-ds_logr_esc').val(retorno.dados["sam_h0001-tipo_logradouro_logradouro"]);
                    }else{
                        msg.alertErro(retorno.msg);
                    }
                },
            'json');
        }
    });
    
    
    $('#sam_h0001-btn_limpar').click(function(){
        self.limpar();
    });
    $('#sam_h0001-btn_incluir').click(function(){
        var campo = '#sam_h0001-cd_escola,#sam_h0001-nm_escola,#sam_h0001-cd_munic_esc,#sam_h0001-sg_uf,#sam_h0001-nm_munic,#sam_h0001-nm_resp_esc,#sam_h0001-nr_fone_01';
        if($(campo).validar(true)){
            self.incluir();
        }
    });
    $('#sam_h0001-btn_alterar').click(function(){
        var campo = '#sam_h0001-cd_escola,#sam_h0001-nm_escola,#sam_h0001-cd_munic_esc,#sam_h0001-sg_uf,#sam_h0001-nm_munic,#sam_h0001-nm_resp_esc,#sam_h0001-nr_fone_01';
        if($(campo).validar(true)){
            self.alterar();
        }
    });
    $('#sam_h0001-btn_excluir').click(function(){
        var campo = '#sam_h0001-cd_escola,#sam_h0001-nm_escola,#sam_h0001-cd_munic_esc,#sam_h0001-sg_uf,#sam_h0001-nm_munic,#sam_h0001-nm_resp_esc,#sam_h0001-nr_fone_01';
        if($(campo).validar(true)){
            self.excluir();
        }
    });

    self.limpar = function(){
        
        $("#sam_h0001-cd_escola").val('');
        $("#sam_h0001-nm_escola").val('');
        $("#sam_h0001-cd_munic_esc").val('');
        $("#sam_h0001-sg_uf").val('');
        $("#sam_h0001-nm_munic").val('');
        $("#sam_h0001-nm_bairro_esc").val('');
        $("#sam_h0001-ds_logr_esc").val('');
        $("#sam_h0001-ds_compl_esc").val('');
        $("#sam_h0001-nr_cep_esc").val('');
        $("#sam_h0001-ds_qd_esc").val('');
        $("#sam_h0001-ds_lt_esc").val('');
        $("#sam_h0001-nr_end_esc").val('');
        $("#sam_h0001-nm_resp_esc").val('');
        $("#sam_h0001-nr_fone_01").val('');
        $("#sam_h0001-nr_fone_02").val('');
        $("#sam_h0001-nr_fone_03").val('');
        $("#sam_h0001-ds_email_esc").val('');
        $.fn.validar.limparErros();
    }
    
    self.consultaCodigoEscola = function(){
        SAM_M0001.form = self.formName;
        SAM_M0001.cd_escola = $('#sam_h0001-cd_escola').val();
        SAM_M0001.st_escola = '0|1';
        SAM_M0001.consultaCodigoEscola();
    }  
    self.consultaNomeEscola = function(){
        SAM_M0001.form = self.formName;
        SAM_M0001.st_escola = '0|1';
        nm_campo_busca = 'cd_escola,nm_escola';
        SAM_M0001.ConsultaNomeEscola();
    }
    
    self.incluir = function(){

        SAM_M0001.form = self.formName;
        SAM_M0001.cd_escola = $('#sam_h0001-cd_escola').val();
        SAM_M0001.nm_escola = $('#sam_h0001-nm_escola').val();
        SAM_M0001.nm_resp_esc = $('#sam_h0001-nm_resp_esc').val();
        SAM_M0001.cd_munic_esc = $('#sam_h0001-cd_munic_esc').val();
        SAM_M0001.sg_uf = $('#sam_h0001-sg_uf').val();
        SAM_M0001.nm_munic = $('#sam_h0001-nm_munic').val();
        SAM_M0001.nm_bairro_esc = $('#sam_h0001-nm_bairro_esc').val();
        SAM_M0001.ds_logr_esc = $('#sam_h0001-ds_logr_esc').val();
        SAM_M0001.ds_compl_esc = $('#sam_h0001-ds_compl_esc').val();
        SAM_M0001.ds_qd_esc = $('#sam_h0001-ds_qd_esc').val();
        SAM_M0001.ds_lt_esc = $('#sam_h0001-ds_lt_esc').val();
        SAM_M0001.nr_end_esc = $('#sam_h0001-nr_end_esc').val();
        SAM_M0001.nr_cep_esc = $('#sam_h0001-nr_cep_esc').val();
        SAM_M0001.nr_fone_01 = $('#sam_h0001-nr_fone_01').val();
        SAM_M0001.nr_fone_02 = $('#sam_h0001-nr_fone_02').val();
        SAM_M0001.nr_fone_03 = $('#sam_h0001-nr_fone_03').val();
        SAM_M0001.st_escola = $('#sam_h0001-st_escola').val();
        SAM_M0001.ds_email_esc = $('#sam_h0001-ds_email_esc').val();
        
        SAM_M0001.incluir(function(retorno){
            if(retorno){                
                self.consultaCodigoEscola();
            }
        });
    }
    
    self.alterar = function(){

        SAM_M0001.form = self.formName;
        SAM_M0001.cd_escola = $('#sam_h0001-cd_escola').val();
        SAM_M0001.nm_escola = $('#sam_h0001-nm_escola').val();
        SAM_M0001.nm_resp_esc = $('#sam_h0001-nm_resp_esc').val();
        SAM_M0001.cd_munic_esc = $('#sam_h0001-cd_munic_esc').val();
        SAM_M0001.sg_uf = $('#sam_h0001-sg_uf').val();
        SAM_M0001.nm_munic = $('#sam_h0001-nm_munic').val();
        SAM_M0001.nm_bairro_esc = $('#sam_h0001-nm_bairro_esc').val();
        SAM_M0001.ds_logr_esc = $('#sam_h0001-ds_logr_esc').val();
        SAM_M0001.ds_compl_esc = $('#sam_h0001-ds_compl_esc').val();
        SAM_M0001.ds_qd_esc = $('#sam_h0001-ds_qd_esc').val();
        SAM_M0001.ds_lt_esc = $('#sam_h0001-ds_lt_esc').val();
        SAM_M0001.nr_end_esc = $('#sam_h0001-nr_end_esc').val();
        SAM_M0001.nr_cep_esc = $('#sam_h0001-nr_cep_esc').val();
        SAM_M0001.nr_fone_01 = $('#sam_h0001-nr_fone_01').val();
        SAM_M0001.nr_fone_02 = $('#sam_h0001-nr_fone_02').val();
        SAM_M0001.nr_fone_03 = $('#sam_h0001-nr_fone_03').val();
        SAM_M0001.st_escola = $('#sam_h0001-st_escola').val();
        SAM_M0001.ds_email_esc = $('#sam_h0001-ds_email_esc').val();
        
        SAM_M0001.alterar(function(retorno){
            if(retorno){                
                self.consultaCodigoEscola();
            }
        });
    }
    self.excluir = function(){

        SAM_M0001.form = self.formName;
        SAM_M0001.cd_escola = $('#sam_h0001-cd_escola').val();
        SAM_M0001.nm_escola = $('#sam_h0001-nm_escola').val();
        SAM_M0001.nm_resp_esc = $('#sam_h0001-nm_resp_esc').val();
        SAM_M0001.cd_munic_esc = $('#sam_h0001-cd_munic_esc').val();
        SAM_M0001.sg_uf = $('#sam_h0001-sg_uf').val();
        SAM_M0001.nm_munic = $('#sam_h0001-nm_munic').val();
        SAM_M0001.nm_bairro_esc = $('#sam_h0001-nm_bairro_esc').val();
        SAM_M0001.ds_logr_esc = $('#sam_h0001-ds_logr_esc').val();
        SAM_M0001.ds_compl_esc = $('#sam_h0001-ds_compl_esc').val();
        SAM_M0001.ds_qd_esc = $('#sam_h0001-ds_qd_esc').val();
        SAM_M0001.ds_lt_esc = $('#sam_h0001-ds_lt_esc').val();
        SAM_M0001.nr_end_esc = $('#sam_h0001-nr_end_esc').val();
        SAM_M0001.nr_cep_esc = $('#sam_h0001-nr_cep_esc').val();
        SAM_M0001.nr_fone_01 = $('#sam_h0001-nr_fone_01').val();
        SAM_M0001.nr_fone_02 = $('#sam_h0001-nr_fone_02').val();
        SAM_M0001.nr_fone_03 = $('#sam_h0001-nr_fone_03').val();
        SAM_M0001.st_escola = $('#sam_h0001-st_escola').val();
        SAM_M0001.ds_email_esc = $('#sam_h0001-ds_email_esc').val();
        
        SAM_M0001.excluir(function(retorno){
            if(retorno){                
                self.limpar();
            }
        });
    }
    self.inicializacao();
});