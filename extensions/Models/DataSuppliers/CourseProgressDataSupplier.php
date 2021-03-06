<?php

namespace LmsPlugin\Models\DataSuppliers;

class CourseProgressDataSupplier
{
    private $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function getData()
    {
        $participants = $this->course->enrollments()->count();

        if (! $participants) {
            return [];
        }

        $statuses = $this->getNumberParticipantsByStatus();

        foreach ($statuses as &$status) {
            $status['percent'] = round(100 / $participants * $status['number']);
        }

        return $statuses;
    }

    private function getNumberParticipantsByStatus()
    {
        global $wpdb;

        $sql = <<<SQL
            SELECT status, COUNT(*) AS number
            FROM {$wpdb->prefix}lms_enrollments
            WHERE course_id = %d
            GROUP BY status;
SQL;

        $sql = $wpdb->prepare($sql, $this->course->id);

        return $wpdb->get_results($sql, ARRAY_A);
    }
}