<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class ProgressDataSupplier
{
    use Filter;

    public function get()
    {
        global $wpdb;

        $where = $this->where();

        $sql = <<<SQL
            SELECT status, COUNT(*) as number
            FROM {$wpdb->prefix}lms_enrollments
            WHERE {$where}
            GROUP BY status;
SQL;

        $results = $wpdb->get_results($sql, OBJECT_K);

        $total = array_reduce($results, function ($sum, $item) {
            return $sum + $item->number;
        });

        foreach ($results as $item) {
            $item->percent = $this->calculatePercent($item->number, $total);
        }

        return new Collection($results);
    }

    private function calculatePercent($number, $total)
    {
        return round(100 / $total * $number);
    }
}