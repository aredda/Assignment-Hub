<?php

// Execute queries and return the result as an array
function Read(string $query, $connection)
: array {
    // Empty array
    $data = [];
    // Query result
    $result = $connection->query($query);
    // Add to the empty array
    while ($row = $result->fetch_assoc())
        array_push($data, $row);
    // Return
    return $data;
}

// Get columns of a specific table
function q_table_columns(string $table) {
    return "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name = '$table'";
}

// Get tables of a specific database
function q_db_tables(string $database)
{
	return "SELECT table_name FROM information_schema.tables WHERE table_schema='$database'";
}

// Get the max column
function q_max(string $table, string $max_column)
{
	return "select max($max_column) as _MAX, * from $table";
}

// Get the min column
function q_min(string $table, string $min_column)
{
	return "select min($min_column) as _MIN, * from $table";
}