var SCP_J0001 = function SCP_J0001(){

    var oSCP_M0001 = new pacote_SCP.Scp.m0001();
    var self = this;
    self.formName = 'scp_h0001';

    self.inicializacao = function(){
        
        $("#scp_h0001-cd_prateleira").addClass('isValid[integer]');
        $('#scp_h0001-cd_prateleira').blur(function(){
            if($(this).val() != ''){
                self.consultaCodigoPrateleira();
            }
        });

        $("#scp_h0001-nm_prateleira").addClass('isValid[required|minlength(1)|maxlength(3)]');
        $("#scp_h0001-in_andar_prateleira").addClass('isValid[required|enum(0,1,2,3)]');
        $("#scp_h0001-nr_linha_prateleira").addClass('isValid[required|integer|minlength(1)|maxlength(3)]');
        $("#scp_h0001-nr_coluna_prateleira").addClass('isValid[required|integer|minlength(1)|maxlength(3)]');
        $("#scp_h0001-nr_max_linha_coluna_item").addClass('isValid[required|integer|minlength(1)|maxlength(3)]');
        $("#scp_h0001-st_prateleira").addClass('isValid[required|enum(0,1)]');
        $('#scp_h0001-btn_limpar').click(function(){
            self.limpar('');
        });
        $('#scp_h0001-btn_incluir').click(function(){
            var campo = '#scp_h0001-nm_prateleira,#scp_h0001-in_andar_prateleira,#scp_h0001-nr_linha_prateleira,#scp_h0001-nr_coluna_prateleira,#scp_h0001-nr_max_linha_coluna_item,#scp_h0001-st_prateleira';
            if($(campo).validar(true)){
                self.incluir();
            }
        });
        $('#scp_h0001-btn_alterar').click(function(){
            if($('#scp_h0001').validar(true)){
                self.alterar();
            }
        });
        $('#scp_h0001-btn_excluir').click(function(){
            if($('#scp_h0001').validar(true)){
                self.excluir();
            }
        });
        $('#scp_h0001-btn_gerar').click(function(){
            if($('#scp_h0001').validar(true)){
                self.gerar();
            }
        });
        self.limpar();
    }

    self.habilitarBotoes = function(flag) {
        $('#scp_h0001-btn_incluir').attr('disabled', !flag);
        $('#scp_h0001-btn_alterar').attr('disabled', flag);
        $('#scp_h0001-btn_excluir').attr('disabled', flag);
        $('#scp_h0001-btn_gerar').attr('disabled', flag);
    };


    self.limpar = function($msg){

        $("#scp_h0001-cd_prateleira").val('');
        $("#scp_h0001-nm_prateleira").val('');
        $("#scp_h0001-st_prateleira").val('');
        $("#scp_h0001-nr_linha_prateleira").val('');
        $("#scp_h0001-nr_coluna_prateleira").val('');
        $("#scp_h0001-nr_max_linha_coluna_item").val('');
        $("#scp_h0001-in_andar_prateleira").val('');
        self.habilitarBotoes(true);
        self.listaRegistrosPrateleira();
        if($msg == '') $.fn.validar.limparErros();
    }

    self.consultaCodigoPrateleira = function(){
        oSCP_M0001.form = self.formName;
        oSCP_M0001.cd_prateleira = $('#scp_h0001-cd_prateleira').val();
        oSCP_M0001.st_prateleira = '0|1';
        oSCP_M0001.consultaCodigoPrateleira();
        if($('#scp_h0001-nm_prateleira').val() != ''){
            self.habilitarBotoes(false);
        }
    }  

    self.listaRegistrosPrateleira = function(){
        
        oSCP_M0001.form = self.formName;
        oSCP_M0001.st_prateleira = '0|1'
        oSCP_M0001.listaPrateleira('#scp_h0001-tbl_result',0);
        $('#scp_h0001-tbl_result').find('table tbody.grid_corpo tr').click(function(){
            $("#scp_h0001-cd_prateleira").val($(this).data().data.cd_prateleira);
            self.consultaCodigoPrateleira();
        });
        $('#grid-busca-scp_c0001-consultaNomePrateleira').tamanhocolunatabela();
    }
    
    self.incluir = function(){
        
        oSCP_M0001.form = self.formName;
        oSCP_M0001.cd_prateleira = $('#scp_h0001-cd_prateleira').val();
        oSCP_M0001.nm_prateleira = $('#scp_h0001-nm_prateleira').val();
        oSCP_M0001.st_prateleira = $('#scp_h0001-st_prateleira').val();
        oSCP_M0001.nr_linha_prateleira = $('#scp_h0001-nr_linha_prateleira').val();
        oSCP_M0001.nr_coluna_prateleira = $('#scp_h0001-nr_coluna_prateleira').val();
        oSCP_M0001.nr_max_linha_coluna_item = $('#scp_h0001-nr_max_linha_coluna_item').val();
        oSCP_M0001.in_andar_prateleira = $('#scp_h0001-in_andar_prateleira').val();
        oSCP_M0001.incluir(function(retorno){
            if(retorno){
                self.limpar(1);
            }
        });
        
    }
    
    self.excluir = function(){
        oSCP_M0001.form = self.formName;
        oSCP_M0001.cd_prateleira = $('#scp_h0001-cd_prateleira').val();
        oSCP_M0001.nm_prateleira = $('#scp_h0001-nm_prateleira').val();
        oSCP_M0001.st_prateleira = $('#scp_h0001-st_prateleira').val();
        oSCP_M0001.nr_linha_prateleira = $('#scp_h0001-nr_linha_prateleira').val();
        oSCP_M0001.nr_coluna_prateleira = $('#scp_h0001-nr_coluna_prateleira').val();
        oSCP_M0001.nr_max_linha_coluna_item = $('#scp_h0001-nr_max_linha_coluna_item').val();
        oSCP_M0001.in_andar_prateleira = $('#scp_h0001-in_andar_prateleira').val();
        oSCP_M0001.excluir(function(retorno){
            if(retorno){
                self.limpar(1);
            }
        });
        
    }

    self.alterar = function(){

        oSCP_M0001.form = self.formName;
        oSCP_M0001.cd_prateleira = $('#scp_h0001-cd_prateleira').val();
        oSCP_M0001.nm_prateleira = $('#scp_h0001-nm_prateleira').val();
        oSCP_M0001.st_prateleira = $('#scp_h0001-st_prateleira').val();
        oSCP_M0001.nr_linha_prateleira = $('#scp_h0001-nr_linha_prateleira').val();
        oSCP_M0001.nr_coluna_prateleira = $('#scp_h0001-nr_coluna_prateleira').val();
        oSCP_M0001.nr_max_linha_coluna_item = $('#scp_h0001-nr_max_linha_coluna_item').val();
        oSCP_M0001.in_andar_prateleira = $('#scp_h0001-in_andar_prateleira').val();
        oSCP_M0001.alterar(function(retorno){
            if(retorno){
                self.limpar(1);
            }
        });
    }

    self.gerar = function(){
        oSCP_M0001.form = self.formName;
        oSCP_M0001.cd_prateleira = $('#scp_h0001-cd_prateleira').val();
        oSCP_M0001.nm_prateleira = $('#scp_h0001-nm_prateleira').val();
        oSCP_M0001.st_prateleira = $('#scp_h0001-st_prateleira').val();
        oSCP_M0001.nr_linha_prateleira = $('#scp_h0001-nr_linha_prateleira').val();
        oSCP_M0001.nr_coluna_prateleira = $('#scp_h0001-nr_coluna_prateleira').val();
        oSCP_M0001.nr_max_linha_coluna_item = $('#scp_h0001-nr_max_linha_coluna_item').val();
        oSCP_M0001.in_andar_prateleira = $('#scp_h0001-in_andar_prateleira').val();
        oSCP_M0001.gerar(function(retorno){
            if(retorno){
                self.limpar(1);
            }
        });
    }

    self.inicializacao();
};

$(function(){
    new SCP_J0001(); 
});