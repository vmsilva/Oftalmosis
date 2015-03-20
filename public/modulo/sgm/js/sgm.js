var pacote_SGM = {
    Sgm:{
        m0001:function(){
            
            var cd_pais;
            var nm_pais;
            var form;

            this.getcd_pais = getcd_pais;
            function getcd_pais() {
                return cd_pais;
            }
            this.getnm_pais = getnm_pais;
            function getnm_pais() {
                return nm_pais;
            }
            this.getform = getform;
            function getform() {
                return form;
            }

            this.consultaCodigoPais = function(nm_campo_ret){
                
                var url = 'sgm_c0001';
                var params;
                params = {
                    'opr': 'consultaCodigoPais',
                    'url': url,
                    'form': this.form,
                    'cd_pais': this.cd_pais,
                    'nm_campo': nm_campo_ret
                };

                this.requisicaoAjax(url, params, this.form);
            }

            this.ConsultaNomePais = function(nm_campo_busca){

                var self = this;

                var url = 'sgm_c0001';
                var params;
                params = {
                    'opr': 'consultaNomePais',
                    'url': url,
                    'form': this.form,
                    'nm_pais': this.nm_pais,
                    'nm_campo_busca':nm_campo_busca,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }

        },
        m0002:function(){

        },
        m0003:function(){
            var cd_munic;
            var nm_munic;
            var cd_uf;
            var sg_uf;
            var form;

            this.getcd_munic = getcd_munic;
            function getcd_munic() {
                return cd_munic;
            }
            this.getnm_munic = getnm_munic;
            function getnm_munic() {
                return nm_munic;
            }
            this.getcd_uf = getcd_uf;
            function getcd_uf() {
                return cd_uf;
            }
            this.getsg_uf = getsg_uf;
            function getsg_uf() {
                return sg_uf;
            }
            this.getform = getform;
            function getform() {
                return form;
            }

            this.consultaCodigoMunicipio = function(nm_campo_ret){

                var url = 'sgm_c0003';
                var params;
                params = {
                    'opr': 'consultaCodigoMunicipio',
                    'url': url,
                    'form': this.form,
                    'cd_munic': this.cd_munic,
                    'nm_campo': nm_campo_ret
                };

                this.requisicaoAjax(url, params, this.form);
            }

            this.ConsultaNomeMunicipio = function(nm_campo_busca){

                var self = this;

                var url = 'sgm_c0003';
                var params;
                params = {
                    'opr': 'consultaNomeMunicipio',
                    'url': url,
                    'form': this.form,
                    'sg_uf': this.sg_uf,
                    'nm_campo_busca':nm_campo_busca,
                    inputBusca:1
                };
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            }

        }
    }
}

pacote_SGM.Sgm.m0001.prototype = new Formulario();
pacote_SGM.Sgm.m0003.prototype = new Formulario();