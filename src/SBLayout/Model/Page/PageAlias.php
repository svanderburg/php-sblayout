<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\PageNotFoundException;

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
	 * @see Page::examineRoute()
	 */
	public function examineRoute(Application $application, Route $route, $index = 0)
	{
		if($route->indexIsAtRequestedPage($index))
		{
			$route->reset($this->menuPathIds);
			$application->examineRoute($route);
		}
		else
		{
			$currentId = $route->getId($index); // Take the first id of the array

			if(array_key_exists($currentId, $this->subPages))
			{
				$route->visitPage($this);
				$currentSubPage = $this->subPages[$currentId];
				$currentSubPage->examineRoute($application, $route, $index + 1);
			}
			else
				throw new PageNotFoundException(); // If the key does not exists, the sub page does not either
		}
	}
}
?>
