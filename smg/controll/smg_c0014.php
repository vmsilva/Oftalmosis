<?php
session_start();
 include '../../authentic/model/mecanismo.php';
 if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    switch ($_POST['opr']) {
        case 'consultaCodigoPaciente':
            consultaCodigoPaciente();
            break;
        case 'consultaNomePaciente':
            consultaNomePaciente();
            break;
        case 'consultaNomePacienteProntuario':
            consultaNomePacienteProntuario();
            break;
        case 'incluir':
            incluir();
            break;
        case 'alterar':
            alterar();
            break;
        case 'excluir':
            excluir();
            break;
        default:
            break;
    }
}else{
    require_once 'validaSessao.php';
}

function consultaCodigoPaciente(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    }

    if($G_MEC->recebePost($_POST, 'form')=== NULL){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        exit;
    }else{
        $form = $G_MEC->recebePost($_POST, 'form');
    }
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SMG_M0014::setcd_empresa($cd_empresa);
    SMG_M0014::setcd_pac($cd_pac);
    $st_pac = 0;
    SMG_M0014::setst_pac($st_pac);
    $rs = SMG_M0014::consultaCodigo();
    if(count($rs)>0){
        if($form === 'smg_h0014'){
            $dados = array(
                'cd_pac'=>$rs['0']['cd_pac'],
                'nr_prontuario_pac'=>$rs['0']['nr_prontuario'],
                'nr_cns_pac'=>$rs['0']['nr_cns_pac'],
                'nm_pac'=>$rs['0']['nm_pac'],
                'tp_sexo_pac'=>$rs['0']['tp_sexo_pac'],
                'dt_nasc_pac'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_nasc_pac']),
                'cd_pais_orig_pac'=>$rs['0']['cd_pais_orig_pac'],
                'nm_pais_orig_pac'=>$rs['0']['nm_pais'],
                'cd_munic_nasc_pac'=>$rs['0']['cd_munic_nasc_pac'],
                'sg_uf_nasc_pac'=>$rs['0']['sg_uf_nasc_pac'],
                'nm_munic_nasc_pac'=>$rs['0']['nm_munic_nasc_pac'],
                'nm_mae_pac'=>$rs['0']['nm_mae_pac'],
                'cd_munic_nasc_mae_pac'=>$rs['0']['cd_munic_nasc_mae_pac'],
                'sg_uf_nasc_mae_pac'=>$rs['0']['sg_uf_nasc_mae_pac'],
                'nm_munic_nasc_mae_pac'=>$rs['0']['nm_munic_nasc_mae_pac'],
                'cd_munic_pac'=>$rs['0']['cd_munic_pac'],
                'sg_uf_pac'=>$rs['0']['sg_uf_pac'],
                'nm_munic_pac'=>$rs['0']['nm_munic_pac'],
                'nm_bairro_pac'=>$rs['0']['nm_bairro_pac'],
                'ds_logr_pac'=>$rs['0']['ds_logr_pac'],
                'ds_compl_pac'=>$rs['0']['ds_compl_pac'],
                'nr_cep_pac'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_cep_pac'],'CEP'),
                'ds_qd_pac'=>$rs['0']['ds_qd_pac'],
                'ds_lt_pac'=>$rs['0']['ds_lt_pac'],
                'nr_pac'=>$rs['0']['nr_pac'],
                'nr_fone_pac_01'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_fone_pac_01'],'FONE'),
                'nr_fone_pac_02'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_fone_pac_02'],'FONE'),
                'nr_fone_pac_03'=>$G_MEC->Formata_Fone_CEP_CPF_CNPJ($rs['0']['nr_fone_pac_03'],'FONE'),
                'ds_email_pac'=>$rs['0']['ds_email_pac']
            );
        }else{
            $dados = array(
                'cd_pac'=>$rs['0']['cd_pac'],
                'nr_cns_pac'=>$rs['0']['nr_cns_pac'],
                'nm_pac'=>$rs['0']['nm_pac'],
                'tp_sexo_pac'=>$G_MEC->EnumSexo($rs['0']['tp_sexo_pac']),
                'dt_nasc_pac'=>$G_MEC->FormataDatacomBarra($rs['0']['dt_nasc_pac']),
                'nm_mae_pac'=>$rs['0']['nm_mae_pac'],
                'nr_prontuario_pac'=>$rs['0']['nr_prontuario']
            );
        }

        $json['ret']=  'true';
        $json['mostra'] = 'false';
        $json['form']=  $form;
        $json['msg'] = 'Sucesso: Código Paciente Localizada com Sucesso!';
        $json['dados'] = $dados;
        echo json_encode($json);
        exit;
    }else{
         $dados = array(
            'cd_pac'=>'',
            'nr_prontuario_pac'=>'',
            'nr_cns_pac'=>'',
            'nm_pac'=>'',
            'tp_sexo_pac'=>'',
            'dt_nasc_pac'=>'',
            'cd_pais_orig_pac'=>'',
            'nm_pais_orig_pac'=>'',
            'cd_munic_nasc_pac'=>'',
            'sg_uf_nasc_pac'=>'',
            'nm_munic_nasc_pac'=>'',
            'nm_mae_pac'=>'',
            'cd_munic_nasc_mae_pac'=>'',
            'sg_uf_nasc_mae_pac'=>'',
            'nm_munic_nasc_mae_pac'=>'',
            'cd_munic_pac'=>'',
            'sg_uf_pac'=>'',
            'nm_munic_pac'=>'',
            'nm_bairro_pac'=>'',
            'ds_logr_pac'=>'',
            'ds_compl_pac'=>'',
            'nr_cep_pac'=>'',
            'ds_qd_pac'=>'',
            'ds_lt_pac'=>'',
            'nr_pac'=>'',
            'nr_fone_pac_01'=>'',
            'nr_fone_pac_02'=>'',
            'nr_fone_pac_03'=>'',
            'ds_email_pac'=>''
        );

        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['dados'] = $dados;
        $json['msg'] = 'Erro: Código Paciente não Localizada!';
        echo json_encode($json);
        exit;
    }
}

