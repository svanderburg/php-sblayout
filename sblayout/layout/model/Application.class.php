<?php
require_once("page/Page.class.php");

/**
 * Encodes the structure of a web application system which pages have common sections, common style settings and
 * a collection of pages displaying content.
 */
class Application
{
	/** Title of the entire application */
	public $title;
	
	/** An array of CSS stylesheets used for all pages */
	public $styles;
	
	/** An array of sections of which every page is composed */
	public $sections;
	
	/** The entry page of the application (which itself may refer to other sub pages) */
	public $entryPage;

	/** Contains the path id components derived from the URL */
	public $menuPathIds;
	
	/** The favorite icon the page should use */
	public $icon;
	
	/** An array of JavaScript files included by all pages */
	public $scripts;
	
	/** The character encoding standard that the page should use */
	public $charset;
	
	/**
	 * Creates a new application instance.
	 * 
	 * @param string $title Title of the entire application
	 * @param array $styles An array of CSS stylesheets used for all pages
	 * @param array $sections An array of sections of which the page is composed
	 * @param Page $entryPage The entry page of the application
	 * @param string $icon The favorite icon the page should use
	 * @param array $scripts An array of JavaScript files included by all pages
	 * @param string $charset The character encoding standard that the page should use (defaults to UTF-8)
	 */
	public function __construct($title, array $styles, array $sections, Page $entryPage, $icon = NULL, array $scripts = NULL, $charset = "UTF-8")
	{
		$this->title = $title;
		$this->styles = $styles;
		$this->sections = $sections;
		$this->entryPage = $entryPage;
		$this->icon = $icon;
		$this->scripts = $scripts;
		$this->charset = $charset;
	}
	
	/**
	 * Lookups the 403 error page and changes the internal id components to refer to it.
	 * 
	 * @return Page The 403 error page
	 */
	public function lookup403Page()
	{
		$this->menuPathIds = array("403");
		return $this->entryPage->lookupSubPage($this->entryPage, $this->menuPathIds);
	}
	
	/**
	 * Lookups the 404 error page and changes the internal id components to refer to it.
	 *
	 * @return Page The 404 error page
	 */
	public function lookup404Page()
	{
		$this->menuPathIds = array("404");
		return $this->entryPage->lookupSubPage($this->entryPage, $this->menuPathIds);
	}
	
	/**
	 * Looks up the currently requested page to be displayed, by looking at the structure of the current URL
	 * 
	 * @throws PageNotFoundException If the page cannot be found
	 * @throws PageForbiddenException If access to the page is restricted
	 * @return Page The page which is currently requested 
	 */
	public function lookupCurrentPage()
	{
		if(!array_key_exists("PATH_INFO", $_SERVER) || $_SERVER["PATH_INFO"] == "")
			$this->menuPathIds = array(); // If no menu path is given take an empty array
		else
			$this->menuPathIds = explode("/", substr($_SERVER["PATH_INFO"], 1)); // Split everything between '/' characters and turn it into an array
		
		/* Lookup the requested sub page */
		return $this->entryPage->lookupSubPage($this->entryPage, $this->menuPathIds);
	}
}
?>
