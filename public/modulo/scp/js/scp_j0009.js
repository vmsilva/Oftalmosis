var SCP_J0009 = function SCP_J0009(){
    
    var oSCA_M0002 = new pacote_SCA.Sca.m0002();
    var oSCP_M0005 = new pacote_SCP.Scp.m0005();
    var self = this;

    self.formName = 'scp_h0009';
    
    self.inicializacao = function(){

        $('#scp_h0009-nr_matr_usu').addClass('isValid[required|justlength(5)]').setMask({mask:'a9999'});
        $('#scp_h0009-nr_matr_usu').blur(function(){
            if($('#scp_h0009-nr_matr_usu').val().length == 5){
                self.consultaUsuarioCodigo();
            }
        })
        $('#scp_h0009-nm_usuario').addClass('isValid[required]');
        $('#scp_h0009-ds_snh_usu').addClass('isValid[required]');
        $('#scp_h0009-nr_solic_mov').addClass('isValid[required]');
        
        $('#scp_h0009-btn_lista_usuario').click(function(){
            self.ConsultaNomeUsuario();
        });
        
        $('#scp_h0009-btn_limpar').click(function(){
            self.limpar();
        });
        
        $('#scp_h0009-btn_confirmar').click(function(){
            self.confirmar();
        });
        self.limpar();
    }
    
    self.consultaUsuarioCodigo = function(){
        
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_matr_usu = $('#scp_h0009-nr_matr_usu').val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.consultaMatricula(function(retorno){
            if(retorno.cd_usuario>0){
                $('#scp_h0009-cd_usuario').val(retorno.cd_usuario);
                $('#sca_h0009-nr_matr_usu').val(retorno.nr_matr_usu);
                $('#scp_h0009-nm_usuario').val(retorno.nm_usuario);
            }
        });
    }
    
    self.ConsultaNomeUsuario = function(){
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $("#scp_h0009-nm_usuario").val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.ConsultaNomeUsuario();
    }

    self.limpar = function(){

        $('#scp_h0009-cd_usuario').val('');
        $('#scp_h0009-nr_matr_usu').val('');
        $('#scp_h0009-nm_usuario').val('');
        $('#scp_h0009-ds_snh_usu').val('');
        $('#scp_h0009-nr_solic_mov').val('');
        $('#scp_h0009-tbl_result table tbody').html('');
        self.consultaSolicitacaoAberto();
        $.fn.validar.limparErros();
    }
    
    self.consultaSolicitacaoAberto = function(){
        
        oSCP_M0005.form = self.formName;
        oSCP_M0005.listaSolicitacaoEmAberto('#scp_h0009-tbl_result',0);
        $('#scp_h0009-tbl_result').find('table tbody.grid_corpo tr').click(function(){
            $('#scp_h0009-nr_solic_mov').val($(this).data().data.nr_solic_mov);
        });
        $('#grid-busca-scp_c0007-listaSolicitacaoEmAberto').tamanhocolunatabela();
    }
    
    self.confirmar = function(){
        var campo = '#scp_h0009-nr_matr_usu,#scp_h0009-nm_usuario,#scp_h0009-ds_snh_usu';
        if($(campo).validar(true)){
            if($('#scp_h0009-nr_solic_mov').validar(true)){
                $.fn.validar.limparErros();
                oSCP_M0005.form = self.formName;
                oSCP_M0005.cd_usuario = $('#scp_h0009-cd_usuario').val();
                oSCP_M0005.nm_usuario = $('#scp_h0009-nm_usuario').val();
                oSCP_M0005.nr_matr_usu = $('#scp_h0009-nr_matr_usu').val();
                oSCP_M0005.ds_snh_usu = $('#scp_h0009-ds_snh_usu').val();
                oSCP_M0005.nr_solic_mov = $('#scp_h0009-nr_solic_mov').val();
                oSCP_M0005.ConfirmaMovimentacaoProntuario(function(retorno){
                    if(retorno){ 
                        self.impressao($('#scp_h0009-nr_solic_mov').val());
                        self.limpar();
                    }
                });
            }else{
                msg.alertErro('Selecione o Regsitro na Lista de Solicitações!');
            }
        }
    }
    
    self.impressao = function(nr_solic_mov){
                
        var url = './scp/controll/scp_c0009.php';
        var params;
        params = {
            'opr': 'listaProntuarioSolicitacao',
            'url': url,
            'form': self.formName,
            'nr_solic_mov': nr_solic_mov
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
                dialogClass: 'dialog-scp_h0009-div',
                buttons:[{text:"Imprimir",class:"btn_imprimir",click:function(){
                        impressao($('#dv_tabela_imp').parent().html());
                }}],
                close:function(){
                    try{
                        $(this).dialog('destroy');
                    }catch(error){}
                }
            }
            $div.dialog(defaultOptions);
        });
        
    }
    self.inicializacao(); 
};

$(function(){
    new SCP_J0009(); 
});