<?php
/**
 * Retrieves the page that is currently requested based on its URL.
 * 
 * @param Application $application Encoding of the web application layout and pages
 * @throws PageForbiddenException If the page is inaccessible
 * @throws PageNotFoundException If the page cannot be found
 * @return Page The page that corresponds to the requested URL
 */
function lookupCurrentPage(Application $application)
{
	try
	{
		$currentPage = $application->lookupCurrentPage();
	}
	catch(PageForbiddenException $ex)
	{
		header("HTTP/1.1 403 Forbidden");
		$currentPage = $application->lookup403Page();
	}
	catch(PageNotFoundException $ex)
	{
		header("HTTP/1.1 404 Not Found");
		$currentPage = $application->lookup404Page();
	}
	
	return $currentPage;
}
?>
