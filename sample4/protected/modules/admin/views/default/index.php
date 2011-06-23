<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>" in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>

TEST LOADING BAR...
<?php 
 echo CHtml::form();
 echo CHtml::ajaxButton (
   'DoAjaxRequest', //label
    $this->createUrl('testajax'), // url for request
    array (
    'beforeSend' => 'function(){ $("#message_box").show();}',
    'complete' => 'function(data, status){
      $("#message_box").hide(); alert(data.responseText);}',
    )
 );
 echo CHtml::endForm();?>