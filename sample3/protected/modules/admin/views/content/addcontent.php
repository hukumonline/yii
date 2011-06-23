<h1>Add Content</h1>
 
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'catalog-form',
    'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateonsubmit'=>false, 'validateonchange'=>true),
)); ?>
 	
    <?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'datePublished'); ?>
	<?php
		$this->widget('application.extensions.my97DatePicker.JMy97DatePicker', array(
		    'model' => $model,
		    'attribute' => 'datePublished',
		    'options' => array('dateFmt' => 'yyyy-MM-dd'),
		    'htmlOptions' => array('value' => $model->datePublished),
		));
	?>
	</div>
 
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array('0'=>'draft','99'=>'Pubished','1'=>'Under Review'),array('options'=>array('99'=>array('selected'=>true)))); ?>
		<?php //echo $form->error($model,'status'); ?>
    </div>
 
	<div class="row">
        <?php echo $form->labelEx($model,'profileId'); ?>
		<?php echo $model->profileId;?>
        <?php echo $form->hiddenField($model,'profileId') ?>
		<?php //echo $form->error($model,'shortTitle'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model,'folderId'); ?>
        <?php echo $form->textField($model,'folderId') ?>
		<?php //echo $form->error($model,'shortTitle'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'shortTitle'); ?>
        <?php echo $form->textField($model,'shortTitle') ?>
		<?php //echo $form->error($model,'shortTitle'); ?>
    </div>

	<?php foreach($model->getCatalogAttributes() as $attribute){?>
		<div class="row">
	        <?php echo $form->label($model,$attribute['name']); ?>
	        <?php 
				switch ($attribute['type'])
				{
					case 'text':
						echo $form->textField($model,$attribute['name'],array('size'=>50));
						break;
					case 'editor' :
						$this->widget('application.extensions.ckeditor.CKEditor', array('model'=>$model, 'attribute'=>$attribute['name'], 'language'=>'en','editorTemplate'=>'full'));
						echo '<br>';
						break;
					case 'textarea':
						echo $form->textArea($model,$attribute['name'],array('style'=>"width:500px"));
						break;
					case 'tag':
						echo $form->textField($model,$attribute['name'], array('size'=>50));
						echo "<br> Please separate the tag with ; or ,<br>&nbsp;";
						break;
					default:
						echo $form->textField($model,$attribute['name']);
						break;
				}
				if($attribute['name']=='title')
					echo $form->error($model,'title');
				
			?>
	    </div>
	<?}?>
	
	
    <div class="row submit">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>
		
 
<?php $this->endWidget(); ?>
</div><!-- form -->
