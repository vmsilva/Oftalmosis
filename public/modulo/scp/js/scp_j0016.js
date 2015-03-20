var SCP_J0016 = function SCP_J0016(){
    
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var oSCP_M0006 = new pacote_SCP.Scp.m0006();
    var self = this;
    self.formName = 'scp_h0016';

    $('#scp_h0016-btn_limpar').click(function(){
        self.limpar();
    });
    
    $('#scp_h0016-btn_confirmar').click(function(){
         if($('#scp_h0016-nr_prontuario').val() != ''){
            $.fn.validar.limparErros();
            self.confirmar();
        }else{
            msg.alertErro('Você deve selecionar um registro para confirmar a Transferência!');
        }
    });
    
    self.limpar = function(){
        $('#scp_h0016-tbl_result').html('');
        self.listaprontuariousuariostatus();
        $.fn.validar.limparErros();
    };
    
    self.listaprontuariousuariostatus = function(){
        
        oSCP_M0005.form = self.formName;
        oSCP_M0005.st_solic_mov = '0';        
        oSCP_M0005.listaProntuarioRecepcionarTransf(function(retorno){
            if(retorno != false){
                $('#scp_h0016-tbl_result').html(retorno.html);
                $('#scp_h0016-tbl_result').find('table tbody.grid_corpo tr').click(function(){
                    var texto = '';
                    texto+= $(this).data().dados.nr_prontuario;
                    texto+= '|'+$(this).data().dados.cd_pac;
                    texto+= '|'+$(this).data().dados.nr_solic_mov;
                    $('#scp_h0016-nr_prontuario').val(texto);
                });
            }else{
                $('#scp_h0016-tbl_result').html('');
            }
        });
    };
    
    self.confirmar = function(){
        oSCP_M0006.form = self.formName;
        oSCP_M0006.lista  = $('#scp_h0016-nr_prontuario').val()   
        oSCP_M0006.ConfirmarRecTransPront(function(retorno){
            if(retorno.ret != false){
                self.limpar();
                msg.alertSucesso(retorno.msg);
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    };
    
    self.limpar();
};

$(function(){
    new SCP_J0016(); 
});