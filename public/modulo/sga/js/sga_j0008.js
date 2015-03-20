var SGA_J0008 = function SGA_J0008(){
    
    var SGA_M0008 = new pacote_SGA.Sga.m0008();
    var SGA_M0013 = new pacote_SGA.Sga.m0013();
    var SMG_M0010 = new pacote_SMG.Smg.m0010();
    var SMG_M0014 = new pacote_SMG.Smg.m0014();
    var SCP_M0002 = new pacote_SCP.Scp.m0002();
    
    
    var self = this;
    this.formName = 'sga_h0008';
    
    self.inicializar = function(){        
        
        $('#sga_h0008-cd_procd_medc').setMask({mask:"9999999999"});
        $('#sga_h0008-cd_pac').addClass('isValid[required|integer]');
        $("#buscapac-nr_prontuario_pac").addClass('isValid[required|justlenght(10)]').setMask({mask:'aa99999999'});
        $("#sga").addClass('isValid[required|justlenght(10)]').setMask({mask:'aa99999999'});
        
        $('#sga_h0008-btn_lista_nr_prontuario').click(function(){
            if($('#buscapac-nr_prontuario_pac').validar(true)){
                self.buscaPacienteProntuario();
            }
        });
        
        $("#sga_h0008-cd_pac").blur(function(){
            self.buscaCodigoPaciente();
        });         
        $("#sga_h0008-btn_lista_pac").click(function(){
            self.buscaNomePaciente(); 
        });
        $("#sga_h0008-cd_procd_medc").blur(function(){
            self.buscaCodigoProcedimento();            
        });
        $("#sga_h0008-btn_lista_procd").click(function(){
            self.buscaNomeProcedimento();
        });
        $("#sga_h0008-btn_confirmar").click(function(){
            self.incluir();
        });
        $("#sga_h0008-btn_imprimir").click(function(){
            if($('#sga_h0008-cd_ex_laudo').val() ==""){
                msg.alertErro('Por Favor Preencha os Dados!');
            }else{
                self.imprimir();
            }
        });
        $("#sga_h0008-btn_limpar").click(function(){
            self.limpar();
        });
       
        
        self.limpar();
    };
    
    self.buscaTextoLaudo = function(){
        
        SGA_M0013.form = this.formName;
        SGA_M0013.cd_procd_medc = $('#sga_h0008-cd_procd_medc').val();
        SGA_M0013.buscaprocdTexto(function(ret){
           $('#sga_h0008-ds_olho_dir').val(ret.ds_olho_dir);
           $('#sga_h0008-ds_olho_esq').val(ret.ds_olho_esq);
           $('#sga_h0008-ds_conclusao').val(ret.ds_conclusao); 
        }); 
    };
    
    self.buscaPacienteProntuario = function(){
        
        SCP_M0002.form = this.formName;
        SCP_M0002.nr_prontuario = $('#buscapac-nr_prontuario_pac').val();
        SCP_M0002.st_prontuario = '2';
        SCP_M0002.consultaProntuario(function(retorno){
            $("#buscapac-nr_prontuario_pac").val(retorno.nr_prontuario);
            $("#buscapac-nm_pac").val(retorno.nm_pac);
            $("#buscapac-dt_nasc_pac").val(retorno.dt_nasc_pac);
            $("#buscapac-tp_sexo_pac").val(retorno.tp_sexo_pac);
            $("#buscapac-nm_mae_pac").val(retorno.nm_mae_pac);
            $("#buscapac-nr_cns_pac").val(retorno.nr_cns_pac);
            $('#sga_h0008-cd_pac').val(retorno.cd_pac);
            
        });
    }
    
    self.buscaCodigoPaciente = function(){
        
        SMG_M0014.form = self.formName;
        SMG_M0014.cd_pac = $("#sga_h0008-cd_pac").val();
        SMG_M0014.consultaCodigoPaciente();        
        $("#sga_h0008-dt_nasc_pac").attr('disabled', true);   
        $("#sga_h0008-nm_mae_pac").attr('disabled', true);   
        $("#sga_h0008-nr_prontuario_pac").attr('disabled', true); 
        
    }
    
    self.buscaNomePaciente = function(){
        SMG_M0014.form = self.formName;
        SMG_M0014.nm_pac = self.formName;
        SMG_M0014.consultaBuscaNomePaciente(function(cd_pac){
            SMG_M0014.cd_pac = cd_pac;
            SMG_M0014.consultaCodigoPaciente();
        });        
    }
    
    self.buscaCodigoProcedimento = function(){
        SMG_M0010.form = this.formName;
        SMG_M0010.cd_procd_medc = $("#sga_h0008-cd_procd_medc").val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaCodigoProcedimento();
        self.buscaTextoLaudo();
    };
    
    self.buscaNomeProcedimento = function(){
        SMG_M0010.form = this.formName;
        SMG_M0010.nm_procd_medc = $("#sga_h0008-nm_procd_medc").val();
        SMG_M0010.st_procd_medc = '0';
        SMG_M0010.consultaNomeProcedimento(0,function(retorno){
            $('#sga_h0008-cd_procd_medc').val(retorno.cd_procd_medc);
            $('#sga_h0008-nm_procd_medc').val(retorno.nm_procd_medc);
        });
    }
    
    self.buscaLaudo = function(){
        
        SGA_M0008.form = this.formName;
        SGA_M0008.cd_pac = $("#buscapac-cd_pac").val();
        SGA_M0008.cd_procd_medc = $("#sga_h0008-cd_procd_medc").val();
        SGA_M0008.ds_olho_dir = $("#sga_h0008-ds_olho_dir").val();
        SGA_M0008.ds_olho_esq = $("#sga_h0008-ds_olho_esq").val();
        SGA_M0008.ds_conclusao = $("#sga_h0008-ds_conclusao").val();
        SGA_M0008.BuscaLaudo(function(retorno){
            $("#sga_h0008-cd_ex_laudo").val(retorno.cd_ex_laudo);
        });
    }
    
    self.incluir = function(){
        
        SGA_M0008.form = this.formName;
        SGA_M0008.cd_procd_medc = $("#sga_h0008-cd_procd_medc").val();
        SGA_M0008.cd_pac = $("#buscapac-cd_pac").val();
        SGA_M0008.ds_olho_dir = $("#sga_h0008-ds_olho_dir").val();
        SGA_M0008.ds_olho_esq = $("#sga_h0008-ds_olho_esq").val();
        SGA_M0008.ds_conclusao = $("#sga_h0008-ds_conclusao").val();
        SGA_M0008.Incluir(function(retorno){
            if(retorno.ret == "true"){
                $("#sga_h0008-cd_ex_laudo").val(retorno.dados['cd_ex_laudo']);
                self.imprimir();
                return;
            }else{
                msg.alertErro(retorno.msg);
            }
        })        
    }
    
    self.imprimir = function(){        
       
            $('.iframeAjaxDownload').remove();
            $('#divPopUp').show();
            iframe = document.createElement('iframe');
            iframe.className = 'iframeAjaxDownload';
            iframe.setAttribute('top', '10px');
            iframe.setAttribute('width', '600px');
            iframe.setAttribute('height', '60%');
            iframe.src = 'sga/controll/sga_p0008.php?cd_ex_laudo='+$("#sga_h0008-cd_ex_laudo").val();
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
        
    };
        
    self.limpar = function(){
  
        $("#buscapac-cd_pac").val("");
        $("#buscapac-dt_nasc_pac").val("");
        $("#buscapac-nm_mae_pac").val("");
        $("#buscapac-nm_pac").val("");
        $("#buscapac-nr_cns_pac").val("");
        $("#buscapac-nr_prontuario_pac").val("");
        $("#buscapac-tp_sexo_pac").val("");
        $("#sga_h0008-cd_ex_laudo").val("");
        $("#sga_h0008-cd_procd_medc").val("0211060127");
        $('#sga_h0008-nm_procd_medc').val("");
        $("#sga_h0008-ds_conclusao").val("");
        $("#sga_h0008-ds_olho_dir").val("");
        $("#sga_h0008-ds_olho_esq").val("");
        self.buscaCodigoProcedimento();
    };    
    
    
    this.inicializar();
};

window.fechaAjax = function(){
    $('#divPopUp').hide();
    $('.iframeAjaxDownload').remove();
};

$(function() {
    new SGA_J0008();
});