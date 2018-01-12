<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class MostHardworkingDataSupplier
{
    public static function getData()
    {
        global $wpdb;

        $sql = <<<SQL
            SELECT user.ID AS id, user.display_name AS name, COUNT(*) AS number
            FROM {$wpdb->usermeta}
            INNER JOIN {$wpdb->users} user
                ON user.ID = user_id
            WHERE meta_key LIKE 'status_%'
                AND meta_value = 'completed'
            GROUP BY user_id
            ORDER BY number DESC;
SQL;

        $results = $wpdb->get_results($sql);

        return new Collection($results);
    }
}