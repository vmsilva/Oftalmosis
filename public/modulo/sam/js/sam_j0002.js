$(function SCA_J0002(){

    var SAM_M0001 = new pacote_SAM.Sam.m0001;
    var SAM_M0002 = new pacote_SAM.Sam.m0002;
    var SGA_M0004 = new pacote_SGA.Sga.m0004;
    //var SGA_M0006 = new pacote_SGA.Sga.m0006;
    var SMG_M0003 = new pacote_SMG.Smg.m0003;
    var SMG_M0004 = new pacote_SMG.Smg.m0004;
    var SMG_M0005 = new pacote_SMG.Smg.m0005;
    var SMG_M0008 = new pacote_SMG.Smg.m0008;
    var self = this;
    self.formName = 'sam_h0002';
    
    self.inicializacao = function(){
        
        $('#buscapac-cd_pac').addClass('isValid[required|integer]');
        $('#buscapac-tp_sexo_pac').addClass('isValid[required]');
        $('#buscapac-dt_nasc_pac').addClass('isValid[required|data]');
        $('#buscapac-nr_cns_pac').addClass('isValid[required|integer]');
        $('#buscapac-cd_pac').addClass('isValid[required]');
        $('#buscapac-nm_pac').addClass('isValid[required]');
        $('#buscapac-nm_mae_pac').addClass('isValid[required]');
        
        $("#sam_h0002-cd_escola").addClass('isValid[required|integer]');
        $('#sam_h0002-cd_escola').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEscola();
            }
        });
        
        $("#sam_h0002-nm_escola").addClass('isValid[required');
        $('#sam_h0002-btn_lista_escola').click(function(){
            self.consultaNomeEscola();
        });
        $("#sam_h0002-in_turno").addClass('isValid[required|enum(0|1|2)]');
        $("#sam_h0002-in_diabetico").addClass('isValid[required|enum(S|N)]');
        $("#sam_h0002-cd_conselho").addClass('isValid[required]');
        $("#sam_h0002-nr_conselho").addClass('isValid[required|integer]');
        $('#sam_h0002-nr_conselho').blur(function(){
            var campo = '#sam_h0002-cd_conselho';
            if($(campo).validar(true)){
                self.consultaNumeroConselho();
            }
        });
        
        $("#sam_h0002-nm_prof").addClass('isValid[required]');
        $('#sam_h0002-btn_lista_profissional').click(function(){
            self.ConsultaNomeProfissional();
        });
        $("#sam_h0002-cd_espld_medc").addClass('isValid[required]');
        $('#sam_h0002-cd_espld_medc').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEspecialidade();
            }
        });
        $("#sam_h0002-nm_espld_medc").addClass('isValid[required]');
        $('#sam_h0002-btn_lista_espld_medc').click(function(){
            self.ConsultaNomeEspecialidade();
        });
        
        
        $('#sam_h0002-nm_tp_consulta').addClass('isValid[required]');
        $("#sam_h0002-dt_atend").addClass('isValid[required|data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button",
            maxDate: data_hoje
        });
        
        self.limpar();
        self.listaConselho();
        self.listaTipoGrade();
    }


    self.habilitarBotoes = function(flag) {
        $('#sam_h0002-btn_incluir').attr('disabled', !flag);
    };

    
    $('#sam_h0002-btn_limpar').click(function(){
        self.limpar();
    });
    $('#sam_h0002-btn_incluir').click(function(){
        var campo = "#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nm_pac,#buscapac-cd_pac,#buscapac-nm_mae_pac,#sam_h0002-cd_escola,#sam_h0002-nm_escola,#sam_h0002-in_turno,#sam_h0002-in_diabetico,#sam_h0002-cd_conselho,#sam_h0002-nr_conselho,#sam_h0002-nm_prof,#sam_h0002-cd_espld_medc,#sam_h0002-nm_espld_medc,#sam_h0002-nm_tp_consulta,#sam_h0002-dt_atend";
        if($(campo).validar(true)){
            self.incluir();
        }
    });

    self.limpar = function(){
        
        //Paciente
        $("#buscapac-tp_sexo_pac").val('');
        $("#buscapac-dt_nasc_pac").val('');
        $("#buscapac-nr_cns_pac").val('');
        $("#buscapac-nm_pac").val('');
        $("#buscapac-cd_pac").val('');
        $("#buscapac-nm_mae_pac").val('');
        //Ficha
        $("#sam_h0002-cd_escola").val('');
        $("#sam_h0002-nm_escola").val('');
        $("#sam_h0002-in_turno").val('');
        $("#sam_h0002-in_diabetico").val('');
        
        $("#sam_h0002-cd_conselho").val('');
        $("#sam_h0002-nr_conselho").val('');
        $("#sam_h0002-cd_prof").val('');
        $("#sam_h0002-nm_prof").val('');
        
        $("#sam_h0002-cd_espld_medc").val('');
        $("#sam_h0002-nm_espld_medc").val('');
        
        $("#sam_h0002-nm_tp_consulta").val('');
        $("#sam_h0002-dt_atend").val('');
        
        $("#sam_h0002-ds_hist_atual_doenca").val('');
        $("#sam_h0002-ds_anteced").val('');
        $("#sam_h0002-ds_ectoscopia").val('');
        $("#sam_h0002-in_av_sc_od").val('');
        $("#sam_h0002-in_av_sc_oe").val('');
        $("#sam_h0002-in_oc_od").val('');
        $("#sam_h0002-in_oc_oe").val('');
        $("#sam_h0002-in_rf_dn_od").val('');
        $("#sam_h0002-in_rf_dn_oe").val('');
        $("#sam_h0002-ds_conduta").val('');
       
        $.fn.validar.limparErros();
    }
    
    self.consultaCodigoEscola = function(){
        SAM_M0001.form = self.formName;
        SAM_M0001.cd_escola = $('#sam_h0002-cd_escola').val();
        SAM_M0001.st_escola = '0';
        SAM_M0001.consultaCodigoEscola();
    }  
    
    
    self.consultaNomeEscola = function(){
        SAM_M0001.form = self.formName;
        SAM_M0001.st_escola = '0|1';
        nm_campo_busca = 'cd_escola,nm_escola';
        SAM_M0001.ConsultaNomeEscola();
    }
    
    self.listaConselho = function(){
        SMG_M0003.form = self.formName;
        SMG_M0003.st_conselho = '0';
        nm_campo_busca = 'sg_conselho';
        SMG_M0003.ConsultaNomeConselho('#sam_h0002-cd_conselho',0, function(retorno){
            for(var i in retorno){
                $('#sam_h0002-cd_conselho').append('<option value="'+i+'">'+retorno[i]+'</option>');
            }
        });
    }
    
    self.consultaNumeroConselho = function(){

        SMG_M0005.form = self.formName;
        SMG_M0005.cd_conselho = $('#sam_h0002-cd_conselho').val();
        SMG_M0005.nr_conselho = $('#sam_h0002-nr_conselho').val();
        SMG_M0005.st_conselho = '0';
        SMG_M0005.ConsultaNumeroConselho();
    }
    
    self.ConsultaNomeProfissional = function(){

        SMG_M0004.form = self.formName;
        SMG_M0004.cd_conselho = $('#sam_h0002-cd_conselho').val();
        SMG_M0004.nr_conselho = $('#sam_h0002-nr_conselho').val();
        SMG_M0004.st_conselho = '0';
        SMG_M0004.ConsultaNomeProfissional();
    }
    
    self.consultaCodigoEspecialidade = function(){
        
        SMG_M0008.form = self.formName;
        SMG_M0008.cd_espld_medc = $('#sam_h0002-cd_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaCodigoEspecialidade();
    }
    
    self.ConsultaNomeEspecialidade = function(){

        SMG_M0008.form = self.formName;
        SMG_M0008.nm_espld_medc = $('#sam_h0002-nm_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaNomeEspecialidade();
        
    }
    
    self.listaTipoGrade = function(){
        SGA_M0004.form = self.formName;
        SGA_M0004.st_tp_grade = '0';
        nm_campo_busca = 'nm_tp_grade';
        SGA_M0004.ConsultaNomeTipoGrade('#sam_h0002-nm_tp_consulta',0, function(retorno){
            for(var i in retorno){
                $('#sam_h0002-nm_tp_consulta').append('<option value="'+i+'">'+retorno[i]+'</option>');
            }
        });
    }
    
    self.incluir = function(){

        SAM_M0002.form = self.formName;
        SAM_M0002.cd_pac = $("#buscapac-cd_pac").val();
        SAM_M0002.cd_escola = $('#sam_h0002-cd_escola').val();
        SAM_M0002.in_turno = $("#sam_h0002-in_turno").val();
        SAM_M0002.in_diabetico = $("#sam_h0002-in_diabetico").val();
        SAM_M0002.cd_conselho = $("#sam_h0002-cd_conselho").val();
        SAM_M0002.nr_conselho = $("#sam_h0002-nr_conselho").val();
        SAM_M0002.cd_prof = $("#sam_h0002-cd_prof").val();
        SAM_M0002.cd_espld_medc = $("#sam_h0002-cd_espld_medc").val();
        SAM_M0002.cd_tp_grade = $("#sam_h0002-nm_tp_consulta").val();
        SAM_M0002.tp_atend = '3';
        SAM_M0002.st_fila = '1';
        SAM_M0002.st_atend = '1';
        SAM_M0002.dt_atend = $("#sam_h0002-dt_atend").val();
        SAM_M0002.ds_hist_atual_doenca = $("#sam_h0002-ds_hist_atual_doenca").val();
        SAM_M0002.ds_anteced = $("#sam_h0002-ds_anteced").val();
        SAM_M0002.ds_ectoscopia = $("#sam_h0002-ds_ectoscopia").val();
        SAM_M0002.in_av_sc_od = $("#sam_h0002-in_av_sc_od").val();
        SAM_M0002.in_av_sc_oe = $("#sam_h0002-in_av_sc_oe").val();
        SAM_M0002.in_oc_od = $("#sam_h0002-in_oc_od").val();
        SAM_M0002.in_oc_oe = $("#sam_h0002-in_oc_oe").val();
        SAM_M0002.in_rf_dn_od = $("#sam_h0002-in_rf_dn_od").val();
        SAM_M0002.in_rf_dn_oe = $("#sam_h0002-in_rf_dn_oe").val();
        SAM_M0002.ds_conduta = $("#sam_h0002-ds_conduta").val();;
        
        SAM_M0002.incluirAtendimentoManual(function(retorno){
            if(retorno){                
                self.limpar();
            }
        });
    }
    
    self.inicializacao();
});