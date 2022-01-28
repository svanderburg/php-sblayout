<?php
namespace SBLayout\Model;
use SBLayout\Model\Page\Page;

/**
 * Records the route from the entry page to the page that is currently requested.
 */
class Route
{
	/** Path components in the URL that correspond to the IDs of the sub pages */
	public $ids;

	/** Pages visited to reach the currently opened page */
	public $pages;

	/**
	 * Creates a new route instance
	 *
	 * @param array ids Path components in the URL that correspond to the IDs of the sub pages
	 */
	public function __construct(array $ids)
	{
		$this->reset($ids);
	}

	/**
	 * Clears the route so that it can be re-investigated with the given path components
	 *
	 * @param array ids Path components in the URL that correspond to the IDs of the sub pages
	 */
	public function reset(array $ids)
	{
		$this->ids = $ids;
		$this->pages = array();
	}

	/**
	 * Visits the provided page by adding a record
	 *
	 * @param Page page Page to visit
	 */
	public function visitPage(Page $page)
	{
		array_push($this->pages, $page);
	}

	/**
	 * Checks whether the given index is the currently requested page.
	 *
	 * @param int index Index of a page
	 * @return bool TRUE if the corresponding page is currently requested, else FALSE
	 */
	public function indexIsAtRequestedPage($index)
	{
		return count($this->ids) == $index;
	}

	/**
	 * Returns the ID of a sub page.
	 * 
	 * @param int index Index of a visited page
	 * @return string The ID of the visited page
	 */
	public function getId($index)
	{
		return $this->ids[$index];
	}

	/**
	 * Determines what the currently requested page is.
	 *
	 * @return Page Currently requested page
	 */
	public function determineCurrentPage()
	{
		return $this->pages[count($this->pages) - 1];
	}

	/**
	 * Checks whether a page with provided ID was visited on the specified level of a menu section.
	 * 
	 * @param string id ID of a page
	 * @param int level Level of a menu section
	 * @return bool TRUE if the page was visited, else FALSE
	 */
	public function hasVisitedPageOnLevel($id, $level)
	{
		return count($this->ids) > $level && $this->ids[$level] == $id;
	}

	/**
	 * Composes a base URL for a menu section on a certain level.
	 *
	 * @param int level Menu section level
	 * @return string The base URL for all links in the menu section
	 */
	public function composeBaseURL($level)
	{
		$basePath = "";

		for($i = 0; $i < $level; $i++)
			$basePath .= $this->ids[$i]."/";

		return $basePath;
	}
}
?>
