<?php
/**
 * @file
 * @brief View-HTML-SiteMap module
 * @defgroup View-HTML-SiteMap
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Route;

/**
 * Displays a site map with all visitable pages and sub pages of a page part of the route
 *
 * @param $route Route from the entry page to current page to be displayed
 * @param $displayMenuItems Indicates whether to display each page link as a menu item or an ordinary link
 * @param $baseURL URL of the given page
 * @param $level Level of a menu section
 */
function displaySiteMap(Route $route, bool $displayMenuItems = false, string $baseURL = null, int $level = 0): void
{
	if($baseURL === null)
		$baseURL = $_SERVER["SCRIPT_NAME"];

	$rootPage = $route->pages[$level];

	if($displayMenuItems)
		displayMenuItem(true, $baseURL, $rootPage);
	else
		displayStandardMenuItem(false, $baseURL, $rootPage);

	displaySubSiteMap($route, $rootPage, $displayMenuItems, $baseURL, $level);
}

/**
 * @}
 */
?>
