<?php

namespace LmsPlugin\Models\DataSuppliers\Statistics;

use FishyMinds\Collection;

class ProgressDataSupplier
{
    private $from;
    private $to;

    public function period($from, $to)
    {
        $this->from = $from;
        $this->to = $to;

        return $this;
    }

    public function getData()
    {
        global $wpdb;

        $where = '1 = 1';
        $where .= $this->from ? " AND updated_at >= '{$this->from}'" : '';
        $where .= $this->to ? " AND updated_at <= '{$this->to}'" : '';

        $sql = <<<SQL
            SELECT status, COUNT(*) as number
            FROM {$wpdb->prefix}lms_enrollments
            WHERE {$where}
            GROUP BY status;
SQL;

        d($sql);

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