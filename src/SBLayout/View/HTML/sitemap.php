<?php
/**
 * @file
 * @brief View-HTML-SiteMap module
 * @defgroup View-HTML-SiteMap
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Application;

/**
 * Displays a site map with all visitable links of the application.
 *
 * @param $application Encoding of the web application layout and pages
 */
function displaySiteMap(Application $application): void
{
	$entryPage = $application->entryPage;
	$url = $_SERVER["SCRIPT_NAME"];
	?>
	<a href="<?= $url ?>"><?= $entryPage->title ?></a>
	<?php
	displaySubSiteMap($entryPage, $url);
}

/**
 * @}
 */
?>
