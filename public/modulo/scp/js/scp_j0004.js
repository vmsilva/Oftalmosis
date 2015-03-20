var SCP_J0004 = function SCP_J0004(){

    var oSCP_M0004 = new pacote_SCP.Scp.m0004();
    var self = this;
    self.formName = 'scp_h0004';

    $('#buscapac-cd_pac').addClass('isValid[required|integer]');
    $('#buscapac-tp_sexo_pac').addClass('isValid[required]');
    $('#buscapac-dt_nasc_pac').addClass('isValid[required|data]');
    $('#buscapac-nr_cns_pac').addClass('isValid[required|integer]');
    $('#buscapac-cd_pac').addClass('isValid[required]');
    $('#buscapac-nm_pac').addClass('isValid[required]');
    $('#buscapac-nm_mae_pac').addClass('isValid[required]');
    $("#scp_h0004-nr_pront_antigo").addClass('isValid[required|integer]');

    $('#scp_h0004-btn_limpar').click(function(){
        self.limpar();
    });

    $('#scp_h0004-btn_gerar').click(function(){
        //#buscapac-nr_cns_pac,
        var campo = '#buscapac-tp_sexo_pac,#buscapac-dt_nasc_pac,#buscapac-nm_pac,#buscapac-nm_mae_pac';
        if($(campo).validar(true)){
            oSCP_M0004.form = self.formName;
            oSCP_M0004.cd_pac = $('#buscapac-cd_pac').val();
            oSCP_M0004.nr_prontuario = $("#scp_h0004-nr_pront_antigo").val();
            oSCP_M0004.gerar(function(retorno){
                if(retorno){
                    self.impressao(retorno);
                    self.limpar();
                }
            });
        }
    });

    self.impressao = function(nr_prontuario){
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
                dialogClass: 'dialog-scp_ha003',
                close:function(){
                    try{
                        $(this).dialog('destroy');
                    }catch(error){}
                }
            }
            $div.dialog(defaultOptions);

        });
    }

    self.limpar = function(){
                
        $("#buscapac-tp_sexo_pac").val('');
        $("#buscapac-dt_nasc_pac").val('');
        $("#buscapac-nr_cns_pac").val('');
        $("#buscapac-nm_pac").val('');
        $("#buscapac-cd_pac").val('');
        $("#buscapac-nm_mae_pac").val('');
        $("#scp_h0004-nr_pront_antigo").val('');
        $.fn.validar.limparErros();
    }

    self.limpar();

};

$(function(){
    new SCP_J0004(); 
});