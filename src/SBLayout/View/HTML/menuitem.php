<?php
/**
 * @file
 * @brief View-HTML-MenuItem module
 * @defgroup View-HTML-MenuItem
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Page\Page;

/**
 * Displays a menu item.
 *
 * @param $active Indicates whether the link is active
 * @param $url URL of the sub page
 * @param $subPage Page where the menu item links to
 */
function displayMenuItem(bool $active, string $url, Page $subPage): void
{
	if($subPage->menuItem === null)
		displayStandardMenuItem($active, $url, $subPage);
	else
		displayCustomMenuItem($active, $url, $subPage);
}

/**
 * @}
 */
?>
