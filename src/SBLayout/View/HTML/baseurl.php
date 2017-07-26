<?php
namespace SBLayout\View\HTML;
use SBLayout\Model\Page\Page;

/**
 * Set the global baseURL variable to the dirname of the script.
 */
function setBaseURL()
{
	$GLOBALS["baseURL"] = Page::computeBaseURL();
}
?>
