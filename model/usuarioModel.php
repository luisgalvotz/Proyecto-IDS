<?php

class UsuarioModel {
    public $Id_Usuario;
    public $Tipo;
    public $Nombre;
    public $Apellido_P;
    public $Apellido_M;
    public $Genero;
    public $Fecha_Nac;
    public $Foto;
    public $Email;
    public $Contrasena;
    public $Fecha_Registro;
    public $Activo;

    public $Edad;

    public $Ingresos_Tarjeta;
    public $Ingresos_Paypal;
    public $Ingreso_Total;

    public function addUserID($Id_Usuario){
        $this->Id_Usuario = $Id_Usuario;
    }

    public function addUser($Id_Usuario, $Tipo, $Nombre, $Apellido_P, $Apellido_M, $Genero, $Fecha_Nac, $Foto, $Email, $Contrasena, $Fecha_Registro, $Activo, $Edad){
        $this->Id_Usuario = $Id_Usuario;
        $this->Tipo = $Tipo;
        $this->Nombre = $Nombre;
        $this->Apellido_P = $Apellido_P;
        $this->Apellido_M = $Apellido_M;
        $this->Genero = $Genero;
        $this->Fecha_Nac = $Fecha_Nac;
        $this->Foto = $Foto;
        $this->Email = $Email;
        $this->Contrasena = $Contrasena;
        $this->Fecha_Registro = $Fecha_Registro;
        $this->Activo = $Activo;
        $this->Edad = $Edad;
    }

    public function addIngresos($Ingresos_Tarjeta, $Ingresos_Paypal, $Ingreso_Total){
        $this->Ingresos_Tarjeta = $Ingresos_Tarjeta;
        $this->Ingresos_Paypal = $Ingresos_Paypal;
        $this->Ingreso_Total = $Ingreso_Total;
    }

}