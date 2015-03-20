<?php

    include '../../authentic/model/mecanismo.php';
    $G_MEC = new Mecanismo();

    $form = $_POST['form'];
    $numeroCEP = $G_MEC->TirarMascara($_POST['nr_cep']);
    if(trim($numeroCEP) === ''){
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['mostra'] = 'true';
        $json['msg'] = 'Erro: CEP não Informado!';
        echo json_encode($json);
        exit;
    }
    
    
    $resultado_busca = json_decode(@file_get_contents('http://cep.correiocontrol.com.br/'.urlencode($numeroCEP).'.json'),true);    

    SGM_M0003::setnm_munic(utf8_encode($resultado_busca['localidade']));
    SGM_M0003::setsg_uf(utf8_encode($resultado_busca['uf']));
    $rs = SGM_M0003::validaNomeCEP();
    if(count($rs)>0){
        $dados = array(
            $form.'-cd_munic' => utf8_encode($rs[0]['cd_munic']),
            $form.'-nm_munic' => utf8_encode($rs[0]['nm_munic']),
            $form.'-uf' => utf8_encode($rs[0]['sg_uf']),
            $form.'-bairro' => $resultado_busca['bairro'],
            $form.'-tipo_logradouro_logradouro' => $resultado_busca['logradouro']
        );

        $json['ret']=  'true';
        $json['form']=  $form;
        $json['mostra'] = 'true';
        $json['dados'] = $dados;
        $json['msg'] = 'CEP Localizado com Sucesso!';
        echo json_encode($json);
        exit;
    }else{
        $json['ret']=  'false';
        $json['form']=  $form;
        $json['mostra'] = 'true';
        $json['msg'] = 'Erro: Município não Localizado para este CEP Informado!';
        echo json_encode($json);
        exit;
    }
?>  