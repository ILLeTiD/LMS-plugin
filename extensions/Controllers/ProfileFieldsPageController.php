<?php

namespace LmsPlugin\Controllers;

use FishyMinds\WordPress\Plugin\Plugin;
use LmsPlugin\ProfileFieldsManager;

class ProfileFieldsPageController extends Controller
{
    private $fields_manager;

    public function __construct(Plugin $plugin)
    {
        $this->fields_manager = new ProfileFieldsManager($plugin);

        parent::__construct($plugin);
    }

    public function create()
    {
        $this->view('pages.profile_fields.create');
    }

    public function store()
    {
        $field = array_only($_POST, [
            'name',
            'description',
            'required',
            'type',
            'options',
            'default_option'
        ]);

        $id = $this->fields_manager->add($field);
        $this->fields_manager->save();

        $_SESSION['messages'] = [
            'success' => __('Profile field saved.', 'lms-plugin')
        ];

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $id)
        );
    }

    public function edit()
    {
        $id = array_get($_GET, 'id');
        $field = $this->fields_manager->get($id);

        $this->view('pages.profile_fields.edit', compact('id', 'field'));
    }

    public function update()
    {
        $id = array_get($_POST, 'id');
        $field = array_only($_POST, [
            'name',
            'description',
            'required',
            'type',
            'options',
            'default_option'
        ]);

        $this->fields_manager->update($id, $field);
        $this->fields_manager->save();

        $_SESSION['messages'] = [
            'success' => __('Profile field saved.', 'lms-plugin')
        ];

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $id)
        );
    }

    public function delete()
    {
        $id = array_get($_GET, 'id');

        $this->fields_manager->delete($id);
        $this->fields_manager->save();

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=settings')
        );
    }

    public function addOption()
    {
        $i = array_get($_GET, 'id', 0);

        $this->view('pages.profile_fields.components.option', compact('i'));
        die;
    }
}

