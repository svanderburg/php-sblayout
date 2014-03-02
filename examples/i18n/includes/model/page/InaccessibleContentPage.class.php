<?php
require_once("layout/model/page/ContentPage.class.php");

class InaccessibleContentPage extends ContentPage
{
	public function checkAccessibility()
	{
		return false;
	}
} 
?>
