<?php

class CitaModel {
    public $Id_Cita;
    public $Nombre_Paciente;
    public $Email;
    public $Telefono;
    public $Motivo;
    public $Fecha;
    public $Hora;
    public $Aprobada;

    public function agregarCita($Id_Cita, $Nombre_Paciente, $Email, $Telefono, $Motivo, $Fecha, $Hora, $Aprobada){
        $this->Id_Cita = $Id_Cita;
        $this->Nombre_Paciente = $Nombre_Paciente;
        $this->Email = $Email;
        $this->Telefono = $Telefono;
        $this->Motivo = $Motivo;
        $this->Fecha = $Fecha;
        $this->Hora = $Hora;
        $this->Aprobada = $Aprobada;
    }

}