<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/usuarioDAO.php';

session_start();
unset($_SESSION['Id_Usuario']);

$usuarioDAO = new UsuarioDAO();

$user = new UsuarioModel();

$user->Nombre_Usuario = $_POST['username'];
$user->Contrasena = $_POST['password'];

$userAux = $usuarioDAO->getUser($user);

if (empty($userAux->Id_Usuario)){
    header("Location: /Proyecto-IDS/login.php");
}
else{
    $_SESSION["Id_Usuario"] = $userAux->Id_Usuario;
    
    header("Location: /Proyecto-IDS/psicologaInicio.php");
}
exit;