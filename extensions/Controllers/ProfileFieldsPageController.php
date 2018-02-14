<?php

namespace LmsPlugin\Controllers;

use FishyMinds\WordPress\Plugin\Plugin;
use LmsPlugin\Profile;

class ProfileFieldsPageController extends Controller
{
    private $profile;

    public function __construct(Plugin $plugin)
    {
        $this->profile = new Profile($plugin);

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
            'options'
        ]);

        $id = $this->profile->addField($field);
        $this->profile->save();

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $id)
        );
    }

    public function edit()
    {
        $id = array_get($_GET, 'id');
        $field = $this->profile->getField($id);

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
            'options'
        ]);

        $this->profile->updateField($id, $field);
        $this->profile->save();

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $id)
        );
    }

    public function delete()
    {
        $id = array_get($_GET, 'id');

        $this->profile->deleteField($id);
        $this->profile->save();

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

