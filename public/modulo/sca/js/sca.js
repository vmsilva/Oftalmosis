var pacote_SCA = {

    Sca:{
        //Classe Empresa
        m0001:function(){
            
            var cd_empresa;
            var st_empresa;
            var form;
            
            this.getcd_empresa = getcd_empresa;
            function getcd_empresa() {
                return cd_empresa;
            }
            this.getst_empresa = getst_empresa;
            function getst_empresa() {
                return st_empresa;
            }
            this.getform = getform;
            function getform() {
                return this.form;
            }

            this.consultaCodigoEmpresa = function(){
               
                var url = 'sca_c0001';
                var params;
                params = {
                    'opr': 'consultaCodigoEmpresa',
                    'url': url,
                    'form': this.form,
                    'cd_empresa': this.cd_empresa,
                    'st_empresa': this.st_empresa
                };

                this.requisicaoAjax(url, params, this.form);
            }

            this.consultaNomeEmpresa = function(){

                var self = this;

                var url = 'sca_c0001';
                var params;
                params = {
                    'opr': 'consultaNomeEmpresa',
                    'url': url,
                    'form': this.form,
                    'nm_empresa': this.nm_empresa,
                    'st_empresa': this.st_empresa,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }

            this.listaEmpresa = function(nmGrid, inputBusca){
                var self = this;
                var url = 'sca_c0001';
                var params;
                 params = {
                    'opr': 'consultaNomeEmpresa',
                    'url': url,
                    'form': this.form,
                    'st_empresa': this.st_empresa,
                    inputBusca:inputBusca
                };
                this.prencheTabelaGrid(url, params, this.form);
            }
        },
        //Classe Usuário
        m0002:function(){
            
            var cd_usuario;
            var nr_matr_usu;
            var dg_matr_usu;
            var nm_usuario;
            var dt_nasc_usu;
            var nr_tel_usu;
            var ds_email_usu;
            var cd_empresa;
            var st_usuario;
            var nr_cpf;
            var nm_form;
            var dados;

            this.getcd_usuario = getcd_usuario;
            function getcd_usuario() {
                return cd_usuario;
            }

            this.getnr_matr_usu = getnr_matr_usu;
            function getnr_matr_usu() {
                return nr_matr_usu;
            }

            this.getdg_matr_usu = getdg_matr_usu;
            function getdg_matr_usu() {
                return dg_matr_usu;
            }

            this.getnm_usuario = getnm_usuario;
            function getnm_usuario() {
                return nm_usuario;
            }

            this.getdt_nasc_usu = getdt_nasc_usu;
            function getdt_nasc_usu() {
                return dt_nasc_usu;
            }

            this.getnr_tel_usu = getnr_tel_usu;
            function getnr_tel_usu() {
                return nr_tel_usu;
            }

            this.getds_email_usu = getds_email_usu;
            function getds_email_usu() {
                return ds_email_usu;
            }

            this.getcd_empresa = getcd_empresa;
            function getcd_empresa() {
                return cd_empresa;
            }

            this.getst_usuario = getst_usuario;
            function getst_usuario() {
                return st_usuario;
            }

            this.getnr_cpf = getnr_cpf;
            function getnr_cpf() {
                return nr_cpf;
            }

            this.getnm_form = getnm_form;
            function getnm_form(){
                return nm_form;
            }

            this.consultaMatricula = function(callback){
                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr' : 'consultaMatricula',
                    'url': url,
                    'form': this.form,
                    'nr_matr_usu': self.nr_matr_usu,
                    'st_usuario': self.st_usuario
                }
                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);

            }
            
            this.ConsultaCPFUsuario = function(callback){
                
                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr' : 'ConsultaCPFUsuario',
                    'url': url,
                    'form': this.form,
                    'nr_cpf': self.nr_cpf,
                    'st_usuario': self.st_usuario
                }
                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);

            }
            
            this.ConsultaNomeUsuario = function(){

                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr': 'ConsultaNomeUsuario',
                    'url': url,
                    'form': self.form,
                    'nm_usuario': self.nm_usuario,
                    'st_usuario': self.st_usuario,
                    inputBusca:1
                };
                
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };
                
                this.requisicaoDivModal(url, callback, params);
            }
            
            this.Incluir = function(callback){
                
                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr': 'Incluir',
                    'url': url,
                    'form': self.form,
                    'nm_usuario': self.nm_usuario,
                    'dt_nasc_usu': self.dt_nasc_usu,
                    'nr_tel_usu': self.nr_tel_usu,
                    'dt_exp_snh_usu': self.dt_exp_snh_usu,
                    'ds_email_usu': self.ds_email_usu,
                    'tp_perm_usu': self.tp_perm_usu,
                    'st_usuario': self.st_usuario,
                    'nr_cpf': self.nr_cpf
                }

                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.Alterar = function(callback){
                
                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr': 'Alterar',
                    'url': url,
                    'form': self.form,
                    'cd_usuario': self.cd_usuario,
                    'nr_tel_usu': self.nr_tel_usu,
                    'ds_email_usu': self.ds_email_usu,
                    'tp_perm_usu': self.tp_perm_usu,
                    'st_usuario': self.st_usuario
                }

                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.GerarSenha = function(callback){
                
                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr': 'GerarSenha',
                    'url': url,
                    'form': self.form,
                    'cd_usuario': self.cd_usuario
                }

                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.Excluir = function(callback){
                
                var self = this;
                var url = 'sca_c0002';
                var params;
                params = {
                    'opr': 'Excluir',
                    'url': url,
                    'form': self.form,
                    'cd_usuario': self.cd_usuario
                }

                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
  
        },
        //Classe Sistema
        m0003:function(){
            
            var cd_sistema;
            var nm_sistema;
            var st_sistema;
            var sg_sistema;
            var in_hier_sist;
            var nm_form;
            var dados;

            this.getcd_sistema = getcd_sistema;
            function getcd_sistema() {
                return cd_sistema;
            }

            this.getnm_sistema = getnm_sistema;
            function getnm_sistema() {
                return nm_sistema;
            }

            this.getst_sistema = getst_sistema;
            function getst_sistema() {
                return st_sistema;
            }

            this.getsg_sistema = getsg_sistema;
            function getsg_sistema() {
                return sg_sistema;
            }

            this.getin_hier_sist = getin_hier_sist;
            function getin_hier_sist() {
                return in_hier_sist;
            }

            this.getnm_form = getnm_form;
            function getnm_form(){
                return nm_form;
            }

            this.consultaCodigoSistema = function(){
                var url = 'sca_c0003';
                var params;
                params = {
                    'opr' : 'consultaCodigoSistema',
                    'url': url,
                    'form': this.form,
                    'cd_sistema': this.cd_sistema,
                    'st_sistema': this.st_sistema
                }

                this.requisicaoAjax(url, params, this.form);
            }
            
            this.ConsultaNomeSistema = function(){

                var self = this;

                var url = 'sca_c0003';
                var params;
                params = {
                    'opr': 'ConsultaNomeSistema',
                    'url': url,
                    'form': this.form,
                    'nm_sistema': this.nm_sistema,
                    'st_sistema': this.st_sistema,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }
        },
        //Classe Sistema
        m0009:function(){
            
            var cd_sistema;
            var st_sistema;
            var cd_formulario;
            var cd_botao;
            var cd_usuario;
            var st_usuario;
            var nm_form;
            var dados;

            this.getcd_sistema = getcd_sistema;
            function getcd_sistema() {
                return cd_sistema;
            }
            
            this.getst_sistema = getst_sistema;
            function getst_sistema() {
                return st_sistema;
            }

            this.getcd_formulario = getcd_formulario;
            function getcd_formulario() {
                return cd_formulario;
            }

            this.getcd_botao = getcd_botao;
            function getcd_botao() {
                return cd_botao;
            }

            this.getcd_usuario = getcd_usuario;
            function getcd_usuario() {
                return cd_usuario;
            }
            
            this.getst_usuario = getst_usuario;
            function getst_usuario() {
                return st_usuario;
            }

            this.getnm_form = getnm_form;
            function getnm_form(){
                return nm_form;
            }

            this.ListaFormBotao = function(callback){
                var url = 'sca_c0009';
                var params;
                params = {
                    'opr' : 'ListaFormBotao',
                    'url': url,
                    'form': this.form,
                    'cd_empresa': this.cd_empresa,
                    'cd_sistema': this.cd_sistema,
                    'st_sistema': this.st_sistema,
                    'cd_usuario': this.cd_usuario,
                    'st_usuario': this.st_usuario
                }

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ListaPermissaoFormBotao = function(callback){
                var url = 'sca_c0009';
                var params;
                params = {
                    'opr' : 'ListaPermissaoFormBotao',
                    'url': url,
                    'form': this.form,
                    'cd_empresa': this.cd_empresa,
                    'cd_sistema': this.cd_sistema,
                    'st_sistema': this.st_sistema,
                    'cd_usuario': this.cd_usuario,
                    'st_usuario': this.st_usuario
                }

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.PermissaoFormBotao = function(operacao, callback){
                var url = 'sca_c0009';
                var params;
                params = {
                    'opr' : operacao,
                    'url': url,
                    'form': this.form,
                    'cd_sistema': this.cd_sistema,
                    'cd_formulario': this.cd_formulario,
                    'cd_botao': this.cd_botao,
                    'cd_usuario': this.cd_usuario
                }

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
        }
    }
}

pacote_SCA.Sca.m0001.prototype = new Formulario();
pacote_SCA.Sca.m0002.prototype = new Formulario();
pacote_SCA.Sca.m0003.prototype = new Formulario();
pacote_SCA.Sca.m0009.prototype = new Formulario();