<?php

class CitaModel {
    public $Id_Cita;
    public $Nombre_Paciente;
    public $Telefono;
    public $Motivo;
    public $Fecha;
    public $Hora;

    public function agregarCita($Nombre_Paciente, $Telefono, $Motivo, $Fecha, $Hora){
        $this->Nombre_Paciente = $Nombre_Paciente;
        $this->Telefono = $Telefono;
        $this->Motivo = $Motivo;
        $this->Fecha = $Fecha;
        $this->Hora = $Hora;
    }

}