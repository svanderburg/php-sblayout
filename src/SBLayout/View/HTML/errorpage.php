<?php
/**
 * @file
 * @brief View-HTML-ErrorPage module
 * @defgroup View-HTML-ErrorPage
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\PageException;

/**
 * Redirects the user to the appropriate error page when the page lookup or controller fails.
 *
 * @param $application Encoding of the web application layout and pages
 * @param $ex Page exception that is thrown by the lookup method or controller
 * @return Route to the error page
 */
function redirectToErrorPage(Application $application, PageException $ex): Route
{
	header("HTTP/1.1 ".$ex->statusCode." ".$ex->headerMessage);
	$GLOBALS["error"] = $ex->displayMessage;
	return $application->determineErrorRoute($ex);
}

/**
 * @}
 */
?>
