<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/nivelDAO.php';

session_start();

$nivelDAO = new NivelDAO();

$nivel = new NivelModel();

$nivel->Contenido = $_POST['descripcion'];
if ($_FILES["imagenNivel"]["size"] != 0){
    $nivel->Imagen = file_get_contents(addslashes($_FILES["imagenNivel"]["tmp_name"]));
}
$nivel->Links = $_POST['links'];
$nivel->Costo = $_POST['costo'];
$nivel->Id_Curso = $_POST['idcurso'];
// VIDEO
$newName = str_replace('.', '', microtime(true));
$name = $_FILES['videoNivel']['name'];
$ext = pathinfo($name, PATHINFO_EXTENSION);
$tmpName = $_FILES['videoNivel']['tmp_name'];

$currentDir = str_replace('\php\controllers', '', getcwd());
$uploadPath = "$currentDir/Videos/$nivel->Id_Curso";
$finalPath = "$uploadPath/$newName.$ext";
if (!file_exists($uploadPath)) {
    mkdir($uploadPath);
}
if (move_uploaded_file($tmpName, $finalPath)) {
    $root = $_SERVER['DOCUMENT_ROOT'] . '/';
    $root = str_replace('/', '\\', $root);
    $finalPath = str_replace($root, '', $finalPath);
    
    $nivel->Video = $finalPath;
}
// ARCHIVO
if ($_FILES["archivoNivel"]["size"] != 0){
    $newName = str_replace('.', '', microtime(true));
    $name = $_FILES['archivoNivel']['name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $tmpName = $_FILES['archivoNivel']['tmp_name'];

    $currentDir = str_replace('\php\controllers', '', getcwd());
    $uploadPath = "$currentDir/Archivos/$nivel->Id_Curso";
    $finalPath = "$uploadPath/$newName.$ext";
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath);
    }
    if (move_uploaded_file($tmpName, $finalPath)) {
        $root = $_SERVER['DOCUMENT_ROOT'] . '/';
        $root = str_replace('/', '\\', $root);
        $finalPath = str_replace($root, '', $finalPath);
        
        $nivel->Archivos = $finalPath;
    }
}

$nivelAux = $nivelDAO->iudNivel("NUEVO", $nivel);

header("Location: /Proyecto-BDMM-PCI/php/views/creacionnivel.php?Id_Curso=".$nivel->Id_Curso);
exit;