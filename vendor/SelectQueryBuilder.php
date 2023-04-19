<?php

namespace vendor;

class SelectQueryBuilder
{
    private $select = [];
    private $from;
    private $where = [];
    private $orderBy = [];
    private $limit;
    private $offset;
    private $params = [];
    

    public function select(array $select): self
    {
        $this->select = $select;
        return $this;
    }

    public function from(string $table): self
    {
        $this->from = $table;
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->where[] = "{$column} {$operator}{$value}";
        
        return $this;
    }

    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $this->orderBy[] = "{$column} {$direction}";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
    
    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function build(): string
    {
        $sql = "SELECT " . implode(', ', $this->select) . " FROM {$this->from}";

        if (!empty($this->where)) {
            $sql .= " WHERE " . implode(' AND ', $this->where);
        }
PR($sql);
        if (!empty($this->orderBy)) {
            $sql .= " ORDER BY " . implode(', ', $this->orderBy);
        }

        if (!empty($this->limit)) {
            $sql .= " LIMIT " . $this->limit;
        }
        if (!empty($this->offset)) {
            $sql .= " OFFSET " . $this->offset;
        }

        return $sql;
    }
}
