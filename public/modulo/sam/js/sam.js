var pacote_SAM = {
    Sam:{
        m0001:function(){
            
            var cd_escola;
            var nm_escola;
            var nm_resp_esc;
            var cd_munic_esc;
            var nm_bairro_esc;
            var ds_logr_esc;
            var ds_compl_esc;
            var ds_qd_esc;
            var ds_lt_esc;
            var nr_end_esc;
            var nr_cep_esc;
            var nr_fone_01;
            var nr_fone_02;
            var nr_fone_03;
            var st_escola;
            var ds_email_pac;
            var form;
            
            this.getcd_escola = getcd_escola;
            this.getnm_escola = getnm_escola;
            this.getnm_resp_esc = getnm_resp_esc;
            this.getcd_munic_esc = getcd_munic_esc;
            this.getnm_bairro_esc = getnm_bairro_esc;
            this.getds_logr_esc = getds_logr_esc;
            this.getds_compl_esc = getds_compl_esc;
            this.getds_qd_esc = getds_qd_esc;
            this.getds_lt_esc = getds_lt_esc;
            this.getnr_end_esc = getnr_end_esc;
            this.getnr_cep_esc = getnr_cep_esc;
            this.getnr_fone_01 = getnr_fone_01;
            this.getnr_fone_02 = getnr_fone_02;
            this.getnr_fone_03 = getnr_fone_03;
            this.getst_escola = getst_escola;
            this.getds_email_pac = getds_email_pac;
            
            function getcd_escola() {
                return cd_escola;
            }
            function getnm_escola() {
                return nm_escola;
            }
            function getnm_resp_esc() {
                return nm_resp_esc;
            }
            function getcd_munic_esc() {
                return cd_munic_esc;
            }
            function getnm_bairro_esc() {
                return nm_bairro_esc;
            }
            function getds_logr_esc() {
                return ds_logr_esc;
            }
            function getds_compl_esc() {
                return ds_compl_esc;
            }
            function getds_qd_esc() {
                return ds_qd_esc;
            }
            function getds_lt_esc() {
                return ds_lt_esc;
            }
            function getnr_end_esc() {
                return nr_end_esc;
            }
            function getnr_cep_esc() {
                return nr_cep_esc;
            }
            function getnr_fone_01() {
                return nr_fone_01;
            }
            function getnr_fone_02() {
                return nr_fone_02;
            }
            function getnr_fone_03() {
                return nr_fone_03;
            }
            function getst_escola() {
                return st_escola;
            }
            function getds_email_pac() {
                return ds_email_pac;
            }

            this.getform = getform;
            function getform() {
                return form;
            }

            this.consultaCodigoEscola = function(){
                
                var url = 'sam_c0001';
                var params;
                params = {
                    'opr': 'consultaCodigoEscola',
                    'url': url,
                    'form': this.form,
                    'cd_escola': this.cd_escola,
                    'st_escola': this.st_escola
                };

                this.requisicaoAjax(url, params, this.form);
            }

            this.ConsultaNomeEscola = function(){

                var self = this;

                var url = 'sam_c0001';
                var params;
                params = {
                    'opr': 'consultaNomeEscola',
                    'url': url,
                    'form': this.form,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }
            
            this.incluir = function(callback){
                var url = 'sam_c0001';
                var params;
                params = {
                    'opr': 'incluir',
                    'url': url,
                    'form': this.form,
                    'cd_escola': this.cd_escola,
                    'nm_escola': this.nm_escola,
                    'nm_resp_esc': this.nm_resp_esc,
                    'cd_munic_esc': this.cd_munic_esc,
                    'sg_uf': this.sg_uf,
                    'nm_munic': this.nm_munic,
                    'nm_bairro_esc': this.nm_bairro_esc,
                    'ds_logr_esc': this.ds_logr_esc,
                    'ds_compl_esc': this.ds_compl_esc,
                    'ds_qd_esc': this.ds_qd_esc,
                    'ds_lt_esc': this.ds_lt_esc,
                    'nr_end_esc': this.nr_end_esc,
                    'nr_cep_esc': this.nr_cep_esc,
                    'nr_fone_01': this.nr_fone_01,
                    'nr_fone_02': this.nr_fone_02,
                    'nr_fone_03': this.nr_fone_03,
                    'st_escola': this.st_escola,
                    'ds_email_esc': this.ds_email_esc
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }
            
            this.alterar = function(callback){
                var url = 'sam_c0001';
                var params;
                params = {
                    'opr': 'alterar',
                    'url': url,
                    'form': this.form,
                    'cd_escola': this.cd_escola,
                    'nm_escola': this.nm_escola,
                    'nm_resp_esc': this.nm_resp_esc,
                    'cd_munic_esc': this.cd_munic_esc,
                    'sg_uf': this.sg_uf,
                    'nm_munic': this.nm_munic,
                    'nm_bairro_esc': this.nm_bairro_esc,
                    'ds_logr_esc': this.ds_logr_esc,
                    'ds_compl_esc': this.ds_compl_esc,
                    'ds_qd_esc': this.ds_qd_esc,
                    'ds_lt_esc': this.ds_lt_esc,
                    'nr_end_esc': this.nr_end_esc,
                    'nr_cep_esc': this.nr_cep_esc,
                    'nr_fone_01': this.nr_fone_01,
                    'nr_fone_02': this.nr_fone_02,
                    'nr_fone_03': this.nr_fone_03,
                    'st_escola': this.st_escola,
                    'ds_email_esc': this.ds_email_esc
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }
            
            this.excluir = function(callback){
                var url = 'sam_c0001';
                var params;
                params = {
                    'opr': 'excluir',
                    'url': url,
                    'form': this.form,
                    'cd_escola': this.cd_escola,
                    'nm_escola': this.nm_escola,
                    'nm_resp_esc': this.nm_resp_esc,
                    'cd_munic_esc': this.cd_munic_esc,
                    'sg_uf': this.sg_uf,
                    'nm_munic': this.nm_munic,
                    'nm_bairro_esc': this.nm_bairro_esc,
                    'ds_logr_esc': this.ds_logr_esc,
                    'ds_compl_esc': this.ds_compl_esc,
                    'ds_qd_esc': this.ds_qd_esc,
                    'ds_lt_esc': this.ds_lt_esc,
                    'nr_end_esc': this.nr_end_esc,
                    'nr_cep_esc': this.nr_cep_esc,
                    'nr_fone_01': this.nr_fone_01,
                    'nr_fone_02': this.nr_fone_02,
                    'nr_fone_03': this.nr_fone_03,
                    'st_escola': this.st_escola,
                    'ds_email_esc': this.ds_email_esc
                };
                
                this.requisicaoAjax(url, params, this.form, callback);
            }

        },
        m0002:function(){
            
            
            this.incluirAtendimentoManual = function(callback){
                
                var url = 'sam_c0002';
                var params;
                params = {
                    'opr': 'Incluir',
                    'url': url,
                    'form': this.form,
                    'cd_pac' : this.cd_pac,
                    'cd_escola' : this.cd_escola,
                    'in_turno' : this.in_turno,
                    'in_diabetico' : this.in_diabetico,
                    'cd_prof' : this.cd_prof,
                    'cd_conselho' : this.cd_conselho,
                    'nr_conselho' : this.nr_conselho,
                    'cd_espld_medc' : this.cd_espld_medc,
                    'cd_tp_grade' : this.cd_tp_grade,
                    'tp_atend' : this.tp_atend,
                    'st_fila' : this.st_fila,
                    'st_atend' : this.st_atend,
                    'dt_atend' : this.dt_atend,
                    'ds_hist_atual_doenca' : this.ds_hist_atual_doenca,
                    'ds_anteced' : this.ds_anteced,
                    'ds_ectoscopia' : this.ds_ectoscopia,
                    'in_av_sc_od' : this.in_av_sc_od,
                    'in_av_sc_oe' : this.in_av_sc_oe,
                    'in_oc_od' : this.in_oc_od,
                    'in_oc_oe' : this.in_oc_oe,
                    'in_rf_dn_od' : this.in_rf_dn_od,
                    'in_rf_dn_oe' : this.in_rf_dn_oe,
                    'ds_conduta' : this.ds_conduta
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }
        }
    }
}

pacote_SAM.Sam.m0001.prototype = new Formulario();
pacote_SAM.Sam.m0002.prototype = new Formulario();