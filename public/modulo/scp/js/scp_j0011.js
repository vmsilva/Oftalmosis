var SCP_J0011 = function SCP_J0011(){
    
    var oSCA_M0002 = new pacote_SCA.Sca.m0002();
    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    var self = this;

    self.formName = 'scp_h0011';
    
    self.inicializacao = function(){

        $('#scp_h0011-nr_matr_usu').addClass('isValid[required|justlength(5)]').setMask({mask:'a9999'});
        $('#scp_h0011-nr_matr_usu').blur(function(){
            if($('#scp_h0011-nr_matr_usu').val().length == 5){
                self.consultaUsuarioCodigo();
            }
        })
        $('#scp_h0011-nm_usuario').addClass('isValid[required]');
        $('#scp_h0011-ds_snh_usu').addClass('isValid[required]');
        $('#scp_h0011-txt_pesquisa').addClass('isValid[required]');
        
        $('#scp_h0011-btn_lista_usuario').click(function(){
            self.ConsultaNomeUsuario();
        });
        
        $('#scp_h0011-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#scp_h0011-btn_desbloquear').click(function(){
            var campo = '#scp_h0011-nr_matr_usu,#scp_h0011-nm_usuario,#scp_h0011-ds_snh_usu';
            if($(campo).validar(true)){
                self.desbloquear();
            }
        });

        $('#scp_h0011-btn-pesquisa').click(function(){
            var campo = '#scp_h0011-txt_pesquisa';
            if($(campo).validar(true)){
                $('#scp_h0011-tbl_result table tbody').html('');
                self.consultaProntuarioBloqueados();
            }
        });
        
        self.limpar();
    }
    
    self.consultaUsuarioCodigo = function(){
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_matr_usu = $('#scp_h0011-nr_matr_usu').val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.consultaMatricula(function(retorno){
            if(retorno.cd_usuario>0){
                $('#scp_h0011-cd_usuario').val(retorno.cd_usuario);
                $('#scp_h0011-nr_matr_usu').val(retorno.nr_matr_usu);
                $('#scp_h0011-nm_usuario').val(retorno.nm_usuario);
            }
        });
    }
    
    self.ConsultaNomeUsuario = function(){
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $("#scp_h0011-nm_usuario").val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.ConsultaNomeUsuario();
    }

    self.limpar = function(){

        $('#scp_h0011-nr_prontuario').val('');
        $('#scp_h0011-cd_usuario').val('');
        $('#scp_h0011-nr_matr_usu').val('');
        $('#scp_h0011-nm_usuario').val('');
        $('#scp_h0011-ds_snh_usu').val('');
        $('#scp_h0011-txt_pesquisa').val('');
        $('#scp_h0011-tbl_result table tbody').html('');
        self.consultaProntuarioBloqueados();
        $.fn.validar.limparErros();
        
    }
    
    self.variaveldesbloquear = function(nr_prontuario){
        
        $('#scp_h0011-nr_prontuario').val(nr_prontuario);
        
    }
    
    self.desbloquear = function(){
        
        oSCP_M0002.form = self.formName;
        oSCP_M0002.cd_usu_loc_pront = $('#scp_h0011-cd_usuario').val();
        oSCP_M0002.senha = $('#scp_h0011-ds_snh_usu').val();
        oSCP_M0002.nr_prontuario = $('#scp_h0011-nr_prontuario').val();
        oSCP_M0002.desbloquearProntuario(function(retorno){
            self.limpar();
            if(retorno.ret == "false"){
                msg.alertErro(retorno.msg);                
            }else{
                msg.alertSucesso(retorno.msg); 
            }
        });
    }
    
    self.consultaProntuarioBloqueados = function(){

        oSCP_M0002.form = self.formName;
        oSCP_M0002.nm_pac = $('#scp_h0011-txt_pesquisa').val();
        oSCP_M0002.st_prontuario = 3;
        oSCP_M0002.listaProntuarioStatus(function(retorno){
            if(retorno){
                for(var i in retorno){
                    var $tr = $('<tr>');
                    $tr.addClass(retorno[i].nr_prontuario);
                    $tr.attr('id',retorno[i].nr_prontuario);
                    $tr.attr('onclick','javascript:variaveldesbloquear("'+retorno[i].nr_prontuario+'")');
                    $tr.append('<td class="td_pro">'+retorno[i].nr_prontuario+'</td>');
                    $tr.append('<td class="td_pac">'+retorno[i].nm_pac+'</td>');
                    $tr.append('<td class="td_mot">'+retorno[i].in_mov_prontuario+'</td>');
                    $tr.data(retorno);
                    if(!$('.'+retorno[i].nr_prontuario).length){
                        var $table = $('#scp_h0011-tbl_result table tbody');
                        var $firstTr = $table.find('tr:first-child');
                        if($firstTr.length){
                           $tr.insertBefore($firstTr);
                        }else {
                            $table.append($tr);
                        }
                        $.fn.validar.limparErros();
                        msg.limparMensagem();
                    }
                   
                }
                $('#scp_h0011-tbl_result').tamanhocolunatabela();
            }else{
                $('#scp_h0011-tbl_result table tbody').html('<tr><td style="width:540px; text-align:center;">Nenhum Registro Localizado!</td></tr>');
            }
        });
    }
    
    self.inicializacao();    
};

$(function(){
    new SCP_J0011(); 
});