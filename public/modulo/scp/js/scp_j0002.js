var SCP_J0002 = function SCP_J0002(){
    
    var oSCP_M0002 = new pacote_SCP.Scp.m0002();
    var oSCP_M0004 = new pacote_SCP.Scp.m0004();
    var self = this;
    self.formName = 'scp_h0002';

    
    self.inicializacao = function(){
        
        $('#scp_h0002-nr_prontuario').addClass('isValid[required]');
        $('#scp_h0002-tp_sexo_pac').addClass('isValid[required]');
        $('#scp_h0002-dt_nasc_pac').addClass('isValid[required]');
        $('#scp_h0002-nm_pac').addClass('isValid[required]');
        $('#scp_h0002-nm_mae_pac').addClass('isValid[required]');
        $('#scp_h0002-lt_prat_disp').addClass('isValid[required]');
        $('#scp_h0002-nr_total').addClass('isValid[required]');
        $('#scp_h0002-nr_livre').addClass('isValid[required]');
        $('#scp_h0002-nr_utilizada').addClass('isValid[required]');
        $('#scp_h0002-tbl_result').html('');
        $('#scp_h0002-tbl_result_prat').html('');
        
        $('#scp_h0002-nr_prontuario').on('pesquisa',function(){
            if($('#scp_h0002-nr_prontuario').val() != ''){
                if(parseInt($('#scp_h0002-nr_prontuario').val().length) == 10){
                    self.consultaProntuario();
                }
            }
        }).keypress(function(event){
         //leitora optica
           if(event.which == 106 || event.which == 0){
                event.preventDefault();
                $(this).trigger('pesquisa');
                return true;
           }
        }).setMask({mask:'aa99999999'});
        
        $('#scp_h0002-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#scp_h0002-btn_transferir').click(function(){
            var campo = '#scp_h0002-nr_prontuario,#scp_h0002-tp_sexo_pac,#scp_h0002-dt_nasc_pac,#scp_h0002-nm_pac,#scp_h0002-nm_mae_pac,#scp_h0002-lt_prat_disp,#scp_h0002-nr_total,#scp_h0002-nr_livre,#scp_h0002-nr_utilizada';
            if($(campo).validar(true)){
                self.transferir();
            }
            
        });
        
        $('#scp_h0002-btn_lista_prateleira').click(function(){
            self.listaPrateleira();
        });
        
        self.limpar();
    }
    

    self.consultaProntuario = function(){
        $.fn.validar.limparErros();
        oSCP_M0002.form = self.formName;
        oSCP_M0002.nr_prontuario = $('#scp_h0002-nr_prontuario').val();
        oSCP_M0002.st_prontuario = 2;
        oSCP_M0002.consultaProntuario(function(retorno){
            if(retorno){
                $('#scp_h0002-tp_sexo_pac').val(retorno.tp_sexo_pac);
                $('#scp_h0002-dt_nasc_pac').val(retorno.dt_nasc_pac);
                $('#scp_h0002-nr_cns_pac').val(retorno.nr_cns_pac);
                $('#scp_h0002-cd_pac').val(retorno.cd_pac);
                $('#scp_h0002-nm_pac').val(retorno.nm_pac);
                $('#scp_h0002-nm_mae_pac').val(retorno.nm_mae_pac);
                self.listaProntuarioAntigo();
                self.listaPrateleiraDisponivel();
            }else{
                self.limpar();
            }
        });
    }
    
    self.listaPrateleira = function(){
        $('#scp_h0002-cd_prateleira_aux').val('');
            $('#scp_h0002-nr_linha_aux').val('');
            $('#scp_h0002-nr_coluna_aux').val('');
            var campo = '#scp_h0002-lt_prat_disp'
            if($(campo).validar(true)){
                oSCP_M0002.form = 'scp_h0002';
                oSCP_M0002.cd_prateleira = $('#scp_h0002-lt_prat_disp').val();
                oSCP_M0002.montaPrateleira(function(retorno){
                    $('#scp_h0002-tbl_result_prat').html(retorno);
                    $('#scp_h0002-tbl_result_prat table tr td').each(function(){
                        $(this).click(function(){
                            $('td.selecionado').removeClass('selecionado');
                            $(this).addClass('selecionado');
                        });
                    });
                    $('#scp_h0002-tbl_result_prat').find('table tr td').click(function(){
                        if($(this).data().data != undefined){
                            $('#scp_h0002-cd_prateleira_aux').val($(this).data().data.cd_prateleira);
                            $('#scp_h0002-nr_linha_aux').val($(this).data().data.nr_linha);
                            $('#scp_h0002-nr_coluna_aux').val($(this).data().data.nr_coluna);
                            self.NumeroPosicao();
                        }else{
                           $('td.selecionado').removeClass('selecionado');
                        }
                    });
                });
            }
    }
    
    self.listaPrateleiraDisponivel = function(){

        oSCP_M0002.form = 'scp_h0002'
        oSCP_M0002.st_prontuario = '0';
        oSCP_M0002.listaLocacao(function(retorno){
            $('#scp_h0002-lt_prat_disp').html('');
            $('#scp_h0002-lt_prat_disp').append('<option value="" selected></option>');
            for(var i in retorno){
                $('#scp_h0002-lt_prat_disp').append(
                    '<option value='+ retorno[i].cd_prateleira + '>'+ retorno[i].nm_prateleira +'</option>'
                );
            }
        });
    }
    
    self.NumeroPosicao = function(){

        oSCP_M0002.form = 'scp_h0002';
        oSCP_M0002.cd_prateleira = $('#scp_h0002-cd_prateleira_aux').val();
        oSCP_M0002.nr_linha_prateleira = $('#scp_h0002-nr_linha_aux').val();
        oSCP_M0002.nr_coluna_prateleira = $('#scp_h0002-nr_coluna_aux').val();
        oSCP_M0002.NumeroPosicao(function(retorno){
            $('#scp_h0002-nr_total').val(retorno.nr_total);
            $('#scp_h0002-nr_livre').val(retorno.nr_livre);
            $('#scp_h0002-nr_utilizada').val(retorno.nr_utilizada);
        });        
    }
    
    self.limpar = function(){

        $('#scp_h0002-nr_prontuario').val('');
        $('#scp_h0002-tp_sexo_pac').val('');
        $('#scp_h0002-dt_nasc_pac').val('');
        $('#scp_h0002-nr_cns_pac').val('');
        $('#scp_h0002-cd_pac').val('');
        $('#scp_h0002-nm_pac').val('');
        $('#scp_h0002-nm_mae_pac').val('');
        $('#scp_h0002-lt_prat_disp').val('');
        $('#scp_h0002-nr_total').val('');
        $('#scp_h0002-nr_livre').val('');
        $('#scp_h0002-nr_utilizada').val('');
        $('#scp_h0002-tbl_result').html('');
        $('#scp_h0002-tbl_result_prat').html('');
        
        $.fn.validar.limparErros();
    }
    
    self.listaProntuarioAntigo = function(){
        oSCP_M0004.form = self.formName;
        oSCP_M0004.cd_pac = $('#scp_h0002-cd_pac').val();
        oSCP_M0004.listaProntuarioAntigo('#scp_h0002-tbl_result',0);
        $('#grid-busca-scp_c0004-listaProntuarioAntigo').tamanhocolunatabela();
    }
    
    self.transferir = function(){
        
        oSCP_M0002.form = 'scp_h0002';
        oSCP_M0002.cd_pac = $('#scp_h0002-cd_pac').val();
        oSCP_M0002.cd_prateleira = $('#scp_h0002-cd_prateleira_aux').val();
        oSCP_M0002.nr_linha_prateleira = $('#scp_h0002-nr_linha_aux').val();
        oSCP_M0002.nr_coluna_prateleira = $('#scp_h0002-nr_coluna_aux').val();
        oSCP_M0002.Transferir(function(retorno){
            self.limpar();
            $('#scp_h0002-nr_prontuario').val(retorno);
            self.consultaProntuario();
            self.impressaoProtocolo(retorno);
        });  
    }
    
    self.impressaoProtocolo = function(nr_prontuario){
        var url = './scp/controll/scp_c0004.php';
        var params;
        params = {
            'opr': 'impressao',
            'url': url,
            'form': self.formName,
            'nr_prontuario': nr_prontuario
        };
        $.post(url,params,function(html){
            //id unico para modal
            var id = 'id-modal-'+Math.floor(Math.random()*10000);
            /* Chamar o dialog */
            var $div = $('<div class="div-modal"></div>').html(html);
            $div.attr('id',id);

            /* Opções default */
            var defaultOptions = {
                modal: true,
                title: 'Envolverti',
                resizable: false,
                width: 'auto',
                height: 'auto',
                zIndex: 9999,
                position: ['center', 100],
                dialogClass: 'dialog-scp_h0002',
                close:function(){
                    try{
                        $(this).dialog('destroy');
                    }catch(error){}
                }
            }
            $div.dialog(defaultOptions);
            $('.'+nr_prontuario).remove();

        });
    }    
    
    self.inicializacao();
};

$(function(){
    new SCP_J0002(); 
});