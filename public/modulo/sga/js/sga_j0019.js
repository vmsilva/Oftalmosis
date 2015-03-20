var SGA_J0019 = function SGA_J0019(){
    
    var SGA_M0013 = new pacote_SGA.Sga.m0013;
    var SGA_M0016 = new pacote_SGA.Sga.m0016;
   
    var self = this;
    this.formName = 'sga_h0019';
    
    self.init = function(){

        $('#sga_h0019-cd_box').addClass('isValid[required]').attr('disabled',true);
        $('#sga_h0019-nm_box').addClass('isValid[required]').attr('disabled',true);
        $('#sga_h0019-cd_serv_painel').addClass('isValid[required]');

        $('#sga_h0019-btn_gerar').click(function(){
            self.gerar();
        });
        
        $('#sga_h0019-btn_limpar').click(function(){
            self.limpar();
        });
        
        self.listaServico();
        
        setTimeout(function(){ self.listaGuiche(); }, 1000);
        
    };
    
    this.limpar = function(){
        
    };
    
    this.gerar = function(){
        
    };
    
    this.listaGuiche = function(){
        
        SGA_M0016.form = self.formName;
        SGA_M0016.nm_box = '';
        SGA_M0016.st_box = '0';  
        SGA_M0016.ConsultaGuicheDeptoUsuario();
        
    };
    
    this.listaServico = function(){
        
        SGA_M0013.form = self.formName;
        SGA_M0013.nm_serv_painel = '';
        SGA_M0013.st_serv_painel = '0';
        SGA_M0013.ConsultaNomeServicoDepto(function(retorno){
            $('#sga_h0019-cd_serv_painel').html('');
            if(retorno.ret != 'false'){
                if(retorno.length>1){
                    $('#sga_h0019-cd_serv_painel').append('<option value=""></option>');
                }else{
                    $('#sga_h0019-cd_serv_painel').attr('disabled',true);
                }
                for(var i in retorno){
                    $('#sga_h0019-cd_serv_painel').append(
                        '<option value='+ retorno[i].cd_servico + '>'+ retorno[i].nm_servico +'</option>'
                    );
                }
            }
        });
    };
    
    self.init();
};

$(function() {
    new SGA_J0019();
});