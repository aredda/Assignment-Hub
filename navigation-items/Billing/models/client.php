<?php

class Client
{
    public $id;
    public $nom;
    public $adresse;

    public function __construct($id, $nom, $adresse)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
    }
    
    public function __destruct()
    {}

    public function displayInfo()
    {
        return "ID: $this->id - Nom: $this->nom - Adresse: $this->adresse";
    }
}