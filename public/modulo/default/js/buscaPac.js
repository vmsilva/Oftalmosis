$(function BUSCA_PAC(){

    var BUSCA_PAC = new pacote_SMG.Smg.m0014();
    var pac = this;
    pac.formPAC = 'buscapac';

    $('#buscapac-btn_busca_pac').click(function(){
        pac.limparPaciente();
        pac.buscaPaciente();
    });
    
    $('#buscapac-btn_limpar_pac').click(function(){
        pac.limparPaciente();
    });

    pac.limparPaciente = function(){
        
        $('#buscapac-tp_sexo_pac').val('');
        $('#buscapac-dt_nasc_pac').val('');
        $('#buscapac-nr_cns_pac').val('');
        $('#buscapac-cd_pac').val('');
        $('#buscapac-nm_pac').val('');
        $('#buscapac-nm_mae_pac').val('');
    }

    pac.buscaPaciente = function(){
        BUSCA_PAC.consultaBuscaNomePaciente(function(cd_pac){
            $('#buscapac-cd_pac').val(cd_pac);
            BUSCA_PAC.form = pac.formPAC;
            BUSCA_PAC.cd_pac = cd_pac;
            BUSCA_PAC.consultaCodigoPaciente();
            console.log();
            ;
        });
    }
})
