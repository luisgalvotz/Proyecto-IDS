<?php

class UsuarioModel {
    public $Id_Usuario;
    public $Nombre_Usuario;
    public $Contrasena;

    public function agregarUsuario($Id_Usuario, $Nombre_Usuario, $Contrasena){
        $this->Id_Usuario = $Id_Usuario;
        $this->Nombre_Usuario = $Nombre_Usuario;
        $this->Contrasena = $Contrasena;
    }

}