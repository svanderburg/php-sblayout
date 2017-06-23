<?php
require_once("Page.class.php");
require_once(dirname(__FILE__)."./../PageNotFoundException.class.php");

/**
 * Defines a page alias that is an alias of an existing page that
 * can be reached from the entry page.
 */
class PageAlias extends Page
{
	/** Path components to the actual page relative from the entry page */
	public $menuPathIds;
	
	/** An associative array mapping URL path components to sub pages */
	public $subPages;
	
	/**
	 * Creates a new PageAlias instance.
	 *
	 * @param string $title Title of the page that is used as a label in a menu section
	 * @param string $path Path to the actual page relative from the entry page
	 * @param array $subPages An associative array mapping ids to sub pages
	 */
	public function __construct($title, $path, array $subPages = null)
	{
		parent::__construct($title);

		if($path == "")
			$this->menuPathIds = array();
		else
			$this->menuPathIds = explode("/", $path);

		$this->subPages = $subPages;
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
	public function lookupSubPage(Application $application, array $ids, $index = 0)
	{
		if(count($ids) == $index)
			return $application->lookupSubPage($this->menuPathIds);
		else
		{
			$currentId = $ids[$index]; // Take the first id of the array

			if(array_key_exists($currentId, $this->subPages))
			{
				$currentSubPage = $this->subPages[$currentId];
				return $currentSubPage->lookupSubPage($application, $ids, $index + 1);
			}
			else
				throw new PageNotFoundException(); // If the key does not exists, the sub page does not either
		}
	}
}
?>
