var SFT_J0003 = function SFT_J0003(){
    
    var oSCP_M0006 = new pacote_SCP.Scp.m0006();
    var oSGA_M0006 = new pacote_SGA.Sga.m0006();
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var oSMG_M0021 = new pacote_SMG.Smg.m0021();
    
    var self = this;
    var $pront = '';
    
    self.formName = 'sft_h0003';
    
    $('#sft_h0003-dt_atend').addClass('isValid[required|justlength(10)|data]').mask("99/99/9999").datepicker({
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        showOn: "button",
        maxDate: data_hoje
    }).change(function(){
        if($('#sft_h0003-dt_atend').val() != ''){
            self.listaProfissionalDataAgenda();
        }
    }).blur(function(){
        if($('#sft_h0003-dt_atend').val() != ''){
            self.listaProfissionalDataAgenda();
        }
    });
    
    $('#sft_h0003-cb_profs').addClass('isValid[required]').change(function(){
        self.listaEspecialidadeDataAgenda();
    });
    
    $('#sft_h0003-cb_espld_medc').addClass('isValid[required]').change(function(){
        $('#sft_h0003-tbl_result #tbody').html('');
        $('#sft_h0003-tbl_atend #tbody').html('');
    });
    
    $('#sft_h0003-btn_limpar').click(function(){
        self.limpar();
    });
    
    self.listaProfissionalDataAgenda = function(){
        
        $('#sft_h0003-cb_profs').html('');
        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#sft_h0003-dt_atend').val();
        oSGA_M0006.ListaProfissionalDataAgenda(function(retorno){
            $('#sft_h0003-cb_profs').html('');
            $('#sft_h0003-cb_profs').append('<option value=""></option>');
            if(retorno.ret != 'false'){
                for(var i in retorno){
                    $('#sft_h0003-cb_profs').append(
                        '<option value='+ retorno[i].cd_prof + '>'+ retorno[i].nm_prof +'</option>'
                    );
                    $('#sft_h0003-cb_espld_medc').html('');
                    $('#sft_h0003-tbl_result #tbody').html('');
                    $('#sft_h0003-tbl_atend #tbody').html('');
                }
            }else{
                if(retorno.mostra == 'true'){
                   msg.alertErro(retorno.msg);
                }
            }
        });
    }
    
    self.listaEspecialidadeDataAgenda = function(){

        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#sft_h0003-dt_atend').val();
        oSGA_M0006.cd_prof =  $('#sft_h0003-cb_profs').val();
        oSGA_M0006.ListaEspecialidadeProfissionalDataAgenda(function(retorno){
            $('#sft_h0003-cb_espld_medc').html('');
            $('#sft_h0003-cb_espld_medc').append('<option value=""></option>');
            if(retorno != false){
                for(var i in retorno){
                    $('#sft_h0003-cb_espld_medc').append(
                        '<option value='+ retorno[i].cd_espld_medc + '>'+ retorno[i].nm_espld_medc +'</option>'
                    );
                    $('#sft_h0003-tbl_result #tbody').html('');
                    $('#sft_h0003-tbl_atend #tbody').html('');
                }
            }
        });
    }
    
    self.listaAgendaProfissionalDia = function(){

        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#sft_h0003-dt_atend').val();
        oSGA_M0006.cd_prof =  $('#sft_h0003-cb_profs').val();
        oSGA_M0006.cd_espld_medc =  $('#sft_h0003-cb_espld_medc').val();
        oSGA_M0006.listaAgendaProfissionalDia(function(retorno){
            $('#sft_h0003-tbl_result #tbody').html(retorno);
        });
    }
    
    self.limpar = function(){
        
        $('#sft_h0003-dt_atend').val('');
        $('#sft_h0003-cb_profs').html('')
        $('#sft_h0003-cb_espld_medc').html('');
        $('#sft_h0003-tbl_result #tbody').html('');
        $('#sft_h0003-tbl_atend #tbody').html('');
        
        $.fn.validar.limparErros();
    }
    
    $('#sft_h0003-btn_consultar').click(function(){
        $('#sft_h0003-tbl_result #tbody').html('');
        $('#sft_h0003-tbl_atend #tbody').html('');
        var campo = '#sft_h0003-dt_atend,#sft_h0003-cb_profs,#sft_h0003-cb_espld_medc';
        if($(campo).validar(true)){
            self.listaAgendaProfissionalDia();
        }
    });
    
    $('#sft_h0003-btn_confirmar').click(function(){
        var campo = '#sft_h0003-dt_atend';
        if($(campo).validar(true)){
            self.confirmar();
        }
    });
    
    
    self.consultaMovProntuario = function(nr_prontuario,cd_pac, st_prontuario){
        
        oSCP_M0006.form = self.formName;
        oSCP_M0006.nr_prontuario = nr_prontuario;
        oSCP_M0006.st_prontuario = st_prontuario;
        oSCP_M0006.cd_pac = cd_pac;
        oSCP_M0006.consultaMovProntuarioPaciente(function(retorno){
            msg.limparMensagem();
            var $div = $('<div class="div-modal"></div>').html(retorno);
            var defaultOptions = {
                modal: true,
                title: 'Cerof',
                resizable: false,
                width: 'auto',
                height: 'auto',
                zIndex: 9999,
                position: ['center', 100],
                dialogClass: 'dialog-scp_h0007-div',
                close:function(){
                    try{
                        $(this).dialog('destroy');
                    }catch(error){}
                }
            }
            $div.dialog(defaultOptions);
        });
    }
    
    self.selecionaProntuario = function(nr_prontuario){
        
       var dados = $('#'+nr_prontuario).data('data');
       var $tr = $("<tr>");
       $tr.attr('id',dados.nr_prontuario);
       $tr.append('<td>'+dados.nr_prontuario+'</td>');
       $tr.append('<td id="'+dados.cd_pac+'">'+dados.nm_pac+'</td>');
       $tr.append('<td>'+self.FormataHora(dados.hr_atend)+'</td>');
       $tr.append('<td>Confirmado</td>');
       
       $('#sft_h0003-tbl_atend #tbody').append($tr);
       
        self.RemoverLinha(nr_prontuario);
    }
    
    self.RemoverLinha = function(nr_prontuario){
        $pront = $pront + nr_prontuario + '|';
        $('#'+nr_prontuario).closest('tr').remove();
    }
    
    self.FormataHora = function(hora){
        return hora.substr(0,2)+':'+hora.substr(2,2);
    }
    
    self.confirmar = function(){
           
        var pront = $pront.substr(0,($pront.length -1));
        var prontuarios = pront.split('|');
        var array = new Array();
        for(i=0;i<prontuarios.length;i++){
            var salvar = {};
            salvar.nr_prontuario = $('#sft_h0003-tbl_atend #'+prontuarios[i]+' td:nth-child(1)').html();
            salvar.cd_pac = $('#'+prontuarios[i]+' td:nth-child(2)')[0]['id'];
            array.push(salvar);
        }
        oSCP_M0005.form = self.formName;
        oSCP_M0005.cd_usu_solic_mov = $('#sft_h0003-cb_profs').val();
        oSCP_M0005.lista = array;
        oSCP_M0005.IncluirSolicitacaoMovimentacaoProntuario(function(retorno){
            if(retorno != false){
                $('#sft_h0003-tbl_result #tbody').html('');
                $('#sft_h0003-tbl_atend #tbody').html('');
            }
        });

    };
    
    self.selecionaPacienteSMS = function(cd_pac){
        alert('Prontuário só pode ser Unificado pelo Arquivo!');
    };
    
    self.confirmaAlteracaoProntuario = function(nr_prontuario, cd_pac){
        oSMG_M0021.form = 'scp_fa014';
        oSMG_M0021.cd_pac_cnes = $('#fa014-cd_pac_cnes').val();
        oSMG_M0021.cd_pac_ant = $('#fa014-cd_pac').val();
        oSMG_M0021.cd_pac_novo = cd_pac;
        oSMG_M0021.nr_prontuario = nr_prontuario;
        oSMG_M0021.confirmaAlteracaoProntuario(function(retorno){
            if(retorno.ret == 'true'){
                $('#dv-dialog-scp_ha014').dialog('destroy');
                msg.alertSucesso(retorno.msg);
                $('#sft_h0003-btn_consultar').click();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.limpar();

};

$(function() {
    new SFT_J0003();
});