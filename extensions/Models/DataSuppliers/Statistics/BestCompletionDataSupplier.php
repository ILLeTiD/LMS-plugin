<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class BestCompletionDataSupplier
{
    use Filter;

    public function get()
    {
        global $wpdb;

        $where = $this->where();

        $sql = <<<SQL
            SELECT course.ID AS id, course.post_title AS name, MAX(IFNULL(grade, 0)) AS grade
            FROM {$wpdb->prefix}lms_enrollments
            LEFT JOIN {$wpdb->posts} course
                ON course.ID = course_id
            WHERE {$where}
            GROUP BY course_id
            ORDER BY grade DESC;
SQL;

        $results = $wpdb->get_results($sql);

        return new Collection($results);
    }
}