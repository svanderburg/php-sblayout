<?php
namespace SBLayout\View\HTML;
use SBLayout\Model\Page\ContentPage;

/**
 * Displays the controller page that handles GET and POST parameters
 * 
 * @param ContentPage $currentPage Page to be currently displayed
 */
function displayController(ContentPage $currentPage)
{
	if($currentPage->contents->controller !== null)
	{
		require(\SBLayout\View\HTML\Util\composeContentPath("controller", $currentPage->contents->controller));
	}
}
?>
