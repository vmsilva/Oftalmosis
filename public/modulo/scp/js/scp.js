var pacote_SCP = {
    Scp:{
        m0001:function(){
            
            var cd_empresa;
            var cd_prateleira;
            var nm_prateleira;
            var st_prateleira;
            var nr_linha_prateleira;
            var nr_coluna_prateleira;
            var nr_max_linha_coluna_item;
            var in_andar_prateleira;
            var form;

            this.getcd_empresa = getcd_empresa;
            function getcd_empresa(){ return cd_empresa;}
            
            this.getcd_prateleira = getcd_prateleira;
            function getcd_prateleira(){ return cd_prateleira;}

            this.getnm_prateleira = getnm_prateleira;
            function getnm_prateleira(){ return nm_prateleira;}

            this.getst_prateleira = getst_prateleira;
            function getst_prateleira(){ return st_prateleira;}

            this.getnr_linha_prateleira = getnr_linha_prateleira;
            function getnr_linha_prateleira(){ return nr_linha_prateleira;}

            this.getnr_coluna_prateleira = getnr_coluna_prateleira;
            function getnr_coluna_prateleira(){ return nr_coluna_prateleira;}

            this.getnr_max_linha_coluna_item = getnr_max_linha_coluna_item;
            function getnr_max_linha_coluna_item(){ return nr_max_linha_coluna_item;}

            this.getin_andar_prateleira = getin_andar_prateleira;
            function getin_andar_prateleira(){ return in_andar_prateleira;}

            this.getform = getform;
            function getform(){ return form;}

            this.consultaCodigoPrateleira = function(){

                var url = 'scp_c0001';
                var params;
                params = {
                    'opr': 'consultaCodigoPrateleira',
                    'url': url,
                    'form': this.form,
                    'cd_prateleira': this.cd_prateleira,
                    'st_prateleira': this.st_prateleira
                };

                this.requisicaoAjax(url, params, this.form);
            }

            this.listaPrateleira = function(nmGrid, inputBusca){

                var self = this;
                var url = 'scp_c0001';
                var params;
                 params = {
                    'opr': 'consultaNomePrateleira',
                    'url': url,
                    'form': this.form,
                    'nm_prateleira': this.nm_prateleira,
                    'st_prateleira': this.st_prateleira,
                    inputBusca:inputBusca
                };
                
                this.prencheTabelaGrid(url, params, this.form);
            }

            this.incluir = function(callback){
                var url = 'scp_c0001';
                var params;
                params = {
                    'opr': 'incluir',
                    'url': url,
                    'form': this.form,
                    'cd_prateleira': this.cd_prateleira,
                    'nm_prateleira': this.nm_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                    'nr_max_linha_coluna_item': this.nr_max_linha_coluna_item,
                    'in_andar_prateleira': this.in_andar_prateleira,
                    'st_prateleira': this.st_prateleira
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.alterar = function(callback){
                var url = 'scp_c0001';
                var params;
                params = {
                    'opr': 'alterar',
                    'url': url,
                    'form': this.form,
                    'cd_prateleira': this.cd_prateleira,
                    'nm_prateleira': this.nm_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                    'nr_max_linha_coluna_item': this.nr_max_linha_coluna_item,
                    'in_andar_prateleira': this.in_andar_prateleira,
                    'st_prateleira': this.st_prateleira
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.excluir = function(callback){
                var url = 'scp_c0001';
                var params;
                params = {
                    'opr': 'excluir',
                    'url': url,
                    'form': this.form,
                    'cd_prateleira': this.cd_prateleira,
                    'nm_prateleira': this.nm_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                    'nr_max_linha_coluna_item': this.nr_max_linha_coluna_item,
                    'in_andar_prateleira': this.in_andar_prateleira,
                    'st_prateleira': this.st_prateleira
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.gerar = function(callback){
                var url = 'scp_c0001';
                var params;
                params = {
                    'opr': 'gerar',
                    'url': url,
                    'form': this.form,
                    'cd_prateleira': this.cd_prateleira,
                    'nm_prateleira': this.nm_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                    'nr_max_linha_coluna_item': this.nr_max_linha_coluna_item,
                    'in_andar_prateleira': this.in_andar_prateleira,
                    'st_prateleira': this.st_prateleira
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

        },
        m0002:function(){
            
            var cd_empresa;
            var cd_prateleira;
            var nr_linha;
            var nr_coluna;
            var nr_posicao;
            var nr_prontuario;
            var st_prontuario;
            var cd_usu_ger_pront;
            var dt_ger_pront;
            var cd_pac;
            var nm_pac;
            var cd_usu_loc_pront;
            var dt_loc_pront;
            var hr_loc_pront;
            var form;

            this.getcd_empresa = getcd_empresa;
            function getcd_empresa(){ return cd_empresa;}

            this.getcd_prateleira = getcd_prateleira;
            function getcd_prateleira(){ return cd_prateleira;}

            this.getnr_linha = getnr_linha;
            function getnr_linha(){ return nr_linha;}

            this.getnr_coluna = getnr_coluna;
            function getnr_coluna(){ return nr_coluna;}

            this.getnr_posicao = getnr_posicao;
            function getnr_posicao(){ return nr_posicao;}

            this.getnr_prontuario = getnr_prontuario;
            function getnr_prontuario(){ return nr_prontuario;}

            this.getst_prontuario = getst_prontuario;
            function getst_prontuario(){ return st_prontuario;}

            this.getcd_usu_ger_pront = getcd_usu_ger_pront;
            function getcd_usu_ger_pront(){ return cd_usu_ger_pront;}

            this.getdt_ger_pront = getdt_ger_pront;
            function getdt_ger_pront(){ return dt_ger_pront;}

            this.getcd_pac = getcd_pac;
            function getcd_pac(){ return cd_pac;}
            
            this.getnm_pac = getnm_pac;
            function getnm_pac(){ return nm_pac;}

            this.getcd_usu_loc_pront = getcd_usu_loc_pront;
            function getcd_usu_loc_pront(){ return cd_usu_loc_pront;}

            this.getdt_loc_pront = getdt_loc_pront;
            function getdt_loc_pront(){ return dt_loc_pront;}

            this.gethr_loc_pront = gethr_loc_pront;
            function gethr_loc_pront(){ return hr_loc_pront;}

            this.getform = getform;
            function getform(){ return form;}

            this.listaLocacao = function(callback){

                var url = 'scp_c0002';
                var params;
                params = {
                    'opr': 'listaLocacao',
                    'st_prontuario': this.st_prontuario,
                    'url': url,
                    'form': this.form
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }

            this.montaPrateleira = function(callback){

                var url = 'scp_c0002';
                var params;
                params = {
                    'opr': 'montaPrateleira',
                    'url': url,
                    'cd_prateleira': this.cd_prateleira,
                    'form': this.form
                };

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.NumeroPosicao = function(callback){

                var url = 'scp_c0002';
                var params;
                params = {
                    'opr': 'NumeroPosicao',
                    'url': url,
                    'cd_prateleira': this.cd_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                    'form': this.form
                };

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }

            this.confirmar = function(callback){
                
                var url = 'scp_c0002';
                var params;
                params = {
                    'opr': 'Confirmar',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac,
                    'nr_prontuario': this.nr_prontuario,
                    'dt_ult_atend': this.dt_ult_atend,
                    'cd_prateleira': this.cd_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.Transferir = function(callback){
                
                var url = 'scp_c0002';
                var params;
                params = {
                    'opr': 'Transferir',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac,
                    'nr_prontuario': this.nr_prontuario,
                    'cd_prateleira': this.cd_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.manutencaoLinhaColuna = function(callback){
                var url = 'scp_c0002';
                var params;
                params = {
                    'opr': 'manutencaoLinhaColuna',
                    'url': url,
                    'form': this.form,
                    'cd_prateleira': this.cd_prateleira,
                    'nr_linha_prateleira': this.nr_linha_prateleira,
                    'nr_coluna_prateleira': this.nr_coluna_prateleira,
                    'in_opr_locacao': this.in_opr_locacao,
                    'nr_total_man': this.nr_total_man
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.consultaProntuario = function(callback){
                var url = 'scp_c0002';
                var params;
                params = {
                    'opr' : 'consultaProntuario',
                    'url': url,
                    'form': this.form,
                    'nr_prontuario': this.nr_prontuario,
                    'st_prontuario': this.st_prontuario
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
            
            this.listaProntuarioStatus = function(callback){
                
                var url = 'scp_c0002';
                var params;
                params = {
                    opr : 'listaProntuarioStatus',
                    url: url,
                    form: this.form,
                    nm_pac: this.nm_pac,
                    st_prontuario: this.st_prontuario
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
            
            this.confirmaSolicitacaoAbertoProntuario = function(callback){
                var url = 'scp_c0005';
                var params;
                params = {
                    'opr' : 'confirmaSolicitacaoAbertoProntuario',
                    'url': url,
                    'form': this.form,
                    'cd_usu_loc_pront': this.cd_usu_loc_pront,
                    'ds_senha': this.senha,
                    'lista': this.lista
                }

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.confirmaSolicitacaoDevolucaoProntuario = function(callback){
                
                var url = 'scp_c0008';
                var params;
                params = {
                    'opr' : 'confirmaSolicitacaoDevolucaoProntuario',
                    'url': url,
                    'form': this.form,
                    'cd_usu_loc_pront': this.cd_usu_loc_pront,
                    'ds_senha': this.senha,
                    'lista': this.lista
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.desbloquearProntuario = function(callback){
                
                var url = 'scp_c0011';
                var params;
                params = {
                    'opr' : 'desbloquearProntuario',
                    'url': url,
                    'form': this.form,
                    'cd_usu_loc_pront': this.cd_usu_loc_pront,
                    'ds_senha': this.senha,
                    'nr_prontuario': this.nr_prontuario
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
            
            this.historicoProntuario = function(callback){
                
                var url = 'scp_c0018';
                var params;
                params = {
                    'opr' : 'historicoProntuario',
                    'url': url,
                    'form': this.form,
                    'nr_prontuario': this.nr_prontuario,
                    'st_prontuario': this.st_prontuario
                };
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            };
        },
        m0003:function(){
            
            var cd_empresa;
            var cd_solic_abert;
            var cd_pac;
            var cd_usu_solic;
            var dt_solic;
            var hr_solic;
            var cd_usu_atend;
            var dt_atend;
            var hr_atend;
            var cd_prateleira;
            var nr_linha;
            var nr_coluna;
            var nr_posicao;
            var form;

            this.getcd_empresa = getcd_empresa;
            function getcd_empresa(){ return cd_empresa;}
            this.getcd_solic_abert = getcd_solic_abert;
            function getcd_solic_abert(){ return cd_solic_abert;}
            this.getcd_pac = getcd_pac;
            function getcd_pac(){ return cd_pac;}
            this.getcd_usu_solic = getcd_usu_solic;
            function getcd_usu_solic(){ return cd_usu_solic;}
            this.getdt_solic = getdt_solic;
            function getdt_solic(){ return dt_solic;}
            this.gethr_solic = gethr_solic;
            function gethr_solic(){ return hr_solic;}
            this.getcd_usu_atend = getcd_usu_atend;
            function getcd_usu_atend(){ return cd_usu_atend;}
            this.getdt_atend = getdt_atend;
            function getdt_atend(){ return dt_atend;}
            this.gethr_atend = gethr_atend;
            function gethr_atend(){ return hr_atend;}
            this.getcd_prateleira = getcd_prateleira;
            function getcd_prateleira(){ return cd_prateleira;}
            this.getnr_linha = getnr_linha;
            function getnr_linha(){ return nr_linha;}
            this.getnr_coluna = getnr_coluna;
            function getnr_coluna(){ return nr_coluna;}
            this.getnr_posicao = getnr_posicao;
            function getnr_posicao(){ return nr_posicao;}
            this.getform = getform;
            function getform(){ return form;}

            this.incluir = function(callback){
                var url = 'scp_c0003';
                var params;
                params = {
                    'opr': 'incluir',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac,
                    'tp_sexo_pac': this.tp_sexo_pac,
                    'dt_nasc_pac': this.dt_nasc_pac,
                    'nr_cns_pac': this.nr_cns_pac,
                    'nm_pac': this.nm_pac,
                    'nm_mae_pac': this.nm_mae_pac
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.excluir = function(callback){
                var url = 'scp_c0003';
                var params;
                params = {
                    'opr': 'excluir',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac
                };

                this.requisicaoAjax(url, params, this.form, callback);
            }

            this.listaRegistroSolicitacao = function(nmGrid, inputBusca){

                var self = this;
                var url = 'scp_c0003';
                var params;
                 params = {
                    'opr': 'consultaSolicitacaoAberturaProntuario',
                    'url': url,
                    'form': this.form,
                    inputBusca:inputBusca
                };

                this.prencheTabelaGrid(url, params, this.form);
            }
        },
        m0004:function(){
            
            var cd_empresa;
            var cd_pac;
            var nr_prontuario;
            var form;

            this.getcd_empresa = getcd_empresa;
            function getcd_empresa(){ return cd_empresa;}

            this.getcd_pac = getcd_pac;
            function getcd_pac(){ return cd_pac;}

            this.getnr_prontuario = getnr_prontuario;
            function getnr_prontuario(){ return nr_prontuario;}

            this.getform = getform;
            function getform(){ return form;}

            this.gerar = function(callback){
                var url = 'scp_c0004';
                var params;
                params = {
                    'opr': 'Gerar',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac,
                    'nr_prontuario': this.nr_prontuario
                };

                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }

            this.impressaoCodigoBarra = function(){
                var url = 'scp_c0004';
                var params;
                params = {
                    'opr': 'impressao',
                    'url': url,
                    'form': this.form,
                    'nr_prontuario': this.nr_prontuario
                };

                this.requisicaoAjaxRetornaValores(url, params, this.form);
            }
            
            this.listaProntuarioAntigo = function(inputBusca){
                var url = 'scp_c0004';
                var params;
                params = {
                    'opr': 'listaProntuarioAntigo',
                    'url': url,
                    'form': this.form,
                    'cd_pac': this.cd_pac,
                    inputBusca:inputBusca
                };

                this.prencheTabelaGrid(url, params, this.form);
                
            }
        },
        m0005:function(){
            var cd_empresa;
            var nr_solic_mov;
            var dt_solic_mov;
            var hr_solic_mov;
            var cd_usu_solic_mov;
            var dt_atend_solic_mov;
            var hr_atend_solic_mov;
            var cd_usu_atend_solic_mov;
            var form;
            
            this.getcd_empresa = getcd_empresa;
            function getcd_empresa(){ return cd_empresa;}
            
            this.getnr_solic_mov = getnr_solic_mov;
            function getnr_solic_mov(){ return nr_solic_mov;}
            
            this.getdt_solic_mov = getdt_solic_mov;
            function getdt_solic_mov(){ return dt_solic_mov;}
            
            this.gethr_solic_mov = gethr_solic_mov;
            function gethr_solic_mov(){ return hr_solic_mov;}
            
            this.getcd_usu_solic_mov = getcd_usu_solic_mov;
            function getcd_usu_solic_mov(){ return cd_usu_solic_mov;}
            
            this.getdt_atend_solic_mov = getdt_atend_solic_mov;
            function getdt_atend_solic_mov(){ return dt_atend_solic_mov;}
            
            this.gethr_atend_solic_mov = gethr_atend_solic_mov;
            function gethr_atend_solic_mov(){ return hr_atend_solic_mov;}
            
            this.getcd_usu_atend_solic_mov = getcd_usu_atend_solic_mov;
            function getcd_usu_atend_solic_mov(){ return cd_usu_atend_solic_mov;}

            this.getform = getform;
            function getform(){ return form;}
            
            this.IncluirSolicitacaoMovimentacaoProntuario = function(callback){
                var url = 'scp_c0007';
                var params;
                params = {
                    'opr' : 'Incluir',
                    'url': url,
                    'form': this.form,
                    'lista': this.lista
                }

                this.requisicaoAjax(url, params, this.form, callback);
            }
            
            this.IncluirSolicitacaoMovimentacaoAgenda = function(callback){
                
                var url = 'scp_c0014';
                var params;
                params = {
                    'opr' : 'IncluirSolicitacaoMovimentacaoAgenda',
                    'url': url,
                    'form': this.form,
                    'cd_usu_solic_mov': this.cd_usu_solic_mov,
                    'lista': this.lista
                }

                 this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.TransferenciaSolicitacaoMovimentacao = function(callback){
                
                var url = 'scp_c0015';
                var params;
                params = {
                    opr : 'TransferenciaSolicitacaoMovimentacao',
                    url: url,
                    form: this.form,
                    cd_usu_solic_mov: this.cd_usu_solic_mov,
                    nr_prontuario: this.nr_prontuario
                }

                 this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ConfirmaMovimentacaoProntuario = function(callback){
                
                var url = 'scp_c0009';                
                var params;
                params = {
                    
                    'opr' : 'ConfirmaMovimentacaoProntuario',
                    'url': url,
                    'form': this.form,
                    'cd_usuario': this.cd_usuario,
                    'nr_matr_usu': this.nr_matr_usu,
                    'nm_usuario': this.nm_usuario,
                    'ds_snh_usu': this.ds_snh_usu,
                    'nr_solic_mov': this.nr_solic_mov
                }

                this.requisicaoAjax(url, params, this.form, callback);
            }
            
            this.ListaConfirmaMovimentacaoProntuario = function(callback){
                
                var url = 'scp_c0010';
                var params;
                params = {
                    'opr' : 'ListaConfirmaMovimentacaoProntuario',
                    'url': url,
                    'form': this.form
                }
                
                this.prencheTabelaGrid(url, params, this.form);
            }
            
            this.ListaMovimentacaoProntuarioUsuario = function(callback){
                
                var url = 'scp_c0012';
                var params;
                params = {
                    'opr' : 'ListaMovimentacaoProntuarioUsuario',
                    'url': url,
                    'form': this.form,
                    'st_solic_mov': this.st_solic_mov
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ListaProntuarioUsuarioStatus = function(callback){
                
                var url = 'scp_c0015';
                var params;
                params = {
                    'opr' : 'listaprontuariousuariostatus',
                    'url': url,
                    'form': this.form,
                    'st_solic_mov': this.st_solic_mov
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ListaProntuarioUsuarioSolicTransf = function(callback){
                
                var url = 'scp_c0015';
                var params;
                params = {
                    'opr' : 'ListaProntuarioUsuarioSolicTransf',
                    'url': url,
                    'form': this.form,
                    'st_solic_mov': this.st_solic_mov
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.listaProntuarioRecepcionarTransf = function(callback){
                
                var url = 'scp_c0015';
                var params;
                params = {
                    'opr' : 'listaProntuarioRecepcionarTransf',
                    'url': url,
                    'form': this.form,
                    'st_solic_mov': this.st_solic_mov
                }
                
                this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            
            this.listaSolicitacaoEmAberto = function(callback,inputBusca){

                var url = 'scp_c0007';
                var params;
                params = {
                    'opr': 'listaSolicitacaoEmAberto',
                    'url': url,
                    'form': this.form,
                    inputBusca:inputBusca
                };
                this.prencheTabelaGrid(url, params, this.form);
            }

        },
        m0006:function(){
    
            var cd_empresa;
            var nr_solic_mov;
            var nr_prontuario;
            var st_prontuario;
            var lista;
            var form;
            
            this.getcd_empresa = getcd_empresa;
            function getcd_empresa(){ return cd_empresa;}
            
            this.getnr_solic_mov = getnr_solic_mov;
            function getnr_solic_mov(){ return nr_solic_mov;}
            
            this.getnr_prontuario = getnr_prontuario;
            function getnr_prontuario(){ return nr_prontuario;}
            
            this.getst_prontuario = getst_prontuario;
            function getst_prontuario(){ return st_prontuario;}
            
            this.getlista = getlista;
            function getlista(){ return lista;}

            this.getform = getform;
            function getform(){ return form;}
            
            this.listaProntuarioSolicitacao = function(callback,inputBusca){

                var url = 'scp_c0009';
                var params;
                params = {
                    'opr': 'listaProntuarioSolicitacao',
                    'url': url,
                    'form': this.form,
                    inputBusca:inputBusca,
                    'nr_solic_mov': this.nr_solic_mov
                };
                this.prencheTabelaGrid(url, params, this.form);
            }
            
            this.listaPacienteSolicitadosNaoAtendidos = function(callback){
                
                var url = 'scp_c0010';
                var params;
                params = {
                    'opr' : 'listaPacienteSolicitadosNaoAtendidos',
                    'url': url,
                    'form': this.form,
                    'nr_solic_mov': this.nr_solic_mov
                }
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.consultaMovimentacaoProntuario = function(callback){
                
                var url = 'scp_c0009';
                var params;
                params = {
                    'opr' : 'consultaMovimentacaoProntuario',
                    'url': url,
                    'form': this.form,
                    'nr_prontuario': this.nr_prontuario,
                    'st_prontuario': this.st_prontuario
                }
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.consultaMovProntuarioPaciente = function(callback){
                
                self = this;
                var url = 'scp_c0007';
                var params;
                params = {
                    'opr' : 'consultaMovimentacaoProntuarioPaciente',
                    'url': url,
                    'form': self.form,
                    'nr_prontuario': self.nr_prontuario,
                    'cd_pac': self.cd_pac,
                    'st_prontuario': self.st_prontuario
                }
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.Confirmar = function(callback){
                
                var url = 'scp_c0010';
                var params;
                params = {
                    opr : 'confirmar',
                    url: url,
                    form: this.form,
                    nr_solic_mov: this.nr_solic_mov,
                    lista:this.lista
                };
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
            this.ConfirmarRecTransPront = function(callback){
                
                var url = 'scp_c0016';
                var params;
                params = {
                    opr : 'confirmar',
                    url: url,
                    form: this.form,
                    nr_solic_mov: this.nr_solic_mov,
                    lista:this.lista
                };
                
                return this.requisicaoAjaxRetornaValores(url, params, this.form, callback);
            }
            
        }
    }
}

pacote_SCP.Scp.m0001.prototype = new Formulario();
pacote_SCP.Scp.m0002.prototype = new Formulario();
pacote_SCP.Scp.m0003.prototype = new Formulario();
pacote_SCP.Scp.m0004.prototype = new Formulario();
pacote_SCP.Scp.m0005.prototype = new Formulario();
pacote_SCP.Scp.m0006.prototype = new Formulario();