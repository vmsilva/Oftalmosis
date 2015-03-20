var SCP_J0012 = function SCP_J0012(){
    
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var self = this;

    self.formName = 'scp_h0012';
    
    self.inicializacao = function(){
        
        $('#scp_h0012-btn_limpar').click(function(){
            self.limpar();
        });
        
        self.limpar();
    }
    
    self.limpar = function(){
        $('#scp_h0012-tbl_result table tbody').html('');
        self.consultaMovimentacaoProntuario();
        $.fn.validar.limparErros();
    }
    
    self.consultaMovimentacaoProntuario = function(){
        oSCP_M0005.form = self.formName;
        oSCP_M0005.st_solic_mov = '0|1';
        oSCP_M0005.ListaMovimentacaoProntuarioUsuario(function(retorno){
            if(retorno.ret == "true"){
                $('#scp_h0012-tbl_result').html(retorno.html);
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    }
    
    self.inicializacao();    
};

$(function(){
    new SCP_J0012(); 
});