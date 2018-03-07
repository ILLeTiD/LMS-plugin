<?php

namespace LmsPlugin\Controllers;

use FishyMinds\View;
use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\CustomRoles;
use LmsPlugin\EnrollmentFactory;
use LmsPlugin\Models\Course;
use LmsPlugin\Models\Enrollment;
use LmsPlugin\Models\Repositories\CategoryRepository;
use LmsPlugin\Models\Repositories\UserRepository;
use LmsPlugin\Models\Role;
use LmsPlugin\Models\User;
use WP_Post;
use WP_User_Query;

class ParticipantsPageController extends Controller
{
    public function all()
    {
        $search = array_get($_GET, 's');
        $role = array_get($_GET, 'role');
        $from = array_get($_GET, 'from');
        $to = array_get($_GET, 'to');

        $roles = wp_roles()->role_names;

        $arguments = [
            // 'role__in' => array_keys(CustomRoles::roles())
            'role__not_in' => ['administrator']
        ];

        if ($search) {
            $arguments['search'] = '*' . $search . '*';
        }

        if ($role) {
            $arguments['role'] = $role;
        }

        if ($from || $to) {
            $meta_query = [];

            if ($from && $to) {
                $meta_query['relation'] = 'AND';
            }

            if ($from) {
                $meta_query[] = [
                    'key' => 'last_activity',
                    'value' => strtotime($from),
                    'compare' => '>=',
                    'type' => 'UNSIGNED'
                ];
            }

            if ($to) {
                $meta_query[] = [
                    'key' => 'last_activity',
                    'value' => strtotime($to) + (3600 * 24),
                    'compare' => '<=',
                    'type' => 'UNSIGNED'
                ];
            }

            $arguments['meta_query'] = $meta_query;
        }

        $users = UserRepository::get($arguments);

        $this->view('pages.participants.all', compact(
            'categories',
            'search',
            'roles',
            'users',
            'from',
            'role',
            'to'
        ));
    }

    public function course()
    {
        add_thickbox();

        $cid = array_get($_GET, 'cid');
        $status = array_get($_GET, 'status');
        $search = array_get($_GET, 's');
        $role = array_get($_GET, 'role');
        $from = array_get($_GET, 'from');
        $to = array_get($_GET, 'to');

        $course = Course::find($cid);
        $roles = wp_roles()->role_names;

        $arguments = [
            'role__in' => array_keys(CustomRoles::roles()),
        ];

        if ($search) {
            $arguments['search'] = '*' . $search . '*';
        }

        if ($role) {
            $arguments['role'] = $role;
        }

        $user_ids = UserRepository::get($arguments)->pluck('id');

        $participants = $course->enrollments()
            ->whereIn('user_id', $user_ids)
            ->where('status', $status)
            ->where('created_at', '>=', $from)
            ->where('created_at', '<', empty($to) ? $to : date(get_option('date_format'), strtotime($to) + 3600 * 24))
            ->get();

        $statuses = [
            'invited' => __('Invited', 'lms-plugin'),
            'in_progress' => __('In progress', 'lms-plugin'),
            'completed' => __('Completed', 'lms-plugin'),
            'failed' => __('Failed', 'lms-plugin'),
        ];

        $this->view(
            'pages.participants.course',
            compact(
                'participants',
                'statuses',
                'course',
                'search',
                'status',
                'roles',
                'from',
                'role',
                'to'
            )
        );
    }

    public function inviteByRoleName()
    {
        $course = array_get($_POST, 'course');
        $role = new Role(array_get($_POST, 'roles'));

        $users = $role->users();

        $this->enrollUsers($course, $users);

        die;
    }

    public function inviteByUserId()
    {
        $course = array_get($_REQUEST, 'course');
        $users = array_get($_REQUEST, 'users');

        $this->enrollUsers($course, $users);

        die;
    }

    public function search()
    {
        $search = sprintf('*%s*', $_POST['search'] ?: '');

        $users = new WP_User_Query([
            // 'role__in' => ['backoffice', 'technicians', 'sales'],
            'search' => $search,
        ]);

        if ($users->total_users) {
            $this->view('pages.participants.users', compact('users'));
        }

        die;
    }

    private function enrollUsers($course, $users)
    {
        $factory = new EnrollmentFactory;
        $enrollments = $factory->create($course, $users);

        foreach ($enrollments as $enrollment) {
            $enrollment->save();
            do_action('lms_event_user_activity', $enrollment->user->id, 'course', 'invited', $enrollment->course->id);
        }
    }
}