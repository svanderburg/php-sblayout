<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\PageForbiddenException;
use SBLayout\Model\PageNotFoundException;
use SBLayout\Model\Page\Content\Contents;

/**
 * Defines a page displaying arbitrary contents in one or more content sections.
 */
class ContentPage extends Page
{
	/** A content object storing properties of the content sections of a page */
	public Contents $contents;

	/**
	 * Creates a new ContentPage instance
	 *
	 * @param $title Title of the page that is used as a label in a menu section
	 * @param $contents A content object storing properties of the content sections of a page
	 * @param $menuItem PHP file that renders the menu item. Leaving it null just renders a hyperlink
	 */
	public function __construct(string $title, Contents $contents, string $menuItem = null)
	{
		parent::__construct($title, $menuItem);
		$this->contents = $contents;
	}

	/**
	 * @see Page::checkActive()
	 */
	public function checkActive(Route $route, string $id, int $level): bool
	{
		return $route->hasVisitedPageOnLevel($id, $level);
	}

	/**
	 * @see Page::examineRoute()
	 */
	public function examineRoute(Application $application, Route $route, int $index = 0): void
	{
		if($route->indexIsAtRequestedPage($index))
		{
			if($this->checkAccessibility())
				$route->visitPage($this);
			else
				throw new PageForbiddenException();
		}
		else
			throw new PageNotFoundException(); // A ContentPage does not refer to sub pages
	}
}
?>
