<?php
	//Zend_Loader::loadClass('Kutu_Core_Orm_Table_Catalog');
	//$tblCatalog = new Kutu_Core_Orm_Table_Catalog();
?>
<?php if($numberOfFolders == 0){?>
	No Sub-Folder(s)
<?php }?>
<table width="100%"  border="0" cellspacing="6" cellpadding="6" bgcolor="">
    <?php 
    for($i = 0; $i < $rows; $i++) 
		{
    ?>
	  <tr valign="top">
	  <?php
	  for($j = 0; $j < $columns; $j++) {
	  	if(isset($data[$i + ($j * $rows)][2]))
	  	{
	  ?>
	  		<?php 
	  			//$countCatinFol = $tblCatalog->countCatalogsInFolderAndChildren($this->data[$i + ($j * $this->rows)][2]);
	  		?>
		    <td width="30" valign="top"><a href="<?php echo '/site/dms/index/node/'.$data[$i + ($j * $rows)][2];?>"><IMG src="<?php echo '/common/images/folder1b.png' ?>" border="0" /></a></td>
		    <td width="250" valign="top">
		    	<a class="folderTitleLink" href="<?php echo '/site/dms/index/node/'.$data[$i + ($j * $rows)][2];?>"><?php echo $data[$i + ($j * $rows)][0];?><span style="font-size:12px;"><patTemplate:var name="CATEGORYTITLE" default=""/></span></a><!-- &nbsp;(<?php //echo $countCatinFol;?>) -->
		    	<br>
		    	<patTemplate:var name="DESCRIPTION" default=""/>
		    </td>	    
		    <td width="10">&nbsp;</td>
		    <td width="">&nbsp;</td>
		<?php }} ?>
	  </tr>
	<?php } ?>
</table>
<div class="borderBottom">&nbsp;</div>
<div style="padding-top:1px"></div>
<script>

</script>