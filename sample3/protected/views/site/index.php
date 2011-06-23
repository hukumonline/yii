<?php $this->pageTitle=Yii::app()->name; ?>

<h1>WelcomeII to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<?php /*$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); */?>

<?php /*$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider2,
    'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); */?>

<p>View Folder</p>
<?php $this->widget('application.components.LatestCatalog');?>

<p>UTAMA</p>
<?php $this->widget('application.components.LatestCatalog', array(
	'folderGuid' => 'lt4aaa29322bdbb',
	'limit' => 5
)); ?>
<p>&nbsp;</p>
<p>ISU HANGAT</p>
<?php $this->widget('application.components.LatestCatalog', array(
	'folderGuid' => 'lt4a6f7d5377193',
	'limit' => 5
)); ?>

<p>&nbsp;</p>
<p>KOLOM</p>
<?php $this->widget('application.components.LatestCatalog', array(
	'folderGuid' => 'fb7',
	'limit' => 5
)); ?>

<p>&nbsp;</p>
<p>TOKOH</p>
<?php $this->widget('application.components.LatestCatalog', array(
	'folderGuid' => 'fb12',
	'limit' => 5
)); ?>

<p>&nbsp;</p>
<p>RESENSI</p>
<?php $this->widget('application.components.LatestCatalog', array(
	'folderGuid' => 'fb17',
	'limit' => 5
)); ?>