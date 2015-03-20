var SCP_J0018 = function SCP_J0018(){
    
    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    
    var self = this;
        
    self.formName = 'scp_h0018';
    
    $('#scp_h0018-nr_prontuario').addClass('isValid[required]');
    $('#scp_h0018-nr_prontuario').on('pesquisa',function(){
            if($('#scp_h0018-nr_prontuario').val() != ''){
                if(parseInt($('#scp_h0018-nr_prontuario').val().length) == 10){
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

    $('#scp_h0018-btn_consultar').click(function(){
        if($('#scp_h0018-nr_prontuario').validar(true)){
            self.consultar();
        }
    });
    
    $('#scp_h0018-btn_limpar').click(function(){
        self.limpar();
    });
    
    self.limpar = function(){
        
        $('#scp_h0018-nr_prontuario').val('');
        $('#scp_h0018-nm_pac').val('');
        $('#scp_h0018-cd_pac').val('');
        $('#scp_h0018-tp_sexo_pac').val('');
        $('#scp_h0018-dt_nasc_pac').val('');
        $('#scp_h0018-nm_mae_pac').val('');
        $('#scp_h0018-nr_cns_pac').val('');
        $('#scp_h0018-tbl_result').html('');
        $('#scp_h0018-nr_prontuario').focus();
        
        $.fn.validar.limparErros();
    };
    
    self.consultaProntuario = function(){
        
        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#scp_h0018-nr_prontuario').val();
        oSCP_M0002.st_prontuario = '1|2|3|4';
        oSCP_M0002.consultaProntuario(function(retorno){
            if(retorno){
                $('#scp_h0018-nr_prontuario').val(retorno.nr_prontuario);
                $('#scp_h0018-cd_pac').val(retorno.cd_pac);
                $('#scp_h0018-nm_pac').val(retorno.nm_pac);
                if(retorno.tp_sexo_pac == 'M'){
                    $('#scp_h0018-tp_sexo_pac').val('Masculino');
                }else{
                    $('#scp_h0018-tp_sexo_pac').val('Feminino');
                }
                $('#scp_h0018-dt_nasc_pac').val(retorno.dt_nasc_pac);
                $('#scp_h0018-nm_mae_pac').val(retorno.nm_mae_pac);
                $('#scp_h0018-nr_cns_pac').val(retorno.nr_cns_pac);
            }else{
                self.limpar();
            }
        });
    };
    
    self.consultar = function(){
        
        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#scp_h0018-nr_prontuario').val();
        oSCP_M0002.st_prontuario = '1|2|3|4';
        oSCP_M0002.historicoProntuario(function(retorno){
            if(retorno.ret == "true"){
                $('#scp_h0018-tbl_result').html(retorno.html);
                $('#grid-busca-scp_c0018-historicoprontuario').tamanhocolunatabela();
            }else{
                $('#scp_h0018-tbl_result').html('');
                msg.alertErro(retorno.msg);
            }
        });
    };
    
    self.limpar();
};

$(function(){
    new SCP_J0018(); 
});