<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    switch (strtolower($_POST['opr'])) {
        case 'gerar':
            gerar();
            break;
        case 'impressao':
            impressao();
            break;
        case 'listaprontuarioantigo':
            listaProntuarioAntigo();
            break;
        default:
            break;
    }
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function gerar(){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    if(validaDados ()){
        $cd_empresa = $_SESSION['cd_empresa_usu'];
        $cd_usuario = $_SESSION['cd_usuario_log'];
        //Verificar se Paciente possui Solicitação de Prontuário
        $form = $G_MEC->recebePost($_POST, 'form');
        SCP_M0003::setcd_empresa($cd_empresa);
        $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
        SCP_M0003::setcd_pac($cd_pac);
        if(count(SCP_M0003::consultaPacienteSolicitacao())<1){
            //Gerar Prontuário
            $G_MEC->TransacaoInicio();
            //Somente prateleiras ativa
            $st_prateleira = '0';
            SCP_M0002::setst_prontuario($st_prateleira);
            SCP_M0002::setcd_empresa($cd_empresa);
            $rs = SCP_M0002::PrimeiraPosicaoLivreLocacao();
            if($G_MEC->ValidaNumeroInteiro($rs['0']['nr_posicao'])){
                //Gerar Solicitação
                SCP_M0003::setcd_usu_solic($cd_usuario);
                SCP_M0003::setdt_solic($G_MEC->DataHoje());
                SCP_M0003::sethr_solic($G_MEC->HoraHoje());
                if(SCP_M0003::Incluir()){
                    //Update
                    SCP_M0002::setcd_pac($cd_pac);
                    $st_prontuario = 1;
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
                        if(trim($G_MEC->recebePost($_POST, 'nr_prontuario')) !== ''){
                            SCP_M0004::setcd_empresa($cd_empresa);
                            SCP_M0004::setcd_pac($cd_pac);
                            SCP_M0004::setcd_usu_pront($cd_usuario);
                            SCP_M0004::setdt_usu_pront($G_MEC->DataHoje());
                            SCP_M0004::sethr_usu_pront($G_MEC->HoraHoje());
                            $nr_prontuario = $G_MEC->recebePost($_POST, 'nr_prontuario');
                            SCP_M0004::setnr_prontuario($nr_prontuario);
                            if(count(SCP_M0004::consultaNumeroProntuario())<1){
                                SCP_M0004::incluir();
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
                            $G_MEC->TransacaoFinaliza();
                            $json['ret']=  'true';
                            $json['mostra'] = 'true';
                            $json['form']=  $form;
                            $json['dados']=  $rs['0']['nr_prontuario'];
                            $json['msg'] = 'Prontuário gerado com Sucesso! '.$rs['0']['nr_prontuario'];
                            echo json_encode($json);
                        }
                    }else{
                        $G_MEC->TransacaoAborta();
                        $json['ret']=  'false';
                        $json['mostra'] = 'true';
                        $json['form']=  $form;
                        $json['msg'] = 'Erro: Falha ao Alocar Prontuário!';
                        echo json_encode($json);
                        exit();
                    }
                }else{
                    $G_MEC->TransacaoAborta();
                    $json['ret']=  'false';
                    $json['mostra'] = 'true';
                    $json['form']=  $form;
                    $json['msg'] = 'Erro: Falha ao Gerar Solicitação Prontuário!';
                    echo json_encode($json);
                    exit();
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
            $json['ret']=  'false';
            $json['mostra'] = 'true';
            $json['form']=  $form;
            $json['msg'] = 'Erro: Já Existe Solicitação para Abertura de Prontuário!';
            echo json_encode($json);
            exit();
        }
    }
}

function impressao(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    //Verificar se Paciente possui Solicitação de Prontuário
    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }
    $form = $G_MEC->recebePost($_POST, 'form');
    
    if($G_MEC->recebePost($_POST, 'nr_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Número Prontuário Antigo Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    $nr_prontuario = $G_MEC->recebePost($_POST, 'nr_prontuario');

    SCP_M0002::setcd_empresa($cd_empresa);
    SCP_M0002::setnr_prontuario($nr_prontuario);
    $rs = SCP_M0002::consultaNumeroProntuario();
    if(count($rs)>0){
        /*echo '<table>';
        echo '<tbody>';
        echo '<tr><td style="width:50px; padding:5px 0 5px 0;">Paciente:</td><td colspan=3 style="width:250px; font-size:12px; font-weight:bold;">'.$rs[0]['nm_pac'].'</td></tr>';
        echo '<tr><td style="padding:5px 0 5px 0;">Dt.Nasc.:</td><td style="width:70px font-size:12px; font-weight:bold;">'.$G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_pac']).'</td>';
        echo '<td style="width:40px;">Sexo:</td><td style="font-size:12px; font-weight:bold;">'.$G_MEC->EnumSexo($rs[0]['tp_sexo_pac']).'</td></tr>';
        echo '<tr><td style="padding:5px 0 5px 0;">Mãe:</td><td colspan=3 style="font-size:12px; font-weight:bold;">'.$rs[0]['nm_mae_pac'].'</td></tr>';
        echo '</tbody>';
        echo '</table>';
        echo '<hr>';
         * 
         */
        echo '<div class="linha">';

        //Gerar Etiqueta com código de Barra
        include_once ('../../library/Barcode/class/BCGFontFile.php');
        include_once('../../library/Barcode/class/BCGColor.php');
        include_once('../../library/Barcode/class/BCGDrawing.php');
        include_once('../../library/Barcode/class/BCGcode39.barcode.php');

        $font = new BCGFontFile('../../library/Barcode/font/Arial.ttf', 18);

        // The arguments are R, G, and B for color.
        $colorFront = new BCGColor(0, 0, 0);
        $colorBack = new BCGColor(255, 255, 255);

        $texto = $rs[0]['nm_pac'];
        
        $code = new BCGcode39(); // Or another class name from the manual
        $code->setScale(2); // Resolution
        $code->setThickness(30); // Thickness
        $code->setForegroundColor($colorFront); // Color of bars
        $code->setBackgroundColor($colorBack); // Color of spaces
        $code->setFont(5); // Font (or 0)
        $code->parse($nr_prontuario); // Text
        
        $tempFile = sys_get_temp_dir(). '/'.  uniqid().'.png'; //Imagem Temporária

        $drawing = new BCGDrawing($tempFile, $colorBack);
        $drawing->setBarcode($code);
        $drawing->draw();
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

        //Alterar a Imagem
        $imagemOrigem = imagecreatefrompng($tempFile); //Carregando a Imagem de Origem
        $infoBar = getimagesize($tempFile); //Largura e Altura da imagem de Origem
        $imagemDestino = @imagecreate($infoBar[0],170); //Imagem de destino
        
        //Configuração da Imagem de Destino
        $background_color = imagecolorallocate($imagemDestino, 255,255, 255); //Cor do Fundo
        $text_color = imagecolorallocate($imagemDestino, 0, 0, 0); //Cor da Fonte
        //$fontColor = array(0, 0, 0);
        //Acrescentando texto na imagem de Destino
        //Cabeçalho

        $textcolor = '255,255,255';
        
        //imagettftext($imagemDestino,8, 0, 2, 10,$textcolor,'../../library/Barcode/font/Arial.ttf',utf8_decode("Paciente:"));
        //imagettftext($imagemDestino,8, 0, 2, 30,$textcolor,'../../library/Barcode/font/Arial.ttf',utf8_decode("Dt. Nasc.:"));
        //imagettftext($imagemDestino,8, 0, 150, 30,$textcolor,'../../library/Barcode/font/Arial.ttf',utf8_decode("Sexo:"));
        //imagettftext($imagemDestino,8, 0, 2, 50,$textcolor,'../../library/Barcode/font/Arial.ttf',utf8_decode("Mãe:"));

        imagestring($imagemDestino, 2, 5, 0,  "Paciente:", $text_color);
        imagestring($imagemDestino, 2, 5, 18,  "Dt. Nasc.:", $text_color);
        imagestring($imagemDestino, 2, 150, 18,  "Sexo:", $text_color);
        imagestring($imagemDestino, 2, 5, 36, utf8_decode("Mãe:"), $text_color);

        //Valores Pronturário
        //imagettftext($imagemDestino,8, 0, 58, 10,$textcolor,'../../library/Barcode/font/arialbd.ttf',utf8_decode($rs[0]['nm_pac']));
        //imagettftext($imagemDestino,8, 0, 58, 30,$textcolor,'../../library/Barcode/font/arialbd.ttf', $G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_pac']));
        //imagettftext($imagemDestino,8, 0, 185, 30,$textcolor,'../../library/Barcode/font/arialbd.ttf', $G_MEC->EnumSexo($rs[0]['tp_sexo_pac']));
        //imagettftext($imagemDestino,8, 0, 58, 50,$textcolor,'../../library/Barcode/font/arialbd.ttf', utf8_decode($rs[0]['nm_mae_pac']));
        
        imagestring($imagemDestino, 3, 70, 0, utf8_decode($rs[0]['nm_pac']), $text_color);
        imagestring($imagemDestino, 3, 70, 18, $G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_pac']), $text_color);
        imagestring($imagemDestino, 3, 185, 18, $G_MEC->EnumSexo($rs[0]['tp_sexo_pac']), $text_color);
        imagestring($imagemDestino, 3, 70, 36, utf8_decode($rs[0]['nm_mae_pac']), $text_color);

        //Unindo as duas imagens
        imagecopy($imagemDestino, $imagemOrigem, 0, 60, 0, 0, $infoBar[0], $infoBar[1]);
        imagepng($imagemDestino,'../../public/modulo/scp/img/'.$nr_prontuario.'.png');

        echo '<img src="data:image/png;base64,'.base64_encode(file_get_contents('../../public/modulo/scp/img/'.$nr_prontuario.'.png')).'"/>';
        echo '</div>';
        exit();
    }else{
        echo 'Prontuário não Localizado!';
        exit();
    }
    
}

function etiqueta(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];
    //Verificar se Paciente possui Solicitação de Prontuário
    $form = $G_MEC->recebePost($_GET, 'form');
    $nr_prontuario = $G_MEC->recebePost($_GET, 'nr_prontuario');

    include_once ('../../library/Barcode/class/BCGFontFile.php');
    include_once('../../library/Barcode/class/BCGColor.php');
    include_once('../../library/Barcode/class/BCGDrawing.php');
    include_once('../../library/Barcode/class/BCGcode39.barcode.php');

    $font = new BCGFontFile('../../library/Barcode/font/Arial.ttf', 18);

    // The arguments are R, G, and B for color.
    $colorFront = new BCGColor(0, 0, 0);
    $colorBack = new BCGColor(255, 255, 255);

    $code = new BCGcode39(); // Or another class name from the manual
    $code->setScale(2); // Resolution
    $code->setThickness(30); // Thickness
    $code->setForegroundColor($colorFront); // Color of bars
    $code->setBackgroundColor($colorBack); // Color of spaces
    $code->setFont(5); // Font (or 0)
    $code->parse($nr_prontuario); // Text

    $drawing = new BCGDrawing('../../public/modulo/scp/img/'.$nr_prontuario.'.png', $colorBack);
    $drawing->setBarcode($code);
    $drawing->draw();
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

  /*  $backgroundSource = "carteririnha_tamanho.jpg";
    $outputImage = imagecreatefromjpeg($backgroundSource);
    $feedBurnerStatsSource = base64_encode(file_get_contents('../../public/modulo/scp/img/'.$nr_prontuario.'.png'));
    $feedBurnerStats = imagecreatefromjpeg($feedBurnerStatsSource);
    $feedBurnerStatsX = imagesx($feedBurnerStats);
    $feedBurnerStatsY = imagesy($feedBurnerStats);
    imagecopymerge($outputImage,$feedBurnerStats,360,480,0,0,$feedBurnerStatsX,$feedBurnerStatsY,100);
    $textcolor = imagecolorallocate($outputImage, 0, 0, 0);
    $outputImage = imagerotate($outputImage, 270, 0);
    header('Content-type: image/png');
    imagepng($outputImage, "carteirinha01.jpg");
    imagedestroy($outputImage);
   * 
   */
    

   echo '<img src="data:image/png;base64,'.base64_encode(file_get_contents('../../public/modulo/scp/img/'.$nr_prontuario.'.png')).'"/>';

}


Function validaDados(){

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_POST, 'form')=== NULL || $G_MEC->recebePost($_POST, 'form')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Nome Formulário não Informado!';
        echo json_encode($json);
        return false;
    }
    
    $form = $G_MEC->recebePost($_POST, 'form');

    if($G_MEC->recebePost($_POST, 'cd_pac')=== NULL || $G_MEC->recebePost($_POST, 'cd_pac')=== ''){
        $json['ret']=  'false';
        $json['mostra'] = 'true';
        $json['form']=  $form;
        $json['msg'] = 'Erro: Código Paciente não Informado!';
        echo json_encode($json);
        return false;
    }
    
//    if($G_MEC->recebePost($_POST, 'nr_prontuario')=== NULL || $G_MEC->recebePost($_POST, 'nr_prontuario')=== ''){
//        $json['ret']=  'false';
//        $json['mostra'] = 'true';
//        $json['form']=  $form;
//        $json['msg'] = 'Erro: Número Prontuário Antigo Paciente não Informado!';
//        echo json_encode($json);
//        return false;
//    }

    return true;
}

Function listaProntuarioAntigo(){
    
    $filtro = @$_POST['filtro'];
    $opr = @$_POST['opr'];
    $url = @$_POST['url'];
    $inputBusca = (int)@$_POST['inputBusca'];

    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';
    $Render = new renderView();
    $headers = array('nr_prontuario'=> 'Anterior', 'dt_usu_pront'=>'Dt.Alt.','hr_usu_pront'=>'Hr.Alt.','nm_usuario'=>'Usuário');
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    SCP_M0004::setcd_empresa($cd_empresa);
    $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    SCP_M0004::setcd_pac($cd_pac);
    $rs = SCP_M0004::consultaNumeroProntuarioPaciente();
    echo $Render->renderGrid($rs, $headers, $inputBusca, $url, $opr);
}
?>
