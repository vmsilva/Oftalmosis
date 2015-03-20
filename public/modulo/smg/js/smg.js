var pacote_SMG = {
    Smg:{
        m0001:function(){

        },
        m0002:function(){
            
            var cd_empresa;
            var cd_cnes;
            var nr_cnes;
            var nm_cnes;
            
            this.getcd_empresa = getcd_empresa;
            function getcd_empresa() {
                return cd_empresa;
            }
            this.getcd_cnes = getcd_cnes;
            function getcd_cnes() {
                return cd_cnes;
            }
            this.getnr_cnes = getnr_cnes;
            function getnr_cnes() {
                return nr_cnes;
            }
            this.getnm_cnes = getnm_cnes;
            function getnm_cnes() {
                return nm_cnes;
            }
            
            this.ConsultaCodigoUnidade = function(callback){
                
                var self = this;
                var url = 'smg_c0002';
                var params;
                params = {
                    opr : 'ConsultaCodigo',
                    url: url,
                    form: this.form,
                    nr_cnes: self.nr_cnes
                };

                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.ConsultaNomeUnidade = function(){

                var self = this;
                var url = 'smg_c0002';
                var params;
                params = {
                    opr: 'ConsultaNome',
                    url: url,
                    form: self.form,
                    nm_cnes: self.nm_cnes,
                    inputBusca:1
                };
                
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };
                
                this.requisicaoDivModal(url, callback, params);
            }
            
        },
        m0003:function(){
    
            var cd_conselho;
            var nm_conselho;
            var sg_conselho;
            var st_conselho;
            var form;

            this.getcd_conselho = getcd_conselho;
            function getcd_conselho() {
                return cd_conselho;
            }
            this.getnm_conselho = getnm_conselho;
            function getnm_conselho() {
                return nm_conselho;
            }
            this.getsg_conselho = getsg_conselho;
            function getsg_conselho() {
                return sg_conselho;
            }
            this.getst_conselho = getst_conselho;
            function getst_conselho() {
                return st_conselho;
            }
            this.getform = getform;
            function getform() {
                return form;
            }

            this.ConsultaNomeConselho = function(nmGrid, inputBusca, callback){
                
                var url = 'smg_c0003';
                var params;
                 params = {
                    'opr': 'ConsultaNomeConselho',
                    'url': url,
                    'form': this.form,
                    'st_conselho': this.st_conselho,
                    inputBusca:inputBusca
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
 
        },
        m0004:function(){
    
            var cd_prof;
            var nm_prof;
            var nm_mae_prof;
            var tp_sexo_prof;
            var dt_nasc_prof;
            var cd_munic_nasc_prof;
            var nr_cns_prof;
            var nr_cpf_prof;
            var nr_fone_prof;
            var cd_pais_orig_prof;
            var cd_munic_end_prof;
            var nm_bairro_end_prof;
            var ds_logr_end_prof;
            var ds_compl_end_prof;
            var ds_qd_end_prof;
            var ds_lt_end_prof;
            var nr_end_prof;
            var nr_cep_end_prof;
            var st_prof;
            var ds_email_prof;
            var form;
            
            this.getcd_prof = cd_prof;
            this.getnm_prof = nm_prof;
            this.getnm_mae_prof = nm_mae_prof;
            this.gettp_sexo_prof = tp_sexo_prof;
            this.getdt_nasc_prof = dt_nasc_prof;
            this.getcd_munic_nasc_prof = cd_munic_nasc_prof;
            this.getnr_cns_prof = nr_cns_prof;
            this.getnr_cpf_prof = nr_cpf_prof;
            this.getnr_fone_prof = nr_fone_prof;
            this.getcd_pais_orig_prof = cd_pais_orig_prof;
            this.getcd_munic_end_prof = cd_munic_end_prof;
            this.getnm_bairro_end_prof = nm_bairro_end_prof;
            this.getds_logr_end_prof = ds_logr_end_prof;
            this.getds_compl_end_prof = ds_compl_end_prof;
            this.getds_qd_end_prof = ds_qd_end_prof;
            this.getds_lt_end_prof = ds_lt_end_prof;
            this.getnr_end_prof = nr_end_prof;
            this.getnr_cep_end_prof = nr_cep_end_prof;
            this.getst_prof = st_prof;
            this.getds_email_prof = ds_email_prof;
            
            function getcd_prof(){
                return cd_prof;
            }
            function getnm_prof(){
                return nm_prof;
            }
            function getnm_mae_prof(){
                return nm_mae_prof;
            }
            function gettp_sexo_prof(){
                return tp_sexo_prof;
            }
            function getdt_nasc_prof(){
                return dt_nasc_prof;
            }
            function getcd_munic_nasc_prof(){
                return cd_munic_nasc_prof;
            }
            function getnr_cns_prof(){
                return nr_cns_prof;
            }
            function getnr_cpf_prof(){
                return nr_cpf_prof;
            }
            function getnr_fone_prof(){
                return nr_fone_prof;
            }
            function getcd_pais_orig_prof(){
                return cd_pais_orig_prof;
            }
            function getcd_munic_end_prof(){
                return cd_munic_end_prof;
            }
            function getnm_bairro_end_prof(){
                return nm_bairro_end_prof;
            }
            function getds_logr_end_prof(){
                return ds_logr_end_prof;
            }
            function getds_compl_end_prof(){
                return ds_compl_end_prof;
            }
            function getds_qd_end_prof(){
                return ds_qd_end_prof;
            }
            function getds_lt_end_prof(){
                return ds_lt_end_prof;
            }
            function getnr_end_prof(){
                return nr_end_prof;
            }
            function getnr_cep_end_prof(){
                return nr_cep_end_prof;
            }
            function getst_prof(){
                return st_prof;
            }
            function getds_email_prof(){
                return ds_email_prof;
            }
            
            this.getform = getform;
            function getform() {
                return form;
            }

            this.ConsultaNomeProfissional = function(){

                var self = this;

                var url = 'smg_c0004';
                var params;
                params = {
                    'opr': 'ConsultaNomeProfissional',
                    'url': url,
                    'form': this.form,
                    'nm_prof': this.nm_prof,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }
            
            this.ConsultaProfissionalCPF = function(callback){
                
                var self = this;
                
                var url = 'smg_c0004';
                var params = {
                    'opr': 'ConsultaProfissionalCPF',
                    'url': url,
                    'form': self.form,
                    'nr_cpf_prof': self.nr_cpf_prof,
                    'st_prof': self.st_prof
                }
                
                self.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.incluir = function(callback){
                
                var self = this;
                var url = 'smg_c0004';
                
                var params = {
                    opr : 'incluir',
                    url : url,
                    form    : self.form,
                    nm_prof : self.nm_prof,
                    nm_mae_prof : self.nm_mae_prof,
                    tp_sexo_prof : self.tp_sexo_prof,
                    dt_nasc_prof : self.dt_nasc_prof,
                    cd_munic_nasc_prof : self.cd_munic_nasc_prof,
                    nr_cns_prof : self.nr_cns_prof,
                    nr_cpf_prof : self.nr_cpf_prof,
                    nr_fone_prof : self.nr_fone_prof,
                    cd_pais_orig_prof : self.cd_pais_orig_prof,
                    cd_munic_end_prof : self.cd_munic_end_prof,
                    nm_bairro_end_prof : self.nm_bairro_end_prof,
                    ds_logr_end_prof : self.ds_logr_end_prof,
                    ds_compl_end_prof : self.ds_compl_end_prof,
                    ds_qd_end_prof : self.ds_qd_end_prof,
                    ds_lt_end_prof : self.ds_lt_end_prof,
                    nr_end_prof : self.nr_end_prof,
                    nr_cep_end_prof : self.nr_cep_end_prof,
                    st_prof : self.st_prof,
                    ds_email_prof : self.ds_email_prof
                };
    
                 self.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.alterar = function(callback){
                
                var self = this;
                var url = 'smg_c0004';
                
                var params = {
                    opr : 'alterar',
                    url : url,
                    form    : self.form,
                    cd_prof : self.cd_prof,
                    cd_munic_nasc_prof : self.cd_munic_nasc_prof,
                    nr_cns_prof : self.nr_cns_prof,
                    nr_cpf_prof : self.nr_cpf_prof,
                    nr_fone_prof : self.nr_fone_prof,
                    cd_munic_end_prof : self.cd_munic_end_prof,
                    nm_bairro_end_prof : self.nm_bairro_end_prof,
                    ds_logr_end_prof : self.ds_logr_end_prof,
                    ds_compl_end_prof : self.ds_compl_end_prof,
                    ds_qd_end_prof : self.ds_qd_end_prof,
                    ds_lt_end_prof : self.ds_lt_end_prof,
                    nr_end_prof : self.nr_end_prof,
                    nr_cep_end_prof : self.nr_cep_end_prof,
                    st_prof : self.st_prof,
                    ds_email_prof : self.ds_email_prof
                };
    
                 self.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            
            this.excluir = function(callback){
                
                var self = this;
                var url = 'smg_c0004';
                
                var params = {
                    opr : 'excluir',
                    url : url,
                    form    : self.form,
                    cd_prof : self.cd_prof
                };
    
                 self.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
            

        },
        m0005:function(){
            
            var cd_prof;
            var nm_prof;
            var cd_conselho;
            var cd_uf;
            var nr_conselho;
            var form;
            
            this.getcd_prof = getcd_prof;
            function getcd_prof() {
                return cd_prof;
            }
            this.getnm_prof = getnm_prof;
            function getnm_prof() {
                return nm_prof;
            }
            this.getcd_conselho = getcd_conselho;
            function getcd_conselho() {
                return cd_conselho;
            }
            this.getcd_uf = getcd_uf;
            function getcd_uf() {
                return cd_uf;
            }
            this.getnr_conselho = getnr_conselho;
            function getnr_conselho() {
                return nr_conselho;
            }
            this.getform = getform;
            function getform() {
                return form;
            }

            this.ConsultaNumeroConselho = function(){
                
                var url = 'smg_c0005';
                var params;
                params = {
                    'opr': 'ConsultaNumeroConselho',
                    'url': url,
                    'form': this.form,
                    'cd_prof': this.cd_prof,
                    'cd_conselho': this.cd_conselho,
                    'nr_conselho': this.nr_conselho,
                    'st_conselho': this.st_conselho
                };
                
                this.requisicaoAjax(url, params, this.form);
            }
            
            this.listaConselhoporProfissional = function(callback){
                
                var url = 'smg_c0005';
                var params;
                 params = {
                    opr: 'listaConselhoporProfissional',
                    url: url,
                    form: this.form,
                    cd_prof: this.cd_prof,
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ConsultaConselhoNomeProfissional = function(inputBusca){
                
                var self = this;
                
                var url = 'smg_c0005';
                var params;
                 params = {
                    opr: 'ConsultaConselhoNomeProfissional',
                    url: url,
                    form: this.form,
                    cd_conselho: this.cd_conselho,
                    nm_prof: this.nm_prof,
                    inputBusca:inputBusca
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
                
            }
            
            this.incluir = function(callback){
                
                var url = 'smg_c0005';
                var params;
                 params = {
                    opr: 'incluir',
                    url: url,
                    form: this.form,
                    'cd_prof': this.cd_prof,
                    'cd_conselho': this.cd_conselho,
                    'cd_uf': this.cd_uf,
                    'nr_conselho': this.nr_conselho
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.excluir = function(callback){
                
                var url = 'smg_c0005';
                var params;
                 params = {
                    opr: 'excluir',
                    url: url,
                    form: this.form,
                    'cd_prof': this.cd_prof,
                    'cd_conselho': this.cd_conselho,
                    'cd_uf': this.cd_uf,
                    'nr_conselho': this.nr_conselho
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }

        },
        m0008:function(){
            
            var cd_espld_medc;
            var nm_espld_medc;
            var cd_cbo;
            var cd_espld_medc_princ;
            var st_espld_medc;
            var form;
            
            this.getcd_espld_medc = getcd_espld_medc;
            function getcd_espld_medc() {
                return cd_espld_medc;
            }
            this.getnm_espld_medc = getnm_espld_medc;
            function getnm_espld_medc() {
                return nm_espld_medc;
            }
            this.getcd_cbo = getcd_cbo;
            function getcd_cbo() {
                return cd_cbo;
            }
            this.getcd_espld_medc_princ = getcd_espld_medc_princ;
            function getcd_espld_medc_princ() {
                return cd_espld_medc_princ;
            }
            this.getst_espld_medc = getst_espld_medc;
            function getst_espld_medc() {
                return st_espld_medc;
            }
            this.getform = getform;
            function getform() {
                return form;
            }

            this.ConsultaCodigoEspecialidade = function(){
                
                var url = 'smg_c0008';
                var params;
                params = {
                    'opr': 'ConsultaCodigoEspecialidade',
                    'url': url,
                    'form': this.form,
                    'cd_espld_medc': this.cd_espld_medc,
                    'st_espld_medc': this.st_espld_medc
                };
                
                this.requisicaoAjax(url, params, this.form);
            }
            
            this.ConsultaNomeEspecialidade = function(){

                var self = this;

                var url = 'smg_c0008';
                var params;
                params = {
                    'opr': 'ConsultaNomeEspecialidade',
                    'url': url,
                    'form': this.form,
                    'nm_espld_medc': this.nm_espld_medc,
                    'st_espld_medc': this.st_espld_medc,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }

        },
        m0010:function(){
            var cd_procd_medc;
            var nm_procd_medc;
            var tp_sexo;
            var vl_idade_min;
            var vl_idade_max;
            var vl_sh;
            var vl_sa;
            var vl_sp;
            var st_procd_medc;
            var form;
             
            this.getcd_procd_medc = getcd_procd_medc;
            function getcd_procd_medc() {
                return cd_procd_medc;
            }
            this.getnm_procd_medc = getnm_procd_medc;
            function getnm_procd_medc() {
                return nm_procd_medc;
            }
            this.gettp_sexo = gettp_sexo;
            function gettp_sexo() {
                return tp_sexo;
            }
            this.getvl_idade_min = getvl_idade_min;
            function getvl_idade_min() {
                return vl_idade_min;
            }
            this.getvl_idade_max = getvl_idade_max;
            function getvl_idade_max() {
                return vl_idade_max;
            }
            this.getvl_sh = getvl_sh;
            function getvl_sh() {
                return vl_sh;
            }
            this.getvl_sa = getvl_sa;
            function getvl_sa() {
                return vl_sa;
            }
            this.getvl_sp = getvl_sp;
            function getvl_sp() {
                return vl_sp;
            }
            this.getst_procd_medc = getst_procd_medc;
            function getst_procd_medc() {
                return st_procd_medc;
            }
            
            this.getform = getform;
            function getform(){return form;}
            
            this.consultaCodigoProcedimento = function(){
                var url = 'smg_c0010';
                var params;
                params = {
                    opr: 'consultaCodigoProcedimento',
                    url: url,
                    form: this.form,
                    cd_procd_medc: this.cd_procd_medc,
                    st_procd_medc: this.st_procd_medc
                };
                this.requisicaoAjax(url, params, this.form);
            };

            this.consultaNomeProcedimento = function(inputBusca, callback){
                
                var url = 'smg_c0010';
                var params;
                params = {
                    opr: 'consultaNomeProcedimento',
                    nm_procd_medc:this.nm_procd_medc,
                    st_procd_medc: this.st_procd_medc,
                    url:url,
                    form:this.form,
                    inputBusca:inputBusca
                };

                this.requisicaoDivModal(url, callback, params);
            }


        },
        m0014:function(){

            var cd_pac;
            var nm_pac;
            var tp_sexo_pac;
            var dt_nasc_pac;
            var cd_munic_nasc_pac;
            var nr_cns_pac;
            var nm_mae_pac;
            var cd_munic_nasc_mae_pac;
            var cd_pais_orig_pac;
            var nr_fone_pac_01;
            var nr_fone_pac_02;
            var nr_fone_pac_03;
            var cd_munic_pac;
            var cd_bairro_pac;
            var ds_logr_pac;
            var ds_compl_pac;
            var ds_qd_pac;
            var ds_lt_pac;
            var nr_pac;
            var nr_cep_pac;
            var ds_email_pac;
            var st_pac_sms;
            var st_pac;
            var form;

            this.getcd_pac = getcd_pac;
            this.getnm_pac = getnm_pac;
            this.gettp_sexo_pac = gettp_sexo_pac;
            this.getdt_nasc_pac = getdt_nasc_pac;
            this.getcd_munic_nasc_pac = getcd_munic_nasc_pac;
            this.getnr_cns_pac = getnr_cns_pac;
            this.getnm_mae_pac = getnm_mae_pac;
            this.getcd_munic_nasc_mae_pac = getcd_munic_nasc_mae_pac;
            this.getcd_pais_orig_pac = getcd_pais_orig_pac;
            this.getnr_fone_pac_01 = getnr_fone_pac_01;
            this.getnr_fone_pac_02 = getnr_fone_pac_02;
            this.getnr_fone_pac_03 = getnr_fone_pac_03;
            this.getcd_munic_pac = getcd_munic_pac;
            this.getcd_bairro_pac = getcd_bairro_pac;
            this.getds_logr_pac = getds_logr_pac;
            this.getds_compl_pac = getds_compl_pac;
            this.getds_qd_pac = getds_qd_pac;
            this.getds_lt_pac = getds_lt_pac;
            this.getnr_pac = getnr_pac;
            this.getnr_cep_pac = getnr_cep_pac;
            this.getds_email_pac = getds_email_pac;
            this.getst_pac_sms = getst_pac_sms;
            this.getst_pac = getst_pac;
            
            function getcd_pac() {
                return cd_pac;
            }
            function getnm_pac() {
                return nm_pac;
            }
            function gettp_sexo_pac() {
                return tp_sexo_pac;
            }
            function getdt_nasc_pac() {
                return dt_nasc_pac;
            }
            function getcd_munic_nasc_pac() {
                return cd_munic_nasc_pac;
            }
            function getnr_cns_pac() {
                return nr_cns_pac;
            }
            function getnm_mae_pac() {
                return nm_mae_pac;
            }
            function getcd_munic_nasc_mae_pac() {
                return cd_munic_nasc_mae_pac;
            }
            function getcd_pais_orig_pac() {
                return cd_pais_orig_pac;
            }
            function getnr_fone_pac_01() {
                return nr_fone_pac_01;
            }
            function getnr_fone_pac_02() {
                return nr_fone_pac_02;
            }
            function getnr_fone_pac_03() {
                return nr_fone_pac_03;
            }
            function getcd_munic_pac() {
                return cd_munic_pac;
            }
            function getcd_bairro_pac() {
                return cd_bairro_pac;
            }
            function getds_logr_pac() {
                return ds_logr_pac;
            }
            function getds_compl_pac() {
                return ds_compl_pac;
            }
            function getds_qd_pac() {
                return ds_qd_pac;
            }
            function getds_lt_pac() {
                return ds_lt_pac;
            }
            function getnr_pac() {
                return nr_pac;
            }
            function getnr_cep_pac() {
                return nr_cep_pac;
            }
            function getds_email_pac() {
                return ds_email_pac;
            }
            function getst_pac_sms() {
                return st_pac_sms;
            }
            function getst_pac() {
                return st_pac;
            }

            this.getform = getform;
            function getform(){return form;}

            this.incluir = function(callback){
                var url = 'smg_c0014';
                var params;
                params = {
                    'opr': 'incluir',
                    'url': url,
                    'form': this.form,
                    'nr_cns_pac' : this.nr_cns_pac,
                    'nm_pac' : this.nm_pac,
                    'tp_sexo_pac' : this.tp_sexo_pac,
                    'dt_nasc_pac' : this.dt_nasc_pac,
                    'cd_pais_orig_pac' : this.cd_pais_orig_pac,
                    'nm_pais_orig_pac' : this.nm_pais_orig_pac,
                    'cd_munic_nasc_pac' : this.cd_munic_nasc_pac,
                    'sg_uf_nasc_pac' : this.sg_uf_nasc_pac,
                    'nm_munic_nasc_pac' : this.nm_munic_nasc_pac,
                    'nm_mae_pac' : this.nm_mae_pac,
                    'cd_munic_nasc_mae_pac' : this.cd_munic_nasc_mae_pac,
                    'sg_uf_nasc_mae_pac' : this.sg_uf_nasc_mae_pac,
                    'nm_munic_nasc_mae_pac' : this.nm_munic_nasc_mae_pac,
                    'cd_munic_pac' : this.cd_munic_pac,
                    'sg_uf_pac' : this.sg_uf_pac,
                    'nm_munic_pac' : this.nm_munic_pac,
                    'nm_bairro_pac' : this.nm_bairro_pac,
                    'ds_logr_pac' : this.ds_logr_pac,
                    'ds_compl_pac' : this.ds_compl_pac,
                    'nr_cep_pac' : this.nr_cep_pac,
                    'ds_qd_pac' : this.ds_qd_pac,
                    'ds_lt_pac' : this.ds_lt_pac,
                    'nr_pac' : this.nr_pac,
                    'nr_fone_pac_01' : this.nr_fone_pac_01,
                    'nr_fone_pac_02' : this.nr_fone_pac_02,
                    'nr_fone_pac_03' : this.nr_fone_pac_03,
                    'ds_email_pac' : this.ds_email_pac
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.alterar = function(callback){
                var url = 'smg_c0014';
                var params;
                params = {
                    'opr': 'alterar',
                    'url': url,
                    'form': this.form,
                    'cd_pac' : this.cd_pac,
                    'nr_cns_pac' : this.nr_cns_pac,
                    'cd_munic_pac' : this.cd_munic_pac,
                    'sg_uf_pac' : this.sg_uf_pac,
                    'nm_munic_pac' : this.nm_munic_pac,
                    'nm_bairro_pac' : this.nm_bairro_pac,
                    'ds_logr_pac' : this.ds_logr_pac,
                    'ds_compl_pac' : this.ds_compl_pac,
                    'nr_cep_pac' : this.nr_cep_pac,
                    'ds_qd_pac' : this.ds_qd_pac,
                    'ds_lt_pac' : this.ds_lt_pac,
                    'nr_pac' : this.nr_pac,
                    'nr_fone_pac_01' : this.nr_fone_pac_01,
                    'nr_fone_pac_02' : this.nr_fone_pac_02,
                    'nr_fone_pac_03' : this.nr_fone_pac_03,
                    'ds_email_pac' : this.ds_email_pac
                };
 
                this.requisicaoAjax(url, params, this.form, callback);
            }
            
            this.alterarPaciente = function(callback){
                
                var url = 'smg_c0020';
                var params;
                params = {
                    'opr': 'alterarPaciente',
                    'url': url,
                    'form': this.form,
                    'cd_pac' : this.cd_pac,
                    'nm_pac' : this.nm_pac,
                    'tp_sexo_pac' : this.tp_sexo_pac,
                    'dt_nasc_pac' : this.dt_nasc_pac,
                    'cd_pais_orig_pac' : this.cd_pais_orig_pac,
                    'nm_pais_orig_pac' : this.nm_pais_orig_pac,
                    'cd_munic_nasc_pac' : this.cd_munic_nasc_pac,
                    'sg_uf_nasc_pac' : this.sg_uf_nasc_pac,
                    'nm_munic_nasc_pac' : this.nm_munic_nasc_pac,
                    'nm_mae_pac' : this.nm_mae_pac,
                    'cd_munic_nasc_mae_pac' : this.cd_munic_nasc_mae_pac,
                    'sg_uf_nasc_mae_pac' : this.sg_uf_nasc_mae_pac,
                    'nm_munic_nasc_mae_pac' : this.nm_munic_nasc_mae_pac
                };
 
                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.excluir = function(){
                var url = 'smg_c0014';
                var params;
                params = {
                    'opr': 'excluir',
                    'url': url,
                    'form': this.form,
                    'cd_pac' : this.cd_pac,
                    'cd_munic_pac' : this.cd_munic_pac,
                    'sg_uf_pac' : this.sg_uf_pac,
                    'nm_munic_pac' : this.nm_munic_pac,
                    'nm_bairro_pac' : this.nm_bairro_pac,
                    'ds_logr_pac' : this.ds_logr_pac,
                    'ds_compl_pac' : this.ds_compl_pac,
                    'nr_cep_pac' : this.nr_cep_pac,
                    'ds_qd_pac' : this.ds_qd_pac,
                    'ds_lt_pac' : this.ds_lt_pac,
                    'nr_pac' : this.nr_pac,
                    'nr_fone_pac_01' : this.nr_fone_pac_01,
                    'nr_fone_pac_02' : this.nr_fone_pac_02,
                    'nr_fone_pac_03' : this.nr_fone_pac_03,
                    'ds_email_pac' : this.ds_email_pac
                };

                this.requisicaoAjax(url, params, this.form);
            }

            // Funçaão alterada retorno era vazio 
            this.consultaCodigoPaciente = function(){
                
                var url = 'smg_c0014';
                var params;
                params = {
                    'opr': 'consultaCodigoPaciente',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac
                };
                this.requisicaoAjax(url, params, this.form);
            }

            this.consultaNomePaciente = function(nmGrid, inputBusca, pegaPaciente, callback){
                
                var url = 'smg_c0014';
                var params;
                params = {
                    'opr': 'consultaNomePaciente',                    
                    'nm_pac':this.nm_pac,
                    'tp_sexo_pac':this.tp_sexo_pac,
                    'dt_nasc_pac':this.dt_nasc_pac,
                    'nm_mae_pac':this.nm_mae_pac,
                    'nr_cns_pac':this.nr_cns_pac,
                    'url':url,
                    'form':this.form,
                    inputBusca:inputBusca

                };

                this.prencheTabelaGridNoAsync(url, params, this.form, pegaPaciente);
            }
            
            this.consultaNomePacienteProntuario = function(nmGrid, inputBusca, pegaPaciente, callback){
                
                var url = 'smg_c0014';
                var params;
                params = {
                    'opr': 'consultaNomePacienteProntuario',
                    'nm_pac':this.nm_pac,
                    'tp_sexo_pac':this.tp_sexo_pac,
                    'dt_nasc_pac':this.dt_nasc_pac,
                    'nm_mae_pac':this.nm_mae_pac,
                    'nr_cns_pac':this.nr_cns_pac,
                    'st_prontuario':this.st_prontuario,
                    'url':url,
                    'form':this.form,
                    inputBusca:inputBusca
                };

                this.prencheTabelaGridNoAsync(url, params, this.form, pegaPaciente);
            }

            this.consultaBuscaNomePaciente = function(callback){
                
                var url = './smg/view/smg_f0014.php';

                var params = Array();
                params = {};

                $.post(url,params,function(html){

                    //id unico para modal
                    var id = 'id-modal-'+Math.floor(Math.random()*10000);

                    /* Chamar o dialog */
                    var $div = $('<div class="div-modal"></div>').html(html);
                    $div.attr('id',id);

                    this.configEventos = function(){

                      $("#"+id+' div.grid_corpo  table').trigger("update");

                        $("#"+id).find('table tbody tr').click(function(){

                            var data = $(this).data('data');
                            //chama funcao callback
                            if(callback ){
                                callback (data);
                                $('#'+id).dialog('destroy');
                            }
                        });
                    }

                    var _this = this;

                    $.ajaxSetup({
                        async:false
                    });

                    /* Opções default */
                    var defaultOptions = {
                        modal: true,
                        title: 'Envolverti',
                        resizable: false,
                        width: 'auto',
                        height: 'auto',
                        zIndex: 9999,
                        position: ['center', 100],
                        dialogClass: 'dialog-smg_h0014',
                        buttons:{Selecionar:function(){
                              var inputPac = $(this).find('input[id="smg_h0014-cd_pac"]');
                              if(!inputPac.val()){
                                  alert('Selecione um paciente!');
                                  return;
                              }else{
                                  $(this).dialog('destroy');
                              }
                              if(callback)callback(inputPac.val());
                        }},
                        buttonsClass : 'teste',
                        close:function(){
                            try{
                                $(this).dialog('destroy');
                            }catch(error){}
                        },
                        open: function(event, ui){
                            _this.configEventos();
                            $div.find('.divfiltrar input').keyup(function(){
                                $.ajaxSetup({
                                    async:true
                                });

                                $.post(url,{
                                    filtro: params,
                                    texto: this.value,
                                    'opr' : params.opr,
                                    'url' : params.url
                                },function(tabela){

                                    $div.find('table tbody').replaceWith($(tabela).find('table tbody'));

                                    _this.configEventos();
                                    $.ajaxSetup({
                                        async:false
                                    });
                                });

                            });
                        }
                    }

                    $div.dialog(defaultOptions);
                })
            }
        },
        m0021:function(){
            
            var cd_empresa;
            var cd_pac_cnes;
            var cd_pac_ant;
            var cd_pac_novo;
            var nr_prontuario;
            var cd_usuario;
            var dt_alt_pac;
            var hr_alt_pac;
            
            this.getcd_empresa = getcd_empresa;
            this.getcd_pac_cnes = getcd_pac_cnes;
            this.getcd_pac_ant = getcd_pac_ant;
            this.getcd_pac_novo = getcd_pac_novo;
            this.getnr_prontuario = getnr_prontuario;
            this.getcd_usuario = getcd_usuario;
            this.getdt_alt_pac = getdt_alt_pac;
            this.gethr_alt_pac = gethr_alt_pac;
            
            function getcd_empresa(){
                return cd_empresa;
            }
            function getcd_pac_cnes(){
                return cd_pac_cnes;
            }
            function getcd_pac_ant(){
                return cd_pac_ant;
            }
            function getcd_pac_novo(){
                return cd_pac_novo;
            }
            function getnr_prontuario(){
                return nr_prontuario;
            }
            function getcd_usuario(){
                return cd_usuario;
            }
            function getdt_alt_pac(){
                return dt_alt_pac;
            }
            function gethr_alt_pac(){
                return hr_alt_pac;
            }

            this.confirmaAlteracaoProntuario = function(callback){

                var url = 'smg_c0021';
                var params;
                 params = {
                        opr: 'confirmar',
                        url: url,
                        form: this.form,
                        cd_empresa : this.cd_empresa,
                        cd_pac_cnes : this.cd_pac_cnes,
                        cd_pac_ant : this.cd_pac_ant,
                        cd_pac_novo : this.cd_pac_novo,
                        nr_prontuario : this.nr_prontuario
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
        }
    }
}

pacote_SMG.Smg.m0001.prototype = new Formulario();
pacote_SMG.Smg.m0002.prototype = new Formulario();
pacote_SMG.Smg.m0003.prototype = new Formulario();
pacote_SMG.Smg.m0004.prototype = new Formulario();
pacote_SMG.Smg.m0005.prototype = new Formulario();
pacote_SMG.Smg.m0008.prototype = new Formulario();
pacote_SMG.Smg.m0010.prototype = new Formulario();
pacote_SMG.Smg.m0014.prototype = new Formulario();
pacote_SMG.Smg.m0021.prototype = new Formulario();