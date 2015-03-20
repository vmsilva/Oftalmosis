<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_GET, 'servico') === NULL || $G_MEC->recebePost($_GET, 'servico') === ''){
        echo 'Erro: Serviço não Informado!';
        exit();
    }
    $servico = $G_MEC->recebePost($_GET, 'servico');
    
    if($G_MEC->recebePost($_GET, 'sistema') === NULL || $G_MEC->recebePost($_GET, 'sistema') === ''){
        echo 'Erro: Sistema não Informado!';
        exit();
    }
    $sistema = $G_MEC->recebePost($_GET, 'sistema');
    
    if($G_MEC->recebePost($_GET, 'senha') === NULL || $G_MEC->recebePost($_GET, 'senha') === ''){
        echo 'Erro: Senha não Informado!';
        exit();
    }
    $senha = $G_MEC->recebePost($_GET, 'senha');
    
    if($G_MEC->recebePost($_GET, 'paciente') === NULL || $G_MEC->recebePost($_GET, 'paciente') === ''){
        echo 'Erro: Paciente não Informado!';
        exit();
    }
    $paciente = $G_MEC->recebePost($_GET, 'paciente');
    
    $html = '<div id="print" class="conteudo"><table>';
    $html.= '<tr><td style="width:60px;"></td></tr>';
    $html.= '<tr><td>Serviço:</td><td>'.$servico.'</td></tr>';
    $html.= '<tr><td>Painel:</td><td>'.$sistema.'</td></tr>';
    $html.= '<tr><td>Senha:</td><td>'.$senha.'</td></tr>';
    $chars = array(".","/","-","(",")",":",'"',"'");
    $html.= '<tr><td>Paciente:</td><td>'.str_replace($chars,"", $G_MEC->TrataString($paciente)).'</td></tr>';
    $html.= '<tr><td>Data:</td><td>'.$G_MEC->FormataDatacomBarra($G_MEC->DataHoje()).' - '.$G_MEC->FormataHora($G_MEC->HoraHoje()).'</td></tr>';
    $html.= '</table></div>';
    $texto = $html;
    $html.= '</br>';
    $html.= '<div class="botao-acao"><button id="painel-btn_imprimir" type="button" onclick="cont();" class="btn_imprimir">Imprimir</button></div>';
    //$html.= '<input type="button" onclick="cont();" value="Imprimir"/>';

    /*
     * 
     * http://forum.imasters.com.br/topic/477714-php-printerdll/
     * http://forum.imasters.com.br/topic/445676-erro-printer-open/
     */
//    $handle = printer_open("Foxit Reader PDF Printer Driver");
//    printer_set_option($handle, PRINTER_MODE, "RAW");
//    printer_write($handle, $texto);
//    printer_close($handle);
//exit();

    $fp = fopen("C:\xampp\htdocs\sistema\imprimir.txt", "w+");
    $salva = fwrite($fp, $html);
    fclose($fp);
    
    system("copy C:\imprimir.txt FOXIT_Reader:");
    exit();
    $conteudo = $html;
    
    $html.= "
        <head>
            <style type='text/css'>
                .botao-acao {
                    clear: both;
                }
                .botao-acao button:before {
                   background-image: url('./../../public/img/glyphicons-halflings.png') !important;
                   content: '';
                   display: inline-block;
                   height: 14px;
                   margin-right: 5px;
                   vertical-align: bottom !important;
                   width: 14px;
                }
                .botao-acao button:first-child {
                    border-radius: 5px 0 0 5px;
                }
                .botao-acao button {
                    border-collapse: collapse;
                }
                .botao-acao button {
                    background: linear-gradient(to bottom, rgba(242, 242, 242, 1) 0%, rgba(232, 232, 232, 1) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                    border: 1px solid #d9d9d9;
                    color: #000;
                    cursor: pointer;
                    min-width: 50px;
                    padding: 5px 10px;
                    text-align: center;
                }
                button {
                    font-family: Verdana,Arial,sans-serif;
                    font-size: 1em;
                }
                * {
                    font-family: Tahoma !important;
                    font-size: 12px;
                    margin: 0;
                    outline: medium none !important;
                    padding: 0;
                    vertical-align: middle;
                }
                .botao-acao button:last-child {
                    border-radius: 5px;
                    border-right: 1px solid #d9d9d9;
                }
                .btn_imprimir:before {
                    background-position: -96px -48px !important;
                }

            </style>
            <script type='text/javascript'>
                function cont(){
                   var conteudo = document.getElementById('print').innerHTML;
                   tela_impressao = window.open('about:blank');
                   tela_impressao.document.write('".$texto."');
                   tela_impressao.window.print();
                   tela_impressao.window.close();
                }
            </script>
        </head>";
   
    echo $html;
    exit();
}
