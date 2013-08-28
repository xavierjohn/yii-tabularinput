<?php

class CourseTest extends CTestCase {

    public function testEAdvancedArBehavior() {



        $courseName = 'testCourse';
        $studentOne = new Student();
        $studentOne->first_name = 'Firsty';
        $studentOne->last_name = 'Test';
        $studentTwo = new Student();
        $studentTwo->first_name = 'Secondy';
        $studentTwo->last_name = 'Test';

        Course::model()->deleteAllByAttributes(array('name' => $courseName));

        $model = new Course();
        $model->name = $courseName;
        $model->description = 'This course was created for testing purpose';
        $model->students = array($studentOne, $studentTwo);
        if ($model->save() == true) {
            echo 'Successfully created ' . $model->name . PHP_EOL;
        } else {
            echo 'Failed to create ' . $model->name . PHP_EOL;
            print_r($model->Errors);
        }

        $model = Course::model()->with('students')->findByAttributes(array('name' => $courseName));
        $this->assertCount(2, $model->students);

        // Verify removing studentTwo
        $model->students = array($studentOne);
        if ($model->save() == true) {
            echo 'Successfully created ' . $model->name . PHP_EOL;
        } else {
            echo 'Failed to create ' . $model->name . PHP_EOL;
            print_r($model->Errors);
        }
        $model = Course::model()->with('students')->findByAttributes(array('name' => $courseName));
        $this->assertCount(1, $model->students);
    }

}
