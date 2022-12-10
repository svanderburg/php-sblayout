<?php
namespace SBLayout\Model\Page;
use Iterator;
use ArrayIterator;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\PageNotFoundException;
use SBLayout\Model\Page\Content\Contents;

/**
 * Defines a page referring to a collection of sub pages whose links can be picked
 * from a menu section.
 */
class StaticContentPage extends ContentPage
{
	/** An associative array mapping URL path components to sub pages */
	public array $subPages;

	/**
	 * Creates a new ContentPage instance.
	 *
	 * @param $title Title of the page that is used as a label in a menu section
	 * @param $contents A content object storing properties of the content sections of a page
	 * @param $subPages An associative array mapping ids to sub pages
	 * @param $menuItem PHP file that renders the menu item. Leaving it null just renders a hyperlink
	 */
	public function __construct(string $title, Contents $contents, array $subPages = array(), string $menuItem = null)
	{
		parent::__construct($title, $contents, $menuItem);
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
	 * @see Page::examineRoute()
	 */
	public function examineRoute(Application $application, Route $route, int $index = 0): void
	{
		if($route->indexIsAtRequestedPage($index))
			parent::examineRoute($application, $route, $index);
		else
		{
			$currentId = $route->getId($index);
			
			if($this->subPages !== null && array_key_exists($currentId, $this->subPages))
			{
				$currentSubPage = $this->subPages[$currentId];
				$route->visitPage($this);
				$currentSubPage->examineRoute($application, $route, $index + 1);
			}
			else
				throw new PageNotFoundException(); // If the key does not exists, the sub page does not either
		}
	}
}
?>
