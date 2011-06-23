<?php
class NewsSlider extends CWidget 
{
	public function init()
	{
		
	}
    public function run() 
	{
		Yii::import('application.extensions.hole.cms.*');
		$manager = new HoleCatalogManager();
		$helper = new HoleCmsHelper();
		
		$catalogRows = $manager->getCatalogInFolder('lt481074ef14e7a',0,3);
		//var_dump($catalogRows);die;
		$catalogDetails = array();
		$i=0;
		foreach ($catalogRows as $catalog) {
			$catalogDetails[$i]['catalog'] = $catalog;
			$catalogDetails[$i]['details'] = $manager->getCatalogDetails($catalog['guid']);
			$catalogDetails[$i]['image'] = $helper->getImageFromHtml($catalogDetails[$i]['details']['fixedContent']);
			$i++;
		}
		
		
		
		//var_dump($catalogDetails);die;
		
		$this->render('newsslider', array('catalogs'=>$catalogDetails));
    }
}
?>