function consultaNomePaciente(){
    
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    $Render = new renderView();
    $headers = array('nr_cns_pac'=>'CNS','nm_pac'=> 'Paciente','tp_sexo_pac'=>'Sexo','dt_nasc_pac'=>'Dt.Nasc.','nm_mae_pac'=> 'Mãe');

    if($_POST['nm_pac'] != ''){
        $nm_pac = $_POST['nm_pac'];
    }else{
        $nm_pac = '';
    }

    if($_POST['tp_sexo_pac'] != ''){
        $tp_sexo_pac = $_POST['tp_sexo_pac'];
    }else{
        $tp_sexo_pac = '';
    }
    if($_POST['nr_cns_pac'] != ''){
        $nr_cns_pac = $_POST['nr_cns_pac'];
    }else{
        $nr_cns_pac = '';
    }
    
    if($_POST['dt_nasc_pac'] != ''){
        
        if($G_MEC->ValidaData($G_MEC->FormataDataTiraBarraInverte($_POST['dt_nasc_pac']))){
            $dt_nasc_pac = $G_MEC->FormataDataTiraBarraInverte($_POST['dt_nasc_pac']);
        }else{
            echo json_encode('Erro: Data Invalida');
            exit;
        }
    }else{
        $dt_nasc_pac = '';
    }
    
    if($_POST['nm_mae_pac'] != ''){
        $nm_mae_pac = $_POST['nm_mae_pac'];
    }else{
        $nm_mae_pac = '';
    }

    SMG_M0014::setnm_pac($nm_pac);
    SMG_M0014::settp_sexo_pac($tp_sexo_pac);
    SMG_M0014::setdt_nasc_pac($dt_nasc_pac);
    SMG_M0014::setnm_mae_pac($nm_mae_pac);
    SMG_M0014::setnr_cns_pac($nr_cns_pac);
    $st_pac = 0;
    SMG_M0014::setst_pac($st_pac);
    $rs = SMG_M0014::consultaNome();
    
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}

