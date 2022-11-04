<?php
/**
 * @file
 * @brief View-HTML-Page module
 * @defgroup View-HTML-Page
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\PageException;

/**
 * Determines the route from the entry page to the requested page based on the requested URL components.
 *
 * @param $application Encoding of the web application layout and pages
 * @throws PageException In case an error occured, such as the page cannot be found or access is restricted
 * @return Route from the entry page to current page to be displayed
 */
function determineRoute(Application $application): Route
{
	try
	{
		$route = $application->determineRoute();
	}
	catch(PageException $ex)
	{
		header("HTTP/1.1 ".$ex->statusCode." ".$ex->headerMessage);
		$route = $application->determineErrorRoute($ex);
	}

	return $route;
}

/**
 * @}
 */
?>
