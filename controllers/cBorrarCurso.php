<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/cursoDAO.php';

session_start();

$cursoDAO = new CursoDAO();

$curso = new CursoModel();

$curso->Id_Curso = $_GET["Id_Curso"];

$cursoDAO->iudCurso("BORRA", $curso);

header("Location: /Proyecto-IDS/views/curso.php?Id_Curso=".$curso->Id_Curso);
exit;