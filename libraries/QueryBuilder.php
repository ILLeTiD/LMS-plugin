<?php

namespace FishyMinds;

class QueryBuilder
{
    private $db;
    private $class;
    private $select = [];
    private $from = [];
    private $where = [];
    private $limit = '';

    public function __construct($table, $class)
    {
        global $wpdb;

        $this->db = $wpdb;
        $this->select[] = '*';
        $this->from[] = $this->db->prefix . $table;
        $this->class = $class;
    }

    private function build()
    {
        $select = 'SELECT ' . implode(', ', $this->select);
        $from = 'FROM ' . implode(', ', $this->from);

        $conditions = array_map(function ($name, $value) {
            if (is_string($value)) {
                $value = "'{$value}'";
            }
            return $name . ' = ' . $value;
        }, array_keys($this->where), array_values($this->where));

        $where = 'WHERE ' . implode(' AND ', $conditions);

        $query = $select . ' ' . $from . ' ' . $where;

        if ($this->limit) {
            $query .= ' LIMIT ' . $this->limit;
        }

        return $query . ';';
    }

    public function where($conditions)
    {
        $this->where = array_merge($this->where, $conditions);

        return $this;
    }

    public function get()
    {
        $rows = $this->db->get_results($this->build(), ARRAY_A);

        $enrollments = array_map(function ($row) {
            return new $this->class($row);
        }, $rows);

        return new Collection($enrollments);
    }

    public function count()
    {
        $this->select[0] = 'COUNT(*)';

        return $this->db->get_var($this->build());
    }

    public function first()
    {
        $this->limit = '1';

        $row = $this->db->get_row($this->build(), ARRAY_A);

        return new $this->class($row);
    }
}