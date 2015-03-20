var SGA_J0006 = function SGA_J0006(){
    
    $('#sga_h0006-realupload').change(function(){
        $('#sga_h0006-fakeupload').val($('#sga_h0006-realupload').val());
    });
    
    function limpar(){
       // $('#sga_h0006-cd_cnes').val('');
       // $('#sga_h0006-nr_cnes').val('').focus();
       // $('#sga_h0006-nm_cnes').val('');
        $('#sga_h0006-fakeupload').val('');
        $('#sga_h0006-realupload').val('');
    }

    $('#sga_h0006-btn_importa').click(function(){
        importa();
    });

    function importa(){
        new FileUpload({
            url:'sga/controll/sga_c0006.php',
            'id':'#sga_h0006-realupload',
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

};

$(function() {
    new SGA_J0006();
});