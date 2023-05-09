<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/nivelDAO.php';

session_start();

$root = $_SERVER['DOCUMENT_ROOT'] . '/';

$nivelDAO = new NivelDAO();

$niv = new NivelModel();
$niv->addNivelID($_POST["Id_Nivel"]);
$archivosNivel = $nivelDAO->getNivel("NIVEL", $niv)[0];

$nivel = new NivelModel();

$nivel->Id_Nivel = $_POST["Id_Nivel"];
$nivel->Contenido = $_POST['descripcion'];
$nivel->Links = $_POST['links'];
// ARCHIVO
if ($_FILES["archivoNivel"]["size"] != 0){
    unlink($root . $archivosNivel->Archivos);

    $newName = str_replace('.', '', microtime(true));
    $name = $_FILES['archivoNivel']['name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $tmpName = $_FILES['archivoNivel']['tmp_name'];

    $currentDir = str_replace('\php\controllers', '', getcwd());
    $uploadPath = "$currentDir/Archivos/$archivosNivel->Id_Curso";
    $finalPath = "$uploadPath/$newName.$ext";
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath);
    }
    if (move_uploaded_file($tmpName, $finalPath)) {
        $root = str_replace('/', '\\', $root);
        $finalPath = str_replace($root, '', $finalPath);
        
        $nivel->Archivos = $finalPath;
    }
}
// VIDEO
if ($_FILES["videoNivel"]["size"] != 0){
    unlink($root . $archivosNivel->Video);

    $newName = str_replace('.', '', microtime(true));
    $name = $_FILES['videoNivel']['name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $tmpName = $_FILES['videoNivel']['tmp_name'];

    $currentDir = str_replace('\php\controllers', '', getcwd());
    $uploadPath = "$currentDir/Videos/$archivosNivel->Id_Curso";
    $finalPath = "$uploadPath/$newName.$ext";
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath);
    }
    if (move_uploaded_file($tmpName, $finalPath)) {
        $root = str_replace('/', '\\', $root);
        $finalPath = str_replace($root, '', $finalPath);
        
        $nivel->Video = $finalPath;
    }
}
// IMAGEN
if ($_FILES["imagenNivel"]["size"] != 0){
    $nivel->Imagen = file_get_contents(addslashes($_FILES["imagenNivel"]["tmp_name"]));
}

$nivelDAO->iudNivel("EDITA", $nivel);

header("Location: /Proyecto-BDMM-PCI/php/views/nivel.php?Id_Nivel=".$nivel->Id_Nivel);
exit;