function consultaNomePacienteProntuario(){
    
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];

    $inputBusca = (int)@$_POST['inputBusca'];

    $form = @$_POST['form'];
    $G_MEC = new Mecanismo();

    if($_POST['nm_pac'] != ''){
        $nm_pac = $_POST['nm_pac'];
    }else{
        $nm_pac = '';
    }

    if($_POST['tp_sexo_pac'] != ''){
        $tp_sexo_pac = $_POST['tp_sexo_pac'];
    }else{
        $tp_sexo_pac = '';
    }
    if($_POST['nr_cns_pac'] != ''){
        $nr_cns_pac = $_POST['nr_cns_pac'];
    }else{
        $nr_cns_pac = '';
    }
    if($_POST['st_prontuario'] != ''){
        $st_prontuario = $_POST['st_prontuario'];
    }else{
        $st_prontuario = '';
    }

    if(trim(str_replace('_','',str_replace('/', '', $_POST['dt_nasc_pac']))) != ''){
        if($G_MEC->ValidaData($G_MEC->FormataDataTiraBarraInverte($_POST['dt_nasc_pac']))){
            $dt_nasc_pac = $G_MEC->FormataDataTiraBarraInverte($_POST['dt_nasc_pac']);
        }else{
            echo json_encode('Erro: Data Invalida');
            exit;
        }
    }else{
        $dt_nasc_pac = '';
    }
    
    if($_POST['nm_mae_pac'] != ''){
        $nm_mae_pac = $_POST['nm_mae_pac'];
    }else{
        $nm_mae_pac = '';
    }

    SMG_M0014::setnm_pac($nm_pac);
    SMG_M0014::settp_sexo_pac($tp_sexo_pac);
    SMG_M0014::setdt_nasc_pac($dt_nasc_pac);
    SMG_M0014::setnm_mae_pac($nm_mae_pac);
    SMG_M0014::setnr_cns_pac($nr_cns_pac);
    $st_pac = 0;
    SMG_M0014::setst_pac($st_pac);
    $rs = SMG_M0014::consultaNomePacienteProntuario($st_prontuario);
    if(count($rs)>0){
        $Render = new renderView();
        $html = '<div class="grid_cabecalho">
                    <table width="100%" id="header-5290ccf719aed">
                        <thead>
                            <tr>
                                <th id="scp_h0007-tbl_solic_1">Prontuário</th>
                                <th id="scp_h0007-tbl_solic_2">Paciente</th>
                                <th id="scp_h0007-tbl_solic_3">Sexo</th>
                                <th id="scp_h0007-tbl_solic_4">Dt.Nasc.</th>
                                <th id="scp_h0007-tbl_solic_5">Mãe</th>
                                <th id="scp_h0007-tbl_solic_6">Situação</th>
                                <th id="scp_h0007-tbl_solic_7"></th>
                            </tr>
                        </thead>
                    </table>
                </div>';
        $html.= '<div class="grid_corpo"><table><tbody class="grid_corpo">';
        foreach ($rs as $key => $value) {
            //0-Livre,1-Alocado sem Confirmação,2-Confirmado Arquivo,3-Bloqueado,4-Em movimentação
            $class =  '';
            switch ($value['st_prontuario']) {
                case 1:
                    $class =  'alocado';
                    break;
                case 2:
                    $class =  'liberado';
                    break;
                case 3:
                    $class =  'bloqueado';
                    break;
                case 4:
                    $class =  'movimento';
                    break;
                default :
                    $class =  'livre';
                    break;
            }
            $html.= '<tr class="'.$class.'" data-data='."'".json_encode($value)."'".'>';
            $html.= '<td>'.$value['nr_prontuario'].'</td>';
            $html.= '<td>'.$value['nm_pac'].'</td>';
            $html.= '<td>'.$value['tp_sexo_pac'].'</td>';
            $html.= '<td>'.$value['dt_nasc_pac'].'</td>';
            $html.= '<td>'.$value['nm_mae_pac'].'</td>';
            $html.= '<td>'.StatusProntuario($value['st_prontuario']).'</td>';
            if($form != 'scp_fa014'){
                if($value['st_prontuario'] == 1 || $value['st_prontuario'] == 3 || $value['st_prontuario'] == 4){
                    $html.= '<td><button class="btn_editar" onclick="consultaMovProntuario('."'".$value['nr_prontuario']."','".$value['cd_pac']."','".$value['st_prontuario']."'".')"></button></td>';
                }else{
                    $html.= '<td>&nbsp;</td>';
                }
            }else{
                $html.= '<td><button class="btn_selecionar" onclick="confirmaAlteracaoProntuario('."'".$value['nr_prontuario']."','".$value['cd_pac']."'".')"></button></td>';
            }
            $html.= '</tr>';
        }
        $html.= '</tbody></table></div>';
        
        echo $html;
        
    }else{

        $html = '<div class="grid_cabecalho">
               <table width="100%" id="header-5290ccf719aed">
                   <thead>
                       <tr>
                           <th id="scp_h0007-tbl_solic_1">Prontuário</th>
                           <th id="scp_h0007-tbl_solic_2">Paciente</th>
                           <th id="scp_h0007-tbl_solic_3">Sexo</th>
                           <th id="scp_h0007-tbl_solic_4">Dt.Nasc.</th>
                           <th id="scp_h0007-tbl_solic_5">Mãe</th>
                           <th id="scp_h0007-tbl_solic_6">Situação</th>
                       </tr>
                   </thead>
               </table>
           </div>';
        $html.= '<div class="grid_corpo"><table><tbody class="grid_corpo">';
        $html.= '<tr><td colspan="6" style="display: inline-block; width:400px; text-align-center;">Nenhuma Paciente Localizado!</td></tr>';
        $html.= '</tbody></table></div>';
        echo $html;
    }
}

function incluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        $G_MEC->TransacaoInicio();
        $form = $G_MEC->recebePost($_POST, 'form');
        $nr_cns_pac = $G_MEC->recebePost($_POST, 'nr_cns_pac');
        SMG_M0014::setnr_cns_pac($nr_cns_pac);
        //Verifica Cartão SUS já cadastrado
        $st_pac = 0;
        SMG_M0014::setst_pac($st_pac);
        $rs_cns = SMG_M0014::ValidaInformacaoPaciente('C');
        if(count($rs_cns)===0){
            //Verifica se o Paciente já existe no Sistema, glosa Nome, Mãe, Sexo, Data de Nascimento,País de Origem, Código Município Nascimento
            $nm_pac = $G_MEC->recebePost($_POST, 'nm_pac');
            SMG_M0014::setnm_pac($nm_pac);
            $tp_sexo_pac = $G_MEC->recebePost($_POST, 'tp_sexo_pac');
            SMG_M0014::settp_sexo_pac($tp_sexo_pac);
            $dt_nasc_pac = $G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_nasc_pac'));
            SMG_M0014::setdt_nasc_pac($dt_nasc_pac);
            $nm_mae_pac = $G_MEC->recebePost($_POST, 'nm_mae_pac');
            SMG_M0014::setnm_mae_pac($nm_mae_pac);
            $cd_pais_orig_pac = $G_MEC->recebePost($_POST, 'cd_pais_orig_pac');
            SMG_M0014::setcd_pais_orig_pac($cd_pais_orig_pac);
            $cd_munic_nasc_pac = $G_MEC->recebePost($_POST, 'cd_munic_nasc_pac');
            SMG_M0014::setcd_munic_nasc_pac($cd_munic_nasc_pac);
            $rs_nome = SMG_M0014::ValidaInformacaoPaciente();
            if(count($rs_nome)===0){
                $cd_munic_nasc_mae_pac = $G_MEC->recebePost($_POST, 'cd_munic_nasc_mae_pac');
                SMG_M0014::setcd_munic_nasc_mae_pac($cd_munic_nasc_mae_pac);
                $cd_munic_pac = $G_MEC->recebePost($_POST, 'cd_munic_pac');
                SMG_M0014::setcd_munic_pac($cd_munic_pac);
                $nm_bairro_pac = $G_MEC->recebePost($_POST, 'nm_bairro_pac');
                SMG_M0014::setnm_bairro_pac($nm_bairro_pac);
                $ds_logr_pac = $G_MEC->recebePost($_POST, 'ds_logr_pac');
                SMG_M0014::setds_logr_pac($ds_logr_pac);
                $ds_compl_pac = $G_MEC->recebePost($_POST, 'ds_compl_pac');
                SMG_M0014::setds_compl_pac($ds_compl_pac);
                $nr_cep_pac = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_cep_pac'));
                SMG_M0014::setnr_cep_pac($nr_cep_pac);
                $ds_qd_pac = $G_MEC->recebePost($_POST, 'ds_qd_pac');
                SMG_M0014::setds_qd_pac($ds_qd_pac);
                $ds_lt_pac = $G_MEC->recebePost($_POST, 'ds_lt_pac');
                SMG_M0014::setds_lt_pac($ds_lt_pac);
                $nr_pac = $G_MEC->recebePost($_POST, 'nr_pac');
                SMG_M0014::setnr_pac($nr_pac);
                $nr_fone_pac_01 = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_fone_pac_01'));
                SMG_M0014::setnr_fone_pac_01($nr_fone_pac_01);
                $nr_fone_pac_02 = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_fone_pac_02'));
                SMG_M0014::setnr_fone_pac_02($nr_fone_pac_02);
                $nr_fone_pac_03 = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_fone_pac_03'));
                SMG_M0014::setnr_fone_pac_03($nr_fone_pac_03);
                $ds_email_pac = $G_MEC->recebePost($_POST, 'ds_email_pac');
                SMG_M0014::setds_email_pac($ds_email_pac);
                SMG_M0014::setcd_usu_cad_pac($_SESSION['cd_usuario_log']);
                SMG_M0014::setdt_usu_cad_pac($G_MEC->DataHoje());
                $rs = SMG_M0014::Incluir();
                if($rs !== false){
                    $G_MEC->TransacaoFinaliza();
                    $json['ret']=  'true';
                    $json['mostra'] = 'true';
                    $json['form']=  $G_MEC->recebePost($_POST, 'form');
                    $dados = array(
                        'cd_pac' => $rs
                    );
                    $json['dados'] = $dados;
                    $json['msg'] = 'Sucesso: Paciente Incluído com Sucesso!';
                    echo json_encode($json);
                }else{
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $G_MEC->recebePost($_POST, 'form');
                    $json['msg'] = 'Erro: Erro ao Inserir Paciente!';
                    echo json_encode($json);
                }
            }else{
                $G_MEC->TransacaoAborta();
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Dados Informado do Paciente já cadastrado!';
                echo json_encode($json);
            }           
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Número Cartão SUS já cadastrado!';
            echo json_encode($json);
        }
    }    
}

