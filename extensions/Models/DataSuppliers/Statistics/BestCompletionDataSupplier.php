<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class BestCompletionDataSupplier
{
    public static function getData()
    {
        global $wpdb;

        $sql = <<<SQL
            SELECT course.ID AS id, course.post_title AS name, meta_value AS grade
            FROM {$wpdb->usermeta}
            LEFT JOIN {$wpdb->posts} course
                ON course.ID = SUBSTRING_INDEX(meta_key, '_', -1)
            WHERE meta_key LIKE 'grade_%'
            GROUP BY meta_key
            ORDER BY grade DESC;
SQL;

        $results = $wpdb->get_results($sql);

        return new Collection($results);
    }
}