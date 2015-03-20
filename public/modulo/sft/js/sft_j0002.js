var SFT_J0002 = function SFT_J0002(){
    
    var SMG_M0008 = new pacote_SMG.Smg.m0008();
    var SMG_M0003 = new pacote_SMG.Smg.m0003();
    var SMG_M0005 = new pacote_SMG.Smg.m0005();
    var SMG_M0010 = new pacote_SMG.Smg.m0010();
    var SGA_M0006 = new pacote_SGA.Sga.m0006();
    var SGA_M0001 = new pacote_SGA.Sga.m0001();
    var SFT_M0001 = new pacote_SFT.Sft.m0001();
    
    var self = this;
    self.formName = 'sft_h0002';
    
    this.init = function(){
        
        $('#sft_h0002-dt_atend').addClass('isValid[required|justlength(10)|data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button",
            maxDate: data_hoje
        });

        $("#sft_h0002-cd_espld_medc").addClass('isValid[required]').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEspecialidade();
            }
        });

        $('#sft_h0002-btn_lista_espld_medc').click(function(){
            self.ConsultaNomeEspecialidade();
        });
        
        $("#sft_h0002-nr_conselho").addClass('isValid[required]').blur(function(){
            if($(this).val() != ''){
                if($('#sft_h0002-cd_conselho').validar(true)){
                    self.ConsultaNumeroConselho();
                }
            }
        });
        
        $('#sft_h0002-btn_lista_profissional').click(function(){
            if($('#sft_h0002-cd_conselho').validar(true)){
                self.consultaNomeProfissional();
            }
        });
        
        $("#sft_h0002-cd_procd_medc").blur(function(){
            if($(this).val() != ''){
                if($('#sft_h0002-dt_atend,#sft_h0002-cd_espld_medc,#sft_h0002-nm_espld_medc,#sft_h0002-cd_conselho,#sft_h0002-nr_conselho,#sft_h0002-nm_prof,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac,#sft_h0002-cd_procd_medc').validar(true)){
                    self.consultaCodigoProcedimento();
                }else{
                    $("#sft_h0002-cd_procd_medc").val('');
                }
            }
        });
        
        $('#sft_h0002-btn_lista_procedimento').click(function(){
            if($('#sft_h0002-dt_atend,#sft_h0002-cd_espld_medc,#sft_h0002-nm_espld_medc,#sft_h0002-cd_conselho,#sft_h0002-nr_conselho,#sft_h0002-nm_prof,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac').validar(true)){
                self.consultaNomeProcedimento();
            }
        });
        
        $("#sft_h0002-cd_grp_consulta").blur(function(){
            if($(this).val() != ''){
                if($('#sft_h0002-dt_atend,#sft_h0002-cd_espld_medc,#sft_h0002-nm_espld_medc,#sft_h0002-cd_conselho,#sft_h0002-nr_conselho,#sft_h0002-nm_prof,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac,#sft_h0002-cd_grp_consulta').validar(true)){
                    self.consultaCodigoGrupoProcedimento();
                }else{
                    $("#sft_h0002-cd_grp_consulta").val('');
                }
            }
        });
        
        $('#sft_h0002-btn_lista_grupo_procedimento').click(function(){
            if($('#sft_h0002-dt_atend,#sft_h0002-cd_espld_medc,#sft_h0002-nm_espld_medc,#sft_h0002-cd_conselho,#sft_h0002-nr_conselho,#sft_h0002-nm_prof,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac').validar(true)){
                self.consultaNomeGrupoProcedimento();
            }
        });
        
        $("#sft_h0002-nm_espld_medc").addClass('isValid[required]');
        $("#sft_h0002-cd_conselho").addClass('isValid[required]');
        $("#sft_h0002-nr_conselho").addClass('isValid[required]');
        $("#sft_h0002-nm_prof").addClass('isValid[required]');
        $('#buscapac-tp_sexo_pac').addClass('isValid[required]');
        $('#buscapac-dt_nasc_pac').addClass('isValid[required]');
        $('#buscapac-nr_cns_pac').addClass('isValid[required]');
        $('#buscapac-nm_pac').addClass('isValid[required]');
        $('#buscapac-nm_mae_pac').addClass('isValid[required]');
        $("#sft_h0002-cd_grp_consulta").addClass('isValid[required]');
        $("#sft_h0002-nm_grp_consulta").addClass('isValid[required]');
        $("#sft_h0002-cd_procd_medc").addClass('isValid[required|justlength(10)]');
        $("#sft_h0002-nm_procd_medc").addClass('isValid[required]');
        
        $('#sft_h0002-btn_add_grp_consulta').click(function(){
            if($('#sft_h0002-cd_grp_consulta,#sft_h0002-nm_grp_consulta').validar(true)){
                if(!$('.grupo_'+$('#sft_h0002-cd_grp_consulta').val()).length){
                    var $opt = $('<option class="grupo_'+$('#sft_h0002-cd_grp_consulta').val()+'">'+$('#sft_h0002-cd_grp_consulta').val()+' - '+$('#sft_h0002-nm_grp_consulta').val()+'</option>');
                    $('#sft_h0002-tbl_result-grupo_consulta').append($opt);
                    $("#sft_h0002-cd_grp_consulta").val('');
                    $("#sft_h0002-nm_grp_consulta").val('');
                    $("#sft_h0002-cd_grp_consulta").focus();
                }else{
                    msg.alertErro('Grupo Consulta já se encontra na Lista!');
                    $("#sft_h0002-cd_grp_consulta").val('');
                    $("#sft_h0002-nm_grp_consulta").val('');
                    $("#sft_h0002-cd_grp_consulta").focus();
                } 
            }
        });
        $('#sft_h0002-btn_rem_grp_consulta').click(function(){
            $('#sft_h0002-tbl_result-grupo_consulta option:selected').remove();
            $("#sft_h0002-cd_grp_consulta").focus();
        });
        
        var i=0;
        $('#sft_h0002-btn_add_procedimento').click(function(){
            if($('#sft_h0002-cd_procd_medc,#sft_h0002-nm_procd_medc').validar(true)){
                var $opt = $('<option class="procd_'+(++i)+'">'+$('#sft_h0002-cd_procd_medc').val()+' - '+$('#sft_h0002-nm_procd_medc').val()+'</option>');
                $('#sft_h0002-tbl_result-procd_medc').append($opt);
                $("#sft_h0002-cd_procd_medc").val('');
                $("#sft_h0002-nm_procd_medc").val('');
                $("#sft_h0002-cd_procd_medc").focus();
            }
        });
        
        $('#sft_h0002-btn_rem_procedimento').click(function(){
            $('#sft_h0002-tbl_result-procd_medc option:selected').remove();
            $("#sft_h0002-cd_procd_medc").focus();
        });

        $('#sft_h0002-btn_agenda').click(function(){
            self.ConsultaAgenda();
        });
        
        $('#sft_h0002-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#sft_h0002-btn_incluir').click(function(){
            var campos = '#sft_h0002-dt_atend,#sft_h0002-cd_espld_medc,#sft_h0002-nm_espld_medc,#sft_h0002-cd_conselho,#sft_h0002-nr_conselho,#sft_h0002-nm_prof,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac';
            if($(campos).validar(true)){
                self.incluir();
            }
        });
        
        self.listaConselho();
    };
    
    this.listaConselho = function(){
        SMG_M0003.form = self.formName;
        SMG_M0003.st_conselho = 0;
        SMG_M0003.ConsultaNomeConselho('sft_h0002-cd_conselho', 0, function(retorno){
            var $option = '<option value=""></option>';
            for (var i=0;i<retorno.dados.length;i++){
                $option+='<option value="'+retorno.dados[i].cd_conselho+'">'+retorno.dados[i].sg_conselho+'</option>';
            }
            $('#sft_h0002-cd_conselho').html($option);
        });
    };
    
    this.ConsultaNumeroConselho = function(){
        SMG_M0005.form = self.formName;
        SMG_M0005.cd_conselho = $('#sft_h0002-cd_conselho').val();
        SMG_M0005.nr_conselho = $('#sft_h0002-nr_conselho').val();
        SMG_M0005.st_conselho = '0';
        SMG_M0005.ConsultaNumeroConselho();
    };
    
    this.consultaNomeProfissional = function(){
        SMG_M0005.form = self.formName;
        SMG_M0005.cd_conselho = $('#sft_h0002-cd_conselho').val();
        SMG_M0005.nm_prof = $('#sft_h0002-nm_prof').val();
        SMG_M0005.ConsultaConselhoNomeProfissional(0);
    };
    
    this.consultaCodigoEspecialidade = function(){
        SMG_M0008.form = self.formName;
        SMG_M0008.cd_espld_medc = $('#sft_h0002-cd_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaCodigoEspecialidade();
    };
    
    this.ConsultaNomeEspecialidade = function(){
        SMG_M0008.form = self.formName;
        SMG_M0008.nm_espld_medc = $('#sft_h0002-nm_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaNomeEspecialidade();
    };
    
    this.consultaCodigoProcedimento = function(){
        SMG_M0010.form = self.formName;
        SMG_M0010.cd_procd_medc = $('#sft_h0002-cd_procd_medc').val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaCodigoProcedimento();
    };
    
    this.consultaNomeProcedimento = function(){
        SMG_M0010.form = self.formName;
        SMG_M0010.nm_procd_medc = $('#sft_h0002-nm_procd_medc').val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaNomeProcedimento(1,function(data){
            $('#sft_h0002-cd_procd_medc').val(data.cd_procd_medc);
            $('#sft_h0002-nm_procd_medc').val(data.nm_procd_medc);
        });
    };
    
    this.consultaCodigoGrupoProcedimento = function(){
        SGA_M0001.form = self.formName;
        SGA_M0001.cd_grp_consulta = $('#sft_h0002-cd_grp_consulta').val();
        SGA_M0001.st_grp_consulta = '0';
        SGA_M0001.consultaCodigoGrupoConsulta();
    };
    
    this.consultaNomeGrupoProcedimento = function(){
        SGA_M0001.form = self.formName;
        SGA_M0001.nm_grp_consulta = $('#sft_h0002-nm_grp_consulta').val();
        SGA_M0001.st_grp_consulta = '0';
        SGA_M0001.consultaNomeGrupoConsulta(1,function(data){
            $('#sft_h0002-cd_grp_consulta').val(data.cd_grp_consulta);
            $('#sft_h0002-nm_grp_consulta').val(data.nm_grp_consulta);
        });
    };
     
    this.ConsultaAgenda = function(){
        
        var campo = '#sft_h0002-dt_atend';
        if($(campo).validar(true)){
            
            SGA_M0006.form = self.formName;
            SGA_M0006.dt_atend = $('#sft_h0002-dt_atend').val();
            //1-Agendado; 2-Confirmado; 8-Encaixe
            SGA_M0006.st_agenda = '1|2|8';
            SGA_M0006.st_fatur = '0';
            SGA_M0006.cd_prof = $('#sft_h0002-cd_prof').val();
            SGA_M0006.cd_espld_medc = $('#sft_h0002-cd_espld_medc').val();
            SGA_M0006.listaAgenda(function(retorno){
                var $div = $('<div class="div-modal"></div>').html(retorno);
                var defaultOptions = {
                    modal: true,
                    title: 'Cerof',
                    resizable: false,
                    width: '1000',
                    height: '400',
                    zIndex: 9999,
                    position: ['center', 100],
                    dialogClass: 'dialog-sft_h0002-div',
                    close:function(){
                        try{
                            $(this).dialog('destroy');
                        }catch(error){}
                    }
                }
                $div.dialog(defaultOptions);
                $('#grid-busca-sft_h0002-listaAgenda').tamanhocolunatabela();
                $('#grid-busca-sft_h0002-listaAgenda .grid_corpo table tbody.grid_corpo').find('tr').click(function(){
                    $('.div-modal').dialog("destroy");
                    self.buscaAgendaPaciente($(this).data().data.cd_agenda);
                });
            });
        }
    };
    
    this.buscaAgendaPaciente = function(cd_agenda){
        SGA_M0006.form = self.formName;
        SGA_M0006.cd_agenda =  cd_agenda;
        SGA_M0006.buscaAgenda(function(retorno){
            if(retorno.ret == 'true'){
                $('#sft_h0002-cd_agenda').val(retorno.dados.cd_agenda);
                $('#sft_h0002-cd_espld_medc').val(retorno.dados.cd_espld_medc);
                $('#sft_h0002-nm_espld_medc').val(retorno.dados.nm_espld_medc);
                $("#sft_h0002-cd_conselho").val(retorno.dados.cd_conselho);
                $("#sft_h0002-nr_conselho").val(retorno.dados.nr_conselho);
                $("#sft_h0002-cd_prof").val(retorno.dados.cd_prof);
                $("#sft_h0002-nm_prof").val(retorno.dados.nm_prof);
                $('#buscapac-tp_sexo_pac').val(retorno.dados.tp_sexo_pac);
                $('#buscapac-dt_nasc_pac').val(retorno.dados.dt_nasc_pac);
                $('#buscapac-nr_cns_pac').val(retorno.dados.nr_cns_pac);
                $('#buscapac-nm_pac').val(retorno.dados.nm_pac);
                $('#buscapac-nm_mae_pac').val(retorno.dados.nm_mae_pac);
                $("#buscapac-cd_pac").val(retorno.dados.cd_pac);
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    };
    
    this.limpar = function(){
        
        $('#sft_h0002-dt_atend').val('');
        $('#sft_h0002-cd_agenda').val('');
        $('#sft_h0002-cd_espld_medc').val('');
        $('#sft_h0002-nm_espld_medc').val('');
        $("#sft_h0002-cd_conselho").val('');
        $("#sft_h0002-nr_conselho").val('');
        $("#sft_h0002-cd_prof").val('');
        $("#sft_h0002-nm_prof").val('');
        $('#buscapac-tp_sexo_pac').val('');
        $('#buscapac-dt_nasc_pac').val('');
        $('#buscapac-nr_cns_pac').val('');
        $('#buscapac-nm_pac').val('');
        $('#buscapac-nm_mae_pac').val('');
        $("#buscapac-cd_pac").val('');
        $('#sft_h0002-cd_grp_consulta').val('');
        $('#sft_h0002-nm_grp_consulta').val('');
        $('#sft_h0002-cd_procd_medc').val('');
        $('#sft_h0002-nm_procd_medc').val('');
        $('#sft_h0002-tbl_result-grupo_consulta').html('');
        $('#sft_h0002-tbl_result-procd_medc').html('');
        $.fn.validar.limparErros();
        msg.limparMensagem();

    };
    
    this.incluir = function(){
        
        SFT_M0001.form = self.formName;
        SFT_M0001.cd_agenda = $('#sft_h0002-cd_agenda').val();
        if($('#sft_h0002-tbl_result-grupo_consulta').length > 0){
            var ArrayDadosGrupoConsulta = Array();
            for (var i=0;i<$('#sft_h0002-tbl_result-grupo_consulta option').length;i++){ 
                ArrayDadosGrupoConsulta[i] = $('#sft_h0002-tbl_result-grupo_consulta')[0][i].value;
            }
        }
        if($('#sft_h0002-tbl_result-procd_medc').length > 0){
            var ArrayDadosProcedimento = Array();
            for (var i=0;i<$('#sft_h0002-tbl_result-procd_medc option').length;i++){ 
                ArrayDadosProcedimento[i] = $('#sft_h0002-tbl_result-procd_medc')[0][i].value;
            }
        }
        SFT_M0001.cd_prof = $('#sft_h0002-cd_prof').val();
        SFT_M0001.cd_espld_medc = $('#sft_h0002-cd_espld_medc').val();
        SFT_M0001.cd_pac = $('#buscapac-cd_pac').val();
        SFT_M0001.dt_atend = $('#sft_h0002-dt_atend').val();
        SFT_M0001.Incluir(ArrayDadosGrupoConsulta,ArrayDadosProcedimento,function(retorno){
            if(retorno.ret == 'true'){
                self.limpar();
                msg.alertSucesso(retorno.msg);
            }
        });
    };
    
    this.init();
};

$(function() {
    new SFT_J0002();
});