function alterar(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        $G_MEC->TransacaoInicio();
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        SMG_M0014::setcd_empresa($cd_empresa);
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
        SMG_M0014::setcd_pac($cd_pac);
        $nr_cns_pac = $G_MEC->recebePost($_POST, 'nr_cns_pac');
        SMG_M0014::setnr_cns_pac($nr_cns_pac);
        $cd_munic_pac = $G_MEC->recebePost($_POST, 'cd_munic_pac');
        SMG_M0014::setcd_munic_pac($cd_munic_pac);
        $nm_bairro_pac = $G_MEC->recebePost($_POST, 'nm_bairro_pac');
        SMG_M0014::setnm_bairro_pac($nm_bairro_pac);
        $ds_logr_pac = $G_MEC->recebePost($_POST, 'ds_logr_pac');
        SMG_M0014::setds_logr_pac($ds_logr_pac);
        $ds_compl_pac = $G_MEC->recebePost($_POST, 'ds_compl_pac');
        SMG_M0014::setds_compl_pac($ds_compl_pac);
        $nr_cep_pac = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_cep_pac'));
        SMG_M0014::setnr_cep_pac($nr_cep_pac);
        $ds_qd_pac = $G_MEC->recebePost($_POST, 'ds_qd_pac');
        SMG_M0014::setds_qd_pac($ds_qd_pac);
        $ds_lt_pac = $G_MEC->recebePost($_POST, 'ds_lt_pac');
        SMG_M0014::setds_lt_pac($ds_lt_pac);
        $nr_pac = $G_MEC->recebePost($_POST, 'nr_pac');
        SMG_M0014::setnr_pac($nr_pac);
        $nr_fone_pac_01 = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_fone_pac_01'));
        SMG_M0014::setnr_fone_pac_01($nr_fone_pac_01);
        $nr_fone_pac_02 = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_fone_pac_02'));
        SMG_M0014::setnr_fone_pac_02($nr_fone_pac_02);
        $nr_fone_pac_03 = $G_MEC->TirarMascara($G_MEC->recebePost($_POST, 'nr_fone_pac_03'));
        SMG_M0014::setnr_fone_pac_03($nr_fone_pac_03);
        $ds_email_pac = $G_MEC->recebePost($_POST, 'ds_email_pac');
        SMG_M0014::setds_email_pac($ds_email_pac);
        SMG_M0014::setcd_usu_alt_pac($_SESSION['cd_usuario_log']);
        SMG_M0014::setdt_usu_alt_pac($G_MEC->DataHoje());
        $rs = SMG_M0014::alterar();
        if($rs !== false){
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Sucesso: Paciente Alterado com Sucesso!';
            echo json_encode($json);
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Erro ao Alterar Paciente!';
            echo json_encode($json);
        }
    }
}

