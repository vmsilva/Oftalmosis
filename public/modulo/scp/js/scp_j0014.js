$(function SCP_J0014(){
    
    var oSCP_M0006 = new pacote_SCP.Scp.m0006();
    var oSGA_M0006 = new pacote_SGA.Sga.m0006();
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var oSMG_M0021 = new pacote_SMG.Smg.m0021();
    
    var self = this;
    var $pront = '';
    
    self.formName = 'scp_h0014';
    
    $('#scp_h0014-dt_atend').addClass('isValid[required|justlength(10)|data]').mask("99/99/9999").datepicker({
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        showOn: "button",
        minDate: data_hoje
    }).change(function(){
        if($('#scp_h0014-dt_atend').val() != ''){
            self.listaProfissionalDataAgenda();
        }
    }).blur(function(){
        if($('#scp_h0014-dt_atend').val() != ''){
            self.listaProfissionalDataAgenda();
        }
    });
    
    $('#scp_h0014-cb_profs').addClass('isValid[required]').change(function(){
        self.listaEspecialidadeDataAgenda();
    });
    
    $('#scp_h0014-cb_espld_medc').addClass('isValid[required]').change(function(){
        $('#scp_h0014-tbl_result #tbody').html('');
        $('#scp_h0014-tbl_atend #tbody').html('');
    });
    
    $('#scp_h0014-btn_limpar').click(function(){
        self.limpar();
    });
    
    self.listaProfissionalDataAgenda = function(){
        
        $('#scp_h0014-cb_profs').html('');
        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#scp_h0014-dt_atend').val();
        oSGA_M0006.ListaProfissionalDataAgenda(function(retorno){
            $('#scp_h0014-cb_profs').html('');
            $('#scp_h0014-cb_profs').append('<option value=""></option>');
            if(retorno.ret != 'false'){
                for(var i in retorno){
                    $('#scp_h0014-cb_profs').append(
                        '<option value='+ retorno[i].cd_prof + '>'+ retorno[i].nm_prof +'</option>'
                    );
                    $('#scp_h0014-cb_espld_medc').html('');
                    $('#scp_h0014-tbl_result #tbody').html('');
                    $('#scp_h0014-tbl_atend #tbody').html('');
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
        oSGA_M0006.cd_agenda =  $('#scp_h0014-dt_atend').val();
        oSGA_M0006.cd_prof =  $('#scp_h0014-cb_profs').val();
        oSGA_M0006.ListaEspecialidadeProfissionalDataAgenda(function(retorno){
            $('#scp_h0014-cb_espld_medc').html('');
            $('#scp_h0014-cb_espld_medc').append('<option value=""></option>');
            if(retorno != false){
                for(var i in retorno){
                    $('#scp_h0014-cb_espld_medc').append(
                        '<option value='+ retorno[i].cd_espld_medc + '>'+ retorno[i].nm_espld_medc +'</option>'
                    );
                    $('#scp_h0014-tbl_result #tbody').html('');
                    $('#scp_h0014-tbl_atend #tbody').html('');
                }
            }
        });
    }
    
    self.listaAgendaProfissionalDia = function(){

        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#scp_h0014-dt_atend').val();
        oSGA_M0006.cd_prof =  $('#scp_h0014-cb_profs').val();
        oSGA_M0006.cd_espld_medc =  $('#scp_h0014-cb_espld_medc').val();
        oSGA_M0006.listaAgendaProfissionalDia(function(retorno){
            $('#scp_h0014-tbl_result #tbody').html(retorno);
        });
    }
    
    self.limpar = function(){
        
        $('#scp_h0014-dt_atend').val('');
        $('#scp_h0014-cb_profs').html('')
        $('#scp_h0014-cb_espld_medc').html('');
        $('#scp_h0014-tbl_result #tbody').html('');
        $('#scp_h0014-tbl_atend #tbody').html('');
        
        $.fn.validar.limparErros();
    }
    
    $('#scp_h0014-btn_consultar').click(function(){
        $('#scp_h0014-tbl_result #tbody').html('');
        $('#scp_h0014-tbl_atend #tbody').html('');
        var campo = '#scp_h0014-dt_atend,#scp_h0014-cb_profs,#scp_h0014-cb_espld_medc';
        if($(campo).validar(true)){
            self.listaAgendaProfissionalDia();
        }
    });
    
    $('#scp_h0014-btn_confirmar').click(function(){
        var campo = '#scp_h0014-dt_atend';
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
       
       $('#scp_h0014-tbl_atend #tbody').append($tr);
       
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
            salvar.nr_prontuario = $('#scp_h0014-tbl_atend #'+prontuarios[i]+' td:nth-child(1)').html();
            salvar.cd_pac = $('#'+prontuarios[i]+' td:nth-child(2)').attr('id');
            array.push(salvar);
        }
        oSCP_M0005.form = self.formName;
        oSCP_M0005.cd_usu_solic_mov = $('#scp_h0014-cb_profs').val();
        oSCP_M0005.lista = array;
        oSCP_M0005.IncluirSolicitacaoMovimentacaoAgenda(function(retorno){
            if(retorno != false){
                $('#scp_h0014-tbl_result #tbody').html('');
                $('#scp_h0014-tbl_atend #tbody').html('');
            }
        });

    };
    
    self.selecionaPacienteSMS = function(cd_pac){
                
            var url = './scp/view/scp_fa014.php';

            var params = Array();
            
            params = {cd_pac:cd_pac};

            $.post(url,params,function(html){

                //id unico para modal
                var id = 'id-modal-'+Math.floor(Math.random()*10000);

                /* Chamar o dialog */
                var $div = $('<div class="div-modal"></div>').html(html);
                $div.attr('id','dv-dialog-scp_ha014');

                this.configEventos = function(){

                  $("#"+id+' div.grid_corpo  table').trigger("update");

                    $("#"+id).find('table tbody tr').click(function(){

                        var data = $(this).data('data');
                        //chama funcao callback
                        if(callback ){
                            callback (data);
                            $('#'+id).dialog('destroy');
                        }
                    });
                }

                var _this = this;

                $.ajaxSetup({
                    async:false
                });

                /* Opções default */
                var defaultOptions = {
                    modal: true,
                    title: 'Envolverti',
                    resizable: false,
                    width: 'auto',
                    height: 'auto',
                    zIndex: 9999,
                    position: ['center', 100],
                    dialogClass: 'dialog-scp_ha014',
                    close:function(){
                        try{
                            $(this).dialog('destroy');
                        }catch(error){}
                    },
                    open: function(event, ui){
                        _this.configEventos();
                        $div.find('.divfiltrar input').keyup(function(){
                            $.ajaxSetup({
                                async:true
                            });
                        });
                    }
                }
                
                $div.dialog(defaultOptions);
                var oSMG_M0014 = new pacote_SMG.Smg.m0014();
                var self = this;
                $("#scp_fa014-tp_sexo_pac").addClass('isValid[required|listEnum(M,F)]');
                $('#scp_fa014-dt_nasc_pac').addClass('isValid[data]').mask("99/99/9999").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        showOtherMonths: true,
                        showOn: "button",
                        maxDate: data_hoje
                });

                $('#scp_fa014-nm_pac').addClass('isValid[required]');
                
                $('#scp_fa014-tp_sexo_pac').click(function(){
                    self.consultaDadosPaciente();
                });

                $('#scp_fa014-dt_nasc_pac').change(function(){
                    self.consultaDadosPaciente();
                });

                $('#scp_fa014-dt_nasc_pac').focus(function(){
                    self.consultaDadosPaciente();
                });

                $('#scp_fa014-nm_pac,#scp_fa014-nm_mae_pac').keyup(function(){
                    self.consultaDadosPaciente();
                });
        
                self.consultaDadosPaciente = function(){
        
                    var campo = '#scp_fa014-tp_sexo_pac,#scp_fa014-nm_pac';
                    if($(campo).validar(true)){
                        oSMG_M0014.form = 'scp_fa014';
                        oSMG_M0014.nm_pac = $('#scp_fa014-nm_pac').val();
                        oSMG_M0014.tp_sexo_pac = $('#scp_fa014-tp_sexo_pac').val();
                        oSMG_M0014.dt_nasc_pac = $('#scp_fa014-dt_nasc_pac').val();
                        oSMG_M0014.nm_mae_pac = $('#scp_fa014-nm_mae_pac').val();
                        //1-Não Alocado, 2-Confirmado Arquivo,3-Bloqueado,4-Em movimentação
                        oSMG_M0014.st_prontuario = '1|2|3|4';
                        oSMG_M0014.nr_cns_pac = '';
                        oSMG_M0014.consultaNomePacienteProntuario('#scp_fa014-tbl_result',0,function(data){
                            
                        });
                    }
                };

            });
            
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
                $('#scp_h0014-btn_consultar').click();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.limpar();

});