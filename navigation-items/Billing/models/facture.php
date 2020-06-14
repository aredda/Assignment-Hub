<?php

class Facture
{
    public $id;
    public $produit;
    public $client;
    public $quantite;

    public function __construct($id, $produit, $client, $quantite)
    {
        $this->id = $id;
        $this->produit = $produit;
        $this->client = $client;
        $this->quantite = $quantite;
    }
}