<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/categoriaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/dbConnection.php';

class CategoriaDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function iudCategoria($opc, $cat){
        
        $idCategoriaNueva = -1;
        
        try{
            $sql = 'CALL SP_Categorias(?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$cat->Id_Categoria);
            $statement->bindParam(3,$cat->Descripcion);
            $statement->bindParam(4,$cat->Id_Usuario);
            $statement->bindValue(5,NULL);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $idCategoriaNueva = $row['ID'];
            }
            
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $idCategoriaNueva;
    }

    public function getCategoria($opc){

        $listaCategoria = [];
        
        try{
            $sql = 'CALL SP_Categorias(?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,NULL);
            $statement->bindValue(3,NULL);
            $statement->bindValue(4,NULL);
            $statement->bindValue(5,NULL);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Categoria = $row['Id_Categoria'];
                $Descripcion = $row['Descripcion'];
                $Fecha_Creacion = $row['Fecha_Creacion'];
                $Id_Usuario = $row['Id_Usuario'];

                $categoria = new CategoriaModel();
                $categoria->addCategoria($Id_Categoria, $Descripcion, $Fecha_Creacion, $Id_Usuario);
                $listaCategoria[] = $categoria;

            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }
        
        return $listaCategoria;
    }

    public function categoriaCurso($opc, $Id_Categoria, $Id_Curso){

        try{
            $sql = 'CALL SP_Categorias(?, ?, ?, ?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$Id_Categoria);
            $statement->bindValue(3,NULL);
            $statement->bindValue(4,NULL);
            $statement->bindParam(5,$Id_Curso);
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