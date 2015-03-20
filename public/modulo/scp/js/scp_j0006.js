var SCP_J0006 = function SCP_J0006(){
    
    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    var self = this;

    self.formName = 'scp_h0006';
    
    self.inicializacao = function(){

        $('#scp_h0006-nr_prontuario').on('pesquisa',function(){
            if($('#scp_h0006-nr_prontuario').val() != ''){
                if(parseInt($('#scp_h0006-nr_prontuario').val().length) == 10){
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
        
        $('#scp_h0006-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#scp_h0006-btn_imprimir').click(function(){
            self.impressaoProtocolo($('#scp_h0006-nr_prontuario_aux').val());
        });
        self.limpar();
    }
    

    self.limpar = function(){
        $('#scp_h0006-nr_prontuario_aux').val('');
        $('#scp_h0006-nr_prontuario').val('');
        $('#scp_h0006-tbl_result table tbody').html('');
        $.fn.validar.limparErros();
    }
    
    self.consultaProntuario = function(){
        
        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#scp_h0006-nr_prontuario').val();
        oSCP_M0002.st_prontuario = '1|2';
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
                $tr.data(retorno)
                if(!$('.'+retorno.nr_prontuario).length){
                    $('#scp_h0006-tbl_result table tbody').append($tr);
                    $('#scp_h0006-tbl_result').find('table tbody.grid_corpo tr').off('click.lista').on('click.lista',function(){
                        $('#scp_h0006-nr_prontuario_aux').val($(this).data().nr_prontuario);
                    });
                    $.fn.validar.limparErros();
                    msg.limparMensagem();
                }else{
                    msg.alertErro('Prontuário já se Encontra na Lista: ' + retorno.nr_prontuario);
                }
                $('#scp_h0006-nr_prontuario_aux').val('');
                $('#scp_h0006-nr_prontuario').val('');
                $('#scp_h0006-nr_prontuario').focus();
            }
        });
    }
 
    self.impressaoProtocolo = function(nr_prontuario){
        var url = './scp/controll/scp_c0004.php';
        var params;
        params = {
            'opr': 'impressao',
            'url': url,
            'form': self.formName,
            'nr_prontuario': nr_prontuario
        };
        $.post(url,params,function(html){
            //id unico para modal
            var id = 'id-modal-'+Math.floor(Math.random()*10000);
            /* Chamar o dialog */
            var $div = $('<div class="div-modal"></div>').html(html);
            $div.attr('id',id);

            /* Opções default */
            var defaultOptions = {
                modal: true,
                title: 'Envolverti',
                resizable: false,
                width: 'auto',
                height: 'auto',
                zIndex: 9999,
                position: ['center', 100],
                dialogClass: 'dialog-scp_h0006',
                close:function(){
                    try{
                        $(this).dialog('destroy');
                    }catch(error){}
                }
            }
            $div.dialog(defaultOptions);
            $('.'+nr_prontuario).remove();

        });
    }    
    self.inicializacao();    
};

$(function(){
    new SCP_J0006(); 
});