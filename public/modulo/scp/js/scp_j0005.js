var SCP_J0005 = function SCP_J0005(){
    
    var oSCA_M0002 = new pacote_SCA.Sca.m0002();
    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    var self = this;

    self.formName = 'scp_h0005';
    
    self.inicializacao = function(){

        $('#scp_h0005-nr_matr_usu').addClass('isValid[required|justlength(5)]').setMask({mask:'a9999'});
        $('#scp_h0005-nr_matr_usu').blur(function(){
            if($('#scp_h0005-nr_matr_usu').val().length == 5){
                self.consultaUsuarioCodigo();
            }
        })
        $('#scp_h0005-nm_usuario').addClass('isValid[required]');
        $('#scp_h0005-ds_snh_usu').addClass('isValid[required]');
        
        $('#scp_h0005-btn_lista_usuario').click(function(){
            self.ConsultaNomeUsuario();
        });
        $('#scp_h0005-nr_prontuario').on('pesquisa',function(){
            if($('#scp_h0005-nr_prontuario').val() != ''){
                if(parseInt($('#scp_h0005-nr_prontuario').val().length) == 10){
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
        
        $('#scp_h0005-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#scp_h0005-btn_confirmar').click(function(){
            var campo = '#scp_h0005-nr_matr_usu,#scp_h0005-nm_usuario,#scp_h0005-ds_snh_usu,#scp_h0005-nr_prontuario';
            if($(campo).validar(true)){
                self.confirmar();
            }
        });
        self.limpar();
    }
    
    self.consultaUsuarioCodigo = function(){
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_matr_usu = $('#scp_h0005-nr_matr_usu').val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.consultaMatricula(function(retorno){
            if(retorno.cd_usuario>0){
                $('#scp_h0005-cd_usuario').val(retorno.cd_usuario);
                $('#scp_h0005-nr_matr_usu').val(retorno.nr_matr_usu);
                $('#scp_h0005-nm_usuario').val(retorno.nm_usuario);
            }
        });
    }
    
    self.ConsultaNomeUsuario = function(){
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $("#scp_h0005-nm_usuario").val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.ConsultaNomeUsuario();
    }

    self.limpar = function(){

        $('#scp_h0005-cd_usuario').val('');
        $('#scp_h0005-nr_matr_usu').val('');
        $('#scp_h0005-nm_usuario').val('');
        $('#scp_h0005-ds_snh_usu').val('');
        $('#scp_h0005-nr_prontuario').val('');
        $('#scp_h0005-tbl_result table tbody').html('');
        $.fn.validar.limparErros();
    }
    
    self.confirmar = function(){
        
        var dados = [];
        $('#scp_h0005-tbl_result table tbody tr').each(function(){
            dados.push($(this).data());
        });
        if(!dados.length){
            msg.alertErro('Nenhum Prontuário Informado na Lista: ');
            return;
        }

        oSCP_M0002.form = self.formName;
        oSCP_M0002.cd_usu_loc_pront = $('#scp_h0005-cd_usuario').val();
        oSCP_M0002.senha = $('#scp_h0005-ds_snh_usu').val();
        oSCP_M0002.lista = dados;
        oSCP_M0002.confirmaSolicitacaoAbertoProntuario(function(retorno){
            if(retorno) self.limpar();
        });
    }
    
    self.consultaProntuario = function(){
        
        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#scp_h0005-nr_prontuario').val();
        oSCP_M0002.st_prontuario = 1;
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
                $tr.data(retorno)
                if(!$('.'+retorno.nr_prontuario).length){
                    var $table = $('#scp_h0005-tbl_result table tbody');
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
                $('#scp_h0005-nr_prontuario').val('');
                $('#scp_h0005-nr_prontuario').focus();
            }else{
                $('#scp_h0005-nr_prontuario').val('');
                $('#scp_h0005-nr_prontuario').focus();
            }
        });
    }
    
    self.RemoverLinha = function(nr_prontuario){
        $(nr_prontuario).closest('tr').remove();
    }
    
    self.inicializacao();    
};


$(function(){
    new SCP_J0005(); 
});