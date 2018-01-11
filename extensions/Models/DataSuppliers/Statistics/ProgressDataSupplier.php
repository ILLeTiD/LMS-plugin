<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class ProgressDataSupplier
{
    public function getData()
    {
        global $wpdb;

        $sql = <<<SQL
            SELECT meta_value AS status, COUNT(*) as number
            FROM {$wpdb->usermeta}
            WHERE meta_key LIKE 'status_%'
            GROUP BY meta_value;
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