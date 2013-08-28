<script type="text/javascript">
    // initializiation of counters for new elements
    var lastStudent = 0;

    // the subviews rendered with placeholders
    var trStudent = new String(<?php echo CJSON::encode($this->renderPartial('form/_studentRow', array('id' => 'idRep', 'model' => new Student, 'form' => $form, 'this' => $this), true, false)); ?>);


    function addStudent(button)
    {
        lastStudent++;
        button.parents('table').children('tbody').append(trStudent.replace(/idRep/g, 'newRow' + lastStudent));
    }


    function deleteStudent(button)
    {
        button.parents('tr').detach();
    }

</script>

