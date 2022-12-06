<?php
/**
 * @file
 * @brief View-HTML-EmbeddedMenuSection module
 * @defgroup View-HTML-EmbeddedMenuSection
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Route;

/**
 * Displays an embedded representation of a menu section.
 *
 * @param $route Route from the entry page to current page to be displayed
 * @param $level The level in the navigation structure where to display sub page links from
 */
function displayEmbeddedMenuSection(Route $route, int $level): void
{
	?>
	<div class="menusection"><?php displayInlineMenuSection($route, $level); ?></div>
	<?php
}

/**
 * @}
 */
?>
