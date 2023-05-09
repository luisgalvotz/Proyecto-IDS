<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/cursoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/dbConnection.php';

class CursoDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function iudCurso($opc, $cur){
        
        $idCursoNuevo = -1;
        
        try{
            $sql = 'CALL SP_Cursos(?, ?, ?, ?, ?, ?, ?, ?, null, null, null, null, null);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$cur->Id_Curso);
            $statement->bindParam(3,$cur->Titulo);
            $statement->bindParam(4,$cur->Descripcion);
            $statement->bindParam(5,$cur->Cant_Niveles);
            $statement->bindParam(6,$cur->Costo);
            $statement->bindParam(7,$cur->Imagen);
            $statement->bindParam(8,$cur->Id_Usuario);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $idCursoNuevo = $row['ID'];
            }
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $idCursoNuevo;
    }

    public function getCurso($opc, $cur){

        $listaCurso = [];
        
        try{
            $sql = 'CALL SP_Cursos(?, ?, ?, ?, ?, ?, ?, ?, null, null, null, null, null);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$cur->Id_Curso);
            $statement->bindValue(3,$cur->Titulo);
            $statement->bindValue(4,$cur->Descripcion);
            $statement->bindValue(5,$cur->Cant_Niveles);
            $statement->bindValue(6,$cur->Costo);
            $statement->bindValue(7,$cur->Imagen);
            $statement->bindValue(8,$cur->Id_Usuario);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Curso = $row['Id_Curso'];
                $Titulo = $row['Titulo'];
                $Descripcion = $row['Descripcion'];
                $Fecha_Creacion = $row['Fecha_Creacion'];
                $Cant_Niveles = $row['Cant_Niveles'];
                $Costo = $row['Costo'];
                $Imagen = $row['Imagen'];
                $Promedio = $row['Promedio'];
                $Vacio = $row['Vacio'];
                $Activo = $row['Activo'];
                $Id_Usuario = $row['Id_Usuario'];
                $Nombre_Usuario = $row['Nombre_Usuario'];
                $Foto_Usuario = $row['Foto_Usuario'];
                $Ingreso_Curso = $row['Ingreso_Curso'];

                $curso = new CursoModel();
                $curso->addCurso($Id_Curso, $Titulo, $Descripcion, $Fecha_Creacion, $Cant_Niveles, $Costo, $Imagen, $Promedio, $Vacio, $Activo, $Id_Usuario, $Nombre_Usuario, $Foto_Usuario, $Ingreso_Curso);
                $listaCurso[] = $curso;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaCurso;
    }

    public function getCursosMain($opc){

        $listaCursos = [];
        
        try{
            $sql = 'CALL SP_Cursos(?, ?, ?, ?, ?, ?, ?, ?, null, null, null, null, null);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,NULL);
            $statement->bindValue(3,NULL);
            $statement->bindValue(4,NULL);
            $statement->bindValue(5,NULL);
            $statement->bindValue(6,NULL);
            $statement->bindValue(7,NULL);
            $statement->bindValue(8,NULL);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Curso = $row['Id_Curso'];
                $Titulo = $row['Titulo'];
                $Descripcion = $row['Descripcion'];
                $Imagen = $row['Imagen'];

                $curso = new CursoModel();
                $curso->addCursosMain($Id_Curso, $Titulo, $Descripcion, $Imagen);
                $listaCursos[] = $curso;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaCursos;
    }

    public function getCursosBusqueda($opc, $idcat, $busca, $maestro, $fini, $ffin){

        $listaCursos = [];
        
        try{
            $sql = 'CALL SP_Cursos(?, null, null, null, null, null, null, null, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$idcat);
            $statement->bindParam(3,$busca);
            $statement->bindParam(4,$maestro);
            $statement->bindParam(5,$fini);
            $statement->bindParam(6,$ffin);
            $statement->execute();
            
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Curso = $row['Id_Curso'];
                $Titulo = $row['Titulo'];
                $Descripcion = $row['Descripcion'];
                $Imagen = $row['Imagen'];

                $curso = new CursoModel();
                $curso->addCursosMain($Id_Curso, $Titulo, $Descripcion, $Imagen);
                $listaCursos[] = $curso;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaCursos;
    }

}



?>