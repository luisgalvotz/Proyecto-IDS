<?php

class ChatModel{
    public $Id_Usuario;
    public $Nombre_Usuario;
    public $Foto;
   
    public function addChatID($Id_Usuario){
        $this->Id_Usuario = $Id_Usuario;
    }

    public function addChat($Id_Usuario, $Nombre_Usuario, $Foto){
        $this->Id_Usuario = $Id_Usuario;
        $this->Nombre_Usuario = $Nombre_Usuario;
        $this->Foto = $Foto;    

    }
}