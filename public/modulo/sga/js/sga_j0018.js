var SGA_J0018 = function SGA_J0018(){
    
    var SGA_M0013 = new pacote_SGA.Sga.m0013;
    var SGA_M0015 = new pacote_SGA.Sga.m0015;
    var self = this;
    this.formName = 'sga_h0018';
    
    self.init = function(){
        
        $('#sga_h0018-cd_serv_painel').addClass('isValid[required]');  
        $('#sga_h0018-in_chamada_pref').addClass('isValid[required]');  
        $('#sga_h0018-in_nome_pac').addClass('isValid[required]');  
        
        $('#sga_h0018-btn_gerar').click(function(){
            self.gerar();
        });
        
        $('#sga_h0018-btn_limpar').click(function(){
            self.limpar();
        });
        
        self.listaServico();
        self.limpar();
    };
    
    this.gerar = function(){
        var campo = '#sga_h0018-cd_serv_painel,#sga_h0018-in_chamada_pref,#sga_h0018-in_nome_pac';
        if($(campo).validar(true)){
            SGA_M0015.form = self.formName;
            SGA_M0015.cd_serv_painel = $('#sga_h0018-cd_serv_painel').val();
            SGA_M0015.in_chamada_pref = $('#sga_h0018-in_chamada_pref').val();
            SGA_M0015.in_nome_pac = $('#sga_h0018-in_nome_pac').val();
            SGA_M0015.incluir(function(retorno){
                if(retorno.ret === "true"){

                    msg.alertSucesso('Senha Gerada com Sucesso!');
                    
                    $('.iframeAjaxDownload').remove();
                    $('#divPopUp').show();
                    iframe = document.createElement('iframe');
                    iframe.className = 'iframeAjaxDownload';
                    iframe.setAttribute('top', '10px');
                    iframe.setAttribute('width', '400px');
                    iframe.setAttribute('height', '180px');
                    iframe.src = 'sga/controll/sga_p0018.php?sistema='+retorno.sistema+'&senha='+retorno.senha+'&servico='+$("#sga_h0018-cd_serv_painel :selected").html()+'&paciente='+$('#sga_h0018-in_nome_pac').val();
                    $('#divPopUp').html('<p><button type="button" onclick="window.parent.fechaAjax()">X</button></p>');
                    $('#divPopUp').append(iframe);

                    $('#divPopUp').css({'padding-top':'26px','zIndex':99999});

                    $('#divPopUp').find('p').css({
                        'width':'420px',
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
                        'background-color':'#FFFFFF',
                    });

                    $('.iframeAjaxDownload').css({
                        'border':'10px solid #FFFFFF',
                        'border-top':'0'});
                    
                    $('#sga_h0018-in_chamada_pref').val('');  
                    $('#sga_h0018-in_nome_pac').val('');  
                    
                }else{
                    msg.alertErro(retorno.msg);
                }
            });
        }
    };
    
    this.limpar = function(){
        
        $('#sga_h0018-cd_serv_painel').val('');  
        $('#sga_h0018-in_chamada_pref').val('');  
        $('#sga_h0018-in_nome_pac').val('');  

    };
    
    this.listaServico = function(){
        
        SGA_M0013.form = self.formName;
        SGA_M0013.nm_serv_painel = '';
        SGA_M0013.st_serv_painel = '0';
        SGA_M0013.ConsultaNomeServico(function(retorno){
            $('#sga_h0018-cd_serv_painel').html('');
            $('#sga_h0018-cd_serv_painel').append('<option value=""></option>');
            if(retorno.ret != 'false'){
                for(var i in retorno){
                    $('#sga_h0018-cd_serv_painel').append(
                        '<option value='+ retorno[i].cd_servico + '>'+ retorno[i].nm_servico +'</option>'
                    );
                }
            }
        });
        
    };
    
    self.init();
    
};

window.fechaAjax = function(){
    
    $('#divPopUp').hide();
    $('.iframeAjaxDownload').remove();
}

$(function() {
    new SGA_J0018();
});