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
	public $contents;

	/**
	 * Creates a new ContentPage instance
	 *
	 * @param string $title Title of the page that is used as a label in a menu section
	 * @param Contents $contents A content object storing properties of the content sections of a page
	 */
	public function __construct($title, Contents $contents)
	{
		parent::__construct($title);
		$this->contents = $contents;
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
