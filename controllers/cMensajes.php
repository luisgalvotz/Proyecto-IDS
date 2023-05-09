<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/mensajesDAO.php';

session_start();

$mensajeDAO = new MensajeDAO();
$mensaje = new MensajeModel();
        
$mensaje->Contenido = $_POST['contenido'];
$mensaje->Id_Usuario_Envia = $_SESSION["Id_Usuario"];
$mensaje->Id_Usuario_Recibe = $_POST['id'];
        
if (empty($mensaje->Contenido)){
    header("Location: /Proyecto-BDMM-PCI/php/views/mensajes.php?id=".$mensaje->Id_Usuario_Recibe);
}
else{
    $mensajeDAO->iudMensaje("NUEVO", $mensaje);
    header("Location: /Proyecto-BDMM-PCI/php/views/mensajes.php?id=".$mensaje->Id_Usuario_Recibe);
}
exit;