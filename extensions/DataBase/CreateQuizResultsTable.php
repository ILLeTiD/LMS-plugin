<?php

namespace LmsPlugin\DataBase;

class CreateQuizResultsTable
{
    public function up()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'lms_quiz_results';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS {$table_name} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT NOT NULL,
              slide_id BIGINT NOT NULL,
              results LONGTEXT,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
              updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) {$charset_collate};
SQL;

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}