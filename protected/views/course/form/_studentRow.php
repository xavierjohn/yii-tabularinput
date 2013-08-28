<?php
/* @var $id int */
/* @var $model Student */
/* @var $form CActiveForm */
/* @var $this ApplicationController */
?>

<tr>
    <?php
        echo $form->hiddenField($model, "[$id]id");
    ?>
    <td>
        <?php echo $form->textField($model, "[$id]first_name"); ?>
    </td>
    <td>
        <?php echo $form->textField($model, "[$id]last_name"); ?>
    </td>
    <td>
        <?php echo CHtml::link('Delete', '#', array('onClick' => 'deleteStudent($(this));return false;')); ?>
    </td>
</tr>

