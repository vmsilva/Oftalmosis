var SMG_J0020 = function SMG_J0020(){
    
    var oSCP_M0002 = new pacote_SCP.Scp.m0002;
    var SMG_M0014 = new pacote_SMG.Smg.m0014;
    var SGM_M0001 = new pacote_SGM.Sgm.m0001;
    var SGM_M0003 = new pacote_SGM.Sgm.m0003;
    var self = this;

    self.formName = 'smg_h0020';
    
    self.inicializacao = function(){
        
        $("#smg_h0020-nm_pac").addClass('isValid[required]');
        $("#smg_h0020-tp_sexo_pac").addClass('isValid[required|listEnum(M,F)]');
        $("#smg_h0020-dt_nasc_pac").addClass('isValid[required|data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button",
            maxDate: data_hoje
        });
        $("#smg_h0020-cd_pais_orig_pac").addClass('isValid[required|integer|minlength(2)|maxlength(3)]');
        $("#smg_h0020-nm_pais_orig_pac").addClass('isValid[required]');
        
        
        $("#smg_h0020-cd_munic_nasc_pac").addClass('isValid[required|integer|justlength(6)]');
        $("#smg_h0020-sg_uf_nasc_pac").addClass('isValid[required|listEnum(AC,AL,AM,AP,BA,CE,DF,ES,FN,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO)]');
        $("#smg_h0020-nm_munic_nasc_pac").addClass('isValid[required]');
        $("#smg_h0020-nm_mae_pac").addClass('isValid[required]');
        $("#smg_h0020-cd_munic_nasc_mae_pac").addClass('isValid[integer|justlength(6)]');
        $("#smg_h0020-sg_uf_nasc_mae_pac").addClass('isValid[listEnum(AC,AL,AM,AP,BA,CE,DF,ES,FN,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO)]');
        $("#smg_h0020-nm_munic_nasc_mae_pac");

        $('#smg_h0020-nr_prontuario').on('pesquisa',function(){
            if($('#smg_h0020-nr_prontuario').val() != ''){
                if(parseInt($('#smg_h0020-nr_prontuario').val().length) == 10){
                    self.consultaProntuario();
                }
            }
        }).keypress(function(event){
         //leitora optica
      
           if(event.which == 106 || event.which == 0){
                event.preventDefault();
                $(this).trigger('pesquisa');
                return true;
           }
        }).setMask({mask:'aa99999999'});
        
        $('#smg_h0020-btn_limpar').click(function(){
            self.limpar();
        });
        $('#smg_h0020-btn_alterar').click(function(){
            var campo = '#smg_h0020-nm_pac,#smg_h0020-tp_sexo_pac,#smg_h0020-dt_nasc_pac,#smg_h0020-cd_pais_orig_pac,#smg_h0020-nm_pais_orig_pac,#smg_h0020-cd_munic_nasc_pac,#smg_h0020-sg_uf_nasc_pac,#smg_h0020-nm_munic_nasc_pac,#smg_h0020-nm_mae_pac';
            if($(campo).validar(true)){
                self.alterar();
            }
        });

        self.limpar();
    }
    
    
    //Busca Nacionalidade Paciente
    $("#smg_h0020-cd_pais_orig_pac").blur(function(){
        var campo = '#smg_h0020-cd_pais_orig_pac';
            if($(campo).validar(true)){
                self.ConsultaCodigoPais();
            }
    });

    self.ConsultaCodigoPais = function(){
        
        SGM_M0001.form = self.formName;
        SGM_M0001.cd_pais = $("#smg_h0020-cd_pais_orig_pac").val();
        SGM_M0001.consultaCodigoPais('nm_pais_orig_pac');
    }
    
    $('#smg_h0020-btn_pais_orig_pac').click(function(){
        nm_campo_busca = 'cd_pais_orig_pac,nm_pais_orig_pac'
        self.ConsultaNomePais(nm_campo_busca);
    });
    
    self.ConsultaNomePais = function(){

        SGM_M0001.form = self.formName;
        SGM_M0001.nm_pais = $("#smg_h0020-nm_pais_orig_pac").val();
        nm_campo_busca = 'cd_pais_orig_pac,nm_pais_orig_pac';
        SGM_M0001.ConsultaNomePais(nm_campo_busca);
        
    }
    
    //Busca Município de Nascimento Paciente
    $("#smg_h0020-cd_munic_nasc_pac").blur(function(){
        var campo = '#smg_h0020-cd_munic_nasc_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.cd_munic = $("#smg_h0020-cd_munic_nasc_pac").val();
                nm_campo = 'cd_munic_nasc_pac,sg_uf_nasc_pac,nm_munic_nasc_pac';
                SGM_M0003.consultaCodigoMunicipio(nm_campo);
            }else{
                $("#smg_h0020-cd_munic_nasc_pac").val('');
            }
    });

    $('#smg_h0020-btn_munic_nasc_pac').click(function(){
        var campo = '#smg_h0020-sg_uf_nasc_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.sg_uf = $("#smg_h0020-sg_uf_nasc_pac").val();
                nm_campo_busca = 'cd_munic_nasc_pac,sg_uf_nasc_pac,nm_munic_nasc_pac';
                SGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0020-nm_munic_nasc_pac").val('');
            }

    });

    //Busca Município de Nascimento da Mãe Paciente
    $("#smg_h0020-cd_munic_nasc_mae_pac").blur(function(){
        var campo = '#smg_h0020-cd_munic_nasc_mae_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.cd_munic = $("#smg_h0020-cd_munic_nasc_mae_pac").val();
                nm_campo = 'cd_munic_nasc_mae_pac,sg_uf_nasc_mae_pac,nm_munic_nasc_mae_pac';
                SGM_M0003.consultaCodigoMunicipio(nm_campo);
            }else{
                $("#smg_h0020-cd_munic_nasc_mae_pac").val('');
            }
    });

    $('#smg_h0020-btn_munic_nasc_mae_pac').click(function(){
        var campo = '#smg_h0020-sg_uf_nasc_mae_pac';
            if($(campo).validar(true)){
                SGM_M0003.form = self.formName;
                SGM_M0003.sg_uf = $("#smg_h0020-sg_uf_nasc_mae_pac").val();
                nm_campo_busca = 'cd_munic_nasc_mae_pac,sg_uf_nasc_mae_pac,nm_munic_nasc_mae_pac';
                SGM_M0003.ConsultaNomeMunicipio(nm_campo_busca);
            }else{
                $("#smg_h0020-nm_munic_nasc_mae_pac").val('');
            }
    });

    self.limpar = function(){

        $('#smg_h0020-nr_prontuario').val('');
        $("#smg_h0020-nm_pac").val('');
        $("#smg_h0020-tp_sexo_pac").val('');
        $("#smg_h0020-dt_nasc_pac").val('');
        $("#smg_h0020-cd_pais_orig_pac").val('');
        $("#smg_h0020-nm_pais_orig_pac").val('');
        $("#smg_h0020-cd_munic_nasc_pac").val('');
        $("#smg_h0020-sg_uf_nasc_pac").val('');
        $("#smg_h0020-nm_munic_nasc_pac").val('');
        $("#smg_h0020-nm_mae_pac").val('');
        $("#smg_h0020-cd_munic_nasc_mae_pac").val('');
        $("#smg_h0020-sg_uf_nasc_mae_pac").val('');
        $("#smg_h0020-nm_munic_nasc_mae_pac").val('');
        $.fn.validar.limparErros();
        
    }
    
    self.consultaProntuario = function(){
        
        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#smg_h0020-nr_prontuario').val();
        oSCP_M0002.st_prontuario = '1|2';
        oSCP_M0002.consultaProntuario(function(retorno){
            if(retorno){
                $("#smg_h0020-nr_prontuario").val(retorno.nr_prontuario);
                $("#smg_h0020-cd_pac").val(retorno.cd_pac);
                $("#smg_h0020-nm_pac").val(retorno.nm_pac);
                $("#smg_h0020-tp_sexo_pac").val(retorno.tp_sexo_pac);
                $("#smg_h0020-dt_nasc_pac").val(retorno.dt_nasc_pac);
                $("#smg_h0020-cd_pais_orig_pac").val(retorno.cd_pais_orig_pac);
                $("#smg_h0020-nm_pais_orig_pac").val(retorno.nm_pais_orig_pac);
                $("#smg_h0020-cd_munic_nasc_pac").val(retorno.cd_munic_nasc_pac);
                $("#smg_h0020-sg_uf_nasc_pac").val(retorno.sg_uf_nasc_pac);
                $("#smg_h0020-nm_munic_nasc_pac").val(retorno.nm_munic_nasc_pac);
                $("#smg_h0020-nm_mae_pac").val(retorno.nm_mae_pac);
                $("#smg_h0020-cd_munic_nasc_mae_pac").val(retorno.cd_munic_nasc_mae_pac);
                $("#smg_h0020-sg_uf_nasc_mae_pac").val(retorno.sg_uf_nasc_mae_pac);
                $("#smg_h0020-nm_munic_nasc_mae_pac").val(retorno.nm_munic_nasc_mae_pac);
            }
        });
    }

    self.alterar = function(){
        
        SMG_M0014.form = self.formName;
        SMG_M0014.cd_pac = $("#smg_h0020-cd_pac").val();
        SMG_M0014.nm_pac = $("#smg_h0020-nm_pac").val();
        SMG_M0014.tp_sexo_pac = $("#smg_h0020-tp_sexo_pac").val();
        SMG_M0014.dt_nasc_pac = $("#smg_h0020-dt_nasc_pac").val();
        SMG_M0014.cd_pais_orig_pac = $("#smg_h0020-cd_pais_orig_pac").val();
        SMG_M0014.nm_pais_orig_pac = $("#smg_h0020-nm_pais_orig_pac").val();
        SMG_M0014.cd_munic_nasc_pac = $("#smg_h0020-cd_munic_nasc_pac").val();
        SMG_M0014.sg_uf_nasc_pac = $("#smg_h0020-sg_uf_nasc_pac").val();
        SMG_M0014.nm_munic_nasc_pac = $("#smg_h0020-nm_munic_nasc_pac").val();
        SMG_M0014.nm_mae_pac = $("#smg_h0020-nm_mae_pac").val();
        SMG_M0014.cd_munic_nasc_mae_pac = $("#smg_h0020-cd_munic_nasc_mae_pac").val();
        SMG_M0014.sg_uf_nasc_mae_pac = $("#smg_h0020-sg_uf_nasc_mae_pac").val();
        SMG_M0014.nm_munic_nasc_mae_pac = $("#smg_h0020-nm_munic_nasc_mae_pac").val();
        SMG_M0014.alterarPaciente(function(retorno){
            if(retorno){
                self.consultaProntuario($("#smg_h0020-nr_prontuario").val());
            }
        });   
    }
    
    self.inicializacao();    
};

$(function() {
    new SMG_J0020();
});