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
	public string $title;
	
	/** An array of CSS stylesheets used for all pages */
	public array $styles;
	
	/** An array of sections of which every page is composed */
	public array $sections;
	
	/** The entry page of the application (which itself may refer to other sub pages) */
	public Page $entryPage;
	
	/** The favorite icon the page should use or NULL if no favorite icon is used */
	public ?string $icon;
	
	/** An array of JavaScript files included by all pages */
	public array $scripts;
	
	/** The character encoding standard that the page should use */
	public string $charset;
	
	/**
	 * Creates a new application instance.
	 *
	 * @param $title Title of the entire application
	 * @param $styles An array of CSS stylesheets used for all pages
	 * @param $sections An array of sections of which the page is composed
	 * @param $entryPage The entry page of the application
	 * @param $icon The favorite icon the page should use
	 * @param $scripts An array of JavaScript files included by all pages
	 * @param $charset The character encoding standard that the page should use (defaults to UTF-8)
	 */
	public function __construct(string $title, array $styles, array $sections, Page $entryPage, string $icon = NULL, array $scripts = array(), string $charset = "UTF-8")
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
	 * Derives the route to an error page.
	 *
	 * @param $cause The page exception that triggered the error page
	 * @return The error page route
	 */
	public function determineErrorRoute(PageException $cause): Route
	{
		$route = new Route(array($cause->statusCode));
		$this->entryPage->examineRoute($this, $route);
		return $route;
	}
	
	/**
	 * Examines a route derived from the path components of the requested URL and records all pages visited.
	 *
	 * @param $route Route to investigate
	 * @throws PageException In case an error occured, such as the page cannot be found or access is restricted
	 */
	public function examineRoute(Route $route): void
	{
		$this->entryPage->examineRoute($this, $route);
	}
	
	/**
	 * Looks up the currently requested page to be displayed, by looking at the structure of the current URL
	 *
	 * @return A route that records all visited pages
	 * @throws PageException In case an error occured, such as the page cannot be found or access is restricted
	 */
	public function determineRoute(): Route
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
