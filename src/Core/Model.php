<?php
namespace Core;
use Core\Database;
use Core\Abstracts\QueryBuilder;

abstract class Model extends Database
{
    protected $table = null;
    protected $sql_query = null;
    protected $select = '*';
    protected $where = [];
    protected $orderBy = '';
    protected $limit = '';

    public function __construct()
    {
        parent::__construct();
    }

    protected function setQueryElement()
    {
        $this->select = $this->select ?: '*';
        $this->where = $this->where ? ' WHERE ' . implode(' AND ', $this->where) : '';
        $this->orderBy = $this->orderBy ? ' ORDER BY ' . $this->orderBy : '';
    }

    protected function setSelectSqlQuery()
    {
        $this->sql_query = "SELECT {$this->select} FROM {$this->table}{$this->where}{$this->orderBy}{$this->limit}";
    }

    public function table($tablename)
    {
        $this->table = $tablename;
    }

    public function where($column, $equal = null)
    {
        if (is_array($column)) {
            foreach ($column as $key => $value) {
                $this->where[] = "$key = :$key";
            }
        } else {
            $this->where[] = "$column = :$column";
        }
    }

    public function select($selected_column)
    {
        $this->select = $selected_column;
    }

    public function orderBy($column, $sort_type)
    {
        $this->orderBy = "$column $sort_type";
    }

    public function limit(int $limit, $offset = false)
    {
        $this->limit = $offset ? " LIMIT $limit, $offset" : " LIMIT $limit";
    }

    public function get()
    {
        $this->setQueryElement();
        $this->setSelectSqlQuery();
        $query = $this->db->prepare($this->sql_query);
        $query->execute($this->getWhereBindings());
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function first()
    {
        $this->setQueryElement();
        $this->limit(1);
        $this->setSelectSqlQuery();
        $query = $this->db->prepare($this->sql_query);
        $query->execute($this->getWhereBindings());
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function insert(array $data)
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ":$col", $columns);
        $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
        $query = $this->db->prepare($sql);
        $query->execute($data);
        return $query->rowCount() ? $this->db->lastInsertId() : $query->errorInfo();
    }

    public function update(array $data)
    {
        $columns = array_keys($data);
        $set = implode(', ', array_map(fn($col) => "$col = :$col", $columns));
        $sql = "UPDATE {$this->table} SET $set{$this->where}";
        $query = $this->db->prepare($sql);
        $query->execute(array_merge($data, $this->getWhereBindings()));
        return $query->rowCount() ? $query->rowCount() : $query->errorInfo();
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->table}{$this->where}";
        $query = $this->db->prepare($sql);
        $query->execute($this->getWhereBindings());
        return $query->rowCount() ? $query->rowCount() : $query->errorInfo();
    }

    protected function getWhereBindings()
    {
        $bindings = [];
        foreach ($this->where as $condition) {
            preg_match('/(\w+) = :(\w+)/', $condition, $matches);
            if (isset($matches[1]) && isset($matches[2])) {
                $bindings[$matches[2]] = $matches[1];
            }
        }
        return $bindings;
    }
}