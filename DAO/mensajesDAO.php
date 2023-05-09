<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/usuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/mensajeModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/chatModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Proyecto-BDMM-PCI/php/model/dbConnection.php';

class MensajeDAO{
    private $connection;

    public function __construct(){
        $database = new BaseDeDatos;
        $this->connection = $database->connect();
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function iudMensaje($opc, $msg){

        try{
            $sql = "CALL SP_Mensajes(?, ?, ?, ?, ?);";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindParam(2,$msg->Id_Mensaje);
            $statement->bindParam(3,$msg->Contenido);
            $statement->bindParam(4,$msg->Id_Usuario_Recibe);
            $statement->bindParam(5,$msg->Id_Usuario_Envia);
            $statement->execute();
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

    }

    
    public function getChatsUser($opc, $us){

        $listaChats = [];

        try{

            $sql = "CALL SP_Mensajes(?, ?, ?, ?, ?);";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,NULL);
            $statement->bindValue(3,NULL);
            $statement->bindParam(4,$us);
            $statement->bindValue(5,NULL);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

                $Nombre = $row["Nombre"];
                $Id_Usuario = $row["Id_Usuario"];
                $Foto = $row["Foto"];

                $chat = new ChatModel();
                $chat->addChat($Id_Usuario, $Nombre, $Foto);
                $listaChats[] = $chat;
            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaChats;
    }

    public function getMessagesUser($opc, $us, $ous){

        $listaMessages = [];

        try{

            $sql = "CALL SP_Mensajes(?, ?, ?, ?, ?);";


            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,NULL);
            $statement->bindValue(3,NULL);
            $statement->bindParam(4,$ous);
            $statement->bindParam(5,$us);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

                $Id_Mensaje = $row["Id_Mensaje"];
                $Fecha_Hora = $row["Fecha_Hora"];
                $Contenido = $row["Contenido"];
                $Id_Usuario_E = $row["Id_Usuario_Envia"];
                $Id_Usuario_R = $row["Id_Usuario_Recibe"];
                $Nombre_Usuario_E = $row["Nombre_Usuario_Envia"];

                $msg = new MensajeModel();
                $msg->addMessage($Id_Mensaje, $Fecha_Hora, $Contenido, $Id_Usuario_E, $Id_Usuario_R, $Nombre_Usuario_E);
                $listaMessages[] = $msg;
            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaMessages;
    }

    public function searchMsg($opc, $us, $ous){

        $listaMessages = [];

        try{

            $sql = "CALL SP_Mensajes(?, ?, ?, ?, ?);";


            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1,$opc);
            $statement->bindValue(2,NULL);
            $statement->bindValue(3,NULL);
            $statement->bindParam(4,$ous);
            $statement->bindParam(5,$us);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

                $Id_Mensaje = $row["Id_Mensaje"];

                $msg = new MensajeModel();
                $msg->addMessageID($Id_Mensaje);
                $listaMessages[] = $msg;
            }
        }
        catch(PDOException $e){
            error_log($e->getMessage());
        }
        finally{
            $statement->closeCursor();
        }

        return $listaMessages;
    }

}