function excluir(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if(ValidaDados()){
        $G_MEC->TransacaoInicio();
        $form = $G_MEC->recebePost($_POST, 'form');
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        SMG_M0014::setcd_empresa($cd_empresa);
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
        SMG_M0014::setcd_pac($cd_pac);
        $cd_munic_pac = $G_MEC->recebePost($_POST, 'cd_munic_pac');
        SMG_M0014::setcd_munic_pac($cd_munic_pac);
        $nm_bairro_pac = $G_MEC->recebePost($_POST, 'nm_bairro_pac');
        SMG_M0014::setnm_bairro_pac($nm_bairro_pac);
        $ds_logr_pac = $G_MEC->recebePost($_POST, 'ds_logr_pac');
        SMG_M0014::setds_logr_pac($ds_logr_pac);
        $ds_compl_pac = $G_MEC->recebePost($_POST, 'ds_compl_pac');
        SMG_M0014::setds_compl_pac($ds_compl_pac);
        $nr_cep_pac = $G_MEC->recebePost($_POST, 'nr_cep_pac');
        SMG_M0014::setnr_cep_pac($nr_cep_pac);
        $ds_qd_pac = $G_MEC->recebePost($_POST, 'ds_qd_pac');
        SMG_M0014::setds_qd_pac($ds_qd_pac);
        $ds_lt_pac = $G_MEC->recebePost($_POST, 'ds_lt_pac');
        SMG_M0014::setds_lt_pac($ds_lt_pac);
        $nr_pac = $G_MEC->recebePost($_POST, 'nr_pac');
        SMG_M0014::setnr_pac($nr_pac);
        $nr_fone_pac_01 = $G_MEC->recebePost($_POST, 'nr_fone_pac_01');
        SMG_M0014::setnr_fone_pac_01($nr_fone_pac_01);
        $nr_fone_pac_02 = $G_MEC->recebePost($_POST, 'nr_fone_pac_02');
        SMG_M0014::setnr_fone_pac_02($nr_fone_pac_02);
        $nr_fone_pac_03 = $G_MEC->recebePost($_POST, 'nr_fone_pac_03');
        SMG_M0014::setnr_fone_pac_03($nr_fone_pac_03);
        $ds_email_pac = $G_MEC->recebePost($_POST, 'ds_email_pac');
        SMG_M0014::setds_email_pac($ds_email_pac);
        SMG_M0014::setcd_usu_alt_pac($_SESSION['cd_usuario_log']);
        SMG_M0014::setdt_usu_alt_pac($G_MEC->DataHoje());
        if(SMG_M0014::excluir()){
            $G_MEC->TransacaoFinaliza();
            $json['ret']=  'true';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Sucesso: Paciente Excluído com Sucesso!';
            echo json_encode($json);
        }else{
            $G_MEC->TransacaoAborta();
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Erro ao Excluir Paciente!';
            echo json_encode($json);
        }
    }
}

