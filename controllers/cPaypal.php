<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/Model/cursoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/cursoDAO.php';

session_start();

$curso_id = $_POST["id_curso"];
$id_fp = $_POST["metodo"];//esto es para cuando seleccione el boton de paypal
$id = $_SESSION['Id_Usuario'];

$fields = [ 'cmd' => '_cart', 'upload'=> '1', 'business' => 'sb-kb32d8460147@business.example.com','currency_code' => 'MXN', 'lc'=>'MX','rm'=>'2',
'return'=>'http://localhost/Proyecto-BDMM-PCI/php/controllers/cPago.php?Id_Usuario='.$id.'&na=0&fp=Paypal&curso='.$curso_id,
'cancel_return' => 'http://localhost/Proyecto-BDMM-PCI/php/views/curso.php?Id_Curso='.$curso_id,
'notify_url' => 'http://localhost/Proyecto-BDMM-PCI/php/views/curso.php?Id_Curso='.$curso_id
];

//recibir el curso o  nivel que se vaya a comprar por que lo vamos a mandar
$cursoDAO = new CursoDAO() ;
$cur = new CursoModel();
$cur->addCursoID($curso_id);
$curso_comprar = $cursoDAO->getCurso("CURSO", $cur)[0];

//hay que hacer un foreach para llenar lo que le vamos a mandar a el fields en caso de ser multipler cosas

$fields["item_name_1"] = $curso_comprar->Titulo;
$fields["item_number_1"] = '1';
$fields["amount_1"] = $curso_comprar->Costo;
$fields["quantity_1"] = 1;

if($id_fp == 2){
    $query_string = http_build_query($fields);
    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
    exit();
}

die();