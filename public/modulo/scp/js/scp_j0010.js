$(function SCP_J0010(){
    
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var oSCP_M0006 = new pacote_SCP.Scp.m0006();
    
    var self = this;
    var $pront = '';

    self.formName = 'scp_h0010';
    
    self.inicializacao = function(){

        $('#scp_h0010-nr_solic_mov').addClass('isValid[required|justlength(10)]').setMask({mask:'9999999999'});

        $('#scp_h0010-btn_lista_nr_solic_mov').click(function(){
            var campo = '#scp_h0010-nr_solic_mov';
            if($(campo).validar(true)){
                self.consultaConfirmacaoSolicitacaoProntuario();
            }
        });
        
        self.limpar();
    }
    
    self.consultaConfirmacaoSolicitacaoProntuario = function(){
        
        oSCP_M0005.form = self.formName;
        oSCP_M0005.ListaConfirmaMovimentacaoProntuario();
        $('#scp_h0010-tbl_result').find('table tbody.grid_corpo tr').click(function(){
            $('#scp_h0010-nr_solic_mov').val($(this).data().data.nr_solic_mov);
            $('#scp_h0010-tbl_lista').html('<div class="grid_cabecalho"><table><thead><tr><th>Prontuário</th><th>Paciente</th><th>Confirmar</th><th>Negar</th></tr></thead></table></div>');
            $('#scp_h0010-tbl_lista_conf').html('<div class="grid_cabecalho"><table><thead><tr><th>Prontuário</th><th>Paciente</th><th>Situação</th></tr></thead></table></div><div classe="grid_corpo"><table><tbody id="dv_tbody" class="grid_corpo"></tbody></table></div>');
            self.listaPacienteSolicitadosNaoAtendidos();
        });
        
        var tabela = $('#scp_h0010-tbl_result').html();
        var local = tabela.search("ret");
        var sinal = tabela.substr(local+6,5);
        if(sinal == 'false'){
            $('#scp_h0010-tbl_result').html('<div class="grid_cabecalho"><table><thead><tr><th>Número Solic.</th><th>Dt. Solic.</th><th>Hr. Solic.</th><th>Atendente</th></tr></thead></table></div></div><div classe="grid_corpo"><table><tbody class="grid_corpo"><tr><td style="width:600px; text-align:center;">Nenhum Registro Localizado!</td></tr></tbody></table></div>');
        }
         $('#grid-busca-scp_c0010-ListaConfirmaMovimentacaoProntuario').tamanhocolunatabela();
    }
    
    self.listaPacienteSolicitadosNaoAtendidos = function(){
        $pront = '';
        oSCP_M0006.form = self.formName;
        oSCP_M0006.nr_solic_mov = $('#scp_h0010-nr_solic_mov').val();
        oSCP_M0006.listaPacienteSolicitadosNaoAtendidos(function(retorno){
            $('#scp_h0010-tbl_lista').html(retorno);
            $('#scp_h0010-tbl_lista').tamanhocolunatabela();
        });
        
    }
    
    $('#scp_h0010-btn_limpar').click(function(){
        self.limpar();
    });
    
    $('#scp_h0010-btn_confirmar').click(function(){
        self.confirmar();
    });
    
    self.confirmar = function(){
        var $dados = $('#scp_h0010-tbl_lista tbody tr').data();
        if($dados == null){
            var pront = $pront.substr(0,($pront.length -1));
            var prontuarios = pront.split('|');
            var array = new Array();
            for(i=0;i<prontuarios.length;i++){
                var salvar = {};
                salvar.nr_prontuario = $('#scp_h0010-tbl_lista_conf #'+prontuarios[i]+' td:nth-child(1)').html();
                salvar.st_mov_prontuario = $('#scp_h0010-tbl_lista_conf #'+prontuarios[i]+' td:nth-child(3)').html();
                array.push(salvar);
            }
            oSCP_M0006.form = self.formName;
            oSCP_M0006.nr_solic_mov = $('#scp_h0010-nr_solic_mov').val();
            oSCP_M0006.lista = array;
            oSCP_M0006.Confirmar(function(retorno){
                if(retorno.ret){
                    self.limpar();
                    msg.alertSucesso(retorno.msg);
                }else{
                    msg.alertErro(retorno.msg);
                }
            });
            
        }else{
            msg.alertErro('Todos os Prontuários Solicitados devem ser informados!');
            return;
        }
    }
    
    self.limpar = function(){
        $pront = '';
        $('#scp_h0010-nr_solic_mov').val('');
        $('#dialog-negar-descricao').val('');
        self.consultaConfirmacaoSolicitacaoProntuario();
        $('#scp_h0010-tbl_lista').html('<div class="grid_cabecalho"><table><thead><tr><th>Prontuário</th><th>Paciente</th><th>Confirmar</th><th>Negar</th></tr></thead></table></div>');
        $('#scp_h0010-tbl_lista_conf').html('<div class="grid_cabecalho"><table><thead><tr><th>Prontuário</th><th>Paciente</th><th>Situação</th></tr></thead></table></div><div classe="grid_corpo"><table><tbody class="grid_corpo"></tbody></table></div>');
        $.fn.validar.limparErros();
        
    }
    
    self.confirmarEncontrado = function(nr_prontuario){
        
       var dados = $('#'+nr_prontuario).data('dados');
       var $tr = $("<tr>");
       $tr.attr('id',dados.nr_prontuario);
       $tr.data($('#'+nr_prontuario).data('dados'));
       $tr.append('<td>'+dados.nr_prontuario+'</td>');
       $tr.append('<td>'+dados.nm_pac+'</td>');
       $tr.append('<td>Confirmado</td>');
       $('#scp_h0010-tbl_lista_conf table tbody').append($tr);
       $('#scp_h0010-tbl_lista_conf').tamanhocolunatabela();
       self.RemoverLinha(nr_prontuario);
       
    }
    
    self.negarDialog = function(nr_prontuario){
        $('#dialog-negar-descricao').val('');
        $("#dialog-negar").dialog({
            bgiframe: true,
            resizable: false,
            height:200,
            with : 300,
            modal: true,
            overlay: {
                backgroundColor: '#000',
                opacity: 0.5
            },
            buttons: {
                'Confirmar': function() {
                    if($('#dialog-negar-descricao').val() != ''){
                        self.negar(nr_prontuario,$('#dialog-negar-descricao').val());
                        $(this).dialog('close');
                    }else{
                        var msg = 'Campo Descrição do Motivo da Negação é obrigatório!';
                        alert(msg);
                    }
                    return;
                },
                'Cancelar': function() {
                    $(this).dialog('close');
                }
            }
        });
    }
        
    self.negar = function(nr_prontuario, in_desc){
        
       var dados = $('#'+nr_prontuario).data('dados');
       var $tr = $('<tr>');
       $tr.attr('id',dados.nr_prontuario);
       $tr.addClass('linhaVermelha');
       $tr.append('<td>'+dados.nr_prontuario+'</td>');
       $tr.append('<td>'+dados.nm_pac+'</td>');
       $tr.append('<td>Negado:'+in_desc+'</td>');
       $('#scp_h0010-tbl_lista_conf table tbody').append($tr);
       $('#scp_h0010-tbl_lista_conf').tamanhocolunatabela();
       self.RemoverLinha(nr_prontuario);
    }
    
    self.RemoverLinha = function(nr_prontuario){
        $pront = $pront + nr_prontuario + '|';
        $("#scp_h0010-tbl_lista #"+nr_prontuario).closest('tr').remove();
    };
    
    self.inicializacao(); 
});