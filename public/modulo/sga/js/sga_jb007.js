var SGA_JB007 = function SGA_JB007(){
    
    var SMG_M0008 = new pacote_SMG.Smg.m0008;
    var SGA_M0007 = new pacote_SGA.Sga.m0007;
    var self = this;
    self.formName = 'sga_h0007';
    
    self.inicializar = function(){
        
        $("#sga_h0007-cd_espld_medc").addClass('isValid[required]').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoEspecialidade();
            }
        });

        $("#sga_h0007-nm_espld_medc").addClass('isValid[required]');
        $('#sga_h0007-btn_lista_espld_medc').click(function(){
            self.ConsultaNomeEspecialidade();
        });
        
        $('#buscapac-tp_sexo_pac').addClass('isValid[required]');
        $('#buscapac-dt_nasc_pac').addClass('isValid[required]');
        $('#buscapac-nr_cns_pac').addClass('isValid[required]');
        $('#buscapac-nm_pac').addClass('isValid[required]');
        $('#buscapac-nm_mae_pac').addClass('isValid[required]');
        
        $('#sga_h0007-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#sga_h0007-btn_incluir').click(function(){
            self.incluir();
        });
 
        self.limpar();
    };
    
    
    self.consultaCodigoEspecialidade = function(){
        
        SMG_M0008.form = self.formName;
        SMG_M0008.cd_espld_medc = $('#sga_h0007-cd_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaCodigoEspecialidade();
        $.fn.validar.limparErros();
    };
    
    self.ConsultaNomeEspecialidade = function(){
        
        SMG_M0008.form = self.formName;
        SMG_M0008.nm_espld_medc = $('#sga_h0007-nm_espld_medc').val();
        SMG_M0008.st_espld_medc = '0';
        SMG_M0008.ConsultaNomeEspecialidade();
        $.fn.validar.limparErros();
        
    };
    
    
    self.limpar = function(){
        
        $("#sga_h0007-cd_espld_medc").val('');
        $("#sga_h0007-nm_espld_medc").val('');
        $('#sga_h0007-cd_fila').val('');
        $("#sga_h0007-tbl_result").html('');
        $('#buscapac-btn_limpar_pac').click();
        self.listaFilaAtendimentoAtual();
        $.fn.validar.limparErros();
    };
    
    self.incluir = function(){
        var campo = '#sga_h0007-tp_atend,#sga_h0007-st_atend,#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac,#sga_h0007-cd_espld_medc,#sga_h0007-nm_espld_medc';
        if($(campo).validar(true)){
            
            SGA_M0007.form = self.formName;
            SGA_M0007.cd_cnes = $("#sga_h0007-cd_cnes").val();
            SGA_M0007.cd_espld_medc = $("#sga_h0007-cd_espld_medc").val();
            SGA_M0007.in_servico = $("#sga_h0007-in_servico").val();
            SGA_M0007.tp_atend = $("#sga_h0007-tp_atend").val();
            SGA_M0007.cd_pac = $("#buscapac-cd_pac").val();
            SGA_M0007.incluir(function(retorno){
                if(retorno.ret == 'true'){
                    msg.alertSucesso(retorno.msg);
                    self.limpar();
                    $('#buscapac-btn_limpar_pac').click();
                }else{
                    msg.alertErro(retorno.msg);
                }
            });
        }
    };
    
    self.inicializar();
};

$(function() {
    new SGA_JB007();
});