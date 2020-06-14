<?php

class Pair {

    public $key;
    public $value;
    public $operator = "=";

    public function __construct($k, $v) {
        $this->key = $k;
        $this->value = $v;
    }

    public function toString() {
        return $this->key . $this->operator . (is_string($this->value) ? "'" . $this->value . "'" : $this->value);
    }

    /// Factory
    // Normal Creation
    public static function Create($k, $v): Pair {
        return new Pair($k, $v);
    }

    // Creation with a custom operator
    public static function CreateWithOperator($k, $v, string $o): Pair {
        $p = Pair::Create($k, $v);
        $p->operator = $o;

        return $p;
    }

}

class Entity {

    public $table_name;
    public $columns;
    public $rows;

    // Validation Methods
    public function HasColumn(string $column): bool {
        foreach ($this->columns as $c)
            if ($c["COLUMN_NAME"] == $column)
                return true;
        return false;
    }
    
    // Selection methods 
    public function Find(Pair $id) {
        if( !$this->HasColumn($id->key) )
            throw new Exception ( "COLUMN($id->key) doesn't belong to TABLE($this->table_name)!" );

        foreach ($this->rows as $row)
            if ($row[$id->key] == $id->value)
                return $row;
                
        return NULL;
    }

    public function Select() {
        // Select result
        $rows = $this->rows;
        $frows = $rows;

        // Params
        $params = func_get_args();
        if (count($params) == 1)
            if (is_array($params[0]))
                $params = $params[0];

        foreach ($params as $f) {
            // Check if the element is a pair
            if (!($f instanceof Pair))
                throw new Exception("Array must be an array of Pair objects!");
            // Check if the column exists in table columns
            if (!$this->HasColumn($f->key))
                throw new Exception($f->key . " is not a column of " . $this->table_name);
            // Clear 
            $frows = [];
            // Apply filters
            foreach ($rows as $r)
                if ($r[$f->key] == $f->value)
                    array_push($frows, $r);
            // Update base array
            $rows = $frows;
        }
        // Return the last array
        return $frows;
    }

    public function Max(string $column, string $type = null, array $rows = null) {
        if (!$this->HasColumn($column))
            throw new Exception("$column doesn't exist in the TABLE($this->table_name)!");

        if ($rows == null)
            $rows = $this->rows;
        
        $vals = [];

        foreach ($rows as $r) {
            $val = $r[$column];
            
            switch ($type) {
                case "Date":
                    $val = new DateTime($val);
                    break;
            }

            array_push($vals, $val);
        }

        $max = max($vals);

        foreach ($rows as $r) {
            if ($type == "Date") {
                if ( strcmp($max->format('Y-m-d'), $r[$column]) == 0 )
                    return $r;
            }
            else if ($max == $r[$column])
                return $r;
        }

        return NULL;
    }

    public function Insert(array $pairs) {
        // Arrays
        $columns = [];
        $values = [];

        // Configuration
        foreach ($pairs as $p) {
            // Check if the element is a pair
            if (!($p instanceof Pair))
                throw new Exception("Array must be an array of Pair objects!");
            // Check if the column exists in table columns
            if (!$this->HasColumn($p->key))
                throw new Exception($p->key . " is not a column of " . $this->table_name);
            // Push
            array_push($columns, $p->key);
            array_push($values, is_string($p->value) ? "'" . $p->value . "'" : $p->value );
        }

        // Validation
        if (count($columns) == 0 || count($values) == 0 || count($columns) != count($values))
            throw new Exception("Cannot generate INSERT Command!");

        return "insert into $this->table_name (" . implode(", ", $columns) . ") values (" . implode(", ", $values) . ")";
    }

    public function Update(Pair $id, array $pairs) {
        // Validation
        if (count($pairs) == 0)
            throw new Exception("Cannot generate INSERST Command!");
        // Array of pair expressions
        $expressions = [];
        // Configuration
        foreach ($pairs as $p) {
            // Check if the element is a pair
            if (!($p instanceof Pair))
                throw new Exception("Array must be an array of Pair objects!");
            // Check if the column exists in table columns
            if (!$this->HasColumn($p->key))
                throw new Exception($p->key . " is not a column of " . $this->table_name);
            // Push
            array_push($expressions, $p->toString());
        }
        // Construction
        return "update $this->table_name set " . implode(", ", $expressions) . " where " . $id->toString();
    }

    public function Delete() {
        // Array of criterias
        $criteria = [];
        // Validation
        if (count(func_get_args()) == 0)
            throw new Exception("Cannot generate DELETE Command!");
        // Configuration
        foreach (func_get_args() as $p) {
            // Check if the element is a pair
            if (!($p instanceof Pair))
                throw new Exception("Array must be an array of Pair objects!");
            // Check if the column exists in table columns
            if (!$this->HasColumn($p->key))
                throw new Exception($p->key . " is not a column of " . $this->table_name);
            // Push
            array_push($criteria, $p->toString());
        }
        // Construct
        return "delete from $this->table_name where " . implode(" and ", $criteria);
    }

    /// Select methods
    public function First()
    {
        return $this->rows[0];
    }
    public function Last()
    {
        return $this->rows[count($this->rows) - 1];
    }

    /// Factory Methods
    // Normal Creation
    public static function Create($name, $columns, $rows) {
        $e = new Entity();
        $e->table_name = $name;
        $e->columns = $columns;
        $e->rows = $rows;

        return $e;
    }

}
