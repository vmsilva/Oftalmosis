var SGA_JA007 = function SGA_JA007(){
    
    var SMG_M0003 = new pacote_SMG.Smg.m0003;
    var SMG_M0004 = new pacote_SMG.Smg.m0004;
    var SMG_M0005 = new pacote_SMG.Smg.m0005;
    var SMG_M0008 = new pacote_SMG.Smg.m0008;
    var SGA_M0006 = new pacote_SGA.Sga.m0006();
    var SGA_M0007 = new pacote_SGA.Sga.m0007;
    var self = this;
    self.formName = 'sga_h0007';
    
    self.inicializar = function(){
        
        $('#sga_h0007-nr_cnes').attr('disabled',true);
        $('#sga_h0007-nm_cnes').attr('disabled',true);
   
        $("#sga_h0007-cd_espld_medc").addClass('isValid[required]').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEspecialidade();
            }
        });
        
        $("#sga_h0007-nm_espld_medc").addClass('isValid[required]');
        $("#sga_h0007-cd_conselho").addClass('isValid[required]').attr('disabled',true);
        $("#sga_h0007-nr_conselho").addClass('isValid[required]');
        $("#sga_h0007-nm_prof").addClass('isValid[required]');
        $('#buscapac-tp_sexo_pac').addClass('isValid[required]');
        $('#buscapac-dt_nasc_pac').addClass('isValid[required]');
        $('#buscapac-nr_cns_pac').addClass('isValid[required]');
        $('#buscapac-nm_pac').addClass('isValid[required]');
        $('#buscapac-nm_mae_pac').addClass('isValid[required]');
        
        $('#sga_h0007-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#sga_h0007-btn_incluir').click(function(){
            self.incluir();
        });
        
        $('#sga_h0007-btn_agenda').click(function(){
            self.listaConselho();
            self.agendamento();
        });
    }
    
    self.agendamento = function(){
        
        var campo = '#sga_h0007-tp_atend,#sga_h0007-st_atend,#sga_h0007-nr_cnes,#sga_h0007-nm_cnes';
        if($(campo).validar(true)){
            if($('#sga_h0007-nr_cnes').val() != ''){
                SGA_M0006.form = self.formName;
                SGA_M0006.cd_cnes =  $('#sga_h0007-cd_cnes').val();
                SGA_M0006.listaAgendaDia(function(retorno){
                    var $div = $('<div class="div-modal"></div>').html(retorno);
                    var defaultOptions = {
                        modal: true,
                        title: 'Cerof',
                        resizable: false,
                        width: '1000',
                        height: '400',
                        zIndex: 9999,
                        position: ['center', 100],
                        dialogClass: 'dialog-sga_h0007-div',
                        close:function(){
                            try{
                                $(this).dialog('destroy');
                            }catch(error){}
                        }
                    }
                    $div.dialog(defaultOptions);
                    $('#grid-busca-sga_h0007-listaAgendaDia').tamanhocolunatabela();
                    $('#grid-busca-sga_h0007-listaAgendaDia .grid_corpo table tbody.grid_corpo').find('tr').click(function(){
                        $('.div-modal').dialog("destroy");
                        self.buscaAgendaPaciente($(this).data().data.cd_agenda);
                    });
//                    $('.filtrar').keyup(function(){
//                        $('#grid-busca-sga_h0007-listaAgendaDia .grid_corpo table tbody.grid_corpo tr td:nth-child("1")').each(function(){
//                            if($(this).text().toUpperCase().indexOf($('.filtrar').val()) < 0){
//                                $(this).parent().hide();
//                            }
//                        });
//                    });
                });
            }else{
                msg.alertErro('Unidade não Informada!');
            }
        }
    }
    
    self.buscaAgendaPaciente = function(cd_agenda){
        SGA_M0006.form = self.formName;
        SGA_M0006.cd_agenda =  cd_agenda;
        SGA_M0006.buscaAgenda(function(retorno){
            if(retorno.ret == 'true'){
                $('#sga_h0007-cd_agenda').val(retorno.dados.cd_agenda);
                $('#sga_h0007-cd_espld_medc').val(retorno.dados.cd_espld_medc);
                $('#sga_h0007-nm_espld_medc').val(retorno.dados.nm_espld_medc);
                $("#sga_h0007-cd_conselho").val(retorno.dados.cd_conselho);
                $("#sga_h0007-nr_conselho").val(retorno.dados.nr_conselho);
                $("#sga_h0007-cd_prof").val(retorno.dados.cd_prof);
                $("#sga_h0007-nm_prof").val(retorno.dados.nm_prof);
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
    }
    
    self.consultaCodigoEspecialidade = function(){
        
        SMG_M0008.form = self.formName;
        SMG_M0008.cd_espld_medc = $('#sga_h0007-cd_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaCodigoEspecialidade();
    };
    
    self.ConsultaNomeEspecialidade = function(){

        SMG_M0008.form = self.formName;
        SMG_M0008.nm_espld_medc = $('#sga_h0007-nm_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaNomeEspecialidade();
        
    };
    
    self.limpar = function(){
        
        $("#sga_h0007-cd_espld_medc").val('');
        $("#sga_h0007-nm_espld_medc").val('');
        $("#sga_h0007-cd_conselho").val('');
        $("#sga_h0007-nr_conselho").val('');
        $("#sga_h0007-nm_prof").val('');
        $('#sga_h0007-cd_fila').val('');
        $("#sga_h0007-tbl_result").html('');
        $('#sga_h0007-cd_agenda').val('');
        $('#buscapac-tp_sexo_pac').val('');
        $('#buscapac-dt_nasc_pac').val('');
        $('#buscapac-nr_cns_pac').val('');
        $('#buscapac-nm_pac').val('');
        $('#buscapac-nm_mae_pac').val('');
        $.fn.validar.limparErros();
        self.listaFilaAtendimentoAtual();
    };
    
    self.incluir = function(){
        
        var campo = '#sga_h0007-tp_atend,#sga_h0007-st_atend,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac,#sga_h0007-cd_espld_medc,#sga_h0007-nm_espld_medc,#sga_h0007-cd_conselho,#sga_h0007-nr_conselho,#sga_h0007-nm_prof';
        if($(campo).validar(true)){
            
            SGA_M0007.form = self.formName;
            SGA_M0007.cd_agenda = $("#sga_h0007-cd_agenda").val();
            SGA_M0007.cd_cnes = $("#sga_h0007-cd_cnes").val();
            SGA_M0007.cd_prof = $("#sga_h0007-cd_prof").val();
            SGA_M0007.cd_espld_medc = $("#sga_h0007-cd_espld_medc").val();
            SGA_M0007.in_servico = $("#sga_h0007-in_servico").val();
            SGA_M0007.tp_atend = $("#sga_h0007-tp_atend").val();
            SGA_M0007.cd_pac = $("#buscapac-cd_pac").val();
            SGA_M0007.incluir(function(retorno){
                if(retorno.ret == 'true'){
                    msg.alertSucesso(retorno.msg);
                    self.limpar();
                    $('#buscapac-btn_limpar_pac').click();
                    self.listaFilaAtendimentoAtual();
                }else{
                    msg.alertErro(retorno.msg);
                }
            });
        }
    };
    
    self.listaConselho = function(){
        
        SMG_M0003.form = self.formName;
        SMG_M0003.st_conselho = '0';
        nm_campo_busca = 'sg_conselho';
        SMG_M0003.ConsultaNomeConselho('#sga_h0007-cd_conselho',0, function(retorno){
            for(var i in retorno.dados){
                $('#sga_h0007-cd_conselho').append('<option value="'+retorno.dados[i].cd_conselho+'">'+retorno.dados[i].sg_conselho+'</option>');
            }
        });
    }
    
    self.consultaNumeroConselho = function(){

        SMG_M0005.form = self.formName;
        SMG_M0005.cd_conselho = $('#sga_h0007-cd_conselho').val();
        SMG_M0005.nr_conselho = $('#sga_h0007-nr_conselho').val();
        SMG_M0005.st_conselho = '0';
        SMG_M0005.ConsultaNumeroConselho();
    };
    
    self.ConsultaNomeProfissional = function(){

        SMG_M0004.form = self.formName;
        SMG_M0004.cd_conselho = $('#sga_h0007-cd_conselho').val();
        SMG_M0004.nr_conselho = $('#sga_h0007-nr_conselho').val();
        SMG_M0004.st_conselho = '0';
        SMG_M0004.ConsultaNomeProfissional();
    };

    self.inicializar();
    
};

$(function() {
    new SGA_JA007();
});