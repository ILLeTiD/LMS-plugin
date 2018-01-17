<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\Models\Course;
use LmsPlugin\Models\DataSuppliers\Statistics\BestCompletionDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\CoursesDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\MostHardworkingDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\MostParticipantsDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\ParticipantsDataSupplier;
use LmsPlugin\Models\DataSuppliers\Statistics\ProgressDataSupplier;
use LmsPlugin\Models\Repositories\CategoryRepository;
use LmsPlugin\Models\Repositories\CourseRepository;
use WP_Term_Query;

class StatisticsPageController extends Controller
{
    public function index()
    {
        $category = array_get($_POST, 'category');
        $from = ! empty($_POST['from']) ? $_POST['from'] : date($this->plugin->date_format, strtotime('-1 month'));
        $to = ! empty($_POST['to']) ? $_POST['to'] : date($this->plugin->date_format);

        $categories = CategoryRepository::get([
            'taxonomy' => 'course_category',
            'hide_empty' => true
        ]);

        $progress = (new ProgressDataSupplier)->period($from, $to)->category($category)->get();
        $statuses = Course::statuses();

        $courses = (new CoursesDataSupplier)->period($from, $to)->category($category)->get();
        $participants = (new ParticipantsDataSupplier)->period($from, $to)->category($category)->get();

        $most_participants = (new MostParticipantsDataSupplier)->period($from, $to)->category($category)->get();
        $best_completion = (new BestCompletionDataSupplier)->period($from, $to)->category($category)->get();
        $users = (new MostHardworkingDataSupplier)->period($from, $to)->category($category)->get();

        $this->view('pages.statistics.index', compact(
            'category',
            'from',
            'to',
            'progress',
            'statuses',
            'courses',
            'participants',
            'most_participants',
            'best_completion',
            'users',
            'categories'
        ));
    }
}