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
	 */
	public function __construct(string $title, Contents $contents)
	{
		parent::__construct($title);
		$this->contents = $contents;
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
