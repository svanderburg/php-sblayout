<?php
namespace Examples\I18N\Model\Page;
use SBLayout\Model\Page\ContentPage;

class InaccessibleContentPage extends ContentPage
{
	public function checkAccessibility(): bool
	{
		return false;
	}
} 
?>
