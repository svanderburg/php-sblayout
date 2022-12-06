<?php
namespace SBLayout\Model\Page;
use Iterator;
use ArrayIterator;
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
	public function checkVisibility(): bool
	{
		return true;
	}

	/**
	 * Checks whether the page is currently accessible.
	 *
	 * @return bool TRUE if the user has access, else FALSE
	 */
	public function checkAccessibility(): bool
	{
		return true;
	}

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
	 * Creates an iterator that can be used to traverse over all sub pages.
	 *
	 * @return An iterator
	 */
	public function subPageIterator(): Iterator
	{
		return new ArrayIterator(array());
	}

	/**
	 * Decides how to compose a URL for the given page from its baseURL and the page identifier.
	 *
	 * @param $baseURL Base URL of the page
	 * @param $id Identifier of the page
	 * @return The URL to this page
	 */
	public function deriveURL(string $baseURL, string $id): string
	{
		return $baseURL."/".rawurlencode($id);
	}

	/**
	 * Checks whether the page is currently active
	 *
	 * @param $route The route from the entry page to the current page
	 * @param $id Identifier of the page
	 * @param $level Level in the navigation structure
	 * @return true if the page is active, else false
	 */
	public abstract function checkActive(Route $route, string $id, int $level): bool;

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
