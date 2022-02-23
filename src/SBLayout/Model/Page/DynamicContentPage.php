<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\Page\Content\Contents;

/**
 * Defines a page referring to the same sub page that dynamically generates it contents
 * using the sub page URL path component as parameter.
 */
class DynamicContentPage extends ContentPage
{
	/** The name of the query parameter that must be set when retrieving the sub page */
	public string $param;
	
	/** The dynamic sub page that interprets the URL parameter component */
	public Page $dynamicSubPage;
	
	/**
	 * Create a new DynamicContentPage instance.
	 *
	 * @param $title Title of the page that is used as a label in a menu section
	 * @param $param The name of the query parameter that must be set when retrieving the sub page
	 * @param $contents A content object storing properties of the content sections of a page
	 * @param $dynamicSubPage The dynamic sub page that interprets the URL parameter component
	 */
	public function __construct(string $title, string $param, Contents $contents, Page $dynamicSubPage)
	{
		parent::__construct($title, $contents);
		$this->param = $param;
		$this->dynamicSubPage = $dynamicSubPage;
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
			$currentId = $route->getId($index); // Take the first id of the array
			$GLOBALS["query"][$this->param] = $currentId; // Set the query parameter
			$route->visitPage($this);
			$this->dynamicSubPage->examineRoute($application, $route, $index + 1);
		}
	}
}
?>
