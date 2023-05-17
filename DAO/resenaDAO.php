<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/model/resenaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/model/dbConnection.php';

class ResenaDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function insResena($opc, $res){
        
        $idResenaNuevo = -1;
        
        try{
            $sql = 'CALL SP_Resenas(?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$res->Contenido);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $idResenaNuevo = $row['ID'];
            }
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $idResenaNuevo;
    }

    public function getResenas($opc){

        $listaResenas = [];
        
        try{
            $sql = 'CALL SP_Resenas(?, null);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Resena = $row['Id_Resena'];
                $Contenido = $row['Contenido'];
                $Fecha = $row['Fecha'];

                $resena = new ResenaModel();
                $resena->agregarResena($Id_Resena, $Contenido, $Fecha);
                $listaResenas[] = $resena;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaResenas;
    }

}



?>