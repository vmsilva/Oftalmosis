<?php session_start();
include '../../authentic/model/mecanismo.php';
if(isset($_SESSION['cd_usuario_log'])|| isset($_SESSION['cd_empresa_usu'])){
    
    $G_MEC = new Mecanismo();
    require_once '../../sca/controll/validaSessao.php';

    if($G_MEC->recebePost($_GET, 'cd_fila') === NULL || $G_MEC->recebePost($_GET, 'cd_fila')=== ''){
        echo 'Erro: Código Fila não Informado!';
        exit();
    }
    $cd_fila = $G_MEC->recebePost($_GET, 'cd_fila');

    require_once '../../library/fpdf/fpdf.php';
    
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $cd_usuario = $_SESSION['cd_usuario_log'];

    $PDF = new FPDF('P', 'mm', 'A4');
    $PDF->SetMargins(3,3,2);
    $PDF->InHeader = false;
    $PDF->InFooter = false;
    $PDF->SetAuthor($_SESSION['nm_usuario_log']);
    $PDF->SetTitle('Ficha de Atendimento Recepção');
    
    $PDF->SetTextColor(100,149,237);
    $PDF->SetDrawColor(100,149,237);
        
    $PDF->AddPage();
    SGA_M0007::setcd_empresa($cd_empresa);
    SGA_M0007::setcd_fila($cd_fila);
    $st_fila = '0|1|2|3';
    SGA_M0007::setst_fila($st_fila);
    $rs = SGA_M0007::listaFilaStatus();
    if(count($rs)>0){
        //Posicionando Logomarca
        $PDF->Image('../../public/img/logomarca/LogoCerof1.gif',26,10,15,15);
        $PDF->SetFont('Arial', 'B', 18);
        $PDF->Cell(60, 53, iconv('utf-8', 'iso-8859-1', 'CEROF'), 0, 0, 'C', '', '');
        $PDF->SetFont('Arial', 'B', 9);
        $PDF->SetXY(3, 4);
        $PDF->Cell(0, 62, iconv('utf-8', 'iso-8859-1', 'Centro de Referência em Oftalmologia'), 0, 0, 'L', '', '');
        $PDF->SetXY(9, 8);
        $PDF->Cell(0, 62, iconv('utf-8', 'iso-8859-1', 'Universidade Federal de Goiàs'), 0, 0, 'L', '', '');
        $PDF->SetXY(13, 12);
        $PDF->Cell(0, 62, iconv('utf-8', 'iso-8859-1', 'Departamento de Cirúrgia'), 0, 0, 'L', '', '');
        $PDF->SetXY(16, 16);
        $PDF->Cell(0, 62, iconv('utf-8', 'iso-8859-1', 'Hospital das Clínicas'), 0, 0, 'L', '', '');

        $PDF->SetTextColor(100,149,237);
        $PDF->SetDrawColor(100,149,237);
       
        //Posicionando Etiqueta
        $PDF->SetFont('Arial', 'B', 14);
        $PDF->SetXY(65, 4);
        $PDF->Cell(130, 5, iconv('utf-8', 'iso-8859-1', tipoAtendimento($rs[0]['tp_atend'],'c')), 0, 0, 'C', '', '');
        $PDF->SetXY(65, 4);
        $PDF->Cell(130, 5, iconv('utf-8', 'iso-8859-1', tipoAtendimento($rs[0]['tp_atend'],'c')), 0, 0, 'C', '', '');
        $PDF->SetXY(65, 10);
        $PDF->Cell(141, 42, '', 1, 0, '', false, '');
        
        //Campos Etiqueta
        $PDF->SetFont('Arial', 'B', 10);
        $PDF->SetXY(65, 10);$PDF->Cell(2, 9, 'Nome:', 0, 0, 'L', '', '');
        $PDF->SetXY(158, 10);$PDF->Cell(2, 9, 'Sexo:', 0, 0, 'L', '', '');
        $PDF->SetXY(175, 10);$PDF->Cell(2, 9, 'D.N.:', 0, 0, 'L', '', '');
        $PDF->SetXY(65, 10);$PDF->Cell(2, 19, iconv('utf-8', 'iso-8859-1', 'Mãe:'), 0, 0, 'L', '', '');
        $PDF->SetXY(158, 10);$PDF->Cell(2, 19, 'CNS:', 0, 0, 'L', '', '');
        $PDF->SetXY(65, 10);$PDF->Cell(2, 29, 'Prof.:', 0, 0, 'L', '', '');
        $PDF->SetXY(65, 10);$PDF->Cell(2, 39, 'Espld.:', 0, 0, 'L', '', '');
        $PDF->SetXY(158, 10);$PDF->Cell(2, 39, iconv('utf-8', 'iso-8859-1', 'Prontuário:'), 0, 0, 'L', '', '');
        $PDF->SetXY(65, 10);$PDF->Cell(2, 49,iconv('utf-8', 'iso-8859-1', 'Convênio:'), 0, 0, 'L', '', '');
        $PDF->SetXY(111, 10);$PDF->Cell(2, 49, 'Atend.:', 0, 0, 'L', '', '');
        $PDF->SetXY(144, 10);$PDF->Cell(2, 49, 'Dt.Atend.:', 0, 0, 'L', '', '');
        $PDF->SetXY(180, 10);$PDF->Cell(2, 49, 'Hr.Cheg.:', 0, 0, 'L', '', '');
        $PDF->SetXY(65, 10);$PDF->Cell(2, 59,iconv('utf-8', 'iso-8859-1', 'Endereço:'), 0, 0, 'L', '', '');
        $PDF->SetXY(65, 10);$PDF->Cell(2, 79,iconv('utf-8', 'iso-8859-1', 'Fone 01:'), 0, 0, 'L', '', '');
        $PDF->SetXY(111, 10);$PDF->Cell(2, 79,iconv('utf-8', 'iso-8859-1', 'Fone 02:'), 0, 0, 'L', '', '');
        $PDF->SetXY(157, 10);$PDF->Cell(2, 79,iconv('utf-8', 'iso-8859-1', 'Fone 03:'), 0, 0, 'L', '', '');
        
        //Posicionando Ficha 1
        $PDF->Image('../../public/img/Ficha/pagina1.jpg',2, 55, 200, 240);
//        
//        //Posicionamento Campos Formulário
//        //Bloco 1
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 55);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '1-História Atual da Doença:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 55);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '1-História Atual da Doença:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(62, 59);//linha 01
//        $PDF->Cell(142, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 64);//linha 02
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 69);//linha 03
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        
//        //Bloco 2
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 72);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '2-Antecedentes(pessoais / familiares / intolerância a fármaco):'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 72);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '2-Antecedentes(pessoais / familiares / intolerância a fármaco):'), 0, 0, 'L', '', '');
//        $PDF->SetXY(130, 76);//linha 01
//        $PDF->Cell(74, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 81);//linha 02
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 86);//linha 03
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 3
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 90);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '3-Ectoscopia(reflexos pupilares / avaliação neuroftalmológica):'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 90);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '3-Ectoscopia(reflexos pupilares / avaliação neuroftalmológica):'), 0, 0, 'L', '', '');
//        $PDF->SetXY(134, 94);//linha 01
//        $PDF->Cell(70, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 100);//linha 02
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 105);//linha 03
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 4
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 109);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '4-AV/SC:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 109);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '4-AV/SC:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(6, 116);
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(17, 120);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(6, 123);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(17, 127);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 5
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(75, 109);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '5-Óculos:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(75, 109);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '5-Óculos:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(77, 116);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(88, 120);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(77, 123);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(88, 127);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 6
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(145, 109);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '6-Refração Dinâmica:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(145, 109);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '6-Refração Dinâmica:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(147, 116);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(158, 120);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(147, 123);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(158, 127);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        
//        //Bloco 7
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 132);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '7-Refração Estática:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 132);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '7-Refração Estática:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(6, 138);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(17, 142);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(6, 146);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(17, 150);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 7 - Adição/Jaeger
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(75, 132);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Adição/Jaeger:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(75, 132);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Adição/Jaeger:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(77, 138);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(88, 142);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(77, 146);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(88, 150);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 7 - Receita de Óculos
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(145, 132);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Receita de Óculos:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(145, 132);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Receita de Óculos:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(147, 138);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(158, 142);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(147, 146);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(158, 150);
//        $PDF->Cell(45, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 8
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 154);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '8-Motilidade Ocular:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 154);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '8-Motilidade Ocular:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(47, 158);
//        $PDF->Cell(70, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(6, 160);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'COVERTEST:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(6, 160);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'COVERTEST:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(35, 164);
//        $PDF->Cell(82, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(6, 166);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'HIRSHBERG:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(6, 166);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'HIRSHBERG:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(35, 170);
//        $PDF->Cell(82, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(7, 176);
//        $PDF->Cell(110, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        
//        //Bloco 8 Desenho
//        $PDF->SetXY(125, 154);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD'), 0, 0, 'L', '', '');
//        $PDF->SetXY(195, 154);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/mot_ocular.png',132,155,23,23);
//        $PDF->Image('../../public/img/Ficha/mot_ocular.png',171,155,23,23);
//
//        //Bloco 9
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 180);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '9-Biomicroscopia:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 180);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '9-Biomicroscopia:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(43, 180);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(52, 184);//linha 01
//        $PDF->Cell(152, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 190);//linha 02
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(43, 192);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(52, 196);//linha 01
//        $PDF->Cell(152, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(5, 202);//linha 02
//        $PDF->Cell(199, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        
//        //Bloco 10 - Gonioscopia
//        $PDF->SetXY(4, 205);
//        $PDF->Cell(45, 71, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(4, 206);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '10-Gonioscopia:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(4, 206);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '10-Gonioscopia:'), 0, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 11);
//        $PDF->SetXY(4, 212);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD:'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/gonioscopia.png',15,212,20,20);
//        $PDF->SetXY(16, 236);//linha 01
//        $PDF->Cell(20, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(16, 241);//linha 02
//        $PDF->Cell(20, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(4, 242);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE:'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/gonioscopia.png',15,243,20,20);
//        $PDF->SetXY(16, 269);//linha 01
//        $PDF->Cell(20, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(16, 274);//linha 02
//        $PDF->Cell(20, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco 10 - Tonometria de Aplanação
//        $PDF->SetXY(49, 205);
//        $PDF->Cell(70, 71, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(50, 206);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '11-Tonometria de Aplanação:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(50, 212);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '{  }Pré Midríase'), 0, 0, 'L', '', '');
//        $PDF->SetXY(54, 218);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD ___________/___________h'), 0, 0, 'L', '', '');
//        $PDF->SetXY(54, 224);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE ___________/___________h'), 0, 0, 'L', '', '');
//        $PDF->SetXY(50, 232);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', '{  }Pós Midríase'), 0, 0, 'L', '', '');
//        $PDF->SetXY(54, 238);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD ___________/___________h'), 0, 0, 'L', '', '');
//        $PDF->SetXY(54, 244);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE ___________/___________h'), 0, 0, 'L', '', '');
//        $PDF->SetXY(50, 252);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Medicação em Uso:'), 0, 0, 'L', '', '');
//        $PDF->SetXY(92, 256);
//        $PDF->Cell(25, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(52, 262);
//        $PDF->Cell(65, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(52, 268);
//        $PDF->Cell(65, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetXY(52, 274);
//        $PDF->Cell(65, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//
//        //Bloco Conjuntiva - Limpo - Pupila
//        $PDF->SetXY(122, 205);
//        $PDF->Cell(82, 71, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->SetFont('Arial', 'B', 12);
//        $PDF->SetXY(130, 206);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Conjuntiva - Limbo - Pupila'), 0, 0, 'L', '', '');
//        $PDF->SetXY(125, 212);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OD'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/conjuntiva.png',127,215,30,15);
//        $PDF->SetXY(193, 212);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'OE'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/conjuntiva.png',170,215,30,15);
//        $PDF->SetXY(123, 235);
//        $PDF->Cell(80, 0, iconv('utf-8', 'iso-8859-1', ''), 1, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/cornea.png',125,240,25,25);
//        $PDF->SetXY(130, 270);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Córnea'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/cristalino.png',150,240,25,25);
//        $PDF->SetXY(152, 270);
//        $PDF->Cell(201, 5, iconv('utf-8', 'iso-8859-1', 'Cristalino'), 0, 0, 'L', '', '');
//        $PDF->Image('../../public/img/Ficha/olhoperfil.png',178,240,25,25);
        
        //Dados Impresso Etiqueta
        //Informação do Atendimento
        $PDF->SetTextColor(0,0,0);
        $PDF->SetFont('Arial', '', 9);
        $PDF->SetXY(78, 10);$PDF->Cell(2, 9, iconv('utf-8', 'iso-8859-1',substr($rs[0]['nm_pac'],0,40)), 0, 0, 'L', '', '');
        $PDF->SetXY(169, 10);$PDF->Cell(2, 9, iconv('utf-8', 'iso-8859-1', $rs[0]['tp_sexo_pac']), 0, 0, 'L', '', '');
        $PDF->SetXY(184, 10);$PDF->Cell(2, 9, iconv('utf-8', 'iso-8859-1',$G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_pac'])), 0, 0, 'L', '', '');
        $PDF->SetXY(78, 10);$PDF->Cell(2, 19, iconv('utf-8', 'iso-8859-1',substr($rs[0]['nm_mae_pac'],0,40)), 0, 0, 'L', '', '');
        $PDF->SetXY(169, 10);$PDF->Cell(2, 19, iconv('utf-8', 'iso-8859-1', $rs[0]['nr_cns_pac']), 0, 0, 'L', '', '');
        if($rs[0]['nm_prof'] != ''){
            $profissional = substr($rs[0]['nm_prof'],0,35).' ('.$rs[0]['sg_conselho'].'-'.$rs[0]['nr_conselho'].')';
            $PDF->SetXY(78, 10);$PDF->Cell(2, 29, iconv('utf-8', 'iso-8859-1', $profissional), 0, 0, 'L', '', '');
        }
        $especialidade = substr($rs[0]['cd_espld_medc'].'-'.$rs[0]['nm_espld_medc'],0,42);
        $PDF->SetXY(78, 10);$PDF->Cell(2, 39, iconv('utf-8', 'iso-8859-1',$especialidade), 0, 0, 'L', '', '');
        $PDF->SetXY(178, 10);$PDF->Cell(2, 39, iconv('utf-8', 'iso-8859-1',$rs[0]['nr_prontuario']), 0, 0, 'L', '', '');
        $PDF->SetXY(83, 10);$PDF->Cell(2, 49, iconv('utf-8', 'iso-8859-1',  substr($rs[0]['nm_cnes_red'],0,12)), 0, 0, 'L', '', '');
        $PDF->SetXY(124, 10);$PDF->Cell(2, 49, iconv('utf-8', 'iso-8859-1',tipoAtendimento($rs[0]['tp_atend'],'')), 0, 0, 'L', '', '');
        $PDF->SetXY(162, 10);$PDF->Cell(2, 49, iconv('utf-8', 'iso-8859-1',$G_MEC->FormataDatacomBarra($rs[0]['dt_atend'])), 0, 0, 'L', '', '');
        $PDF->SetXY(196, 10);$PDF->Cell(2, 49, iconv('utf-8', 'iso-8859-1',$G_MEC->FormataHora($rs[0]['hr_cheg'])), 0, 0, 'L', '', '');

        //Endereço
        if(trim($rs[0]['ds_logr_pac']) == ''){
            $linha = 59;
        }else{
            $linha = 69;
            $PDF->SetXY(83, 10);$PDF->Cell(2, 59, iconv('utf-8', 'iso-8859-1',$rs[0]['ds_logr_pac'].', Qd.'.$rs[0]['ds_qd_pac'].', Lt.'.$rs[0]['ds_lt_pac'].', Nr.'.$rs[0]['nr_pac']), 0, 0, 'L', '', '');
        }
        if($rs[0]['nm_bairro_pac'] != ''){
            $bairro = $rs[0]['nm_bairro_pac'].', ';
        }else{
            $bairro = '';
        }
        if($rs[0]['nm_munic_pac'] != ''){
            $municipio = $rs[0]['nm_munic_pac'].'-'.$rs[0]['sg_uf_pac'];
        }else{
            $municipio = '';
        }
        if($rs[0]['nr_cep_pac'] != ''){
            $cep = ', '.$G_MEC->Formata_Fone_CEP_CPF_CNPJ(trim($rs[0]['nr_cep_pac']),'CEP');
        }else{
            $cep = '';
        }
        
        $PDF->SetXY(83, 10);$PDF->Cell(2, $linha, iconv('utf-8', 'iso-8859-1',$bairro.$municipio.$cep), 0, 0, 'L', '', '');
        if(is_numeric($rs[0]['nr_fone_pac_01'])) $PDF->SetXY(83, 10);$PDF->Cell(2, 79, iconv('utf-8', 'iso-8859-1',$G_MEC->Formata_Fone_CEP_CPF_CNPJ(trim($rs[0]['nr_fone_pac_01']),'FONE')), 0, 0, 'L', '', '');
        if(is_numeric($rs[0]['nr_fone_pac_02'])) $PDF->SetXY(127, 10);$PDF->Cell(2, 79, iconv('utf-8', 'iso-8859-1',$G_MEC->Formata_Fone_CEP_CPF_CNPJ(trim($rs[0]['nr_fone_pac_02']),'FONE')), 0, 0, 'L', '', '');
        if(is_numeric($rs[0]['nr_fone_pac_03'])) $PDF->SetXY(173, 10);$PDF->Cell(2, 79, iconv('utf-8', 'iso-8859-1',$G_MEC->Formata_Fone_CEP_CPF_CNPJ(trim($rs[0]['nr_fone_pac_03']),'FONE')), 0, 0, 'L', '', '');
        
        //Página 2
        $PDF->AddPage();

        //Posicionando Logomarca
        $PDF->Image('../../public/img/Ficha/pagina2.jpg',2, 2, 200, 290);
        $PDF->SetAutoPageBreak(true);
        
        //Usuário que Cadastro Sistema
        $nameUsuario = $rs[0]['nr_matr_usu'].$rs[0]['dg_matr_usu'].'-'.substr($rs[0]['nm_usuario'],0,40);
        $PDF->Footer('E',$nameUsuario);
        
        $PDF->Output($rs[0]['nm_pac'].".pdf",'I');
    }else{
        echo 'Ficha de Atendimento não Localizada!';
        exit();
    }    
}else{
    require_once '../../sca/controll/validaSessao.php';
}

function tipoAtendimento($tp_atend,$local){
	if($local==='c'){
            switch ($tp_atend) {
                case '0':
                        return 'A T E N D I M E N T O  A M B U L A T Ó R I O';
                        break;
                case '1':
                        return 'A T E N D I M E N T O  DE  U R G Ê N C I A';
                        break;
                case '2':
                        return 'A T E N D I M E N T O  E N C A I X E';
                        break;
                default:
                        return 'A T E N D I M E N T O  N Ã O  I N F O R M A D O';
                break;
            }
	}else{
            switch ($tp_atend) {
                case '0':
                        return 'Ambulatório';
                        break;
                case '1':
                        return 'Urgência';
                        break;
                case '2':
                        return 'Encaixe';
                        break;
                default:
                        return 'Não Informado';
                break;
            }
	}
}