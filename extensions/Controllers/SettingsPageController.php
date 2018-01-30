<?php

namespace LmsPlugin\Controllers;

class SettingsPageController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['settings'])) {
            $this->save($_POST['settings']);
        }

        $settings = $this->plugin->getSettings();

        $this->view('pages.settings.index', compact('settings'));
    }

    private function save($settings)
    {
        $this->plugin->setSettings($settings);
    }
}