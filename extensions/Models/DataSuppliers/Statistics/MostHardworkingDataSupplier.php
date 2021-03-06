<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class MostHardworkingDataSupplier
{
    use Filter;

    public function get()
    {
        global $wpdb;

        $where = $this->where();

        $sql = <<<SQL
            SELECT user.ID AS id, user.display_name AS name, COUNT(*) AS number
            FROM {$wpdb->prefix}lms_enrollments
            INNER JOIN {$wpdb->users} user
                ON user.ID = user_id
            WHERE {$where} 
                AND status = 'completed'
            GROUP BY user_id
            ORDER BY number DESC;
SQL;

        $results = $wpdb->get_results($sql);

        return new Collection($results);
    }
}