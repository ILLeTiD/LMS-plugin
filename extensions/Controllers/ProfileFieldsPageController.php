<?php

namespace LmsPlugin\Controllers;

class ProfileFieldsPageController extends Controller
{
    public function create()
    {
        $this->view('pages.profile_fields.create');
    }

    public function edit()
    {
        $id = array_get($_GET, 'id');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (is_null($id)) {
                $id = $this->store($_POST);
            } else {
                $this->update($id, $_POST);
            }
        }

        $fields = $this->plugin->getOption('profile_fields');

        $field = array_get($fields, $id);

        $this->view('pages.profile_fields.edit', compact('id', 'field'));
    }

    public function store($data)
    {
        $fields = $this->plugin->getOption('profile_fields');

        $fields[] = $data;

        $this->plugin->setOption('profile_fields', $fields);

        return count($fields) - 1;
    }

    public function update($id, $data)
    {
        $fields = $this->plugin->getOption('profile_fields');

        $fields[$id] = $data;

        $this->plugin->setOption('profile_fields', $fields);
    }
}

