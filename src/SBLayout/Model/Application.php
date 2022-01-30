<?php
namespace SBLayout\Model;
use SBLayout\Model\Route;
use SBLayout\Model\Page\Page;

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
	 * Derives the route to the 403 error page.
	 *
	 * @return Route The 403 error page route
	 */
	public function determine403Route()
	{
		$route = new Route(array("403"));
		$this->entryPage->examineRoute($this, $route);
		return $route;
	}
	
	/**
	 * Derives the route to the 403 error page.
	 *
	 * @return Route The 404 error page route
	 */
	public function determine404Route()
	{
		$route = new Route(array("404"));
		$this->entryPage->examineRoute($this, $route);
		return $route;
	}
	
	/**
	 * Examines a route derived from the path components of the requested URL and records all pages visited.
	 *
	 * @param Route route Route to investigate
	 * @throws PageNotFoundException If the page cannot be found
	 * @throws PageForbiddenException If access to the page is restricted
	 */
	public function examineRoute(Route $route)
	{
		$this->entryPage->examineRoute($this, $route);
	}
	
	/**
	 * Looks up the currently requested page to be displayed, by looking at the structure of the current URL
	 *
	 * @throws PageNotFoundException If the page cannot be found
	 * @throws PageForbiddenException If access to the page is restricted
	 * @return Route A route that records all visited pages
	 */
	public function determineRoute()
	{
		if(!array_key_exists("PATH_INFO", $_SERVER) || $_SERVER["PATH_INFO"] == "")
			$ids = array(); // If no menu path is given take an empty array
		else
			$ids = explode("/", substr($_SERVER["PATH_INFO"], 1)); // Split everything between '/' characters and turn it into an array

		$route = new Route($ids);
		$this->examineRoute($route);
		return $route;
	}
}
?>
