<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/cursoinscritoDAO.php';

session_start();

$ciDAO = new CursoInscritoDAO();
$comentario = new CursoInscritoModel();
$calif = new CursoInscritoModel();
        
$comentario->Comentario = $_POST["comentario"];
$comentario->Id_Usuario = $_SESSION["Id_Usuario"];
$comentario->Id_Curso = $_POST["Id_Curso"];
        
$calif->Calificacion = $_POST["calificacion"];
$calif->Id_Usuario = $_SESSION["Id_Usuario"];
$calif->Id_Curso = $_POST["Id_Curso"];

if (empty($comentario->Comentario)){
    header("Location: /Proyecto-BDMM-PCI/php/views/curso.php?Id_Curso=".$comentario->Id_Curso);
}
else{
    $ciDAO->inComentario("ACMNT", $comentario);
    $ciDAO->inCalificacion("ADCAL", $calif);
    header("Location: /Proyecto-BDMM-PCI/php/views/curso.php?Id_Curso=".$comentario->Id_Curso);
}
exit;