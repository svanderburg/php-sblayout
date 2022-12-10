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
 * Displays a menu item in the standard way
 *
 * @param $active Indicates whether the link is active
 * @param $url URL of the sub page
 * @param $subPage Page where the menu item links to
 */
function displayMenuItem(bool $active, string $url, Page $subPage): void
{
	if($active)
	{
		?>
		<a class="active" href="<?= $url ?>"><strong><?= $subPage->title ?></strong></a>
		<?php
	}
	else
	{
		?>
		<a href="<?= $url ?>"><?= $subPage->title ?></a>
		<?php
	}
}

/**
 * @}
 */
?>
