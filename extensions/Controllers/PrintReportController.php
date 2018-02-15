<?php

namespace LmsPlugin\Controllers;

class PrintReportController extends Controller
{
    public function printReport()
    {
        $content = array_get($_POST, 'content');

        print '<style>';
        print $this->getStyles();
        print '</style>';

        echo stripcslashes($content);
        die;
    }

    private function getStyles()
    {
        $styles = file_get_contents($this->plugin->getDirectory('assets/css/dashboard.css'));
        $styles .= '.lsm-link-wrap { display: none }';

        return $styles;
    }
}