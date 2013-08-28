<?php

/**
 * Creates some courses.
 *
 * @author xavier
 */
class CreateCoursesCommand extends CConsoleCommand {

    public function run($args) {
        echo 'Creating course and a few students' . PHP_EOL;

        $courses[] = array(
            'name' => 'Php 5', 
            'description' => 'Beginners guide to PHP 5 web development',
            'students' => array(
                array('first_name' => 'Bille', 'last_name' => 'Jean'),
                array('first_name' => 'Dirty', 'last_name' => 'Diana'),
            ));
        $courses[] = array('name' => 'C#', 
            'description' => 'Beginners guide to C# development',
            'students' => array(
                array('first_name' => 'Bille', 'last_name' => 'Jean'),
                array('first_name' => 'Michael', 'last_name' => 'Jackson'),
            ));

        foreach ($courses as $course) {
            $model = Course::model()->findByAttributes(array('name' => $course['name']));
            if (is_null($model)) {
                $model = new Course();
                $model->name = $course['name'];
            }
            $model->description= $course['description'];
            $students = $course['students'];
            $student_array = array();
            foreach ($students as $s) {
                $student = new Student();
                $student->first_name = $s['first_name'];
                $student->last_name = $s['last_name'];
                array_push($student_array, $student);
            }
            $model->students = $student_array;
            if ($model->save() == true) {
                echo 'Successfully created ' . $model->name . PHP_EOL;
            } else {
                echo 'Failed to create ' . $model->name . PHP_EOL;
                print_r($model->Errors);
            }
        }
    }

}

?>
