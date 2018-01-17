<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

class ParticipantsDataSupplier
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
                GROUP BY user_id
            ) u;
SQL;

        return $wpdb->get_var($sql);
    }
}