var SGA_J0017 = function SGA_J0017(){
    
    SGA_M0017 = new pacote_SGA.Sga.m0017();
    SMG_M0010 = new pacote_SMG.Smg.m0010();
    var self = this;
    self.formName = 'sga_h0017';
    
    this.inicializar = function(){
        
        $('#sga_h0017-cd_procd_medc').addClass('isValid[required|integer|justlength(10)').setMask('9999999999',{maxlenght:'false'});
        $('#sga_h0017-dt_exc_procd').addClass('isValid[required|justlength(10)|data]').mask("99/99/9999").datepicker({
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            showOn: "button"
        });
        
        $('#sga_h0017-cd_procd_medc').blur(function(){
            self.buscaCodigoProcedimento();
        });
        $('#sga_h0017-btn_lista_procd').click(function(){
            self.buscaNomeProcedimento();
        });
        $('#sga_h0017-btn_incluir').click(function(){
            self.incluirExcesao();
        });
        $('#sga_h0017-btn_limpar').click(function(){
            self.limpar();
        });
        
        self.listaExcessoes();
        
    };
    
    this.listaExcessoes = function(){
        SGA_M0017.form = self.formName;
        SGA_M0017.Listar(function(retorno){
            $('#sga_h0017-tblresult').html(retorno.html);
            $('#sga_h0017-f0017 #grid-busca-sga_c0017-listar .grid_corpo').find('tr').click(function(){
                $('#sga_h0017-cd_procd_medc').val($(this).data().data.cd_procd_medc);
                $('#sga_h0017-nm_procd_medc').val($(this).data().data.nm_procd_medc);
                $('#sga_h0017-dt_exc_procd').val($(this).data().data.dt_exc_procd);
                $('#sga_h0017-ds_exc_procd').val($(this).data().data.ds_exc_procd);
            });
        });     
    };
    
    this.buscaCodigoProcedimento = function(){
        SMG_M0010.form = self.formName;
        SMG_M0010.cd_procd_medc = $('#sga_h0017-cd_procd_medc').val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaCodigoProcedimento();
    };
    this.buscaNomeProcedimento = function(){
        SMG_M0010.form = self.formName;
        SMG_M0010.nm_procd_medc = $('#sga_h0017-nm_procd_medc').val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaNomeProcedimento(0,function(retorno){
            $('#sga_h0017-cd_procd_medc').val(retorno.cd_procd_medc);
            $('#sga_h0017-nm_procd_medc').val(retorno.nm_procd_medc);
        });
    };
    this.incluirExcesao = function(){
        SGA_M0017.form = self.formName;
        SGA_M0017.cd_procd_medc = $('#sga_h0017-cd_procd_medc').val();
        SGA_M0017.dt_exc_procd = $('#sga_h0017-dt_exc_procd').val();
        SGA_M0017.ds_exc_procd = $('#sga_h0017-ds_exc_procd').val();
        SGA_M0017.Incluir(function(retorno){
            if(retorno.ret == "true"){
                msg.alertSucesso(retorno.msg);
                self.limpar();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    };
    this.limpar = function(){
        $('#sga_h0017-cd_procd_medc').val('');
        $('#sga_h0017-nm_procd_medc').val('');
        $('#sga_h0017-dt_exc_procd').val('');
        $('#sga_h0017-ds_exc_procd').val('');
        self.listaExcessoes();
    };
    
    
    self.inicializar();
};

$(function() {
    new SGA_J0017();
});