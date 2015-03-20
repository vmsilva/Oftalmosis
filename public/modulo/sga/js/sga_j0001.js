var SGA_J0001 = function SGA_J0001(){
    
    var SGA_M0001 = new pacote_SGA.Sga.m0001();

    var self = this;
    this.formName = 'sga_h0001';
    
    this.inicializar = function(){
        
        $('#sga_h0001-cd_grp_consulta').addClass('isValid[required|integer]');
        $('#sga_h0001-nm_grp_consulta').addClass('isValid[required]');
        $('#sga_h0001-st_grp_consulta').addClass('isValid[required|enum(0|1)]');
        
        $('#sga_h0001-cd_grp_consulta').blur(function(){
            if(($('#sga_h0001-cd_grp_consulta').val() !== '') && ($('#sga_h0001-cd_grp_consulta').val() > 0 )){
                self.consultaCodigoGrupo();               
            }
           
        });
        
        
        $('#sga_h0001-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#sga_h0001-btn_incluir').click(function(){
            var campo = '#sga_h0001-nm_grp_consulta,#sga_h0001-st_grp_consulta';
            if($(campo).validar(true)){
                self.incluir();
            }
        });
        
        $('#sga_h0001-btn_alterar').click(function(){
            var campo = '#sga_cd_grp_consulta,#sga_h0001-nm_grp_consulta,#sga_h0001-st_grp_consulta';
            if($(campo).validar(true)){                
                self.alterar();
                self.listarGrupoConsulta();
                self.limpar();
            }
        });
        
        $('#sga_h0001-btn_excluir').click(function(){
            var campo = '#sga_h0001-cd_grp_consulta,#sga_h0001-nm_grp_consulta,#sga_h0001-st_grp_consulta';
            if($(campo).validar(true)){
                self.excluir();
                self.listarGrupoConsulta();
            }
            
        });
        
        $('#sga_h0001-btn_lista_grp_consulta').click(function(){
            self.consultaNomeGrupo();
        });
        
        self.limpar(); 
    };
    

    this.consultaCodigoGrupo = function(){        
        
        SGA_M0001.form = self.formName;
        SGA_M0001.cd_grp_consulta = $('#sga_h0001-cd_grp_consulta').val();
        SGA_M0001.nm_grp_consulta = $('#sga_h0001-nm_grp_consulta').val();
        SGA_M0001.st_grp_consulta = '0|1';       
        SGA_M0001.BuscaCodigo(function(retorno){
            if(retorno.ret != 'false'){
                $('#sga_h0001-cd_grp_consulta').val(retorno.cd_grp_consulta);
                $('#sga_h0001-nm_grp_consulta').val(retorno.nm_grp_consulta);
                $('#sga_h0001-st_grp_consulta').val(retorno.st_grp_consulta);
            }else{
                msg.alertErro(retorno.msg);
            }
        });        
    };
    
    this.consultaNomeGrupo = function(){
        
        SGA_M0001.form = self.formName;
        SGA_M0001.nm_grp_consulta = $('#sga_h0001-nm_grp_consulta').val();
        SGA_M0001.st_grp_consulta = '0|1';
        SGA_M0001.consultaNome();
    };
    
    this.limpar = function(){
        
        $('#sga_h0001-cd_grp_consulta').val('');
        $('#sga_h0001-nm_grp_consulta').val('');
        $('#sga_h0001-st_grp_consulta').val('');
        
        self.listarGrupoConsulta();
    };
    
    this.listarGrupoConsulta = function(){
        
        SGA_M0001.form = self.formName;
        SGA_M0001.st_grp_consulta = '0|1';
        SGA_M0001.listaNome(function(retorno){
            $('#sga_h0001-result').html(retorno.html);
            $('#sga_h0001-f0001 #grid-busca-sga_c0001-listanome .grid_corpo').find('tr').click(function(){
                $('#sga_h0001-cd_grp_consulta').val($(this).data().data.cd_grp_consulta);
                $('#sga_h0001-nm_grp_consulta').val($(this).data().data.nm_grp_consulta);
                $('#sga_h0001-st_grp_consulta').val($(this).data().data.st_grp_consulta);
            });          
        });
        
    };
     
    this.incluir = function(){
    
        SGA_M0001.form = this.formName;
        SGA_M0001.nm_grp_consulta = $('#sga_h0001-nm_grp_consulta').val();
        SGA_M0001.st_grp_consulta = $('#sga_h0001-st_grp_consulta').val();
        SGA_M0001.cd_grp_consulta = $('#sga_h0001-cd_grp_consulta').val();
        SGA_M0001.Incluir(function(retorno){
            console.log(retorno.ret);
            if(retorno.ret === 'true'){
                msg.alertSucesso(retorno.msg);
                self.limpar();
            }else{
                msg.alertErro(retorno.msg);
            }

        });
    };
    
    this.alterar = function(){
        
        SGA_M0001.form = this.formName;
        SGA_M0001.cd_grp_consulta = $('#sga_h0001-cd_grp_consulta').val();
        SGA_M0001.st_grp_consulta = $('#sga_h0001-st_grp_consulta').val();
        SGA_M0001.nm_grp_consulta = $('#sga_h0001-nm_grp_consulta').val();
        SGA_M0001.Alterar(function(retorno){
            if(retorno.ret === 'true'){
                msg.alertSucesso(retorno.msg);
                self.limpar();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    };
    
    this.excluir = function(){

        SGA_M0001.form = this.formName;
        SGA_M0001.cd_grp_consulta = $('#sga_h0001-cd_grp_consulta').val();
        SGA_M0001.st_grp_consulta = $('#sga_h0001-st_grp_consulta').val();
        SGA_M0001.nm_grp_consulta = $('#sga_h0001-nm_grp_consulta').val();
        SGA_M0001.Excluir(function(retorno){
            console.log(retorno);
            if(retorno.ret === 'true'){
                msg.alertSucesso(retorno.msg);
                self.limpar();
            }else{
                msg.alertErro(retorno.msg);
            }
            
        });
    };
    
   this.inicializar();
    
};

$(function(){
	new SGA_J0001();
});