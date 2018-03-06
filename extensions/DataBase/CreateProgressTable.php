<?php

namespace LmsPlugin\DataBase;

class CreateProgressTable extends CreateTable
{
    const TABLE = 'lms_progress';

    public function up()
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS {$this->table} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT NOT NULL,
              slide_id BIGINT,
              name VARCHAR(255) NOT NULL,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) {$this->charset_collate};
SQL;

        $this->db->query($sql);
    }
}