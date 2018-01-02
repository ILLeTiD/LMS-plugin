<?php

namespace LmsPlugin\Models;

use WP_User_Query;

class Role
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function users()
    {
        $query = new WP_User_Query([
            'role__in' => $this->name,
            'fields' => 'ID'
        ]);

        return $query->results;
    }
}