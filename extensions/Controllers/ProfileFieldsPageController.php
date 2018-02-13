<?php

namespace LmsPlugin\Controllers;

class ProfileFieldsPageController extends Controller
{
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

        $fields = $this->plugin->getOption('profile_fields');

        $field['slug'] = kebab_case($field['name']);

        $fields[] = $field;

        $this->plugin->setOption('profile_fields', $fields);

        $id = count($fields) - 1;

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $id)
        );
    }

    public function edit()
    {
        $id = array_get($_GET, 'id');

        $fields = $this->plugin->getOption('profile_fields');

        $field = array_get($fields, $id);

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

        $fields = $this->plugin->getOption('profile_fields');

        $field['slug'] = kebab_case($field['name']);

        $fields[$id] = $field;

        $this->plugin->setOption('profile_fields', $fields);

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $id)
        );
    }

    public function delete()
    {
        $id = array_get($_GET, 'id');

        $fields = $this->plugin->getOption('profile_fields');

        array_splice($fields, $id, 1);

        $this->plugin->setOption('profile_fields', $fields);

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

