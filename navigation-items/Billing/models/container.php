<?php

class Container
{
    public $context;

    public $produits;
    public $clients;
    public $factures;

    public function __construct(array $config)
    {
        // Initialize a connection
        $this->context = new DataContext($config);

        $this->refresh();
    }

    public function loadProducts()
    {
        $this->produits = [];

        foreach ( $this->context->GetEntity("produit")->rows as $record )
            array_push($this->produits, new Produit($record["id"], $record["nom"], $record["prix"], $record["quantite"]));
    }

    public function loadClients()
    {
        $this->clients = [];

        foreach ( $this->context->GetEntity("client")->rows as $record )
            array_push($this->clients, new Client($record["id"], $record["nom"], $record["adresse"]));
    }

    public function refresh()
    {
        $this->loadProducts();
        $this->loadClients();
    }
}