<?php

include "m_entity.php";
include "u_query.php";
include "u_node.php";

class DataContext 
{
    public $configArray;

    public $connection;
    public $entities;

    public function __construct($configArray) 
    {
        $this->configArray = $configArray;
        
        $this->connection = mysqli_connect(
            $configArray["host"], 
            $configArray["user"], 
            $configArray["pass"], 
            $configArray["data"]
        );

        if ($this->connection->connect_error)
            throw new Exception("Couldn't connect to the database " . $configArray["data"]);

        // Set up
        $this->SetEntities();
    }

    private function SetEntities() 
    {    
        $data = $this->configArray["data"];
        // Clear table array
        $this->entities = [];
        // Get all Table names from the database
        $names = Read(q_db_tables($data), $this->connection);
        // Set up tables
        foreach ($names as $n)
            $this->SetEntity($n["table_name"]);
    }

    public function SetEntity(string $table_name)
    : Entity 
    {
        // Columns
        $q_cols = q_table_columns($table_name);
        // Rows
        $q_rows = "select * from $table_name";
        // Creation
        $e = Entity::Create($table_name, Read($q_cols, $this->connection), Read($q_rows, $this->connection));
        // Saving
        array_push($this->entities, $e);
        // Return entity
        return $e;
    }

    public function GetEntity(string $table_name)
    : Entity 
    {
        // Iterate and return
        foreach ($this->entities as $e)
            if ($e->table_name == $table_name)
                return $e;

        throw new Exception("TABLE($table_name) doesn't exist!");
    }

    // Update and refresh data
    public function Refresh() {
        // Refreshing the entities
        $this->SetEntities();
    }

    // Execute commands, refresh the context and return the result of the execution
    public function RunQuery(string $query) {
        // Run query
        $result = $this->connection->query($query);
        // Refresh database
        $this->Refresh();
        // Return result
        return $result;
    }

    // Get database table names
    public function getEntityNames()
    {
        // Execute query
        $result = $this->connection->query(q_db_tables($this->configArray["data"]));
        // Fetch
        $names = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            array_push($names, $row[0]);

        return $names;
    }

}
