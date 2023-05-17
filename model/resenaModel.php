<?php

class ResenaModel {
    public $Id_Resena;
    public $Contenido;
    public $Fecha;

    public function agregarResena($Id_Resena, $Contenido, $Fecha){
        $this->Id_Resena = $Id_Resena;
        $this->Contenido = $Contenido;
        $this->Fecha = $Fecha;
    }

}