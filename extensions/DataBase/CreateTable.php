<?php

namespace LmsPlugin\DataBase;

abstract class CreateTable
{
    protected $db;
    protected $table;
    protected $charset_collate;

    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;
        $this->table = $wpdb->prefix . static::TABLE;
        $this->charset_collate = $wpdb->get_charset_collate();
    }

}