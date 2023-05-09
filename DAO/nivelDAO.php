<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/nivelModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/dbConnection.php';

class NivelDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function iudNivel($opc, $niv){
        
        $idNivelNuevo = -1;
        
        try{
            $sql = 'CALL SP_Niveles(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$niv->Id_Nivel);
            $statement->bindParam(3,$niv->Num_Nivel);
            $statement->bindParam(4,$niv->Contenido);
            $statement->bindParam(5,$niv->Imagen);
            $statement->bindParam(6,$niv->Video);
            $statement->bindParam(7,$niv->Archivos);
            $statement->bindParam(8,$niv->Links);
            $statement->bindParam(9,$niv->Costo);
            $statement->bindParam(10,$niv->Id_Curso);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $idNivelNuevo = $row['ID'];
            }
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $idNivelNuevo;
    }

    public function getNivel($opc, $niv){

        $listaNivel = [];
        
        try{
            $sql = 'CALL SP_Niveles(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$niv->Id_Nivel);
            $statement->bindParam(3,$niv->Num_Nivel);
            $statement->bindParam(4,$niv->Contenido);
            $statement->bindParam(5,$niv->Imagen);
            $statement->bindParam(6,$niv->Video);
            $statement->bindParam(7,$niv->Archivos);
            $statement->bindParam(8,$niv->Links);
            $statement->bindParam(9,$niv->Costo);
            $statement->bindParam(10,$niv->Id_Curso);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Nivel = $row['Id_Nivel'];
                $Num_Nivel = $row['Num_Nivel'];
                $Contenido = $row['Contenido'];
                $Imagen = $row['Imagen'];
                $Video = $row['Video'];
                $Archivos = $row['Archivos'];
                $Links = $row['Links'];
                $Costo = $row['Costo'];
                $Id_Curso = $row['Id_Curso'];

                $nivel = new NivelModel();
                $nivel->addNivel($Id_Nivel, $Num_Nivel, $Contenido, $Imagen, $Video, $Archivos, $Links, $Costo, $Id_Curso);
                $listaNivel[] = $nivel;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaNivel;
    }

}



?>