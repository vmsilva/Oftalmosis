<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])){
        case 'listalocacao':
            listaLocacao();
            break;
        case 'montaprateleira':
            montaPrateleira();
            break;
        case 'confirmar':
            Confirmar();
            break;
        case 'consultaprontuario':
            consultaProntuario();
            break;
        case 'numeroposicao':
            NumeroPosicao();
            break;
        case 'manutencaolinhacoluna':
            manutencaoLinhaColuna();
            break;
        case 'transferir':
            Transferir();
            break;
        case 'listaprontuariostatus':
            listaProntuarioStatus();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

Function listaLocacao($situacao = null){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $st_prontuario = $G_MEC->recebePost($_POST, 'st_prontuario');
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0002::setst_prontuario($st_prontuario);
    SCP_M0002::setcd_empresa($cd_empresa);
    $rs = SCP_M0002::listaTodasPrateleirasPorEmpresa();
    if(count($rs)>0){
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['dados'] = $rs;
        echo json_encode($json);
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        echo json_encode($json);
    }
}

Function montaPrateleira(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'cd_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setcd_prateleira($cd_prateleira);
    $rs_linha = SCP_M0002::montaPrateleira('linha');
    $html = '';
    if(count($rs_linha)>0){
        $html.= '<table>';
        $html.= '<tr><td colspan="99" class="dv_nm_prateleira">Prateleira: '.$rs_linha['0']['nm_prateleira'].'</td></tr>';
        foreach ($rs_linha as $key => $value) {
            $html.= '<tr>';
            SCP_M0002::setnr_linha($rs_linha[$key]['nr_linha']);
            $rs_coluna = SCP_M0002::montaPrateleira('coluna');
            foreach ($rs_coluna as $k => $v) {
                //Situação da Locação
                SCP_M0002::setnr_coluna($rs_coluna[$k]['nr_coluna']);
                $rs_qtde = SCP_M0002::listaLocacao();
                $qtdeTotal = 0;
                $qtdeVazia = 0;
                $qtdeUtilizada = 0;
                foreach ($rs_qtde as $l => $j) {
                    $qtdeTotal++;
                    if($rs_qtde[$l]['cd_pac'] === null){
                        $qtdeVazia++;
                    }else{
                       $qtdeUtilizada++;
                    }
                }
                $cor = '';
                if($qtdeTotal === $qtdeVazia){
                    $cor = 'td_azul';
                }else{
                    if($qtdeTotal === $qtdeUtilizada){
                        $cor = 'td_vermelho';
                    }else{
                        $cor = 'td_amarelo';
                    }
                }
                $tooltip = 'Disponível: '.$qtdeVazia.' Utilizada: '.$qtdeUtilizada;
                $html.= '<td data-data='.json_encode($rs_coluna[$k]).' class='.$cor.' title="'.$tooltip.'"><label>L:'.str_pad($rs_linha[$key]['nr_linha'], 2, "0", STR_PAD_LEFT).'&nbsp;C:'.str_pad($rs_coluna[$k]['nr_coluna'], 2, "0", STR_PAD_LEFT).'</label></td>';
            }
            $html.= '</tr>';
        }
        $html.= '</table>';
        $json['ret']=  'true';
        $json['form']=  $form;
        $json['dados'] = $html;
        echo json_encode($json);
        exit();
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nenhum Registro Encontrado!';
        echo json_encode($json);
        exit();
    }
}

Function Confirmar(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        exit();
    }

    if($G_MEC->recebePost($_POST, 'nr_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário Antigo Paciente não Informado!';
        echo json_encode($json);
        exit();
    }

    if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'cd_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }

    if($G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número de Linha Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Coluna Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
    $nr_linha = $G_MEC->recebePost($_POST, 'nr_linha_prateleira');
    $nr_coluna = $G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
    $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    $nr_prontuario = $G_MEC->recebePost($_POST, 'nr_prontuario');

    $G_MEC->TransacaoInicio();
    SCP_M0004::setcd_empresa($cd_empresa);
    SCP_M0004::setcd_pac($cd_pac);
    SCP_M0004::setnr_prontuario($nr_prontuario);
    //Conferir Número Prontuário Antigo
    $rs_pront = SCP_M0004::consultaNumeroProntuario();
    if(count($rs_pront)<1){
        SCP_M0004::setcd_usu_pront($_SESSION['cd_usuario_log']);
        SCP_M0004::setdt_usu_pront($G_MEC->DataHoje());
        SCP_M0004::sethr_usu_pront($G_MEC->HoraHoje());
        if(SCP_M0004::incluir()){
            SCP_M0002::setcd_empresa($cd_empresa);
            SCP_M0002::setcd_prateleira($cd_prateleira);
            SCP_M0002::setnr_linha($nr_linha);
            SCP_M0002::setnr_coluna($nr_coluna);
            $rs_loc = SCP_M0002::listaPosicaoLivreLocacao();
            if(count($rs_loc)>0){
                SCP_M0002::setcd_pac($cd_pac);
                $st_prontuario = 1; //Alocado
                SCP_M0002::setst_prontuario($st_prontuario);
                SCP_M0002::setcd_usu_loc_pront($_SESSION['cd_usuario_log']);
                SCP_M0002::setdt_loc_pront($G_MEC->DataHoje());
                SCP_M0002::sethr_loc_pront($G_MEC->HoraHoje());
                SCP_M0002::setnr_posicao($rs_loc['0']['nr_posicao']);
                $rs_loc['0']['nr_prontuario'];
                if(SCP_M0002::alterar()){
                    SCP_M0003::setcd_usu_atend($_SESSION['cd_usuario_log']);
                    SCP_M0003::setdt_atend($G_MEC->DataHoje());
                    SCP_M0003::sethr_atend($G_MEC->HoraHoje());
                    SCP_M0003::setcd_prateleira($cd_prateleira);
                    SCP_M0003::setnr_linha($nr_linha);
                    SCP_M0003::setnr_coluna($nr_coluna);
                    SCP_M0003::setnr_posicao($rs_loc['0']['nr_posicao']);
                    SCP_M0003::setcd_empresa($cd_empresa);
                    SCP_M0003::setcd_pac($cd_pac);
                    if(SCP_M0003::alterar()){
                        $G_MEC->TransacaoFinaliza();
                        $json['ret']=  'true';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Paciente Alocado com Sucesso!';
                        $dados['nr_prontuario'] = $rs_loc['0']['nr_prontuario'];
                        $json['dados'] = $dados;
                        echo json_encode($json);
                        exit();
                    }else{
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Alocar Paciente Prateleira!';
                        echo json_encode($json);
                        exit();
                    }
                }else{
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Alocar Paciente Prateleira!';
                    echo json_encode($json);
                    exit();
                }
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Não há mais Prontuário Disponível para Está Posição na Prateleira!';
                echo json_encode($json);
                exit();
            }
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Incluir Prontuário Antigo no Sistema!';
            echo json_encode($json);
            exit();
        }
    }else{
        $G_MEC->TransacaoAborta();
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Prontuário Antigo já Cadastrado no Sistema!';
        echo json_encode($json);
        exit();
    }
    
}

Function consultaProntuario(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'nr_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'st_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'st_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $st_prontuario = $G_MEC->recebePost($_POST, 'st_prontuario');

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setnr_prontuario($G_MEC->recebePost($_POST, 'nr_prontuario'));
    SCP_M0002::setst_prontuario($st_prontuario);
    //2-Confirmado Arquivo
    $rs = SCP_M0002::consultaNumeroProntuario();
    if(count($rs)>0){
        $dados = array(
            'nr_prontuario'=>$rs['0']['nr_prontuario'],
            'cd_pac'=>$rs['0']['cd_pac'],
            'nm_pac'=>$rs['0']['nm_pac'],
            'tp_sexo_pac'=>$rs['0']['tp_sexo_pac'],
            'dt_nasc_pac'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_nasc_pac']),
            'nm_mae_pac'=>$rs['0']['nm_mae_pac'],
            'cd_pais_orig_pac'=>$rs['0']['cd_pais_orig_pac'],
            'nm_pais_orig_pac'=>$rs['0']['nm_pais'],
            'cd_munic_nasc_pac'=>$rs['0']['cd_munic_nasc_pac'],
            'sg_uf_nasc_pac'=>$rs['0']['sg_uf_nasc_pac'],
            'nm_munic_nasc_pac'=>$rs['0']['nm_munic_nasc_pac'],
            'cd_munic_nasc_mae_pac'=>$rs['0']['cd_munic_nasc_mae_pac'],
            'sg_uf_nasc_mae_pac'=>$rs['0']['sg_uf_nasc_mae_pac'],
            'nm_munic_nasc_mae_pac'=>$rs['0']['nm_munic_nasc_mae_pac'],
            'nr_cns_pac'=>$rs['0']['nr_cns_pac'],
        );
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Sucesso: Prontuário Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Prontuário não Localizada!';
        echo json_encode($json);
        exit;
    }   
}

Function NumeroPosicao(){
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'cd_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    if($G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Linha Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    if($G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Coluna Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
    $nr_linha = $G_MEC->recebePost($_POST, 'nr_linha_prateleira');
    $nr_coluna = $G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setcd_prateleira($cd_prateleira);
    SCP_M0002::setnr_linha($nr_linha);
    SCP_M0002::setnr_coluna($nr_coluna);
    $rs = SCP_M0002::listaLocacao();
    $qtdeTotal = 0;
    $qtdeVazia = 0;
    $qtdeUtilizada = 0;
    if(count($rs)>0){
        $qtdeTotal = count($rs);
         foreach ($rs as $k => $v){             
            if($rs[$k]['cd_pac'] === null){
                $qtdeVazia++;
            }else{
               $qtdeUtilizada++;
            }
        }
        $dados = array(
            'nr_total'=>$qtdeTotal,
            'nr_utilizada'=>$qtdeUtilizada,
            'nr_livre'=>$qtdeVazia
        );
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Sucesso: Quantidade Listada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }
}

Function manutencaoLinhaColuna(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'cd_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    if($G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Linha Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    if($G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Coluna Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    if($G_MEC->recebePost($_POST, 'in_opr_locacao')=== NULL || $G_MEC->recebePost($_POST, 'in_opr_locacao')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Operação não Informado!';
        echo json_encode($json);
        exit();
    }
    if($G_MEC->recebePost($_POST, 'nr_total_man')=== NULL || $G_MEC->recebePost($_POST, 'nr_total_man')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Total Manutenção não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
    $nr_linha = $G_MEC->recebePost($_POST, 'nr_linha_prateleira');
    $nr_coluna = $G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
    $in_opr_locacao = $G_MEC->recebePost($_POST, 'in_opr_locacao');
    $nr_total_man = $G_MEC->recebePost($_POST, 'nr_total_man');
    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setcd_prateleira($cd_prateleira);
    SCP_M0002::setnr_linha($nr_linha);
    SCP_M0002::setnr_coluna($nr_coluna);
    $rs = SCP_M0002::listaLocacao();
    $qtdeTotal = 0;
    $qtdeVazia = 0;
    $qtdeUtilizada = 0;
    if(count($rs)>0){
        $qtdeTotal = count($rs);
         foreach ($rs as $k => $v){             
            if($rs[$k]['cd_pac'] === null){
                $qtdeVazia++;
            }else{
               $qtdeUtilizada++;
            }
        }
        //Subtração
        if((int)$in_opr_locacao === 1){
            $G_MEC->TransacaoInicio();
            if(($nr_total_man < $qtdeTotal) && ($nr_total_man <= $qtdeVazia)){
                for ($index = 0; $index < $nr_total_man; $index++) {
                    $rs_nr_pos = SCP_M0002::consultaNumeroProntuarioMaximoVazio();
                    SCP_M0002::setnr_posicao($rs_nr_pos[0]["nr_posicao"]);
                    if(!SCP_M0002::manutencaoLinhaColunaSubtrair()){
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Manipular Linha Coluna!';
                        echo json_encode($json);
                        exit();
                    }
                }
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Sucesso: Linha Coluna Alterada com Sucesso!';
                echo json_encode($json);
                exit();
            }else{
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Resultado não Pode ser Alterado!';
                echo json_encode($json);
                exit();
            }
        }else{
            //Adição
            if((int)$in_opr_locacao === 0){
                $rs_inf = SCP_M0002::listaLocacao();
                $nm_prateleira = $rs_inf[0]["nm_prateleira"];
                $G_MEC->TransacaoInicio();
                $rs_nr_pos = SCP_M0002::consultaNumeroProntuarioMaximo();
                $nr_posicao = $rs_nr_pos[0]["nr_posicao"];
                for ($index = 0; $index < $nr_total_man; $index++) {
                    $nr_posicao++;
                    $nr_prontuario = $nm_prateleira.str_pad($nr_linha, 2, "0", STR_PAD_LEFT).str_pad($nr_coluna, 2, "0", STR_PAD_LEFT).str_pad($nr_posicao, 4, "0", STR_PAD_LEFT);
                    $st_prontuario = 0;
                    SCP_M0002::setnr_posicao($nr_posicao);
                    SCP_M0002::setnr_prontuario($nr_prontuario);
                    SCP_M0002::setst_prontuario($st_prontuario);
                    $cd_usu_ger_pront = $_SESSION['cd_usuario_log'];
                    SCP_M0002::setcd_usu_ger_pront($cd_usu_ger_pront);
                    SCP_M0002::setdt_ger_pront($G_MEC->DataHoje());
                    if(SCP_M0002::incluir() <> 1){
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Gerar Registro!';
                        echo json_encode($json);
                        exit;
                    }
                }
                $G_MEC->TransacaoFinaliza();
                $json['ret']=  'true';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Registro Gerado com Sucesso!';
                echo json_encode($json);
                exit;
            }
        }
    }
}

Function Transferir(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'cd_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'cd_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_linha_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Linha Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== NULL || $G_MEC->recebePost($_POST, 'nr_coluna_prateleira')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Coluna Prateleira não Informado!';
        echo json_encode($json);
        exit();
    }
    
    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Paciente não Informado!';
        echo json_encode($json);
        exit();
    }
    
    SMG_M0014::setcd_empresa($cd_empresa);
    $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    SMG_M0014::setcd_pac($cd_pac);
	$st_pac = 0;
    SMG_M0014::setst_pac($st_pac);
    $rs = SMG_M0014::consultaCodigo();
    if(count($rs)>0){
        //Prontuário Atual
        $nr_prontuario = $rs[0]['nr_prontuario'];
        $G_MEC->TransacaoInicio();
        //Gravar prontuário na Tabela de Antigos
        SCP_M0004::setcd_empresa($cd_empresa);
        SCP_M0004::setcd_pac($cd_pac);
        SCP_M0004::setcd_usu_pront($_SESSION['cd_usuario_log']);
        SCP_M0004::setdt_usu_pront($G_MEC->DataHoje());
        SCP_M0004::sethr_usu_pront($G_MEC->HoraHoje());
        SCP_M0004::setnr_prontuario($nr_prontuario);
        if(SCP_M0004::incluir()){
            //Liberar Locação para Utilização Futura
            $st_prontuario = 0;
            SCP_M0002::setst_prontuario($st_prontuario);
            SCP_M0002::setcd_empresa($cd_empresa);
            SCP_M0002::setcd_pac($cd_pac);
            SCP_M0002::setnr_prontuario($nr_prontuario);
            if(SCP_M0002::liberarLocacao()){
                $cd_prateleira = $G_MEC->recebePost($_POST, 'cd_prateleira');
                $nr_linha = $G_MEC->recebePost($_POST, 'nr_linha_prateleira');
                $nr_coluna = $G_MEC->recebePost($_POST, 'nr_coluna_prateleira');
                //Gerar Prontuário
                SCP_M0002::setcd_empresa($cd_empresa);
                SCP_M0002::setcd_prateleira($cd_prateleira);
                SCP_M0002::setnr_linha($nr_linha);
                SCP_M0002::setnr_coluna($nr_coluna);
                $rs = SCP_M0002::PrimeiraPosicaoLivreLocacaoEspecifica();
                if($G_MEC->ValidaNumeroInteiro($rs['0']['nr_posicao'])){
                    //Gerar Solicitação
                    SCP_M0002::setcd_pac($cd_pac);
                    $st_prontuario = 2;
                    SCP_M0002::setst_prontuario($st_prontuario);
                    SCP_M0002::setcd_usu_loc_pront($cd_usuario);
                    SCP_M0002::setdt_loc_pront($G_MEC->DataHoje());
                    SCP_M0002::sethr_loc_pront($G_MEC->HoraHoje());
                    //Clausula Where
                    SCP_M0002::setcd_prateleira($rs['0']['cd_prateleira']);
                    SCP_M0002::setnr_linha($rs['0']['nr_linha']);
                    SCP_M0002::setnr_coluna($rs['0']['nr_coluna']);
                    SCP_M0002::setnr_posicao($rs['0']['nr_posicao']);
                    $rs_Pos = SCP_M0002::alterar();
                    if($G_MEC->ValidaNumeroInteiro($rs_Pos)){
                        $G_MEC->TransacaoFinaliza();
                        $json['ret']=  'true';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['dados']=  $rs['0']['nr_prontuario'];
                        $json['msg'] = 'Prontuário gerado com Sucesso! '.$rs['0']['nr_prontuario'];
                        echo json_encode($json);
                    }else{
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Prontuário Antigo já Cadastrado!';
                        echo json_encode($json);
                    }
                }else{
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Númeração de Prontuário Indisponível, entre em contato com o Arquivo!';
                    echo json_encode($json);
                    exit();
                }       
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $form;
                $json['msg'] = 'Erro: Falha ao Liberar Locação Prontuário!';
                echo json_encode($json);
                exit();
            }
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Falha ao Gravar Prontuário Anterior!';
            echo json_encode($json);
            exit();
        }
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Paciente não Localizado!';
        echo json_encode($json);
        exit();
    }
}

