<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/DAO/usuarioDAO.php';

session_start();
unset($_SESSION['Id_Usuario']);
unset($_SESSION['Tipo']);

$usuarioDAO = new UsuarioDAO();

$user = new UsuarioModel();

$user->Email = $_POST['email'];
$user->Contrasena = $_POST['password'];

$userAux = $usuarioDAO->getUser("LOGIN", $user);

if (empty($userAux)){
    header("Location: /Proyecto-BDMM-PCI/php/views/login.php");
}
else{
    $_SESSION["Id_Usuario"] = $userAux[0]->Id_Usuario;
    $_SESSION["Tipo"] = $userAux[0]->Tipo;
    
    if ($userAux[0]->Tipo == "E"){
        header("Location: /Proyecto-BDMM-PCI/php/views/perfilM.php?Id_Usuario=".$_SESSION["Id_Usuario"]);
    }
    else{
        header("Location: /Proyecto-BDMM-PCI/php/views/perfilA.php?Id_Usuario=".$_SESSION["Id_Usuario"]);
    }
}
exit;