$(function SCA_J0001(){
    
    var oSCA_M0001 = new pacote_SCA.Sca.m0001();
    var self = this;
    this.formName = 'sca_h0001';
    
    this.inicializacao = function(){

        $('#sca_h0001-cd_empresa').addClass('isValid[required|integer|maxlength(2)]');
        $('#sca_h0001-cd_empresa').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEmpresa();
            }
        });
        $('#sca_h0001-nm_empresa').addClass('isValid[required|minlength(3)|maxlength(65)]');
        $('#sca_h0001-btn_lista_empresa').click(function(){
            self.consultaNomeEmpresa();
        });
        $('#sca_h0001-st_empresa').addClass('isValid[required|enum(0,1)]');
        $('#sca_h0001-in_logomarca').addClass('isValid[required|maxlength(20)]');
        $('#sca_h0001-btn_incluir').click(function(){
            self.incluir();
        });
        $('#sca_h0001-btn_alterar').click(function(){
            self.alterar();
        });
        $('#sca_h0001-btn_excluir').click(function(){
            self.excluir();
        });
        $('#sca_h0001-btn_limpar').click(function(){
            self.limpar();
        });
        
    };

    self.habilitarBotoes = function(flag) {

        $('#sca_h0001-btn_incluir').attr('disabled', !flag);
        $('#sca_h0001-btn_alterar').attr('disabled', flag);
        $('#sca_h0001-btn_excluir').attr('disabled', flag);
    };

    self.consultaCodigoEmpresa = function(){

        oSCA_M0001.form = self.formName;
        oSCA_M0001.cd_empresa = $('#sca_h0001-cd_empresa').val();
        oSCA_M0001.st_empresa = '0|1';
        rs = oSCA_M0001.consultaCodigoEmpresa();
        self.habilitarBotoes(false);
    }

    self.consultaNomeEmpresa = function(){
        
        oSCA_M0001.form = self.formName;
        oSCA_M0001.nm_empresa = $('#sca_h0001-nm_empresa').val();
        oSCA_M0001.st_empresa = '0|1';
        $rs = oSCA_M0001.consultaNomeEmpresa();

    }

    this.incluir = function(){
        self.habilitarBotoes(false);
    }

    this.alterar = function(){
        this.habilitarBotoes(true);
    }
    
    this.excluir = function(){
        this.habilitarBotoes(true);
    }

    this.limpar = function(){
        $('#sca_h0001-cd_empresa').val('');
        $('#sca_h0001-nm_empresa').val('');
        $('#sca_h0001-st_empresa').val('');
        $('#sca_h0001-in_logomarca').val('');
        $('#sca_h0001-tbl_result').html('');
        self.listaRegistrosEmpresa();
        this.habilitarBotoes(true);
    }

    this.listaRegistrosEmpresa = function(){

        oSCA_M0001.form = self.formName;
        oSCA_M0001.st_empresa = '0|1';
        oSCA_M0001.listaEmpresa('#sca_h0001-tbl_result',0);
        
    }

    this.init = function(){
        
        self.inicializacao();
        self.limpar();

    }

    self.init();
});
