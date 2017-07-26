<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Page\Content\Contents;

/**
 * Defines a static content page which link is not visible in any menu section.
 */
class HiddenStaticContentPage extends StaticContentPage
{
	/**
	 * @see StaticContentPage::__construct()
	 */
	public function __construct($title, Contents $contents, array $subPages = null)
	{
		parent::__construct($title, $contents, $subPages);
	}
	
	/**
	 * @see Page::checkVisibility()
	 */
	public function checkVisibility()
	{
		return false;
	}
}
?>
