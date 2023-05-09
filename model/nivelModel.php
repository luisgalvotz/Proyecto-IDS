<?php

class NivelModel{
    public $Id_Nivel;
    public $Num_Nivel;
    public $Contenido;
    public $Imagen;
    public $Video;
    public $Archivos;
    public $Links;
    public $Costo;
    public $Id_Curso;

    public function addNivelID($Id_Nivel){
        $this->Id_Nivel = $Id_Nivel;
    }

    public function addNivel($Id_Nivel, $Num_Nivel, $Contenido, $Imagen, $Video, $Archivos, $Links, $Costo, $Id_Curso){
        $this->Id_Nivel = $Id_Nivel;
        $this->Num_Nivel = $Num_Nivel;
        $this->Contenido = $Contenido;
        $this->Imagen = $Imagen;
        $this->Video = $Video;
        $this->Archivos = $Archivos;
        $this->Links = $Links;
        $this->Costo = $Costo;
        $this->Id_Curso = $Id_Curso;
    }
}