<?php
/**
 * @file
 * @brief View-HTML-Page module
 * @defgroup View-HTML-Page
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\PageForbiddenException;
use SBLayout\Model\PageNotFoundException;

/**
 * Determines the route from the entry page to the requested page based on the requested URL components.
 *
 * @param Application $application Encoding of the web application layout and pages
 * @throws PageForbiddenException If the page is inaccessible
 * @throws PageNotFoundException If the page cannot be found
 * @return Route Route from the entry page to current page to be displayed
 */
function determineRoute(Application $application)
{
	try
	{
		$route = $application->determineRoute();
	}
	catch(PageForbiddenException $ex)
	{
		header("HTTP/1.1 403 Forbidden");
		$route = $application->determine403Route();
	}
	catch(PageNotFoundException $ex)
	{
		header("HTTP/1.1 404 Not Found");
		$route = $application->determine404Route();
	}
	
	return $route;
}

/**
 * @}
 */
?>
