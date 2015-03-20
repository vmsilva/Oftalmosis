$(function SCP_J0007(){
    
    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var oSCP_M0006 = new pacote_SCP.Scp.m0006();
    var oSMG_M0014 = new pacote_SMG.Smg.m0014();
    var self = this;

    self.formName = 'scp_h0007';
    
    self.inicializacao = function(){
        
        $("#scp_h0007-tp_sexo_pac").addClass('isValid[required|listEnum(M,F)]');
        $('#scp_h0007-dt_nasc_pac').addClass('isValid[data]').mask("99/99/9999").datepicker({
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                showOn: "button",
                maxDate: data_hoje
        });
    
        $('#scp_h0007-nm_pac').addClass('isValid[required]');
        $('#scp_h0007-tp_sexo_pac').click(function(){
            self.consultaDadosPaciente();
        });
    
        $('#scp_h0007-dt_nasc_pac').change(function(){
            self.consultaDadosPaciente();
        });
    
        $('#scp_h0007-dt_nasc_pac').focus(function(){
            self.consultaDadosPaciente();
        });

        $('#scp_h0007-nm_pac,#scp_h0007-nm_mae_pac').keyup(function(){
            self.consultaDadosPaciente();
        });
 

        $('#scp_h0007-nr_prontuario').on('pesquisa',function(){
            if($('#scp_h0007-nr_prontuario').val() != ''){
                if(parseInt($('#scp_h0007-nr_prontuario').val().length) == 10){
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
        
        $('#scp_h0007-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#scp_h0007-btn_confirmar').click(function(){
            self.confirmar();
        });
        
        self.limpar();
    }
    

    self.limpar = function(){
        
        $('#scp_h0007-nr_solic_pront').val('');
        $('#scp_h0007-dt_solic_pront').val(data_hoje);
        $('#scp_h0007-hr_solic_pront').val(hora_hoje).setMask({mask:'99:99'});
        $('#scp_h0007-nr_prontuario').val('');
        $('#scp_h0007-cd_pac').val('');
        $('#scp_h0007-nm_pac').val('');
        $('#scp_h0007-nm_mae_pac').val('');
        $('#scp_h0007-dt_nasc_pac').val('');
        $('#scp_h0007-tp_sexo_pac').val('');
        $('#scp_h0007-nr_cns_pac').val('');
        $('#scp_h0007-tbl_result table tbody').html('');
        $('#scp_h0007-tbl_solic table tbody').html('');
        $.fn.validar.limparErros();
        
    }
    
    self.consultaProntuario = function(){

        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#scp_h0007-nr_prontuario').val();
        oSCP_M0002.st_prontuario = '2';
        oSCP_M0002.consultaProntuario(function(retorno){
            if(retorno){
                var $tr = $('<tr>');
                //um para cada coluna
                $tr.addClass(retorno.nr_prontuario);
                $tr.append('<td class="td_pro">'+retorno.nr_prontuario+'</td>');
                $tr.append('<td class="td_pac">'+retorno.nm_pac+'</td>');
                $tr.append('<td class="td_sex">'+retorno.tp_sexo_pac+'</td>');
                $tr.append('<td class="td_dtn">'+retorno.dt_nasc_pac+'</td>');
                $tr.append('<td class="td_mae">'+retorno.nm_mae_pac+'</td>');
                $tr.append('<td class="td_lnk"><a class="link_ex" onclick="RemoverLinha(this);"></a></td>');
                $tr.data(retorno);
                if(!$('.'+retorno.nr_prontuario).length){
                    var $table =  $('#scp_h0007-tbl_solic table tbody');
                    var $firstTr = $table.find('tr:first-child');
                    if($firstTr.length){
                       $tr.insertBefore($firstTr);
                    }else {
                        $table.append($tr);
                    }
                    $.fn.validar.limparErros();
                    msg.limparMensagem();
                }else{
                    msg.alertErro('Prontuário já se Encontra na Lista: ' + retorno.nr_prontuario);
                }
                $('#scp_h0007-nr_prontuario').val('');
            }
            $('#grid-busca-scp_h0007-tbl_solic').tamanhocoluna();
        });
        
        self.RemoverLinha = function(nr_prontuario){
            $(nr_prontuario).closest('tr').remove();
        }
    }
    
    self.confirmar = function(){
        
        var dados = [];
        $('#scp_h0007-tbl_solic table tbody tr').each(function(){
            dados.push($(this).data());
        });
        if(!dados.length){
            msg.alertErro('Nenhum Prontuário Informado na Lista!');
            return;
        }

        oSCP_M0005.form = self.formName;
        oSCP_M0005.lista = dados;
        oSCP_M0005.IncluirSolicitacaoMovimentacaoProntuario(function(retorno){
            if(retorno){ 
                $('#scp_h0007-tbl_solic table tbody').html('');
            }
        });
    }
    
    self.consultaDadosPaciente = function(){
        
        var campo = '#scp_h0007-tp_sexo_pac,#scp_h0007-nm_pac';
        if($(campo).validar(true)){
            oSMG_M0014.form = self.formName;
            oSMG_M0014.nm_pac = $('#scp_h0007-nm_pac').val();
            oSMG_M0014.tp_sexo_pac = $('#scp_h0007-tp_sexo_pac').val();
            oSMG_M0014.dt_nasc_pac = $('#scp_h0007-dt_nasc_pac').val();
            oSMG_M0014.nm_mae_pac = $('#scp_h0007-nm_mae_pac').val();
            //2-Confirmado Arquivo,3-Bloqueado,4-Em movimentação
            oSMG_M0014.st_prontuario = '1|2|3|4';
            oSMG_M0014.nr_cns_pac = '';
            oSMG_M0014.consultaNomePacienteProntuario('#scp_h0007-tbl_result',0,function(data){
                if(data.st_prontuario != 2){
                    msg.alertErro('Prontuário não Liberado para Movimentação!');
                }else{
                    $('#scp_h0007-nr_prontuario').val(data.nr_prontuario);
                    $('#scp_h0007-cd_pac').val('');
                    $('#scp_h0007-nm_pac').val('');
                    $('#scp_h0007-nm_mae_pac').val('');
                    $('#scp_h0007-dt_nasc_pac').val('');
                    $('#scp_h0007-tp_sexo_pac').val('');
                    $('#scp_h0007-nr_cns_pac').val('');
                    $('#scp_h0007-tbl_result table tbody').html('');
                    self.consultaProntuario();
                }
            });
        }
    }
    
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
            };
            $div.dialog(defaultOptions);
        });
    }
    
    self.inicializacao();    
});