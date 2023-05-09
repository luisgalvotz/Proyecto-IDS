<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/cursoinscritoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/dbConnection.php';

class CursoInscritoDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function inCursoInscrito($opc, $ci){

        try{
            $sql = "CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindParam(3,$ci->Nivel_Actual);
            $statement->bindValue(4,null);
            $statement->bindValue(5,null);
            $statement->bindValue(6,null);
            $statement->bindParam(7,$ci->Forma_Pago);
            $statement->bindParam(8,$ci->Id_Usuario);
            $statement->bindParam(9,$ci->Id_Curso);
            $statement->execute();
        }
        catch(PDOException $e){
            error_log($e->getMessage());
            echo $e;
        }
        finally{
            $statement->closeCursor();
        }

    }

    public function getStatus($opc, $us, $cur){

        $listaStatus = [];

        try{
            $sql = "CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindValue(3,null);
            $statement->bindValue(4,null);
            $statement->bindValue(5,null);
            $statement->bindValue(6,null);
            $statement->bindValue(7,null);
            $statement->bindParam(8,$us);
            $statement->bindParam(9,$cur);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Nivel_Actual = $row['Nivel_Actual'];
                $Fecha_Fin = $row['Fecha_Fin'];
                $Calificacion = $row['Calificacion'];
                $Comentario = $row['Comentario'];
                $Forma_Pago = $row['Forma_Pago'];

                $st = new CursoInscritoModel();
                $st->addStatus($Nivel_Actual, $Fecha_Fin, $Calificacion, $Comentario, $Forma_Pago);
                $listaStatus[] = $st;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaStatus;
    }

    public function inCalificacion($opc, $cal){

        try{
            $sql = "CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindValue(3,null);
            $statement->bindParam(4,$cal->Calificacion);
            $statement->bindValue(5,null);
            $statement->bindValue(6,null);
            $statement->bindValue(7,null);
            $statement->bindParam(8,$cal->Id_Usuario);
            $statement->bindParam(9,$cal->Id_Curso);
            $statement->execute();
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

    }

    public function inComentario($opc, $cmnt){

        try{
            $sql = "CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindValue(3,null);
            $statement->bindValue(4,null);
            $statement->bindParam(5,$cmnt->Comentario);
            $statement->bindValue(6,null);
            $statement->bindValue(7,null);
            $statement->bindParam(8,$cmnt->Id_Usuario);
            $statement->bindParam(9,$cmnt->Id_Curso);
            $statement->execute();
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

    }

    public function getComentario($opc, $cur){

        $listaComentario = [];
        
        try{
            $sql = 'CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindValue(3,null);
            $statement->bindValue(4,null);
            $statement->bindValue(5,null);
            $statement->bindValue(6,null);
            $statement->bindValue(7,null);
            $statement->bindValue(8,null);
            $statement->bindParam(9,$cur);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Comentario = $row['Comentario'];
                $Calificacion = $row['Calificacion'];
                $Id_Usuario = $row['Id_Usuario'];
                $Nombre_Usuario = $row['Nombre_Usuario'];
                $Foto = $row['Foto'];

                $com = new CursoInscritoModel();
                $com->addComentario($Comentario, $Calificacion, $Id_Usuario, $Nombre_Usuario, $Foto);
                $listaComentario[] = $com;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaComentario;
    }

    public function getUsersCurso($opc, $cur){

        $listaUserCur = [];
        
        try{
            $sql = 'CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindValue(3,null);
            $statement->bindValue(4,null);
            $statement->bindValue(5,null);
            $statement->bindValue(6,null);
            $statement->bindValue(7,null);
            $statement->bindValue(8,null);
            $statement->bindParam(9,$cur);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Nivel_Actual = $row['Nivel_Actual'];
                $Fecha_Inicio = $row['Fecha_Inicio'];
                $Pago_Total = $row['Pago_Total'];
                $Forma_Pago = $row['Forma_Pago'];
                $Id_Usuario = $row['Id_Usuario'];
                $Nombre_Usuario = $row['Nombre_Usuario'];
                $Foto = $row['Foto'];

                $uscur = new CursoInscritoModel();
                $uscur->addUserCurso($Nivel_Actual, $Fecha_Inicio, $Pago_Total, $Forma_Pago, $Id_Usuario, $Nombre_Usuario, $Foto);
                $listaUserCur[] = $uscur;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaUserCur;
    }

    public function getDiplomas($opc, $us){

        $listaDiploma = [];
        
        try{
            $sql = 'CALL SP_CursoInscrito(?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,null);
            $statement->bindValue(3,null);
            $statement->bindValue(4,null);
            $statement->bindValue(5,null);
            $statement->bindValue(6,null);
            $statement->bindValue(7,null);
            $statement->bindParam(8,$us);
            $statement->bindValue(9,null);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Usuario = $row['Id_Usuario'];
                $Nombre_Usuario = $row['Usuario_Recibe_Diploma'];
                $Nombre_Maestro = $row['Usuario_Entrega_Diploma'];
                $Titulo = $row['Titulo'];
                $Imagen = $row['Imagen'];
                $Fecha_Fin = $row['Fecha_Fin'];

                $dip = new CursoInscritoModel();
                $dip->addDiploma($Id_Usuario, $Nombre_Usuario, $Nombre_Maestro, $Titulo, $Imagen, $Fecha_Fin);
                $listaDiploma[] = $dip;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaDiploma;
    }

}



?>