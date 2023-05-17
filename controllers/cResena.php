<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/resenaDAO.php';

$resenaDAO = new ResenaDAO();

$resena = new ResenaModel();
$resena->Contenido = $_POST['contenido'];

$resenaDAO->insResena("INS", $resena);

if ($resenaDAO > 0) {
    header("Location: /Proyecto-IDS/perfil.php");
}
exit;