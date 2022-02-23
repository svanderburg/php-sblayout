<?php
/**
 * @file
 * @brief View-HTML-Controller module
 * @defgroup View-HTML-Controller
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Page\ContentPage;

/**
 * Displays the controller page that handles GET and POST parameters
 *
 * @param $currentPage Page to be currently displayed
 */
function displayController(ContentPage $currentPage): void
{
	if($currentPage->contents->controller !== null)
	{
		require(\SBLayout\View\HTML\Util\composeContentPath("controller", $currentPage->contents->controller));
	}
}

/**
 * @}
 */
?>
