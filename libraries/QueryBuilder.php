<?php

namespace FishyMinds;

class QueryBuilder
{
    private $db;
    private $class;
    private $select = [];
    private $from = [];
    private $where = [];
    private $order_by = [];
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

        $query = $select . ' ' . $from;

        if ($this->where) {
            $conditions = array_map(function ($name, $value) {
                if (is_string($value)) {
                    $value = "'{$value}'";
                }

                if (is_array($value)) {
                    $set = array_map(function ($item) {
                        return "'{$item}'";
                    }, $value);
                    return $name . ' IN (' . implode(', ', $set) . ')';
                }

                return $name . ' = ' . $value;
            }, array_keys($this->where), array_values($this->where));

            $query = ' WHERE ' . implode(' AND ', $conditions);
        }


        if ($this->order_by) {
            $columns = array_map(function ($column, $order) {
                return $column . ' ' . $order;
            }, array_keys($this->order_by), array_values($this->order_by));

            $query .= ' ORDER BY ' . implode(', ', $columns);
        }

        if ($this->limit) {
            $query .= ' LIMIT ' . $this->limit;
        }

        return $query . ';';
    }

    public function select($columns)
    {
        if (is_string($columns)) {
            $columns = [$columns];
        }

        $this->select =  $columns;

        $this->class = null;

        return $this;
    }

    public function where($conditions)
    {
        $this->where = array_merge($this->where, $conditions);

        return $this;
    }

    /**
     * @param string $column
     * @param array $values
     */
    public function whereIn($column, $values)
    {
        $this->where[$column] = $values;

        return $this;
    }

    public function orderBy($columns)
    {
        $this->order_by = array_merge($this->order_by, $columns);

        return $this;
    }

    public function get()
    {
        $rows = $this->db->get_results($this->build(), ARRAY_A);

        if ($this->class) {
            $enrollments = array_map(function ($row) {
                return new $this->class($row);
            }, $rows);

            return new Collection($enrollments);
        }

        return new Collection($rows);
    }

    public function count()
    {
        $this->select[0] = 'COUNT(*)';

        return $this->db->get_var($this->build());
    }

    public function first($columns = [])
    {
        $this->limit = '1';

        $row = $this->db->get_row($this->build(), ARRAY_A);

        if ($this->class) {
            return new $this->class($row);
        }

        if ($columns) {
            if (is_string($columns)) {
                return $row[$columns];
            }
        }

        return $row;
    }
}