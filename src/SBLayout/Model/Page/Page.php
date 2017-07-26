<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;

/**
 * Defines a page that can be reached from a link in a menu section or through
 * the last path components of an URL.
 */
abstract class Page
{
	/** Title of the page that is used as a label in a menu section */
	public $title;
	
	/**
	 * Creates a new Page instance.
	 * 
	 * @param string $title Title of the page that is used as a label in a menu section
	 */
	public function __construct($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Checks whether the page link should be displayed in a menu section.
	 *
	 * @return bool TRUE if the page is visible, else FALSE
	 */
	public abstract function checkVisibility();
	
	/**
	 * Checks whether the page is currently accessible.
	 *
	 * @return bool TRUE if the user has access, else FALSE
	 */
	public abstract function checkAccessibility();
	
	/**
	 * Lookup a sub page by using the given ids orginating from the last path components
	 * of an URL.
	 * 
	 * @param Application $application Application layout where the page belongs to
	 * @param array $ids An array of strings containing URL path components
	 * @param int $index The current index of the element in the ids array
	 * @return Page The requested sub page
	 */
	public abstract function lookupSubPage(Application $application, array $ids, $index = 0);

	/**
	 * Computes the base URL from the script name.
	 *
	 * @return The dir name of the base URL or an empty string if it is the root.
	 */
	public static function computeBaseURL()
	{
		$baseURL = dirname($_SERVER["SCRIPT_NAME"]);
		if($baseURL == "/")
			$baseURL = "";

		return $baseURL;
	}
}
?>
