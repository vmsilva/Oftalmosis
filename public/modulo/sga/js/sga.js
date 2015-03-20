var pacote_SGA = {
    Sga:{
        m0001:function(){
            
            var cd_grp_consulta;
            var nm_grp_consulta;
            var st_grp_consulta;
            
            this.getcd_grp_consulta = getcd_grp_consulta;
            function getcd_grp_consulta() {
                return cd_grp_consulta;
            }
            this.getnm_grp_consulta = getnm_grp_consulta;
            function getnm_grp_consulta() {
                return nm_grp_consulta;
            }
            this.getst_grp_consulta = getst_grp_consulta;
            function getst_grp_consulta() {
                return st_grp_consulta;
            }
            
            this.consultaCodigoGrupoConsulta = function(){
                
                var url = 'sga_c0001';
                var params;
                params = {
                    opr: 'consultaCodigoGrupoConsulta',
                    url: url,
                    form: this.form,
                    cd_grp_consulta: this.cd_grp_consulta,
                    st_grp_consulta: this.st_grp_consulta
                };
                
                
                this.requisicaoAjax(url, params, this.form);
            };

            this.consultaNomeGrupoConsulta = function(inputBusca, callback){
                
                var url = 'sga_c0001';
                var params;
                params = {
                    opr: 'consultaNomeGrupoConsulta',
                    nm_grp_consulta:this.nm_grp_consulta,
                    st_grp_consulta: this.st_grp_consulta,
                    url:url,
                    form:this.form,
                    inputBusca:inputBusca
                };

                this.requisicaoDivModal(url, callback, params);
            }
			
            this.BuscaCodigo = function(callback){
                
                var url= 'sga_c0001';
                var params;
                params = {
                    opr: 'buscaCodigo',
                    url: url,
                    form: this.form,
                    cd_grp_consulta: this.cd_grp_consulta,
                    nm_grp_consulta: this.nm_grp_consulta,
                    st_grp_consulta: this.st_grp_consulta
                };
 
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);                
            };
            
            this.listaNome = function(callback){
                
                var url = 'sga_c0001';
                var params;
                
                params = {
                    opr: 'listaNome',
                    url: url,
                    form: this.form,
                    nm_grp_consulta: this.nm_grp_consulta,
                    st_grp_consulta: this.st_grp_consulta
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
                
            };
            
            this.consultaNome = function(){
                
                var self = this;
                
                var url = 'sga_c0001';
                var params;
                 params = {
                    opr: 'consultaNome',
                    url: url,
                    form: this.form,
                    nm_grp_consulta: this.nm_grp_consulta,
                    st_grp_consulta: this.st_grp_consulta
                };
                
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            };
            
            this.Incluir = function(callback){
                
                var url = 'sga_c0001';
                var params;
                params = {
                    opr:'incluir',
                    url: url,
                    form: this.form,
                    nm_grp_consulta:this.nm_grp_consulta,
                    st_grp_consulta:this.st_grp_consulta
                    
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
                
            };
            
            this.Alterar = function(callback){
                
                var url = 'sga_c0001';
                var params;
                params = {
                    opr:'alterar',
                    url: url,
                    form: this.form,
                    nm_grp_consulta:this.nm_grp_consulta,
                    st_grp_consulta:this.st_grp_consulta,
                    cd_grp_consulta:this.cd_grp_consulta
                    
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            
            };
            
            this.Excluir = function(callback){
                
                var url = 'sga_c0001';
                var params;
                params = {
                    opr:'excluir',
                    url:url,
                    form:this.form,
                    nm_grp_consulta:this.nm_grp_consulta,
                    st_grp_consulta:this.st_grp_consulta,
                    cd_grp_consulta:this.cd_grp_consulta
                };

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };        
        },		
        m0002:function(){
		
            var cd_grp_consulta;
            var nm_grp_consulta;
            var cd_procd_medc;
            var nm_procd_medc;
            var vl_sa_cont;
            var nr_qtde_procd_medc;
            
            this.getcd_grp_consulta = getcd_grp_consulta;
            function getcd_grp_consulta() {
                return cd_grp_consulta;
            }
            this.getnm_grp_consulta = getnm_grp_consulta;
            function getnm_grp_consulta() {
                return nm_grp_consulta;
            }
            this.getcd_procd_medc = getcd_procd_medc;
            function getcd_procd_medc() {
                return cd_procd_medc;
            }
            this.getnm_procd_medc = getnm_procd_medc;
            function getnm_procd_medc() {
                return nm_procd_medc;
            }
            this.getvl_sa_cont = getvl_sa_cont;
            function getvl_sa_cont() {
                return vl_sa_cont;
            }
            this.getnr_qtde_procd_medc = getnr_qtde_procd_medc;
            function getnr_qtde_procd_medc() {
                return nr_qtde_procd_medc;
            }
            
            this.consultaCodigoGrupoProcedimento = function(){
                var url = 'sga_c0002';
                var params;
                params = {
                    opr: 'consultaCodigoGrupoProcedimento',
                    url: url,
                    form: this.form,
                    cd_grp_procd_medc: this.cd_procd_medc,
                    st_grp_procd_medc: this.st_procd_medc
                };
                this.requisicaoAjax(url, params, this.form);
            };

            this.consultaNomeGrupoProcedimento = function(inputBusca, callback){
                
                var url = 'sga_c0002';
                var params;
                params = {
                    opr: 'consultaNomeGrupoProcedimento',
                    nm_grp_procd_medc:this.nm_procd_medc,
                    st_grp_procd_medc: this.st_procd_medc,
                    url:url,
                    form:this.form,
                    inputBusca:inputBusca
                };

                this.requisicaoDivModal(url, callback, params);
            }
			
			
            this.BuscaCodigoProcedimento = function(callback){
                
                var self = this;
                
                var url = 'sga_c0002';
                var params;
                params = {
                    'opr': 'buscacodigoprocedimento',
                    'url': url,
                    'form': this.form,
                    'cd_procd_medc': this.cd_procd_medc,
                    'cd_grp_consulta':this.cd_grp_consulta
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
            
            this.ListaProcedimento = function(callback){
                
                var url = 'sga_c0002';
                var params;
                params = {
                    opr:'listar',
                    url: url,
                    form: this.form,
                    cd_grp_consulta: this.cd_grp_consulta
                };
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
            
            this.consultaNome = function(){
                
                var self = this;                
                var url = 'sga_c0002';
                var params;
                 params = {
                    'opr': 'buscanomeprocedimento',
                    'url': url,
                    'form': this.form,
                    'cd_grp_consulta':this.cd_grp_consulta,
                    'nm_procd_medc': this.nm_procd_medc,
                    inputBusca:1
                };
                
                var callback = function(d){
                    self.preencheDadosFormulario(d, params.form);
                };

                this.requisicaoDivModal(url, callback, params);
            };
            
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
                
                var url = 'sga_c0002';
                var params;
                params = {
                    opr:'incluir',
                    url: url,
                    form: this.form,
                    cd_grp_consulta: this.cd_grp_consulta,
                    cd_procd_medc: this.cd_procd_medc,
                    vl_sa_cont: this.vl_sa_cont,
                    nr_qtde_procd_medc: this.nr_qtde_procd_medc
                    
                };
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
                
            }; 
            
            this.Excluir = function(callback){
                
                var url = 'sga_c0002';
                var params;
                params = {
                    opr:'excluir',
                    url: url,
                    form: this.form,
                    cd_grp_consulta: this.cd_grp_consulta,
                    cd_procd_medc: this.cd_procd_medc                    
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };

        },        
        m0003:function(){
            var cd_procd_medc;
            var nm_procd_medc;
            var nr_dia_semana;
            var in_local_atend;
            var hr_ini_atend;
            var hr_fin_atend;
            var nr_id_min;
            var nr_id_max;
            var nr_qtd_atend;
            var form;
            
            this.getcd_procd_medc = getcd_procd_medc;
            function getcd_procd_medc() {
                return cd_procd_medc;
            }   
            this.getnm_procd_medc = getnm_procd_medc;
            function getnm_procd_medc() {
                return nm_procd_medc;
            }   
            this.getnr_dia_semana = getnr_dia_semana;
            function getnr_dia_semana() {
                return nr_dia_semana;
            }   
            this.getin_local_atend = getin_local_atend;
            function getin_local_atend() {
                return in_local_atend;
            }   
            this.gethr_ini_atend = gethr_ini_atend;
            function gethr_ini_atend() {
                return hr_ini_atend;
            }   
            this.gethr_fin_atend = gethr_fin_atend;
            function gethr_fin_atend() {
                return hr_fin_atend;
            }   
            this.getnr_id_min = getnr_id_min;
            function getnr_id_min() {
                return nr_id_min;
            }   
            this.getnr_id_max = getnr_id_max;
            function getnr_id_max() {
                return nr_id_max;
            }   
            this.getnr_qtd_atend = getnr_qtd_atend;
            function getnr_qtd_atend() {
                return nr_qtd_atend;
            }
            this.getform = getform;
            function getform() {
                return form;
            }
            
            this.Incluir = function(callback){
                
                var url = 'sga_c0003';
                var params;
                params = {
                   'opr' : 'incluir',
                   'url' : url,
                   'form': this.form,
                   'cd_procd_medc'  : this.cd_procd_medc,
                   'nm_procd_medc'  : this.nm_procd_medc,
                   'nr_dia_semana'  : this.nr_dia_semana,
                   'in_local_atend' : this.in_local_atend,
                   'hr_ini_atend'   : this.hr_ini_atend,
                   'hr_fin_atend'   : this.hr_fin_atend,
                   'nr_id_min'      : this.nr_id_min,
                   'nr_id_max'      : this.nr_id_max,
                   'nr_qtd_atend'   : this.nr_qtd_atend                   
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            },
                    
            this.Excluir = function(callback){
                
                var url = 'sga_c0003';
                var params;
                params = {
                    'opr' : 'excluir',
                    'url': url,
                    'form': this.form,
                    'cd_procd_medc': this.cd_procd_medc,
                    'cd_grade':this.cd_grade
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
                
            },
            
            this.listaGrade = function(callback){
                
                var url = 'sga_c0003';
                var params;
                params = {
                    'opr' : 'listar',
                    'url': url,
                    'form': this.form,
                    'cd_procd_medc': this.cd_procd_medc
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
                
            }
        },        
        m0004:function(){
            var cd_cnes;
            var cd_tp_grade;
            var nm_tp_grade;
            var st_tp_grade;
            var st_agendamento;
            var form;

            this.getcd_cnes = getcd_cnes;
            function getcd_cnes() {
                return cd_cnes;
            }
            this.getcd_tp_grade = getcd_tp_grade;
            function getcd_tp_grade() {
                return cd_tp_grade;
            }
            this.getnm_tp_grade = getnm_tp_grade;
            function getnm_tp_grade() {
                return nm_tp_grade;
            }
            this.getst_tp_grade = getst_tp_grade;
            function getst_tp_grade() {
                return st_tp_grade;
            }
            this.getst_agendamento = getst_agendamento;
            function getst_agendamento() {
                return st_agendamento;
            }
            this.getform = getform;
            function getform() {
                return form;
            }

            this.ConsultaNomeTipoGrade = function(nmGrid, inputBusca, callback){
                
                var url = 'sga_c0004';
                var params;
                 params = {
                    'opr': 'ConsultaNomeTipoGrade',
                    'url': url,
                    'form': this.form,
                    'st_tp_grade': this.st_tp_grade,
                    inputBusca:inputBusca
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }

        },
        m0006:function(){
    
            var cd_empresa;
            var cd_agenda;
            var cd_cnes;
            var cd_prof;
            var cd_espld_medc;
            var in_local_atend;
            var nr_dia_semana;
            var cd_tp_grade;
            var nr_id_min;
            var nr_id_max;
            var hr_ini_atend;
            var hr_fin_atend;
            var hr_atend;
            var dt_atend;
            var hr_agend;
            var cd_pac;
            var st_agenda;
            var st_atend;
            var cd_usu_ger_agenda;
            var dt_usu_ger_agenda;
            var cd_usu_cad_agenda;
            var dt_usu_cad_agenda;
            var cd_usu_alt_agenda;
            var dt_usu_alt_agenda;
            var form;
            
            this.getcd_agenda = getcd_agenda;
            function getcd_agenda() {
                return cd_agenda;
            }
            this.getcd_cnes = getcd_cnes;
            function getcd_cnes() {
                return cd_cnes;
            }
            this.getcd_prof = getcd_prof;
            function getcd_prof() {
                return cd_prof;
            }
            this.getcd_espld_medc = getcd_espld_medc;
            function getcd_espld_medc() {
                return cd_espld_medc;
            }
            this.getin_local_atend = getin_local_atend;
            function getin_local_atend() {
                return in_local_atend;
            }
            this.getnr_dia_semana = getnr_dia_semana;
            function getnr_dia_semana() {
                return nr_dia_semana;
            }
            this.getcd_tp_grade = getcd_tp_grade;
            function getcd_tp_grade() {
                return cd_tp_grade;
            }
            this.nr_id_min = nr_id_min;
            function getnr_id_min() {
                return nr_id_min;
            }
            this.getnr_id_max = getnr_id_max;
            function getnr_id_max() {
                return nr_id_max;
            }
            this.gethr_ini_atend = gethr_ini_atend;
            function gethr_ini_atend() {
                return hr_ini_atend;
            }
            this.gethr_fin_atend = gethr_fin_atend;
            function gethr_fin_atend() {
                return hr_fin_atend;
            }
            this.gethr_atend = gethr_atend;
            function gethr_atend() {
                return hr_atend;
            }
            this.getdt_atend = getdt_atend;
            function getdt_atend() {
                return dt_atend;
            }
            this.getcd_pac = getcd_pac;
            function getcd_pac() {
                return cd_pac;
            }
            this.getst_agenda = getst_agenda;
            function getst_agenda() {
                return st_agenda;
            }
            this.getst_atend = getst_atend;
            function getst_atend() {
                return st_atend;
            }
            this.getcd_usu_ger_agenda = getcd_usu_ger_agenda;
            function getcd_usu_ger_agenda() {
                return cd_usu_ger_agenda;
            }
            this.getdt_usu_ger_agenda = getdt_usu_ger_agenda;
            function getdt_usu_ger_agenda() {
                return dt_usu_ger_agenda;
            }
            this.getcd_usu_cad_agenda = getcd_usu_cad_agenda;
            function getcd_usu_cad_agenda() {
                return cd_usu_cad_agenda;
            }
            this.getdt_usu_cad_agenda = getdt_usu_cad_agenda;
            function getdt_usu_cad_agenda() {
                return dt_usu_cad_agenda;
            }
            this.getcd_usu_alt_agenda = getcd_usu_alt_agenda;
            function getcd_usu_alt_agenda() {
                return cd_usu_alt_agenda;
            }
            this.getdt_usu_alt_agenda = getdt_usu_alt_agenda;
            function getdt_usu_alt_agenda() {
                return dt_usu_alt_agenda;
            }
            this.getform = getform;
            function getform() {
                return form;
            }
            
            this.ListaProfissionalDataAgenda = function(callback){
                
                var url = 'sga_c0006';
                var params;
                params = {
                    'opr' : 'ListaProfissionalDataAgenda',
                    'url': url,
                    'form': this.form,
                    'dt_atend': this.cd_agenda
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ListaEspecialidadeProfissionalDataAgenda = function(callback){
                
                var url = 'sga_c0006';
                var params;
                params = {
                    'opr' : 'ListaEspecialidadeProfissionalDataAgenda',
                    'url': url,
                    'form': this.form,
                    'dt_atend': this.cd_agenda,
                    'cd_prof': this.cd_prof
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.listaAgendaProfissionalDia = function(callback){
                
                var url = 'sga_c0006';
                var params;
                params = {
                    'opr' : 'listaAgendaProfissionalDia',
                    'url': url,
                    'form': this.form,
                    'dt_atend': this.cd_agenda,
                    'cd_prof': this.cd_prof,
                    'cd_espld_medc': this.cd_espld_medc
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.listaAgendaDia = function(callback){
                
                var url = 'sga_c0006';
                var params;
                params = {
                    opr : 'listaAgendaDia',
                    url : url,
                    form : this.form,
                    cd_cnes : this.cd_cnes
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.listaAgenda = function(callback){
                
                var url = 'sga_c0006';
                var params;
                params = {
                    opr : 'listaAgenda',
                    url: url,
                    form: this.form,
                    dt_atend: this.dt_atend,
                    st_agenda: this.st_agenda,
                    st_fatur: this.st_fatur,
                    cd_prof: this.cd_prof,
                    cd_espld_medc: this.cd_espld_medc
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            this.buscaAgenda = function(callback){
                
                var url = 'sga_c0006';
                var params;
                params = {
                    opr : 'buscaAgenda',
                    url : url,
                    form : this.form,
                    cd_agenda : this.cd_agenda
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
        },
        m0007:function(){
            var cd_empresa;
            var cd_fila;
            var cd_cnes;
            var cd_espld_medc;
            var cd_prof;
            var cd_agenda;
            var tp_atend;
            var in_servico;
            var cd_pac;
            var dt_atend;
            var hr_cheg;
            var hr_ini_atend;
            var hr_fin_atend;
            var st_fila;
            var cd_empresa_pai;
            var cd_fila_pai;
            
            this.getcd_empresa = getcd_empresa;
            function getcd_empresa() {
                return cd_empresa;
            }            
            this.getcd_fila = getcd_fila;
            function getcd_fila() {
                return cd_fila;
            }            
            this.getcd_cnes = getcd_cnes;
            function getcd_cnes() {
                return cd_cnes;
            }
            this.getcd_espld_medc = getcd_espld_medc;
            function getcd_espld_medc() {
                return cd_espld_medc;
            }
            this.getcd_prof = getcd_prof;
            function getcd_prof() {
                return cd_prof;
            }
            this.getcd_agenda = getcd_agenda;
            function getcd_agenda() {
                return cd_agenda;
            }
            this.gettp_atend = gettp_atend;
            function gettp_atend() {
                return tp_atend;
            }
            this.getin_servico = getin_servico;
            function getin_servico() {
                return in_servico;
            }
            this.getcd_pac = getcd_pac;
            function getcd_pac() {
                return cd_pac;
            }            
            this.getdt_atend = getdt_atend;
            function getdt_atend() {
                return dt_atend;
            }
            this.gethr_cheg = gethr_cheg;
            function gethr_cheg() {
                    return hr_cheg;
            }
            this.gethr_ini_atend = gethr_ini_atend;
            function gethr_ini_atend() {
                    return hr_ini_atend;
            }
            this.gethr_fin_atend = gethr_fin_atend;
            function gethr_fin_atend() {
                    return hr_fin_atend;
            }
            
            this.getst_fila = getst_fila;
            function getst_fila() {
                    return st_fila;
            }
            this.getcd_empresa_pai = getcd_empresa_pai;
            function getcd_empresa_pai() {
                    return cd_empresa_pai;
            }
            this.getcd_fila_pai = getcd_fila_pai;
            function getcd_fila_pai() {
                    return cd_fila_pai;
            }
            
            this.incluir = function(callback){
                
                var url = 'sga_c0007';
                var params = {
                    opr : 'incluir',
                    url: url,
                    form: this.form,
                    cd_agenda : this.cd_agenda,
                    cd_cnes : this.cd_cnes,
                    cd_prof : this.cd_prof,
                    cd_espld_medc : this.cd_espld_medc,
                    cd_pac : this.cd_pac,
                    tp_atend : this.tp_atend,
                    in_servico : this.in_servico
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.excluir = function(callback){
                
                var url = 'sga_c0007';
                var params = {
                    opr : 'excluir',
                    url: url,
                    form: this.form,
                    cd_fila : this.cd_fila,
                    cd_pac : this.cd_pac
                };
 
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.listaFilaAtendimento = function(inputBusca){
                
                var url = 'sga_c0007';
                var params = {
                    opr : 'listaFilaAtendimento',
                    url: url,
                    form: this.form,
                    in_servico : this.in_servico,
                    inputBusca:inputBusca
                };
                
                this.prencheTabelaGrid(url, params, this.form);
            }
        },
        m0008:function(){
            
            var cd_procd_medc;
            var cd_pac;
            var cd_ex_laudo;
            var ds_olho_dir;
            var ds_olho_esq;
            var ds_conclusao;
            var form;
            
            this.getcd_procd_medc = getcd_procd_medc;
            function getcd_procd_medc() {
                return cd_procd_medc;
            }
            this.getcd_pac = getcd_pac;
            function getcd_pac() {
                return cd_pac;
            }
            this.getcd_ex_laudo = getcd_ex_laudo;
            function getcd_ex_laudo() {
                return cd_ex_laudo;
            }
            this.getds_olho_dir = getds_olho_dir;
            function getds_olho_dir() {
                return ds_olho_dir;
            }
            this.getds_olho_esq = getds_olho_esq;
            function getds_olho_esq() {
                return ds_olho_esq;
            }
            this.getds_conclusao = getds_conclusao;
            function getds_conclusao() {
                return ds_conclusao;
            }            
            this.getform = getform;
            function getform() {
                return form;
            }
            
            
            this.Incluir = function(callback){
                var url = 'sga_c0008';
                var params = {
                    'opr' : 'incluir',
                    'url': url,
                    'form': this.form,
                    'cd_procd_medc':this.cd_procd_medc,
                    'cd_pac': this.cd_pac,
                    'ds_olho_dir': this.ds_olho_dir,
                    'ds_olho_esq': this.ds_olho_esq,
                    'ds_conclusao':this.ds_conclusao                    
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
                  
            
            this.BuscaLaudo = function(callback){
                
                var url = 'sga_c0008';
                var params;
                params = {
                    'opr' : 'buscalaudo',
                    'url' : url,
                    'form' : this.form,
                    'cd_procd_medc':this.cd_procd_medc,
                    'cd_pac' : this.cd_pac,
                    'ds_olho_dir': this.ds_olho_dir,
                    'ds_olho_esq': this.ds_olho_esq,
                    'ds_conclusao':this.ds_conclusao  
                }
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }            
        },
        m0013:function(){
            
            var cd_procd_medc;
            var form;
            
            this.getcd_procd_medc = getcd_procd_medc;
            function getcd_procd_medc() {
                return cd_procd_medc;
            }
            this.getform = getform;
            function getform() {
                return form;
            }
            
            this.buscaprocdTexto = function(callback){
                
                var url = 'sga_c0013';
                var params = {
                    'opr' : 'buscar',
                    'url': url,
                    'form': this.form,
                    'cd_procd_medc':this.cd_procd_medc                                        
                };                
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
        },
        m0017:function(){
            
            var cd_procd_medc;
            var dt_exc_procd;
            var ds_exc_procd;
            var form;
            
            this.getcd_procd_medc = getcd_procd_medc;
            function getcd_procd_medc() {
                return cd_procd_medc;
            }
            this.getdt_exc_procd = getdt_exc_procd;
            function getdt_exc_procd() {
                return dt_exc_procd;
            }
            this.getds_exc_procd = getds_exc_procd;
            function getds_exc_procd() {
                return ds_exc_procd;
            }
            this.getform = getform;
            function getform() {
                return form;
            }
            
            this.Incluir = function(callback){
                
                var url = 'sga_c0017';
                var params;
                params = {
                    opr:'incluir',
                    url: url,
                    form: this.form,
                    cd_procd_medc: this.cd_procd_medc,
                    dt_exc_procd: this.dt_exc_procd,
                    ds_exc_procd: this.ds_exc_procd
                };
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
            
            this.Listar = function(callback){
                
                var url = 'sga_c0017';
                var params;
                params = {
                    opr:'listar',
                    url: url,
                    form: this.form,
                    cd_procd_medc: this.cd_procd_medc
                };
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
        }
    }
};

pacote_SGA.Sga.m0001.prototype = new Formulario();
pacote_SGA.Sga.m0002.prototype = new Formulario();
pacote_SGA.Sga.m0003.prototype = new Formulario();
pacote_SGA.Sga.m0004.prototype = new Formulario();
pacote_SGA.Sga.m0006.prototype = new Formulario();
pacote_SGA.Sga.m0007.prototype = new Formulario();
pacote_SGA.Sga.m0008.prototype = new Formulario();
pacote_SGA.Sga.m0013.prototype = new Formulario();
pacote_SGA.Sga.m0017.prototype = new Formulario();