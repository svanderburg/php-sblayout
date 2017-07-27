<?php
namespace Examples\Simple\Model\Page;
use SBLayout\Model\Page\ContentPage;

class InaccessibleContentPage extends ContentPage
{
	public function checkAccessibility()
	{
		return false;
	}
} 
?>
