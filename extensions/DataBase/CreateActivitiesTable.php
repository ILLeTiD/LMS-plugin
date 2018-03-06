<?php

namespace LmsPlugin\DataBase;

class CreateActivitiesTable extends CreateTable
{
    const TABLE = 'lms_activities';

    public function up()
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS {$this->table} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT,
              type ENUM('course', 'account') NOT NULL DEFAULT 'account',
              name VARCHAR(255) NOT NULL,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) {$this->charset_collate};
SQL;

        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS {$this->table}";

        $this->db->query($sql);
    }
}