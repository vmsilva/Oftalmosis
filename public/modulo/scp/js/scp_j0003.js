var SCP_J0003 = function SCP_J0003(){

    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    var self = this;
    self.formName = 'scp_h0003';

    self.inicializar = function(){
        
        $('#scp_h0003-lt_prat_disp').addClass('isValid[required]');
        $('#scp_h0003-nr_total').addClass('isValid[required]');
        $('#scp_h0003-nr_livre').addClass('isValid[required]');
        $('#scp_h0003-nr_utilizada').addClass('isValid[required]');
        $('#scp_h0003-in_opr_locacao').addClass('isValid[required]');
        $('#scp_h0003-nr_total_man').addClass('isValid[required|integer]');
        
        $('#scp_h0003-tbl_result').html('');
        
        self.listaPrateleiraDisponivel();
    }
    
    $('#scp_h0003-btn_lista_prateleira').click(function(){
        self.listaPrateleira();
    });
    
    self.listaPrateleira = function(){
        $('#scp_h0003-cd_prateleira_aux').val('');
            $('#scp_h0003-nr_linha_aux').val('');
            $('#scp_h0003-nr_coluna_aux').val('');
            var campo = '#scp_h0003-lt_prat_disp'
            if($(campo).validar(true)){
                oSCP_M0002.form = 'scp_h0003';
                oSCP_M0002.cd_prateleira = $('#scp_h0003-lt_prat_disp').val();
                oSCP_M0002.montaPrateleira(function(retorno){
                    $('#scp_h0003-tbl_result').html(retorno);
                    $('#scp_h0003-tbl_result table tr td').each(function(){
                        $(this).click(function(){
                            $('td.selecionado').removeClass('selecionado');
                            $(this).addClass('selecionado');
                        });
                    });
                    $('#scp_h0003-tbl_result').find('table tr td').click(function(){
                        if($(this).data().data != undefined){
                            $('#scp_h0003-cd_prateleira_aux').val($(this).data().data.cd_prateleira);
                            $('#scp_h0003-nr_linha_aux').val($(this).data().data.nr_linha);
                            $('#scp_h0003-nr_coluna_aux').val($(this).data().data.nr_coluna);
                            self.NumeroPosicao();
                        }else{
                           $('td.selecionado').removeClass('selecionado');
                        }
                    });
                });
            }
    }

    $('#scp_h0003-btn_limpar').click(function(){
         self.limpar();
         $.fn.validar.limparErros();
         self.listaPrateleiraDisponivel();
     });
    $('#scp_h0003-btn_confirmar').click(function(){
        var campo = '#scp_h0003-lt_prat_disp,#scp_h0003-nr_total,#scp_h0003-nr_livre,#scp_h0003-nr_utilizada,#scp_h0003-in_opr_locacao,#scp_h0003-nr_total_man';
            if($(campo).validar(true)){
                self.confirmar();
            }
     });
     
     self.limpar = function(){
         
        $('#scp_h0003-lt_prat_disp').val('');
        $('#scp_h0003-cd_prateleira_aux').val('');
        $('#scp_h0003-nr_linha_aux').val('');
        $('#scp_h0003-nr_coluna_aux').val(''); 
        $('#scp_h0003-lt_prat_disp').addClass('isValid[required]');
        $('#scp_h0003-nr_total').val('');
        $('#scp_h0003-nr_livre').val('');
        $('#scp_h0003-nr_utilizada').val('');
        $('#scp_h0003-in_opr_locacao').val('');
        $('#scp_h0003-nr_total_man').val('');
        $('#scp_h0003-tbl_result').html('');
        
     }
     
     self.confirmar = function(){
        oSCP_M0002.form = 'scp_h0003'
        oSCP_M0002.cd_prateleira = $('#scp_h0003-cd_prateleira_aux').val();
        oSCP_M0002.nr_linha_prateleira = $('#scp_h0003-nr_linha_aux').val();
        oSCP_M0002.nr_coluna_prateleira = $('#scp_h0003-nr_coluna_aux').val();
        oSCP_M0002.in_opr_locacao = $('#scp_h0003-in_opr_locacao').val();
        oSCP_M0002.nr_total_man = $('#scp_h0003-nr_total_man').val();
        oSCP_M0002.manutencaoLinhaColuna(function(retorno){
            self.listaPrateleira();
            $('#scp_h0003-nr_total').val('');
            $('#scp_h0003-nr_livre').val('');
            $('#scp_h0003-nr_utilizada').val('');
            $('#scp_h0003-in_opr_locacao').val('');
            $('#scp_h0003-nr_total_man').val('');
        });
     }
    
      self.listaPrateleiraDisponivel = function(){

        oSCP_M0002.form = 'scp_h0003'
        oSCP_M0002.st_prontuario = '0|1|2|3';
        oSCP_M0002.listaLocacao(function(retorno){
            $('#scp_h0003-lt_prat_disp').html('');
            $('#scp_h0003-lt_prat_disp').append('<option value="" selected></option>');
            for(var i in retorno){
                $('#scp_h0003-lt_prat_disp').append(
                    '<option value='+ retorno[i].cd_prateleira + '>'+ retorno[i].nm_prateleira +'</option>'
                );
            }
        });
    }
    
    self.NumeroPosicao = function(){

        oSCP_M0002.form = 'scp_h0003';
        oSCP_M0002.cd_prateleira = $('#scp_h0003-cd_prateleira_aux').val();
        oSCP_M0002.nr_linha_prateleira = $('#scp_h0003-nr_linha_aux').val();
        oSCP_M0002.nr_coluna_prateleira = $('#scp_h0003-nr_coluna_aux').val();
        oSCP_M0002.NumeroPosicao(function(retorno){
            $('#scp_h0003-nr_total').val(retorno.nr_total);
            $('#scp_h0003-nr_livre').val(retorno.nr_livre);
            $('#scp_h0003-nr_utilizada').val(retorno.nr_utilizada);
        });        
    }

   self.inicializar();
};

$(function(){
    new SCP_J0003(); 
});