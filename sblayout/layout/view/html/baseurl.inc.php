<?php
/**
 * Set the global baseURL variable to the dirname of the script.
 */
function setBaseURL()
{
	$GLOBALS["baseURL"] = Page::computeBaseURL();
}
?>