function ValidaDados(){
    
    $G_MEC = new Mecanismo();

    if($G_MEC->recebePost($_POST, 'form')=== NULL || trim($G_MEC->recebePost($_POST, 'form'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Formulário não Informado!';
        echo json_encode($json);
        return false;
    }

    if($G_MEC->recebePost($_POST, 'opr') !== 'incluir'){

        if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'cd_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
    }

    if($G_MEC->recebePost($_POST, 'opr') === 'incluir'){

        $nm_pac = $G_MEC->recebePost($_POST, 'nm_pac');
        if($nm_pac === NULL || trim($G_MEC->recebePost($_POST, 'nm_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Nome Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'tp_sexo_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'tp_sexo_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Sexo Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'dt_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'dt_nasc_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Data Nascimento Paciente não Informado!';
            echo json_encode($json);
            return false;
        }else{
            if(!$G_MEC->ValidaData($G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_nasc_pac')))){
                $json['ret']=  'false';
                $json['mostra'] = 'true';
                $json['form']=  $G_MEC->recebePost($_POST, 'form');
                $json['msg'] = 'Erro: Data Nascimento Paciente Inválido!';
                echo json_encode($json);
                return false;
            }else{
                $dataPaciente = $G_MEC->FormataDataTiraBarraInverte($G_MEC->recebePost($_POST, 'dt_nasc_pac'));
                $dataHoje = $G_MEC->DataHoje();
                if($G_MEC->FormataDataVerificaMaior($dataPaciente, $dataHoje)){
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $G_MEC->recebePost($_POST, 'form');
                    $json['msg'] = 'Erro: Data Nascimento não pode Ser maior que data Hoje!';
                    echo json_encode($json);
                    return false;
                }
            }
        }

        if($G_MEC->recebePost($_POST, 'cd_pais_orig_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'cd_pais_orig_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código País de Origem Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'nm_pais_orig_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_pais_orig_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Nome País de Origem Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'cd_munic_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'cd_munic_nasc_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Código Município Nascimento Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'sg_uf_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'sg_uf_nasc_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Sigla UF Nascimento Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'nm_munic_nasc_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_munic_nasc_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Nome Município Nascimento Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
        if($G_MEC->recebePost($_POST, 'nm_mae_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_mae_pac'))=== ''){
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $G_MEC->recebePost($_POST, 'form');
            $json['msg'] = 'Erro: Nome Mãe Paciente não Informado!';
            echo json_encode($json);
            return false;
        }
    }

    /*if($G_MEC->recebePost($_POST, 'nr_cns_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nr_cns_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código CNS Paciente não Informado!';
        echo json_encode($json);
        return false;
    }*/
        
    if($G_MEC->recebePost($_POST, 'cd_munic_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'cd_munic_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Código Município Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'sg_uf_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'sg_uf_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Sigla UF Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'nm_munic_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_munic_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Município Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'nm_bairro_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nm_bairro_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Bairro Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'ds_logr_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'ds_logr_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Nome Logradouro Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'nr_cep_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'nr_cep_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Número CEP Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'ds_qd_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'ds_qd_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Quadra Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    if($G_MEC->recebePost($_POST, 'ds_lt_pac')=== NULL || trim($G_MEC->recebePost($_POST, 'ds_lt_pac'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Lote Residencia Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
  /*  if($G_MEC->recebePost($_POST, 'nr_fone_pac_01')=== NULL || trim($G_MEC->recebePost($_POST, 'nr_fone_pac_01'))=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $G_MEC->recebePost($_POST, 'form');
        $json['msg'] = 'Erro: Telefone Paciente não Informado!';
        echo json_encode($json);
        return false;
    }*/
    return true;
}

function StatusProntuario($st_prontuario){
    //0-Livre,1-Alocado sem Confirmação,2-Confirmado Arquivo,3-Bloqueado,4-Em movimentação
    switch ($st_prontuario) {
        case 0:
            return 'Livre';
            break;
        case 1:
            return 'Não Alocado';
            break;
        case 2:
            return 'Liberado';
            break;
        case 3 :
            return 'Bloqueado';
            break;
        case 4:
            return 'Em movimentação';
            break;
        default:
            return 'Não Informado';
            break;
    }
}
?>