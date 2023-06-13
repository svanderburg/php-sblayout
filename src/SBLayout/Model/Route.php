<?php
namespace SBLayout\Model;
use SBLayout\Model\Page\Page;

/**
 * Records the route from the entry page to the page that is currently requested.
 */
class Route
{
	/** Path components in the URL that correspond to the IDs of the sub pages */
	public array $ids;

	/** Pages visited to reach the currently opened page */
	public array $pages;

	/**
	 * Creates a new route instance
	 *
	 * @param $ids Path components in the URL that correspond to the IDs of the sub pages
	 */
	public function __construct(array $ids)
	{
		$this->reset($ids);
	}

	/**
	 * Clears the route so that it can be re-investigated with the given path components
	 *
	 * @param $ids Path components in the URL that correspond to the IDs of the sub pages
	 */
	public function reset(array $ids): void
	{
		$this->ids = $ids;
		$this->pages = array();
	}

	/**
	 * Visits the provided page by adding a record
	 *
	 * @param $page Page to visit
	 */
	public function visitPage(Page $page): void
	{
		array_push($this->pages, $page);
	}

	/**
	 * Checks whether the given index is the currently requested page.
	 *
	 * @param $index Index of a page
	 * @return TRUE if the corresponding page is currently requested, else FALSE
	 */
	public function indexIsAtRequestedPage(int $index): bool
	{
		return count($this->ids) == $index;
	}

	/**
	 * Returns the ID of a sub page.
	 *
	 * @param $index Index of a visited page
	 * @return The ID of the visited page
	 */
	public function getId(int $index): string
	{
		return $this->ids[$index];
	}

	/**
	 * Determines what the currently requested page is.
	 *
	 * @return Currently requested page
	 */
	public function determineCurrentPage(): Page
	{
		return $this->pages[count($this->pages) - 1];
	}

	/**
	 * Checks whether a page with provided ID was visited on the specified level of a menu section.
	 *
	 * @param $id ID of a page
	 * @param $level Level of a menu section
	 * @return TRUE if the page was visited, else FALSE
	 */
	public function hasVisitedPageOnLevel(string $id, int $level): bool
	{
		return count($this->ids) > $level && $this->ids[$level] == $id;
	}

	/**
	 * Composes the URL for the current page or any of its parent pages at a certain level.
	 *
	 * @param $baseURL Base URL to prepend to the resulting URL
	 * @param $level Page level
	 * @param $argSeparator The symbol that separates arguments
	 * @return The URL of the current page or any of its parent pages
	 */
	public function composeURLAtLevel(string $baseURL, int $level, string $argSeparator = "&amp;"): string
	{
		$url = $baseURL;

		for($i = 0; $i < $level; $i++)
		{
			$currentId = $this->ids[$i];
			$currentPage = $this->pages[$i + 1];

			$url = $currentPage->deriveURL($url, $currentId, $argSeparator);
		}

		return $url;
	}

	/**
	 * Composes the URL to the parent page of the currently opened URL.
	 *
	 * @param $baseURL Base URL to prepend to the resulting URL
	 * @param $argSeparator The symbol that separates arguments
	 * @return The URL to the parent page
	 */
	public function composeParentPageURL(string $baseURL, string $argSeparator = "&amp;"): string
	{
		return $this->composeURLAtLevel($baseURL, count($this->ids) - 1, $argSeparator);
	}
}
?>
