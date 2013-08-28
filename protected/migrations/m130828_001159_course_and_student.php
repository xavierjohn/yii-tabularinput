<?php

class m130828_001159_course_and_student extends CDbMigration {

    public function up() {
        $this->createTable('course', array(
            'id' => 'pk',
            'name' => 'VARCHAR(100) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
                ), 'ENGINE=InnoDB');

        $this->createTable('student', array(
            'id' => 'pk',
            'first_name' => 'VARCHAR(100) NOT NULL',
            'last_name' => 'VARCHAR(100) NOT NULL',
                ), 'ENGINE=InnoDB');

        $this->createTable('course_student', array(
            'course_id' => 'INT NOT NULL',
            'student_id' => 'INT NOT NULL',
            'PRIMARY KEY (`course_id`,`student_id`)',
                ), 'ENGINE=InnoDB');
        $this->addForeignKey("fk_cs_course", "course_student", "course_id", "course", "id", "CASCADE", "RESTRICT");
        $this->addForeignKey("fk_cs_student", "course_student", "student_id", "student", "id", "CASCADE", "RESTRICT");
    }

    public function down() {
        $this->dropTable('course_student');
        $this->dropTable('student');
        $this->dropTable('course');
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}