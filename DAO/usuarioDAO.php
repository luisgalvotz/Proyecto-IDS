<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/model/usuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-IDS/model/dbConnection.php';

class UsuarioDAO{

    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function getUser($us){

        $user = new UsuarioModel();
        
        try{
            $sql = 'CALL SP_Login(?, ?);';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$us->Nombre_Usuario);
            $statement->bindParam(2,$us->Contrasena);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                
                $Id_Usuario = $row['Id_Usuario'];
                $Nombre_Usuario = $row['Nombre_Usuario'];
                $Contrasena = $row['Contrasena'];

                $user->agregarUsuario($Id_Usuario, $Nombre_Usuario, $Contrasena);
            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $user;
    }


}



?>