<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/cursoDAO.php';

session_start();

$cursoDAO = new CursoDAO();

$curso = new CursoModel();

$curso->Id_Curso = $_POST["Id_Curso"];
$curso->Titulo = $_POST['titulo'];
$curso->Descripcion = $_POST['descripcion'];
if ($_FILES["imagenCurso"]["size"] != 0){
    $curso->Imagen = file_get_contents(addslashes($_FILES["imagenCurso"]["tmp_name"]));
}

$cursoDAO->iudCurso("EDITA", $curso);

header("Location: /Proyecto-BDMM-PCI/php/views/curso.php?Id_Curso=".$curso->Id_Curso);
exit;