var SCP_J0013 = function SCP_J0013(){

    var self = this;

    self.formName = 'scp_h0013';
    
    self.inicializacao = function(){
        
        $('#scp_h0013-realupload').change(function(){
            $('#scp_h0013-fakeupload').val($('#scp_h0013-realupload').val());
        });
        
        $('#scp_h0013-btn_importa').click(function(){
            importa();
        });
        
        $('#scp_h0013-btn_limpar').click(function(){
            self.limpar();
        });
        
        self.limpar();
    }
    
    self.limpar = function(){
        $('#scp_h0013-fakeupload').val('');
        $('#scp_h0013-realupload').val('');
        $.fn.validar.limparErros();
    }
    
    function importa(){
        new FileUpload({
            url:'scp/controll/scp_c0013.php',
            'id':'#scp_h0013-realupload',
            retorno:function(retorno){
                if(retorno.ret == 'false'){
                    msg.alertErro(retorno.msg);
                }else{
                    msg.alertSucesso(retorno.msg);
                }
            }
        });
    }

    function FileUpload(options){

        this.form = null;
        this.iframe = null;

        this.init = function(){

            var iframe = document.createElement('iframe');
            $(iframe).css({display:'none'});

            $(iframe).appendTo('body')

            var docIframe = iframe.contentWindow.document

            this.form = docIframe.createElement('form')

            docIframe.body.appendChild(this.form)

            this.form.action = options.url;
            this.form.method = 'post';
            this.form.enctype = 'multipart/form-data';

            var  file =  $(options.id)[0]

            this.form.appendChild($.clone(file));

            this.iframe = iframe;

            this.enviar(options.retorno);
        }

        this.enviar = function(callback){
            this.iframe.contentWindow.onload = function(){
                var json = $.parseJSON(this.document.body.innerHTML);
                callback(json)
            }
            this.form.submit();
        }

        this.init();
    }
    
    self.inicializacao();    
};

$(function(){
    new SCP_J0013(); 
});