<?php
class HoleCmsHelper
{
	public function getStringRelatedFolders($folderGuid)
	{
		$aFolders = '';
		switch ($folderGuid)
		{
			case 'ild':
													// executive_summary, ild
				$aFolders = "('lt47fdd0a5e59a6','lt47f05cdbe170a')";
				
			break;
			case 'ilb':
													// executive_alert, ilb
				$aFolders = "('lt47fdd15979d91','lt4827d822559d1','lt4827d6831ccfb','lt4827d5f970fd6','lt4827d6eccfd96','lt4827d78f06fe0','lt4827d87d9c690')";
				
			break;
			case 'hot_issue_ild':
													// hot_issue_ild
				$aFolders = "('lt47f066d2f122d')";
				
			break;
			case 'hot_issue_ilb':
													// hot_issue_ilb
				$aFolders = "('lt47f0675927df5')";
				
			break;
			case 'hot_news':
													// hot_news
				$aFolders = "('lt4810069ce5b5b')";
				
			break;
			case 'news':
													// news
				$aFolders = "('lt481005fa41f52')";
				
			break;
			case 'ile':
				
				$aFolders = "('lt481064ddeb43b')";
				
			break;
			case 'hot_issue_ile':
				
				$aFolders = "('lt4810657c8c94a')";
				
			break;
			case 'article':
				$aFolders = "('lt47b42de36c8d3')";
				break;
			default:
				$aFolders = "('$folderGuid')";
				break;
		}
		return $aFolders;
	}
}
?>