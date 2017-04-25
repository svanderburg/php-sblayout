<?php
require_once("ContentPage.class.php");

/**
 * Defines a page referring to the same sub page that dynamically generates it contents
 * using the sub page URL path component as parameter.
 */
class DynamicContentPage extends ContentPage
{
	/** The name of the query parameter that must be set when retrieving the sub page */
	public $param;
	
	/** The dynamic sub page that interprets the URL parameter component */
	public $dynamicSubPage;
	
	/**
	 * Create a new DynamicContentPage instance.
	 * 
	 * @param string $title Title of the page that is used as a label in a menu section
	 * @param string $param The name of the query parameter that must be set when retrieving the sub page
	 * @param Contents $contents A content object storing properties of the content sections of a page
	 * @param Page $dynamicSubPage The dynamic sub page that interprets the URL parameter component
	 */
	public function __construct($title, $param, Contents $contents, Page $dynamicSubPage)
	{
		parent::__construct($title, $contents);
		$this->param = $param;
		$this->dynamicSubPage = $dynamicSubPage;
	}
	
	/**
	 * @see Page::lookupSubPage()
	 */
	public function lookupSubPage(Page $entryPage, array $ids, $index = 0)
	{
		if(count($ids) == $index)
			return parent::lookupSubPage($entryPage, $ids, $index);
		else
		{
			$currentId = $ids[$index]; // Take the first id of the array
			$GLOBALS["query"][$this->param] = $currentId; // Set the query parameter
			return $this->dynamicSubPage->lookupSubPage($entryPage, $ids, $index + 1);
		}
	}
}
?>
