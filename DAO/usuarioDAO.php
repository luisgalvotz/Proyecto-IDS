<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/usuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/cursoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/dbConnection.php';

class UsuarioDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function iudUser($opc, $us){
        
        $idUsuarioNuevo = -1;
        
        try{
            $sql = 'CALL SP_Usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$us->Id_Usuario);
            $statement->bindParam(3,$us->Tipo);
            $statement->bindParam(4,$us->Nombre);
            $statement->bindParam(5,$us->Apellido_P);
            $statement->bindParam(6,$us->Apellido_M);
            $statement->bindParam(7,$us->Genero);
            $statement->bindParam(8,$us->Fecha_Nac);
            $statement->bindParam(9,$us->Foto);
            $statement->bindParam(10,$us->Email);
            $statement->bindParam(11,$us->Contrasena);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $idUsuarioNuevo = $row['ID'];
            }
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $idUsuarioNuevo;
    }

    public function getUser($opc, $us){

        $listaUsuarios = [];
        
        try{
            $sql = 'CALL SP_Usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$us->Id_Usuario);
            $statement->bindParam(3,$us->Tipo);
            $statement->bindParam(4,$us->Nombre);
            $statement->bindParam(5,$us->Apellido_P);
            $statement->bindParam(6,$us->Apellido_M);
            $statement->bindParam(7,$us->Genero);
            $statement->bindParam(8,$us->Fecha_Nac);
            $statement->bindParam(9,$us->Foto);
            $statement->bindParam(10,$us->Email);
            $statement->bindParam(11,$us->Contrasena);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Usuario = $row['Id_Usuario'];
                $Tipo = $row['Tipo'];
                $Nombre = $row['Nombre'];
                $Apellido_P = $row['Apellido_P'];
                $Apellido_M = $row['Apellido_M'];
                $Genero = $row['Genero'];
                $Fecha_Nac = $row['Fecha_Nac'];
                $Foto = $row['Foto'];
                $Email = $row['Email'];
                $Contrasena = $row['Contrasena'];
                $Fecha_Registro = $row['Fecha_Registro'];
                $Activo = $row['Activo'];
                $Edad = $row['Edad'];

                $user = new UsuarioModel();
                $user->addUser($Id_Usuario, $Tipo, $Nombre, $Apellido_P, $Apellido_M, $Genero, $Fecha_Nac, $Foto, $Email, $Contrasena, $Fecha_Registro, $Activo, $Edad);
                $listaUsuarios[] = $user;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaUsuarios;
    }

    public function getCursosUser($opc, $id, $tipo){
        
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
            $statement->bindParam(8,$id);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                if ($tipo == "E"){
                    $Id_Curso = $row['Id_Curso'];
                    $Titulo = $row['Titulo'];
                    $Cant_Niveles = $row['Cant_Niveles'];
                    $Descripcion = $row['Descripcion'];
                    $Imagen = $row['Imagen'];
                    $Alumnos_Inscritos = $row['Alumnos_Inscritos'];
                    $Nivel_Promedio = $row['Nivel_Promedio'];
                    $Ingreso_Curso = $row['Ingreso_Curso'];
    
                    $curso = new CursoModel();
                    $curso->addCursoE($Id_Curso, $Titulo, $Cant_Niveles, $Descripcion, $Imagen, $Alumnos_Inscritos, $Nivel_Promedio, $Ingreso_Curso);
                    $listaCursos[] = $curso;
                }

                if ($tipo == "A"){
                    $Id_Curso = $row['Id_Curso'];
                    $Titulo = $row['Titulo'];
                    $Nivel_Actual = $row['Nivel_Actual'];
                    $Cant_Niveles = $row['Cant_Niveles'];
                    $Fecha_Inicio = $row['Fecha_Inicio'];
                    $Fecha_Reciente = $row['Fecha_Reciente'];
                    $Fecha_Fin = $row['Fecha_Fin'];
                    $Imagen = $row['Imagen'];
    
                    $curso = new CursoModel();
                    $curso->addCursoA($Id_Curso, $Titulo, $Nivel_Actual, $Cant_Niveles, $Fecha_Inicio, $Fecha_Reciente, $Fecha_Fin, $Imagen);
                    $listaCursos[] = $curso;
                }

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

    public function getIngresos($opc, $us){

        $listaIngresos = [];
        
        try{
            $sql = 'CALL SP_Usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$us);
            $statement->bindValue(3,NULL);
            $statement->bindValue(4,NULL);
            $statement->bindValue(5,NULL);
            $statement->bindValue(6,NULL);
            $statement->bindValue(7,NULL);
            $statement->bindValue(8,NULL);
            $statement->bindValue(9,NULL);
            $statement->bindValue(10,NULL);
            $statement->bindValue(11,NULL);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Ingresos_Tarjeta = $row['Ingresos_Tarjeta'];
                $Ingresos_Paypal = $row['Ingresos_Paypal'];
                $Ingreso_Total = $row['Ingreso_Total'];

                $ing = new UsuarioModel();
                $ing->addIngresos($Ingresos_Tarjeta, $Ingresos_Paypal, $Ingreso_Total);
                $listaIngresos[] = $ing;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaIngresos;
    }

}



?>