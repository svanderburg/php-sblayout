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
	 * Composes a base URL for a menu section on a certain level.
	 *
	 * @param $level Menu section level
	 * @return The base URL for all links in the menu section
	 */
	public function composeBaseURL(int $level): string
	{
		$basePath = "";

		for($i = 0; $i < $level; $i++)
		{
			$currentId = $this->ids[$i];
			$basePath .= "/".rawurlencode($currentId);
		}

		return $basePath;
	}
}
?>
