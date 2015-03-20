function SCA_J0005(){

    var self = this;
    var formName = 'sca_h0005';
    
    var oSCA_M0001 = new pacote_SCA.Sca.m0001();

    $('#sca_h0005-cd_empresa').addClass('isValid[required|integer|maxlength(2)]');
        $('#sca_h0005-cd_empresa').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEmpresa();
            }
        });
    $('#sca_h0005-nm_empresa').addClass('isValid[required|minlength(3)|maxlength(65)]');
    
    this.habilitarBotoes = function(flag) {
        $('#sca_h0005-btn_incluir').attr('disabled', !flag);
        $('#sca_h0005-btn_alterar').attr('disabled', flag);
        $('#sca_h0005-btn_excluir').attr('disabled', flag);
    };
    this.consultaCodigoEmpresa = function(){

        oSCA_M0001.form = formName;
        oSCA_M0001.cd_empresa = $('#sca_h0005-cd_empresa').val();
        oSCA_M0001.st_empresa = '0';
        rs = oSCA_M0001.consultaCodigoEmpresa();
        self.habilitarBotoes(false);
    }
}

$(function(){
window.t2 =new SCA_J0005();
   
})