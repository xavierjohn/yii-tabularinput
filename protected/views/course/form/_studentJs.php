<?php

Yii::app()->clientScript->registerScript('studentRow', "var lastStudent = 0;
    var trStudent = new String(" .
        CJSON::encode($this->renderPartial('form/_studentRow', array('id' => 'idRep', 'model' => new Student, 'form' => $form, 'this' => $this), true, false)) .
        ");
    function addStudent(button)
    {
        lastStudent++;
        button.parents('table').children('tbody').append(trStudent.replace(/idRep/g, 'newRow' + lastStudent));
    }


    function deleteStudent(button)
    {
        button.parents('tr').detach();
    }
");
?>

