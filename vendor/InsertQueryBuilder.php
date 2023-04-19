<?php
namespace vendor;


class InsertQueryBuilder{

    private $table;
    private $values = [];

    public function into(string $table): self
    {
        $this->table = $table;
        return $this;
    }
    
    public function values(array $values): self
    {
        $this->values[] = $values;
        return $this;
    }
    
    public function build(): string
    {
        $columns = implode(', ' , array_keys($this->values[0]));
       
        $placeholders = implode(', ', array_fill(0, count($this->values[0]), '?'));
        
        $values = implode("', '", array_map(function($value) {
            return "('" . implode("', '", $value) . "')";
        }, $this->values));
        
        return "INSERT INTO {$this->table} ({$columns}) VALUES {$values};";
    }
    
    
    
}