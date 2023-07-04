<?php
/**
 * @file
 * @brief View-HTML-CustomMenuItem module
 * @defgroup View-HTML-CustomMenuItem
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Page\Page;

/**
 * Displays a menu item in a custom way
 *
 * @param $active Indicates whether the link is active
 * @param $url URL of the sub page
 * @param $subPage Page where the menu item links to
 */
function displayCustomMenuItem(bool $active, string $url, Page $subPage): void
{
	$GLOBALS["active"] = $active;
	$GLOBALS["url"] = $url;
	$GLOBALS["subPage"] = $subPage;

	require(\SBLayout\View\HTML\Util\composeContentPath("menuitems", $subPage->menuItem));
}

/**
 * @}
 */
?>
