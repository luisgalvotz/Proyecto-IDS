<?php

class CursoModel {
    public $Id_Curso;
    public $Titulo;
    public $Descripcion;
    public $Fecha_Creacion;
    public $Cant_Niveles;
    public $Costo;
    public $Imagen;
    public $Promedio;
    public $Vacio;
    public $Activo;
    public $Id_Usuario;

    public $Nombre_Usuario;
    public $Foto_Usuario;

    public $Nivel_Actual;
    public $Fecha_Inicio;
    public $Fecha_Reciente;
    public $Fecha_Fin;

    public $Alumnos_Inscritos;
    public $Nivel_Promedio;
    public $Ingreso_Curso;

    public function addCursoID($Id_Curso){
        $this->Id_Curso = $Id_Curso;
    }

    public function addCurso($Id_Curso, $Titulo, $Descripcion, $Fecha_Creacion, $Cant_Niveles, $Costo, $Imagen, $Promedio, $Vacio, $Activo, $Id_Usuario, $Nombre_Usuario, $Foto_Usuario, $Ingreso_Curso){
        $this->Id_Curso = $Id_Curso;
        $this->Titulo = $Titulo;
        $this->Descripcion = $Descripcion;
        $this->Fecha_Creacion = $Fecha_Creacion;
        $this->Cant_Niveles = $Cant_Niveles;
        $this->Costo = $Costo;
        $this->Imagen = $Imagen;
        $this->Promedio = $Promedio;
        $this->Vacio = $Vacio;
        $this->Activo = $Activo;
        $this->Id_Usuario = $Id_Usuario;
        $this->Nombre_Usuario = $Nombre_Usuario;
        $this->Foto_Usuario = $Foto_Usuario;
        $this->Ingreso_Curso = $Ingreso_Curso;
    }

    public function addCursoE($Id_Curso, $Titulo, $Cant_Niveles, $Descripcion, $Imagen, $Alumnos_Inscritos, $Nivel_Promedio, $Ingreso_Curso){
        $this->Id_Curso = $Id_Curso;
        $this->Titulo = $Titulo;
        $this->Cant_Niveles = $Cant_Niveles;
        $this->Descripcion = $Descripcion;
        $this->Imagen = $Imagen;
        $this->Alumnos_Inscritos = $Alumnos_Inscritos;
        $this->Nivel_Promedio = $Nivel_Promedio;
        $this->Ingreso_Curso = $Ingreso_Curso;
    }

    public function addCursoA($Id_Curso, $Titulo, $Nivel_Actual, $Cant_Niveles, $Fecha_Inicio, $Fecha_Reciente, $Fecha_Fin, $Imagen){
        $this->Id_Curso = $Id_Curso;
        $this->Titulo = $Titulo;
        $this->Nivel_Actual = $Nivel_Actual;
        $this->Cant_Niveles = $Cant_Niveles;
        $this->Fecha_Inicio = $Fecha_Inicio;
        $this->Fecha_Reciente = $Fecha_Reciente;
        $this->Fecha_Fin = $Fecha_Fin;
        $this->Imagen = $Imagen;
    }

    public function addCursosMain($Id_Curso, $Titulo, $Descripcion, $Imagen){
        $this->Id_Curso = $Id_Curso;
        $this->Titulo = $Titulo;
        $this->Descripcion = $Descripcion;
        $this->Imagen = $Imagen;
    }

}