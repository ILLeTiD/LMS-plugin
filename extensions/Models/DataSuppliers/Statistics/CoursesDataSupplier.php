<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

class CoursesDataSupplier
{
    use Filter;

    public function get()
    {
        global $wpdb;

        $where = $this->where();

        $sql = <<<SQL
            SELECT COUNT(*)
            FROM (
                SELECT COUNT(*)
                FROM {$wpdb->prefix}lms_enrollments
                WHERE {$where}
                GROUP BY course_id
            ) c;
SQL;

        return $wpdb->get_var($sql);
    }
}