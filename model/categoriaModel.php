<?php

class CategoriaModel{
    public $Id_Categoria;
    public $Descripcion;
    public $Fecha_Creacion;
    public $Id_Usuario;
    
    public $Id_Curso;

    public function addCategoria($Id_Categoria, $Descripcion, $Fecha_Creacion, $Id_Usuario){
        $this->Id_Categoria = $Id_Categoria;
        $this->Descripcion = $Descripcion;
        $this->Fecha_Creacion = $Fecha_Creacion;
        $this->Id_Usuario = $Id_Usuario;
    }
}