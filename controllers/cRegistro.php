<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/usuarioDAO.php';

session_start();
unset($_SESSION['Id_Usuario']);

$usuarioDAO = new UsuarioDAO();

$user = new UsuarioModel();

$user->Tipo = $_POST['flexRadioDefault'];
$user->Nombre = $_POST['name'];
$user->Apellido_P = $_POST['fname'];
$user->Apellido_M = $_POST['lname'];
$user->Genero = $_POST['genero'];
$user->Fecha_Nac = $_POST['birthday'];
$user->Foto = file_get_contents(addslashes($_FILES["fotoPerfil"]["tmp_name"]));
$user->Email = $_POST['email'];
$user->Contrasena = $_POST['password'];

$userAux = $usuarioDAO->iudUser("RGSTR", $user);

$_SESSION["Id_Usuario"] = $userAux;
$_SESSION["Tipo"] = $user->Tipo;

if ($user->Tipo == "E"){
    
    header("Location: /Proyecto-BDMM-PCI/php/views/perfilM.php?Id_Usuario=".$_SESSION["Id_Usuario"]);
}
else{
    header("Location: /Proyecto-BDMM-PCI/php/views/perfilA.php?Id_Usuario=".$_SESSION["Id_Usuario"]);
}
exit;