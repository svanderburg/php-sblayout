<?php
namespace SimpleExample\Model\Page;
use SBLayout\Model\Page\ContentPage;

class InaccessibleContentPage extends ContentPage
{
	public function checkAccessibility()
	{
		return false;
	}
} 
?>
