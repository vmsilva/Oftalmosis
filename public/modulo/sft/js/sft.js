var pacote_SFT = {
    Sft:{
        m0001:function(){
            var cd_empresa;
            var cd_fatur_bpa;
            var cd_agenda;
            
            this.getcd_empresa = getcd_empresa;
            function getcd_empresa() {
                return cd_empresa;
            }
            this.getcd_fatur_bpa = getcd_fatur_bpa;
            function getcd_fatur_bpa() {
                return cd_fatur_bpa;
            }
            this.getcd_agenda = getcd_agenda;
            function getcd_agenda() {
                return cd_agenda;
            }
            
            this.Incluir = function(ArrayDadosGrupoConsulta,ArrayDadosProcedimento,callback){

                var self = this;
                var url = 'sft_c0002';
                var params;
                params = {
                    opr: 'Incluir',
                    url: url,
                    form: self.form,
                    cd_agenda: self.cd_agenda,
                    cd_prof: self.cd_prof,
                    cd_espld_medc: self.cd_espld_medc,
                    cd_pac: self.cd_pac,
                    dt_atend: self.dt_atend,
                    DadosGrupoConsulta: ArrayDadosGrupoConsulta,
                    DadosProcedimento: ArrayDadosProcedimento
                };

                this.requisicaoAjaxRetornaValores(url, params, self.form, callback);
            }
        }
    }
};

pacote_SFT.Sft.m0001.prototype = new Formulario();