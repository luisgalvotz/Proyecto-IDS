<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/DAO/citaDAO.php';

$citaDAO = new CitaDAO();

$cita = new CitaModel();

if (isset($_POST['id'])) {
    $cita->Id_Cita = $_POST['id'];
    $cita->Aprobada = $_POST['aprobada'];

    echo $cita->Id_Cita;
    echo $cita->Aprobada;

    $citaDAO->updateCita($cita);

    header("Location: /Proyecto-IDS/Citas.php");

    exit;
} else {
    $cita = new CitaModel();
    
    $cita->Nombre_Paciente = $_POST['nombre'];
    $cita->Telefono = $_POST['telefono'];
    $cita->Email = $_POST['email'];
    $cita->Motivo = $_POST['motivo'];
    $cita->Fecha = $_POST['fecha'];
    $cita->Hora = $_POST['hora'];

    echo $cita->Fecha;
    echo $cita->Hora;

    $citaDAO->insCita("INS", $cita);

    if ($citaDAO > 0) {
        header("Location: /Proyecto-IDS/perfil.php");
    } else {
        echo "Error";
    }
    exit;
}

?>