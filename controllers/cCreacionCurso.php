<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/cursoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/categoriaDAO.php';

session_start();

$cursoDAO = new CursoDAO();
$categoriaDAO = new CategoriaDAO();

$curso = new CursoModel();
$cat = new CategoriaModel();

$curso->Titulo = $_POST['titulo'];
$curso->Descripcion = $_POST['descripcion'];
$curso->Costo = $_POST['costo'];
$curso->Imagen = file_get_contents(addslashes($_FILES["imagenCurso"]["tmp_name"]));
$curso->Id_Usuario = $_SESSION['Id_Usuario'];

$cursoAux = $cursoDAO->iudCurso("NUEVO", $curso);

if (!empty($_POST['categoria'])){
    foreach ($_POST['categoria'] as $nCat){
        $categoriaDAO->categoriaCurso("CATCU", $nCat, $cursoAux);
    }
}

if (!empty($_POST['nuevaCat'])){
    $cat->Descripcion = $_POST['nuevaCat'];
    $cat->Id_Usuario = $_SESSION['Id_Usuario'];
    $catAux = $categoriaDAO->iudCategoria("NUEVA", $cat);
    $categoriaDAO->categoriaCurso("CATCU", $catAux, $cursoAux);
}

header("Location: /Proyecto-BDMM-PCI/php/views/creacionnivel.php?Id_Curso=".$cursoAux);
exit;