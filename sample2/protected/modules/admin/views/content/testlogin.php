<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>true,
)); ?>
 
    <?php echo $form->errorSummary($model); ?>

	<div class="row">
	    <?php echo $form->labelEx($model,'username'); ?>
	    <?php echo $form->textField($model,'username'); ?>
	    <?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
	    <?php echo $form->labelEx($model,'password'); ?>
	    <?php echo $form->textField($model,'password'); ?>
	    <?php echo $form->error($model,'password'); ?>
	</div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->