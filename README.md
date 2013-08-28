yii-tabularinput
================

This demo shows how to use a model to save and validate related models. In this example I am using a MANY_MANY relationship.
In this demo you will find
* Validating model as a whole including its related models
* Collecting data for the model and its related models (tabular input)
* Displaying errors from the related models.
* Saving the primary model and its related models.
* natural association ( $model->students = array($studentOne, $studentTwo); ) 

Usage:
Create a MySQL schema called classroom
Run the migration to create the tables and some sample courses
<pre>
./protected/yiic migrate

./protected/yiic createCourses
</pre>
Run the site.

Details:

Validate of the Course model is done by over loading the validate method. 
This method can be used to validate the model as a whole, like prevent students with the same name.

<pre>
    public function validate($attributes = null, $clearErrors = true) {
        $isValid = parent::validate($attributes, $clearErrors);
        foreach ($this->students as $student) {
            if ($student->validate() == false) {
                $isValid = false;
                $this->addErrors($student->getErrors());
            }
        }
        return $isValid;
    }
</pre>

Next we overload the save method to save all related models.

<pre>
public function save($runValidation = true, $attributes = null) {
    if ($runValidation) {
        if ($this->validate($attributes) == false)
            return false;
    }
    foreach ($this->students as $student) {
        $student->save(false);
    }
    return parent::save(false, $attributes);
}
</pre>

Now I can create a course model and its related students.

Snip from protected/tests/unit/CourseTest.php
<pre>
    $courseName = 'testCourse';
    $studentOne = new Student();
    $studentOne->first_name = 'Firsty';
    $studentOne->last_name = 'Test';
    $studentTwo = new Student();
    $studentTwo->first_name = 'Secondy';
    $studentTwo->last_name = 'Test';

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
</pre>

EAdvancedArBehavior is used to update the relationship table.
http://www.yiiframework.com/extension/eadvancedarbehavior/

To collect tabular input of students for a course I go through the Student collection as
<pre>
if (isset($_POST['Course'])) {
    $model->attributes = $_POST['Course'];
    $model->students = CourseController::assignStudents($model, $_POST['Student']);
</pre>

CourseController::assignStudents is defined as
<pre>
    public static function assignStudents($model, $items_posted) {
        $students = array();
        foreach ($items_posted as $item_post) {
            $student = CourseController::findStudent($model, $item_post['id']);
            if (is_null($student)) {
                $student = new Student();
            }
            $student->attributes = $item_post;
            array_push($students, $student);
        }
        return $students;
    }

    public static function findStudent($model, $id) {
        $student = null;
        foreach ($model->students as $s) {
            if ($s->id == $id) {
                $student = $s;
            }
        }
        return $student;
    }
}
</pre>

I got the idea to solve the tabular input from
http://www.yiiframework.com/extension/ztabularinputmanager/
