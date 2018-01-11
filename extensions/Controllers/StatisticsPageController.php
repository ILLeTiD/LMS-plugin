<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\CustomRoles;
use LmsPlugin\Models\Course;
use LmsPlugin\Models\DataSuppliers\Statistics\MostParticipantsDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\ProgressDataSupplier;
use LmsPlugin\Models\Repositories\CourseRepository;
use LmsPlugin\Models\Repositories\UserRepository;

class StatisticsPageController extends Controller
{
    public function index()
    {
        $from = date($this->plugin->date_format, strtotime('-1 month'));
        $to = date($this->plugin->date_format);

        $progress = (new ProgressDataSupplier)->getData();
        $statuses = Course::statuses();

        $courses = CourseRepository::get();
        $participants = UserRepository::get([
            'role__in' => array_keys(CustomRoles::roles()),
        ]);

        $most_participants = (new MostParticipantsDataSupplier)->getData();

        $this->view('pages.statistics.index', compact('from', 'to', 'progress', 'statuses', 'courses', 'participants', 'most_participants'));
    }
}