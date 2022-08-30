<?php
/**
 * @file
 * @brief View-HTML-Sections module
 * @defgroup View-HTML-Sections
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\Page\ContentPage;
use SBLayout\Model\Section\CompoundSection;

/**
 * Displays a collection of sections.
 *
 * @param $application Encoding of the web application layout and pages
 * @param $route Route from the entry page to current page to be displayed
 * @param $currentPage Page to be currently displayed
 * @param $compoundSection Compound section in which the sections are embedded or null if they are on root level
 */
function displaySections(Application $application, Route $route, ContentPage $currentPage, CompoundSection $compoundSection = null): void
{
	if($compoundSection === null)
		$sections = $application->sections;
	else
		$sections = $compoundSection->sections;

	foreach($sections as $id => $section)
		displaySection($application, $id, $section, $route, $currentPage);
}

/**
 * @}
 */
?>
