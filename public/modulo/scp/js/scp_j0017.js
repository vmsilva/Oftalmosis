var SCP_J0017 = function SCP_J0017(){
    
    var oSGA_M0006 = new pacote_SGA.Sga.m0006();
    
    var self = this;
        
    self.formName = 'scp_h0017';
    
    $('#scp_h0017-dt_atend').addClass('isValid[required|justlength(10)|data]').mask("99/99/9999").datepicker({
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        showOn: "button"
    });

    $('#scp_h0017-dt_atend').change(function(){
        self.listaProfissionalDataAgenda();
    });
    
    $('#scp_h0017-dt_atend').blur(function(){
        if($('#scp_h0017-dt_atend').val() != ''){
            self.listaProfissionalDataAgenda();
        }
    });
    
    $('#scp_h0017-cb_profs').addClass('isValid[required]').change(function(){
        self.listaEspecialidadeDataAgenda();
    });
    
    $('#scp_h0017-cb_espld_medc').addClass('isValid[required]').change(function(){
        $('#scp_h0017-tbl_result #tbody').html('');
    });
    
    $('#scp_h0017-btn_limpar').click(function(){
        self.limpar();
    });
    
    self.listaProfissionalDataAgenda = function(){
        
        $('#scp_h0017-cb_profs').html('');
        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#scp_h0017-dt_atend').val();
        oSGA_M0006.ListaProfissionalDataAgenda(function(retorno){
            $('#scp_h0017-cb_profs').html('');
            $('#scp_h0017-cb_profs').append('<option value=""></option>');
            if(retorno.ret != 'false'){
                for(var i in retorno){
                    $('#scp_h0017-cb_profs').append(
                        '<option value='+ retorno[i].cd_prof + '>'+ retorno[i].nm_prof +'</option>'
                    );
                    $('#scp_h0017-cb_espld_medc').html('');
                    $('#scp_h0017-tbl_result #tbody').html('');
                }
            }else{
                if(retorno.mostra == 'true'){
                   msg.alertErro(retorno.msg);
                }
            }
        });
    }
    
    self.listaEspecialidadeDataAgenda = function(){

        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#scp_h0017-dt_atend').val();
        oSGA_M0006.cd_prof =  $('#scp_h0017-cb_profs').val();
        oSGA_M0006.ListaEspecialidadeProfissionalDataAgenda(function(retorno){
            $('#scp_h0017-cb_espld_medc').html('');
            $('#scp_h0017-cb_espld_medc').append('<option value=""></option>');
            if(retorno != false){
                for(var i in retorno){
                    $('#scp_h0017-cb_espld_medc').append(
                        '<option value='+ retorno[i].cd_espld_medc + '>'+ retorno[i].nm_espld_medc +'</option>'
                    );
                    $('#scp_h0017-tbl_result #tbody').html('');
                }
            }
        });
    }
    
    self.listaAgendaProfissionalDia = function(){

        oSGA_M0006.form = self.formName;
        oSGA_M0006.cd_agenda =  $('#scp_h0017-dt_atend').val();
        oSGA_M0006.cd_prof =  $('#scp_h0017-cb_profs').val();
        oSGA_M0006.cd_espld_medc =  $('#scp_h0017-cb_espld_medc').val();
        oSGA_M0006.listaAgendaProfissionalDia(function(retorno){
            $('#scp_h0017-tbl_result #tbody').html(retorno);
        });
        $('#scp_h0017-tbl_result').tamanhocolunatabela();
    }
    
    self.limpar = function(){
        
        $('#scp_h0017-dt_atend').val('');
        $('#scp_h0017-cb_profs').html('')
        $('#scp_h0017-cb_espld_medc').html('');
        $('#scp_h0017-tbl_result #tbody').html('');
        $.fn.validar.limparErros();
    }
    
    $('#scp_h0017-btn_consultar').click(function(){
        $('#scp_h0017-tbl_result #tbody').html('');
        var campo = '#scp_h0017-dt_atend,#scp_h0017-cb_profs,#scp_h0017-cb_espld_medc';
        if($(campo).validar(true)){
            self.listaAgendaProfissionalDia();
        }
    });

    self.limpar();
};

$(function(){
    new SCP_J0017(); 
});