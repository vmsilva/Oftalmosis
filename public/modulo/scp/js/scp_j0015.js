var SCP_J0015 = function SCP_J0015(){

    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var oSCA_M0002 = new pacote_SCA.Sca.m0002();
    var self = this;
    self.formName = 'scp_h0015';

    $('#scp_h0015-btn_limpar').click(function(){
        self.limpar();
    });
    
    $('#scp_h0015-btn_transferir').click(function(){
        if($('#scp_h0015-nr_prontuario').val() != ''){
            var campo = '#scp_h0015-nr_matr_usu,#scp_h0015-nm_usuario';
            if($(campo).validar(true)){
                $.fn.validar.limparErros();
                oSCP_M0005.form = self.formName;
                oSCP_M0005.cd_usu_solic_mov = $('#scp_h0015-cd_usuario').val();        
                oSCP_M0005.nr_prontuario = $('#scp_h0015-nr_prontuario').val();        
                oSCP_M0005.TransferenciaSolicitacaoMovimentacao(function(retorno){
                    if(retorno.ret != false){
                        self.limpar();
                        msg.alertSucesso(retorno.msg);
                    }else{
                        msg.alertErro(retorno.msg);
                    }
                });
            }
        }else{
            msg.alertErro('Você deve selecionar um registro para realizar a Transferência!');
        }
    });
    
    $('#scp_h0015-nr_matr_usu').addClass('isValid[required|justlength(5)]').setMask({mask:'a9999'});
    $('#scp_h0015-nr_matr_usu').blur(function(){
        if($('#scp_h0015-nr_matr_usu').val().length == 5){
            self.consultaUsuarioCodigo();
        }
    });
    
    $('#scp_h0015-nm_usuario').addClass('isValid[required|minlength(3)|maxlength(65)]');
    $('#scp_h0015-btn_lista_usuario').click(function(){
        self.ConsultaNomeUsuario();
    });
    
    self.limpar = function(){
        $('#scp_h0015-nr_prontuario').val('');
        $('#scp_h0015-cd_usuario').val('');
        $('#scp_h0015-nr_matr_usu').val('');
        $('#scp_h0015-nm_usuario').val('');
        $('#scp_h0015-tbl_result').html('');
        $('#scp_h0015-tbl_result_transf').html('');
        self.listaprontuariousuariostatus();
        self.listaprontuariousuariotransf();
        $.fn.validar.limparErros();
    };
    
    self.listaprontuariousuariostatus = function(){
        
        oSCP_M0005.form = self.formName;
        oSCP_M0005.st_solic_mov = '1';        
        oSCP_M0005.ListaProntuarioUsuarioStatus(function(retorno){
            if(retorno != false){
                $('#scp_h0015-tbl_result').html(retorno.html);
                $('#scp_h0015-tbl_result').find('table tbody.grid_corpo tr').click(function(){
                    
                    var texto = '';
                    texto+= $(this).data().dados.nr_prontuario;
                    texto+= '|'+$(this).data().dados.cd_pac;
                    texto+= '|'+$(this).data().dados.nr_solic_mov;
                    $('#scp_h0015-nr_prontuario').val(texto);
                });
            }else{
                $('#scp_h0015-tbl_result').html('');
            }
        });
    };
    
    self.listaprontuariousuariotransf = function(){
        
        oSCP_M0005.form = self.formName;
        oSCP_M0005.st_solic_mov = '5';        
        oSCP_M0005.ListaProntuarioUsuarioSolicTransf(function(retorno){
            if(retorno != false){
                $('#scp_h0015-tbl_result_transf').html(retorno.html);
            }else{
                $('#scp_h0015-tbl_result_transf').html('');
            }
        });
    };
    
    self.consultaUsuarioCodigo = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_matr_usu = $('#scp_h0015-nr_matr_usu').val();
        oSCA_M0002.st_usuario = '0';
        oSCA_M0002.consultaMatricula(function(retorno){
            if(retorno.cd_usuario>0){
                $('#scp_h0015-cd_usuario').val(retorno.cd_usuario);
                $('#scp_h0015-nr_matr_usu').val(retorno.nr_matr_usu);
                $('#scp_h0015-nm_usuario').val(retorno.nm_usuario);
            }
             $.fn.validar.limparErros();
        });
    };
    
    self.ConsultaNomeUsuario = function(){
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $("#scp_h0015-nm_usuario").val();
        oSCA_M0002.st_usuario = '0';
        oSCA_M0002.ConsultaNomeUsuario();
        $('#grid-busca-sca_c0002-ConsultaNomeUsuario table tbody.grid_corpo tr').click(function(){
            self.consultaUsuarioCodigo();
        });
    };
    
   self.limpar();
   
};

$(function(){
    new SCP_J0015(); 
});