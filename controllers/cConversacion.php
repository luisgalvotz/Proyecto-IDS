<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/mensajesDAO.php';

session_start();

$mensajeDAO = new MensajeDAO();
$mensaje = new MensajeModel();

$ous = $_GET['id'];

$msgAux = $mensajeDAO->searchMsg("CONVE", $_SESSION["Id_Usuario"], $ous);
if (empty($msgAux)){
    $mensaje->Contenido = "Hola";
    $mensaje->Id_Usuario_Envia = $_SESSION["Id_Usuario"];
    $mensaje->Id_Usuario_Recibe = $ous;
    
    $mensajeDAO->iudMensaje("NUEVO", $mensaje);
}

header("Location: /Proyecto-IDS/views/mensajes.php?id=".$ous);

exit;