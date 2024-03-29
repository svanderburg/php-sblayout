<?php
/**
 * @file
 * @brief View-HTML-MenuSection module
 * @defgroup View-HTML-MenuSection
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\Section\MenuSection;

/**
 * Displays a menu section containing links to sub pages
 *
 * @param $application Encoding of the web application layout and pages
 * @param $section Menu section to display
 * @param $route Route from the entry page to current page to be displayed
 */
function displayMenuSection(Application $application, MenuSection $section, Route $route): void
{
	displayInlineMenuSection($route, $section->level);
}

/**
 * @}
 */
?>
