<?php

namespace LmsPlugin\DataBase;

class CreateQuizResultsTable extends CreateTable
{
    const TABLE = 'lms_quiz_results';

    public function up()
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS {$this->table} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT NOT NULL,
              slide_id BIGINT NOT NULL,
              results LONGTEXT,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
              updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) {$this->charset_collate};
SQL;

        $this->db->query($sql);
    }
}