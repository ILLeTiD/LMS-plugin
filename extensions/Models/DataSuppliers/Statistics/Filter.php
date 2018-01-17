<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use LmsPlugin\Models\Repositories\CourseRepository;

trait Filter
{
    private $from;
    private $to;
    private $category;

    public function period($from, $to)
    {
        $this->from = $from;
        $this->to = $to;

        return $this;
    }

    public function category($name)
    {
        $this->category = $name;

        return $this;
    }

    private function where()
    {
        $where = '1 = 1';
        $where .= $this->from ? " AND updated_at >= '{$this->from}'" : '';
        $where .= $this->to ? " AND updated_at <= ADDDATE('{$this->to}', 1)" : '';

        // Filter by category.
        if ($this->category) {
            $courses = CourseRepository::get([
                'tax_query' => [[
                    'taxonomy' => 'course_category',
                    'terms' => $this->category
                ]]
            ]);

            if (! $courses->count()) {
                return new Collection([]);
            }

            $where .= sprintf(" AND course_id IN (%s)", $courses->join(', '));
        }

        return $where;
    }
}