Function listaProntuarioStatus(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        exit();
    }
    $form = $G_MEC->recebePost($_POST, 'form');
        
    if($G_MEC->recebePost($_POST, 'st_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'st_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Status Prontuário não Informado!';
        echo json_encode($json);
        exit();
    }
    
    $st_prontuario = $G_MEC->recebePost($_POST, 'st_prontuario');

    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setst_prontuario($st_prontuario);

    if($G_MEC->recebePost($_POST, 'nm_pac')!= NULL || $G_MEC->recebePost($_POST, 'nm_pac')!= ''){
        SCP_M0002::setnm_pac($G_MEC->recebePost($_POST, 'nm_pac'));
    }
    $rs = SCP_M0002::listaProntuarioPorStatus();
    if(count($rs)>0){
        foreach ($rs as $key => $value) {
            
            $dados[$key]['nr_prontuario'] = $value['nr_prontuario'];
            $dados[$key]['cd_pac'] = $value['cd_pac'];
            $dados[$key]['nm_pac'] = $value['nm_pac'];
            $dados[$key]['tp_sexo_pac'] = $value['tp_sexo_pac'];
            $dados[$key]['dt_nasc_pac'] = $G_MEC->FormataDatacomBarra($value['dt_nasc_pac']);
            $dados[$key]['nm_mae_pac'] = $value['nm_mae_pac'];
            
            SCP_M0006::setcd_empresa($cd_empresa);
            SCP_M0006::setnr_prontuario($value['nr_prontuario']);
            SCP_M0006::setcd_pac($value['cd_pac']);
            SCP_M0006::setst_solic_mov($st_prontuario);
            $rs_desc = SCP_M0006::ListarSolicitacaoProntuarioStatus();
            if(count($rs_desc)>0){
                $dados[$key]['in_mov_prontuario'] = $rs_desc[0]['in_mov_prontuario'];
            }else{
                $dados[$key]['in_mov_prontuario'] = '';
            }
        }
        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['dados'] = $dados;
        echo json_encode($json);
    }else{
        $json['ret']=  'false';
        $json['mostra'] = 'false';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        echo json_encode($json);
    }   
}