<?php

namespace LmsPlugin\Controllers;

use DateInterval;
use DatePeriod;
use DateTime;
use LmsPlugin\CustomRoles;
use LmsPlugin\Models\Course;
use LmsPlugin\Models\DataSuppliers\Statistics\BestCompletionDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\MostHardworkingDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\MostParticipantsDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\ProgressDataSupplier;
use LmsPlugin\Models\Enrollment;
use LmsPlugin\Models\Repositories\CategoryRepository;
use LmsPlugin\Models\Repositories\CourseRepository;
use LmsPlugin\Models\Repositories\UserRepository;
use WP_Term_Query;

class StatisticsPageController extends Controller
{
    public function index()
    {
        $filter['category'] = array_get($_POST, 'category');

        $from = array_get($_POST, 'from', date('Y-m-d H:i:s', strtotime('-1 month')));
        $to = ! empty($_POST['to']) ? $_POST['to'] : date('Y-m-d H:i:s');

        $dateFilter = $this->dateFilter();

        $categories = CategoryRepository::get([
            'taxonomy' => 'course_category',
            'hide_empty' => true
        ]);

        $progress = (new ProgressDataSupplier)->period($from, $to)->getData();
        $statuses = Course::statuses();

        if ($filter['category']) {
            $courses = CourseRepository::get([
                'tax_query' => [[
                    'taxonomy' => 'course_category',
                    'terms' => $filter['category']
                ]]
            ]);
        } else {
            $courses = CourseRepository::get();
        }

        $participants = UserRepository::get([
            'role__in' => array_keys(CustomRoles::roles()),
        ]);

        $most_participants = (new MostParticipantsDataSupplier)->getData();
        $best_completion = BestCompletionDataSupplier::getData();
        $users = MostHardworkingDataSupplier::getData();

        $this->view('pages.statistics.index', compact(
            'filter',
            'from',
            'to',
            'progress',
            'statuses',
            'courses',
            'participants',
            'most_participants',
            'best_completion',
            'users',
            'categories',
            'dateFilter'
        ));
    }

    private function dateFilter()
    {
        $earliest = Enrollment::select('created_at')->orderBy(['updated_at' => 'DESC'])->first('created_at');

        $begin = new DateTime($earliest);
        $begin->modify('first day of this month');
        $end = new DateTime();
        $interval = new DateInterval('P1M');

        return new DatePeriod($begin, $interval ,$end);
    }
}