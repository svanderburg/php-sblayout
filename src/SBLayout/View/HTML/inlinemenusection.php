<?php
/**
 * @file
 * @brief View-HTML-InlineMenuSection module
 * @defgroup View-HTML-InlineMenuSection
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Route;

/**
 * Displays an inline representation of a menu section.
 *
 * @param $route Route from the entry page to current page to be displayed
 * @param $level The level in the navigation structure where to display sub page links from
 */
function displayInlineMenuSection(Route $route, int $level): void
{
	if($level <= count($route->ids))
	{
		$baseURL = $route->composeURLAtLevel($_SERVER["SCRIPT_NAME"], $level);
		$rootPage = $route->pages[$level];

		// Display links to the sub pages

		foreach($rootPage->subPageIterator() as $id => $subPage)
		{
			if($subPage->checkVisibleInMenu())
			{
				$url = $subPage->deriveURL($baseURL, $id, "&amp;");
				$active = $subPage->checkActive($route, $id, $level);
				displayMenuItem($active, $url, $subPage);
			}
		}
	}
}

/**
 * @}
 */
?>
