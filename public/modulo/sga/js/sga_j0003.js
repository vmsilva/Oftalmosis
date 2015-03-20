var SGA_J0003 = function SGA_J0003(){
    
    var SGA_M0003 = new pacote_SGA.Sga.m0003();
    var SMG_M0010 = new pacote_SMG.Smg.m0010();

    var self = this;
    this.formName = 'sga_h0003';
    
    
    this.inicializar = function(){
        
        $('#sga_h0003-cd_procd_medc').addClass('isValid[required|integer]');
        $('#sga_h0003-nm_procd_medc').addClass('isValid[required]');        
        $('#sga_h0003-nr_dia_semana').addClass('isValid[required|enum(0|1|2|3|4|5|6)]');
        $('#sga_h0003-in_local_atend').addClass('isValid[required|maxlength(35)]');
        $('#sga_h0003-hr_ini_atend').addClass('isValid[required|hora]');
        $('#sga_h0003-hr_fin_atend').addClass('isValid[required|hora]');        
        //$('#sga_h0003-nr_id_min').addClass('somenteNumero');
        $('#sga_h0003-nr_id_max').addClass('isValid[required|integer|maxint(110)]');
        $('#sga_h0003-nr_qtd_atend').addClass('isValid[required|integer|minint(0)|maxint(999)]');  
        
        

        $('#sga_h0003-nr_id_min').setMask('999', {maxlength: false});     
        $("#sga_h0003-hr_ini_atend").mask("99:99");
        $("#sga_h0003-hr_fin_atend").mask("99:99");       
        
        //$('#sga_h0003-nr_id_min').keypress(somenteNumeros);
        
        $('#sga_h0003-cd_procd_medc').blur(function(){
            var campo = '#sga_h0003-cd_procd_medc';
            if($(campo).validar(true)){
                self.buscaCodigoProcedimento();
            };
        });        
        $('#sga_h0003-btn_lista_procd_medc').click(function(){            
            self.buscaNomeProcedimento();
        });        
        $('#sga_h0003-btn_incluir').click(function(){            
            self.incluir();
        });
        $('#sga_h0003-btn_excluir').click(function(){
            var campo = '#sga_h0003-cd_procd_medc';
            if($(campo).validar(true)){
                self.excluir();
            };
        });
        $('#sga_h0003-btn_limpar').click(function(){
            self.limpar();
        });
        
              
        self.limpar(); 
    
        $('.somenteNumero').keypress(function(event) {
            var tecla = (window.event) ? event.keyCode : event.which;
            //alert(tecla);
            if ((tecla > 47 && tecla < 58)) 
                return true;
            else {
                if (tecla != 8 ) 
                    return false;
                else{
                    if(tecla != 0){
                        return false
                    }                    
                    return true;                    
                }                     
            }
        });
    
    };       
    

    this.limpar = function(){
        
        $('#sga_h0003-cd_procd_medc').val('');
        $('#sga_h0003-nm_procd_medc').val('');        
        $('#sga_h0003-nr_dia_semana').val('');
        $('#sga_h0003-in_local_atend').val('');
        $('#sga_h0003-hr_ini_atend').val('');
        $('#sga_h0003-hr_fin_atend').val('');
        $('#sga_h0003-nr_id_min').val('');
        $('#sga_h0003-nr_id_max').val('');
        $('#sga_h0003-nr_qtd_atend').val('');        
        $('#sga_h0003-cd_grade').val('');  
        $('#sga_h0003-result').html('');
        self.listarGrade();
    };
    
    this.buscaCodigoProcedimento = function(){
        
        SMG_M0010.form = this.formName;
        SMG_M0010.cd_procd_medc = $('#sga_h0003-cd_procd_medc').val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaCodigoProcedimento();
        self.listarGrade();
    };
    
    this.buscaNomeProcedimento = function(){
        
        SMG_M0010.form = this.formName;
        SMG_M0010.nm_procd_medc = $('#sga_h0003-nm_procd_medc').val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaNomeProcedimento(0,function(retorno){
            $('#sga_h0003-cd_procd_medc').val(retorno.cd_procd_medc);
            $('#sga_h0003-nm_procd_medc').val(retorno.nm_procd_medc);
            self.listarGrade();
        });
        
    };
         
    this.incluir = function(){
        
        SGA_M0003.form = this.formName;
        SGA_M0003.cd_procd_medc = $('#sga_h0003-cd_procd_medc').val();
        SGA_M0003.nm_procd_medc = $('#sga_h0003-nm_procd_medc').val();
        SGA_M0003.nr_dia_semana = $('#sga_h0003-nr_dia_semana').val();
        SGA_M0003.in_local_atend = $('#sga_h0003-in_local_atend').val();
        SGA_M0003.hr_ini_atend = $('#sga_h0003-hr_ini_atend').val();
        SGA_M0003.hr_fin_atend = $('#sga_h0003-hr_fin_atend').val();
        SGA_M0003.nr_id_min = $('#sga_h0003-nr_id_min').val();
        SGA_M0003.nr_id_max = $('#sga_h0003-nr_id_max').val();
        SGA_M0003.nr_qtd_atend = $('#sga_h0003-nr_qtd_atend').val();
        SGA_M0003.Incluir(function(retorno){
            console.log(retorno);
            if(retorno.ret === 'true'){
                msg.alertSucesso(retorno.msg);
                $('#sga_h0003-nr_dia_semana').val('');
                $('#sga_h0003-in_local_atend').val('');
                $('#sga_h0003-hr_ini_atend').val('');
                $('#sga_h0003-hr_fin_atend').val('');
                $('#sga_h0003-nr_id_min').val('');
                $('#sga_h0003-nr_id_max').val('');
                $('#sga_h0003-nr_qtd_atend').val('');        
                $('#sga_h0003-cd_grade').val('');
                self.listarGrade();
            }else{
                msg.alertErro(retorno.msg);
            }
        });
    };    
        
    this.excluir = function(){
        SGA_M0003.form = this.formName;
        SGA_M0003.cd_procd_medc = $('#sga_h0003-cd_procd_medc').val();
        SGA_M0003.cd_grade = $('#sga_h0003-cd_grade').val();
        SGA_M0003.Excluir(function(retorno){
            if(retorno.ret === 'true'){
                msg.alertSucesso(retorno.msg);
                $('#sga_h0003-nr_dia_semana').val('');
                $('#sga_h0003-in_local_atend').val('');
                $('#sga_h0003-hr_ini_atend').val('');
                $('#sga_h0003-hr_fin_atend').val('');
                $('#sga_h0003-nr_id_min').val('');
                $('#sga_h0003-nr_id_max').val('');
                $('#sga_h0003-nr_qtd_atend').val('');        
                $('#sga_h0003-cd_grade').val('');
                self.listarGrade();
            }else{
                msg.alertErro(retorno.msg);
            }
            
        });
    };
    
    this.listarGrade = function(){

        SGA_M0003.form = this.formName;
        SGA_M0003.cd_procd_medc = $('#sga_h0003-cd_procd_medc').val();
        SGA_M0003.listaGrade(function(retorno){            
            $('#sga_h0003-result').html(retorno.html);   
            $('#sga_h0003-f0003 #grid-busca-sga_c0003-listar .grid_corpo').find('tr').click(function(){
                $('#sga_h0003-cd_procd_medc').val($(this).data().data.cd_procd_medc);
                $('#sga_h0003-nm_procd_medc').val($(this).data().data.nm_procd_medc);
                $('#sga_h0003-nr_dia_semana').val($(this).data().data.nr_dia_semana);
                $('#sga_h0003-in_local_atend').val($(this).data().data.in_local_atend);
                $('#sga_h0003-hr_ini_atend').val($(this).data().data.hr_ini_atend);
                $('#sga_h0003-hr_fin_atend').val($(this).data().data.hr_fin_atend);
                $('#sga_h0003-nr_id_min').val($(this).data().data.nr_id_min);
                $('#sga_h0003-nr_id_max').val($(this).data().data.nr_id_max);
                $('#sga_h0003-nr_qtd_atend').val($(this).data().data.nr_qtd_atend);
                $('#sga_h0003-cd_grade').val($(this).data().data.cd_grade);
            });
        });     

    };
    
   this.inicializar();
    
};

$(function(){
   new SGA_J0003();
});