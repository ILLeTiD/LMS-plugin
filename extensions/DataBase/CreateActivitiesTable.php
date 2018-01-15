<?php

namespace LmsPlugin\DataBase;

class CreateActivitiesTable
{
    public function up()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'lms_activities';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS {$table_name} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT NOT NULL,
              slide_id BIGINT,
              name VARCHAR(255) NOT NULL,
              description VARCHAR(255),
              date DATETIME DEFAULT CURRENT_TIMESTAMP
            ) {$charset_collate};
SQL;

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}