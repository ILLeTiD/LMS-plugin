<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class MostParticipantsDataSupplier
{
    public function getData()
    {
        global $wpdb;

        $sql = <<<SQL
            SELECT course.ID AS id, course.post_title AS name, COUNT(*) AS participants
            FROM {$wpdb->prefix}lms_enrollments
            LEFT JOIN {$wpdb->posts} course
                ON course.ID = course_id
            GROUP BY status
            ORDER BY participants DESC;
SQL;

        $results = $wpdb->get_results($sql);

        return new Collection($results);
    }
}