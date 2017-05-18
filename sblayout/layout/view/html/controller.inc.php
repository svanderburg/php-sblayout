<?php
require_once("util/composecontentpath.inc.php");

/**
 * Displays the controller page that handles GET and POST parameters
 * 
 * @param ContentPage $currentPage Page to be currently displayed
 */
function displayController(ContentPage $currentPage)
{
	if($currentPage->contents->controller !== null)
	{
		require(composeContentPath("controller", $currentPage->contents->controller));
	}
}
?>
