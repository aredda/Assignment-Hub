<?php

class Produit
{
    public $id;
    public $nom;
    public $prix;
    public $quantite;

    public function __construct($id, $nom, $prix, $quantite)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }

    public function displayInfo()
    {
        return "ID: $this->id - Nom: $this->nom - Prix: $this->prix DH - Quantite: $this->quantite";
    }
}