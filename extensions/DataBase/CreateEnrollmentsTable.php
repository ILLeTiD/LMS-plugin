<?php

namespace LmsPlugin\DataBase;

class CreateEnrollmentsTable extends CreateTable
{
    const TABLE = 'lms_enrollments';

    public function up()
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS {$this->table} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT NOT NULL,
              status ENUM('invited', 'in_progress', 'completed', 'failed') NOT NULL DEFAULT 'invited',
              grade TINYINT UNSIGNED,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
              updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) {$this->charset_collate};
SQL;

        $this->db->query($sql);
    }
}