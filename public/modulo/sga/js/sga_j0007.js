var SGA_J0007 = function SGA_J0007(){
    
    var SMG_M0002 = new pacote_SMG.Smg.m0002;
    var SGA_M0007 = new pacote_SGA.Sga.m0007;
    var self = this;
    this.formName = 'sga_h0007';
    
    self.init = function(){
        
        $('#sga_h0007-tela').html('');
        
        $('#sga_h0007-tp_atend').addClass('isValid[required|listEnum(0,1)]');
        
        $('#sga_h0007-in_servico').addClass('isValid[required|listEnum(0)]');
        
        $('#sga_h0007-tp_atend').click(function(){
            self.carregarTelaAtendimento();
        });
        
        $('#sga_h0007-in_servico').click(function(){
            self.carregarTelaAtendimento();
        });
           
        $('#sga_h0007-nr_cnes').blur(function(){
            if($('#sga_h0007-nr_cnes') != ''){
                self.consultaCodigoCnes();
            }
        });
        
        $('#sga_h0007-btn_lista_cnes').click(function(){
            self.consultaNomeCnes();
        });
        
        $('#sga_h0007-btn_excluir').click(function(){
            self.excluir();
        });
        
        $('#sga_h0007-btn_imprimir').click(function(){
            self.imprimir();
        });
        
        self.carregarTelaAtendimento();
        self.listaFilaAtendimentoAtual();
        self.consultaNomeCnes();
    };
    
    self.carregarTelaAtendimento = function(){
        
        var campo = '#sga_h0007-tp_atend,#sga_h0007-st_atend';
        if($(campo).validar(true)){
            $.post('./sga/view/sga_fa007.php',{
                tp_atend: $('#sga_h0007-tp_atend').val(),
                in_servico: $('#sga_h0007-in_servico').val()
            },function(retorno){
                $('#sga_h0007-tela').html(retorno);
            });
        }
    };
    
    
    self.listaFilaAtendimentoAtual = function(){
        
        SGA_M0007.form = self.formName;
        SGA_M0007.in_servico = $("#sga_h0007-in_servico").val();
        SGA_M0007.tp_atend = $("#sga_h0007-tp_atend").val();
        SGA_M0007.listaFilaAtendimento('0');
        $('#sga_h0007-tbl_result').find('table tbody.grid_corpo tr').click(function(){
            $('#sga_h0007-cd_fila').val($(this).data().data.cd_fila);
            $('#buscapac-tp_sexo_pac').val($(this).data().data.tp_sexo_pac);
            $('#buscapac-dt_nasc_pac').val($(this).data().data.dt_nasc_pac);
            $('#buscapac-nr_cns_pac').val($(this).data().data.nr_cns_pac);
            $('#buscapac-cd_pac').val($(this).data().data.cd_pac);
            $('#buscapac-nm_pac').val($(this).data().data.nm_pac);
            $('#buscapac-nm_mae_pac').val($(this).data().data.nm_mae_pac);
            $.fn.validar.limparErros();
        });
        
        $('#grid-busca-sga_h0007-listaFilaAtendimento').tamanhocolunatabela();
    };
    
    self.consultaCodigoCnes = function(){
        
        SMG_M0002.form = self.formName;
        SMG_M0002.nr_cnes =  $('#sga_h0007-nr_cnes').val();
        SMG_M0002.ConsultaCodigoUnidade(function(retorno){
            if(retorno.ret = 'true'){
                $('#sga_h0007-nr_cnes').val(retorno.dados.nr_cnes);
                $('#sga_h0007-cd_cnes').val(retorno.dados.cd_cnes);
                $('#sga_h0007-nm_cnes').val(retorno.dados.nm_cnes);
            }
        });
    };
    
    self.consultaNomeCnes = function(){
        
        SMG_M0002.form = self.formName;
        SMG_M0002.nm_cnes =  $('#sga_h0007-nm_cnes').val();
        SMG_M0002.ConsultaNomeUnidade(function(retorno){
            if(retorno.ret = 'true'){
                $('#sga_h0007-nr_cnes').val(retorno.dados.nr_cnes);
                $('#sga_h0007-nm_cnes').val(retorno.dados.nm_cnes);
                $('#sga_h0007-nm_cnes').val(retorno.dados.nm_cnes);
            }
        });
    };
    
    
    self.excluir = function(){
        var campo = '#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nr_cns_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac';
        if($(campo).validar(true)){
            SGA_M0007.form = self.formName;
            SGA_M0007.cd_fila = $("#sga_h0007-cd_fila").val();
            SGA_M0007.cd_pac = $("#buscapac-cd_pac").val();
            SGA_M0007.excluir(function(retorno){
                if(retorno.ret == 'true'){
                    msg.alertSucesso(retorno.msg);
                    $('#buscapac-btn_limpar_pac').click();
                    self.listaFilaAtendimentoAtual();
                }else{
                    msg.alertErro(retorno.msg);
                }
            });
        }
    };

    self.imprimir = function(){
        
        if($("#sga_h0007-cd_fila").val() != ''){
            $('.iframeAjaxDownload').remove();
            $('#divPopUp').show();
            iframe = document.createElement('iframe');
            iframe.className = 'iframeAjaxDownload';
            iframe.setAttribute('top', '10px');
            iframe.setAttribute('width', '600px');
            iframe.setAttribute('height', '60%');
            iframe.src = 'sga/controll/sga_p0007.php?cd_fila='+$("#sga_h0007-cd_fila").val();
            $('#divPopUp').html('<p><button type="button" onclick="window.parent.fechaAjax()">X</button></p>');
            $('#divPopUp').append(iframe);

            $('#divPopUp').css({'padding-top':'26px','zIndex':99999});

            $('#divPopUp').find('p').css({
                'width':'618px',
                'background-color':'#FFFFFF',
                'height':'17px'
            });

            $('#divPopUp').find('button').css({
                'float': 'right',
                'cursor':'pointer',
                'border':'none',
                'color':'#FFFFFF',
                'background-image':'-moz-linear-gradient(#F58634, #FFB90F 2%, #FF8C00)'
            });

            $('.iframeAjaxDownload').css({
                'border':'10px solid #FFFFFF',
                'border-top':'0'});
        }else{
            msg.alertErro('Paciente não Selecionado na Fila de Atendimento!');
        }
    };
    
    self.init();
};

window.fechaAjax = function(){
    $('#divPopUp').hide();
    $('.iframeAjaxDownload').remove();
}

$(function() {
    new SGA_J0007();
});