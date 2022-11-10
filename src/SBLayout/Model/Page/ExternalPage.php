<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;

/**
 * A page that refers to an external URL instead of a sub page belonging to the same application.
 */
class ExternalPage extends Page
{
	/** External URL to which the page redirects */
	public string $url;

	/**
	 * Creates a new ExternalPage instance.
	 *
	 * @param $title Title of the page that is used as a label in a menu section
	 * @param $url External URL to which the page redirects
	 */
	function __construct(string $title, string $url)
	{
		parent::__construct($title);
		$this->url = $url;
	}

	/**
	 * @see Page::deriveURL()
	 */
	function deriveURL(string $baseURL, string $id): string
	{
		return $this->url;
	}

	/**
	 * @see Page::examineRoute()
	 */
	public function examineRoute(Application $application, Route $route, int $index = 0): void
	{
		if($route->indexIsAtRequestedPage($index))
		{
			if($this->checkAccessibility())
				$route->visitPage($this);
			else
				throw new PageForbiddenException();
		}
		else
			throw new PageNotFoundException(); // An external page does not refer to sub pages
	}
}
?>
