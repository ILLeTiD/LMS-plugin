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
            $conditions = array_map(function ($condition) {
                if (is_string($condition['value'])) {
                    return sprintf("%s %s '%s'", $condition['column'], $condition['operator'], $condition['value']);
                }

                if (is_array($condition['value'])) {
                    $set = array_map(function ($item) {
                        return is_int($item) ? $item : "'{$item}'";
                    }, $condition['value']);

                    return sprintf('%s IN (%s)', $condition['column'], implode(', ', $set));
                }

                return sprintf('%s %s %s', $condition['column'], $condition['operator'], $condition['value']);

            }, $this->where);

            $query .= ' WHERE ' . implode(' AND ', $conditions);
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

        // d($query);

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

    /**
     * Add where condition.
     *
     * @param string|array $column
     * @param null|int|string $operator
     * @param null|int|string $value
     *
     * @return $this|\FishyMinds\QueryBuilder
     */
    public function where($column, $operator = null, $value = null)
    {
        if (is_array($column)) {
            foreach ($column as $name => $value) {
                $this->where($name, '=', $value);
            }

            return $this;
        }

        if (is_null($value)) {
            $value = $operator;
            $operator = '=';
        }

        $condition = compact('column', 'operator', 'value');

        if ( ! empty($value)) {
            $this->where[] = $condition;
        }

        return $this;
    }

    /**
     * @param string $column
     * @param array $values
     */
    public function whereIn($column, $values)
    {
        $condition = [
            'column' => $column,
            'operator' => 'IN',
            'value' => $values
        ];

        $this->where[] = $condition;

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