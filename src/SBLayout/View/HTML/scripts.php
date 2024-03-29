<?php
/**
 * @file
 * @brief View-HTML-Scripts module
 * @defgroup View-HTML-Scripts
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Page\ContentPage;

/**
 * Determines the actual script path. If the path is absolute, it is taken as is.
 * If it is relative it's expanded to a path that included from the scripts/ folder.
 *
 * @param $script Path to a script file
 * @return An expanded relative path or the the absolute path
 */
function determineScriptPath(string $script): string
{
	global $baseURL;
	
	if(substr($script, 0, 1) == "/")
		return $script;
	else
		return $baseURL."/scripts/".$script;
}

/**
 * Displays a section that includes JavaScript files both on application and page level
 *
 * @param $application Encoding of the web application layout and pages
 * @param $currentPage Page to be currently displayed
 */
function generateScriptSection(Application $application, ContentPage $currentPage): void
{
	/* Include the defined scripts in the application layout */
	if($application->scripts !== NULL)
	{
		foreach($application->scripts as $script)
		{
			$scriptPath = determineScriptPath($script);
			?>
			<script type="text/javascript" src="<?= $scriptPath ?>"></script>
			<?php
		}
	}
			
	/* Include the defined scripts of the contents */
	if($currentPage->contents->scripts !== NULL)
	{
		foreach($currentPage->contents->scripts as $script)
		{
			$scriptPath = determineScriptPath($script);
			?>
			<script type="text/javascript" src="<?= $scriptPath ?>"></script>
			<?php
		}
	}
}

/**
 * @}
 */
?>
