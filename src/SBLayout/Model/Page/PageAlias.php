<?php
namespace SBLayout\Model\Page;
use Iterator;
use ArrayIterator;
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
	public array $ids;

	/** An associative array mapping URL path components to sub pages */
	public array $subPages;

	/**
	 * Creates a new PageAlias instance.
	 *
	 * @param $title Title of the page that is used as a label in a menu section
	 * @param $path Path to the actual page relative from the entry page
	 * @param $subPages An associative array mapping ids to sub pages
	 */
	public function __construct(string $title, string $path, array $subPages = array())
	{
		parent::__construct($title);

		if($path == "")
			$this->ids = array();
		else
			$this->ids = explode("/", $path);

		$this->subPages = $subPages;
	}

	/**
	 * @see Page::subPageIterator()
	 */
	public function subPageIterator(): Iterator
	{
		return new ArrayIterator($this->subPages);
	}

	/**
	 * @see Page::checkActive()
	 */
	public function checkActive(Route $route, string $id, int $level): bool
	{
		return count($route->ids) === count($this->ids) && array_diff($route->ids, $this->ids) === array_diff($this->ids, $route->ids);
	}

	/**
	 * @see Page::examineRoute()
	 */
	public function examineRoute(Application $application, Route $route, int $index = 0): void
	{
		if($route->indexIsAtRequestedPage($index))
		{
			$route->reset($this->ids);
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
