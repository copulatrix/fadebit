<?php
class Fadebit{
    function __construct($App){
        $this->App = $App;
        $this->Portals = json_decode(file_get_contents(__DIR__ . '/../Data/Portals.json'), true);
        $this->User = false;
    }

    function App(){
        return $this->App;
    }

    function Portals(){
        return $this->Portals;
    }

    function SetUser($Object){
        $this->User = $Object;
    }

    function GetUser(){
        return $this->User;
    }
}