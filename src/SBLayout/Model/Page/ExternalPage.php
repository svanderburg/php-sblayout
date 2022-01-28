<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;

/**
 * A page that refers to an external URL instead of a sub page belonging to the same application.
 */
class ExternalPage extends Page
{
	/** External URL to which the page redirects */
	public $url;
	
	/**
	 * Creates a new ExternalPage instance.
	 *
	 * @param string $title Title of the page that is used as a label in a menu section
	 * @param string $url External URL to which the page redirects
	 */
	function __construct($title, $url)
	{
		parent::__construct($title);
		$this->url = $url;
	}
	
	/**
	 * @see Page::checkVisibility()
	 */
	function checkVisibility()
	{
		return true;
	}
	
	/**
	 * @see Page::checkAccessibility()
	 */
	function checkAccessibility()
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
			throw new PageNotFoundException(); // An external page does not refer to sub pages
	}
}
?>
