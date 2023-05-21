<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/model/citaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/model/dbConnection.php';

class CitaDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function insCita($opc, $cita){
        
        $idCitaNuevo = -1;
        
        try{
            $sql = 'CALL SP_Citas(?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$cita->Nombre_Paciente);
            $statement->bindParam(3,$cita->Email);
            $statement->bindParam(4,$cita->Telefono);
            $statement->bindParam(5,$cita->Motivo);
            $statement->bindParam(6,$cita->Fecha);
            $statement->bindParam(7,$cita->Hora);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $idCitaNuevo = $row['ID'];
            }
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $idCitaNuevo;
    }

    public function getCitas($opc){

        $listaCitas = [];
        
        try{
            $sql = 'CALL SP_Citas(?, null, null, null, null, null, null);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Cita = $row['Id_Cita'];
                $Nombre = $row['Nombre_Paciente'];
                $Email = $row['Email'];
                $Telefono = $row['Telefono'];
                $Motivo = $row['Motivo'];
                $Fecha = $row['Fecha'];
                $Hora = $row['Hora'];
                $Aprobada = $row['Aprobada'];

                $cita = new CitaModel();
                $cita->agregarCita($Id_Cita, $Nombre, $Email, $Telefono, $Motivo, $Fecha, $Hora, $Aprobada);
                $listaCitas[] = $cita;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaCitas;
    }

    public function updateCita($cita){
        
        try{
            $sql = "UPDATE citas SET Aprobada = ? WHERE Id_Cita = ?;";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$cita->Aprobada, PDO::PARAM_INT);
            $statement->bindParam(2,$cita->Id_Cita);
            $statement->execute();
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }
    }
}
?>