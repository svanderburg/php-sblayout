<?php
/**
 * @file
 * @brief View-HTML-SiteMapSection module
 * @defgroup View-HTML-SiteMapSection
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Route;
use SBLayout\Model\Section\SiteMapSection;

/**
 * Displays a sitemap section containing links to sub pages and transitive sub pages
 *
 * @param $section Site map section to display
 * @param $route Route from the entry page to current page to be displayed
 */
function displaySiteMapSection(SiteMapSection $section, Route $route): void
{
	if($section->level <= count($route->ids))
	{
		$baseURL = $route->composeURLAtLevel($_SERVER["SCRIPT_NAME"], $section->level);
		displaySiteMap($route, true, $baseURL, $section->level);
	}
}

/**
 * @}
 */
?>
