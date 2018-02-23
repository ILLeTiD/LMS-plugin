<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\UsersListTable;

class UsersPageController extends Controller
{
    public function index()
    {
        // d($this->request->get('filter'));
        $table = new UsersListTable();

        $this->view('pages.users.index', compact('table'));
    }
}