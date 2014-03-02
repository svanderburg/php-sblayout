<?php
require_once("StaticContentPage.class.php");

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
