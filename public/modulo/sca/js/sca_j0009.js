$(function SCA_J0009() {

    var oSCA_M0002 = new pacote_SCA.Sca.m0002();
    var oSCA_M0003 = new pacote_SCA.Sca.m0003();
    var oSCA_M0009 = new pacote_SCA.Sca.m0009();

    var self = this;

    self.formName = 'sca_h0009';

    $('#sca_h0009-cd_empresa').addClass('isValid[required|integer|maxlength(2)]').attr('disabled', true);
    $('#sca_h0009-nm_empresa').addClass('isValid[required|minlength(3)|maxlength(65)]').attr('disabled', true);

    $('#sca_h0009-nr_matr_usu').addClass('isValid[required|justlength(5)]').setMask({mask: 'a9999'});
    $('#sca_h0009-nr_matr_usu').blur(function() {
        if ($('#sca_h0009-nr_matr_usu').val().length == 5) {
            self.consultaUsuarioCodigo();
        }
    })
    $('#sca_h0009-nm_usuario').addClass('isValid[required]');
    $('#sca_h0009-btn_lista_usuario').click(function() {
        self.ConsultaNomeUsuario();
    });
    $('#sca_h0009-btn_limpar').click(function() {
        self.limpar();
    });

    self.limpar = function() {

        $('#sca_h0009-cd_usuario').val('');
        $('#sca_h0009-nr_matr_usu').val('').focus();
        $('#sca_h0009-nm_usuario').val('');
        $('#sca_h0009-cd_sistema').val('');
        $('#sca_h0009-nm_sistema').val('');
        $('#sca_h0009-dv_formulario').html('');

    }

    self.consultaUsuarioCodigo = function() {

        oSCA_M0002.form = self.formName;
        oSCA_M0002.nr_matr_usu = $('#sca_h0009-nr_matr_usu').val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.consultaMatricula(function(retorno) {
            if (retorno.cd_usuario > 0) {
                $('#sca_h0009-cd_usuario').val(retorno.cd_usuario);
                $('#sca_h0009-nr_matr_usu').val(retorno.nr_matr_usu);
                $('#sca_h0009-nm_usuario').val(retorno.nm_usuario);
            }
        });
        self.ListaFormBotao();
    }

    self.ConsultaNomeUsuario = function() {
        oSCA_M0002.form = self.formName;
        oSCA_M0002.nm_usuario = $("#sca_h0009-nm_usuario").val();
        oSCA_M0002.st_usuario = 0;
        oSCA_M0002.ConsultaNomeUsuario();
        $('#grid-busca-sca_c0002-ConsultaNomeUsuario table tbody.grid_corpo tr').click(function() {
            self.consultaUsuarioCodigo();
        });
    }

    $('#sca_h0009-cd_sistema').addClass('isValid[required|integer|maxlength(2)]');
    $('#sca_h0009-cd_sistema').blur(function() {
        if ($('#sca_h0009-cd_sistema').val() != '') {
            self.consultaCodigoSistema();
        }
    });
    $('#sca_h0009-nm_sistema').addClass('isValid[required|minlength(3)|maxlength(65)]');
    $('#sca_h0009-btn_lista_sistema').click(function() {
        self.ConsultaNomeSistema();
    });

    self.consultaCodigoSistema = function() {

        oSCA_M0003.form = self.formName;
        oSCA_M0003.cd_sistema = $('#sca_h0009-cd_sistema').val();
        oSCA_M0003.st_sistema = '0|2';
        oSCA_M0003.consultaCodigoSistema();
        self.ListaFormBotao();
    }

    self.ConsultaNomeSistema = function() {
        oSCA_M0003.form = self.formName;
        oSCA_M0003.nm_sistema = $("#sca_h0009-nm_sistema").val();
        oSCA_M0003.st_sistema = '0|2';
        oSCA_M0003.ConsultaNomeSistema();

        $('#grid-busca-sca_c0003-ConsultaNomeSistema table tbody.grid_corpo tr').click(function() {
            self.consultaCodigoSistema();
        });
    }


    self.ListaFormBotao = function() {
        $('#sca_h0009-dv_formulario').html('');
        if ($('#sca_h0009-nr_matr_usu').val() != '' && $('#sca_h0009-cd_sistema').val() != '') {
            oSCA_M0009.form = self.formName;
            oSCA_M0009.cd_empresa = $('#sca_h0009-cd_empresa').val();
            oSCA_M0009.cd_sistema = $('#sca_h0009-cd_sistema').val();
            oSCA_M0009.st_sistema = '0|2';
            oSCA_M0009.cd_usuario = $('#sca_h0009-cd_usuario').val();
            oSCA_M0009.st_usuario = '0';
            oSCA_M0009.ListaFormBotao(function(retorno) {
                $('#sca_h0009-dv_formulario').html(retorno);
                self.ListaPermissaoFormBotao();
            });
        }
    }

    self.ListaPermissaoFormBotao = function() {

        if ($('#sca_h0009-nr_matr_usu').val() != '' && $('#sca_h0009-cd_sistema').val() != '') {
            oSCA_M0009.form = self.formName;
            oSCA_M0009.cd_empresa = $('#sca_h0009-cd_empresa').val();
            oSCA_M0009.cd_sistema = $('#sca_h0009-cd_sistema').val();
            oSCA_M0009.st_sistema = '0|2';
            oSCA_M0009.cd_usuario = $('#sca_h0009-cd_usuario').val();
            oSCA_M0009.st_usuario = '0';
            oSCA_M0009.ListaPermissaoFormBotao(function(retorno) {
                for (var i in retorno.dados) {
                    $('#' + retorno.dados[i]).attr('checked', true);
                }
            });
        }
    }

    self.operacaoForm = function(cd_form, e) {
        if (e.checked) {
            self.PermissaoFormBotao('IncluirForm', cd_form, '');
        } else {
            $('input[id*=btn_' + cd_form + ']').attr('checked', false);
            self.PermissaoFormBotao('ExcluirForm', cd_form, '');
        }
    }

    self.operacaoFormBotao = function(cd_form, cd_botao, e) {
        if (e.checked) {
            $('#' + cd_form).attr('checked', true);
            self.PermissaoFormBotao('IncluirFormBotao', cd_form, cd_botao);
        } else {
            self.PermissaoFormBotao('ExcluirFormBotao', cd_form, cd_botao);
        }
    }

    self.PermissaoFormBotao = function(oper, cd_form, cd_botao) {

        oSCA_M0009.form = self.formName;
        oSCA_M0009.cd_sistema = $('#sca_h0009-cd_sistema').val();
        oSCA_M0009.cd_formulario = cd_form;
        oSCA_M0009.cd_botao = cd_botao;
        oSCA_M0009.cd_usuario = $('#sca_h0009-cd_usuario').val();
        oSCA_M0009.PermissaoFormBotao(oper, function(retorno) {

        });
    };

    self.limpar();
});