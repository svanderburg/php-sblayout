<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;

/**
 * Defines a page that can be reached from a link in a menu section or through
 * the last path components of an URL.
 */
abstract class Page
{
	/** Title of the page that is used as a label in a menu section */
	public string $title;
	
	/**
	 * Creates a new Page instance.
	 * 
	 * @param $title Title of the page that is used as a label in a menu section
	 */
	public function __construct(string $title)
	{
		$this->title = $title;
	}
	
	/**
	 * Checks whether the page link should be displayed in a menu section.
	 *
	 * @return bool TRUE if the page is visible, else FALSE
	 */
	public abstract function checkVisibility(): bool;
	
	/**
	 * Checks whether the page is currently accessible.
	 *
	 * @return bool TRUE if the user has access, else FALSE
	 */
	public abstract function checkAccessibility(): bool;
	
	/**
	 * Checks all conditions that must be met so that a page is displayed in a menu.
	 *
	 * @return bool TRUE if the page should be visible, else FALSE
	 */
	public function checkVisibleInMenu(): bool
	{
		return $this->checkVisibility() && $this->checkAccessibility();
	}
	
	/**
	 * Examines a route derived from the path components of the requested URL and records all pages visited.
	 *
	 * @param $application Application layout where the page belongs to
	 * @param $route Route to investigate
	 * @param $index The index of the page to be visited
	 */
	public abstract function examineRoute(Application $application, Route $route, int $index = 0): void;

	/**
	 * Computes the base URL from the script name.
	 *
	 * @return The dir name of the base URL or an empty string if it is the root.
	 */
	public static function computeBaseURL(): string
	{
		$baseURL = dirname($_SERVER["SCRIPT_NAME"]);
		if($baseURL == "/")
			$baseURL = "";

		return $baseURL;
	}
}
?>
