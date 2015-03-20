var SGA_J0002 = function SGA_J0002(){
    
    var SGA_M0001 = new pacote_SGA.Sga.m0001();
    var SGA_M0002 = new pacote_SGA.Sga.m0002();
    
    var self = this;
    
    self.formName = 'sga_h0002';
    
    self.inicializar = function(){
        
        $('#sga_h0002-cd_grp_consulta').addClass('isValid[required|integer]');
        $('#sga_h0002-nm_grp_consulta').addClass('isValid[required]');
        $('#sga_h0002-cd_procd_medc').addClass('isValid[required|integer]');
        $('#sga_h0002-nm_procd_medc').addClass('isValid[required]');
        $('#sga_h0002-nr_qtde_procd_medc').addClass('isValid[required|integer]');
        $('#sga_h0002-vl_sa_cont').addClass('isValid[required]');
        
        $('#sga_h0002-vl_sa_cont').setMask('99.99,99',{maxlength:false});
        
        $('#sga_h0002-cd_grp_consulta').blur(function(){
            if(($('#sga_h0002-cd_grp_consulta').val() !== '') && ($('#sga_h0002-cd_grp_consulta').val() > 0 )){
                self.consultaCodigoGrupo();
                self.listaProcedimentoValor();
            }
           
        });
        
        $('#sga_h0002-btn_lista_grp_consulta').click(function(){
            self.consultaNomeGrupo();
        });
        
        $('#sga_h0002-cd_procd_medc').blur(function(){
            if(($('#sga_h0002-cd_grp_consulta').val() !== '') && ($('#sga_h0002-cd_grp_consulta').val() > 0 )){
                self.consultaCodigoProcedimento();
            }
        });
        
        $('#sga_h0002-btn_lista_procd_medc').click(function(){
            self.consultaNomeProcedimento();
        });
        
        $('#sga_h0002-btn_limpar').click(function(){
            self.limpar();            
        }); 
        
        $('#sga_h0002-btn_incluir').click(function(){
            var campo = '#sga_h0002-nm_grp_consulta,#sga_h0002-cd_grp_consulta,'
            campo += '#sga_h0002-cd_procd_medc,#sga_h0002-nm_procd_medc,#sga_h0002-vl_sa_cont,#sga_h0002-nr_qtde_procd_medc';
            if($(campo).validar(true)){
                self.incluir();
            }            
        });
        
        $('#sga_h0002-btn_excluir').click(function(){
            var campo = '#sga_h0002-cd_grp_consulta, #sga_h0002-cd_procd_medc   ';
            if($(campo).validar(true)){
                self.excluir();
                self.listaProcedimentoValor();
            }
        });
        
         
        
        self.limpar();
        
    };
    
    self.limpar = function(){      
        
        $('#sga_h0002-cd_grp_consulta').val('');
        $('#sga_h0002-nm_grp_consulta').val('');
        $('#sga_h0002-cd_procd_medc').val('');
        $('#sga_h0002-nm_procd_medc').val('');
        $('#sga_h0002-vl_sa_cont').val('');
        $('#sga_h0002-nr_qtde_procd_medc').val('');
        
        self.listaProcedimentoValor();           
    };
    
    self.consultaCodigoGrupo = function(){        
        
        SGA_M0001.form = self.formName;
        SGA_M0001.cd_grp_consulta = $('#sga_h0002-cd_grp_consulta').val();
        SGA_M0001.nm_grp_consulta = $('#sga_h0002-nm_grp_consulta').val();
        SGA_M0001.st_grp_consulta = '0';       
        SGA_M0001.BuscaCodigo(function(retorno){
            if(retorno.ret !==   'false'){
                $('#sga_h0002-cd_grp_consulta').val(retorno.cd_grp_consulta);
                $('#sga_h0002-nm_grp_consulta').val(retorno.nm_grp_consulta);
            }else{
                msg.alertErro(retorno.msg);
            }
        });        
    };
    
    self.consultaNomeGrupo = function(){
        
        SGA_M0001.form = self.formName;
        SGA_M0001.nm_grp_consulta = $('#sga_h0002-nm_grp_consulta').val();
        SGA_M0001.st_grp_consulta = '0';
        SGA_M0001.consultaNome();
        
        $('#grid-busca-sga_h0002-consultaNome .grid_corpo table tbody tr').click(function(){
           $('#sga_h0002-cd_grp_consulta').val($(this).data().data.cd_grp_consulta);
           self.listaProcedimentoValor();
        });
        
    };
    
    
    self.consultaCodigoProcedimento = function(){

          SGA_M0002.form = self.formName;
          SGA_M0002.cd_procd_medc = $('#sga_h0002-cd_procd_medc').val();
          SGA_M0002.BuscaCodigoProcedimento(function(retorno){              
            if(retorno.ret !== 'false'){
                $('#sga_h0002-nm_procd_medc').val(retorno.nm_procd_medc);
            }else{
                msg.alertErro(retorno.msg);
            } 
            
          });
    };
    
    self.consultaNomeProcedimento = function(){
        
        SGA_M0002.form = self.formName;
        SGA_M0002.cd_grp_consulta = $('#sga_h0002-cd_grp_consulta').val();
        SGA_M0002.nm_procd_medc = $('#sga_h0002-nm_procd_medc').val();
        SGA_M0002.consultaNome();
    };
    
    self.listaProcedimentoValor = function(){
   
        SGA_M0002.form = self.formName;
        SGA_M0002.cd_grp_consulta = $('#sga_h0002-cd_grp_consulta').val();
        SGA_M0002.ListaProcedimento(function(retorno){
            $('#sga_h0002-result').html(retorno.html);
            $('#sga_h0002-f0002 #grid-busca-sga_c0002-listar .grid_corpo').find('tr').click(function(){
                $('#sga_h0002-cd_procd_medc').val($(this).data().data.cd_procd_medc);
                $('#sga_h0002-nm_procd_medc').val($(this).data().data.nm_procd_medc);
                $('#sga_h0002-vl_sa_cont').val($(this).data().data.vl_sa_cont);
                $('#sga_h0002-nr_qtde_procd_medc').val($(this).data().data.nr_qtde_procd_medc);
            });
        });
    };
    
    self.incluir = function(){
        
        SGA_M0002.form = self.formName;
        SGA_M0002.cd_grp_consulta = $('#sga_h0002-cd_grp_consulta').val();
        SGA_M0002.cd_procd_medc = $('#sga_h0002-cd_procd_medc').val();
        SGA_M0002.vl_sa_cont = $('#sga_h0002-vl_sa_cont').val();
        SGA_M0002.nr_qtde_procd_medc = $('#sga_h0002-nr_qtde_procd_medc').val();
        SGA_M0002.Incluir(function(retorno){
            if(retorno.ret !== 'false'){
                msg.alertSucesso(retorno.msg);
                $('#sga_h0002-cd_procd_medc').val('');
                $('#sga_h0002-nm_procd_medc').val('');
                $('#sga_h0002-vl_sa_cont').val('');
                $('#sga_h0002-nr_qtde_procd_medc').val('');
                self.listaProcedimentoValor();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    };
    
    self.excluir = function(){
        
        SGA_M0002.form = self.formName;
        SGA_M0002.cd_grp_consulta = $('#sga_h0002-cd_grp_consulta').val();
        SGA_M0002.cd_procd_medc = $('#sga_h0002-cd_procd_medc').val();
        SGA_M0002.Excluir(function(retorno){
            if(retorno.ret !== 'false'){
                msg.alertSucesso(retorno.msg);
                $('#sga_h0002-cd_procd_medc').val('');
                $('#sga_h0002-nm_procd_medc').val('');
                $('#sga_h0002-vl_sa_cont').val('');
                $('#sga_h0002-nr_qtde_procd_medc').val('');
                self.listaProcedimentoValor();
            }else{
                msg.alertErro(retorno.msg);
            }
        }); 
    };
    
    this.inicializar();        
};

$(function(){
	new SGA_J0002();
});