<?php
/* @var $this CourseController */
/* @var $model Course */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery'); 
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'course-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <table >
        <thead>
            <tr>
                <td>
                    First Name
                </td>
                <td>
                    Last Name
                </td>
                <td>
                    <?php echo CHtml::link('Add', '', array('onClick' => 'addStudent($(this))')); ?>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model->students as $id => $student) {
                $this->renderPartial('form/_studentRow', array('id' => $id, 'model' => $student, 'form' => $form, 'this' => $this), false, true);
            }
            ?>
        </tbody>
    </table>

    <div class="row buttons">
        <?php $this->renderPartial('form/_studentJs', array( 'form' => $form, 'this' => $this),false,true); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->