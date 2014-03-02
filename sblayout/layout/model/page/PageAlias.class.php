<?php
require_once("Page.class.php");

/**
 * Defines a page alias that is an alias of an existing page that
 * can be reached from the entry page.
 */
class PageAlias extends Page
{
	/** Path components to the actual page relative from the entry page */
	public $menuPathIds;
	
	/**
	 * Creates a new PageAlias instance.
	 * 
	 * @param string $title Title of the page that is used as a label in a menu section
	 * @param string $path Path to the actual page relative from the entry page
	 */
	public function __construct($title, $path)
	{
		parent::__construct($title);
		
		if($path == "")
			$this->menuPathIds = array();
		else
			$this->menuPathIds = explode("/", $path);
	}
	
	/**
	 * @see Page::checkVisibility()
	 */
	public function checkVisibility()
	{
		return true;
	}
	
	/**
	 * @see Page::checkAccessibility()
	 */
	public function checkAccessibility()
	{
		return true;
	}
	
	/**
	 * @see Page::lookupSubPage()
	 */
	public function lookupSubPage(Page $entryPage, array $ids, $index = 0)
	{
		return $entryPage->lookupSubPage($entryPage, $this->menuPathIds);
	}
}
?>
