<?php
/**
 * @file
 * @brief View-HTML-Styles module
 * @defgroup View-HTML-Styles
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Page\ContentPage;

/**
 * Determines the actual CSS path. If the path is absolute, it is taken as is.
 * If it is relative it's expanded to a path that included from the styles/ folder.
 *
 * @param $style Path to a CSS file
 * @return An expanded relative path or the the absolute path
 */
function determineStylePath(string $style): string
{
	global $baseURL;

	if(substr($style, 0, 1) == "/")
		return $style;
	else
		return $baseURL."/styles/".$style;
}

/**
 * Displays a section that includes CSS files both on application and page level
 *
 * @param $application Encoding of the web application layout and pages
 * @param $currentPage Page to be currently displayed
 */
function generateStyleSection(Application $application, ContentPage $currentPage): void
{
	/* Include the defined CSS stylesheets in the application layout */
	if($application->styles !== NULL)
	{
		foreach($application->styles as $style)
		{
			$stylePath = determineStylePath($style);
			?>
			<link rel="stylesheet" type="text/css" href="<?= $stylePath ?>">
			<?php
		}
	}

	/* Include the defined styles in the contents */
	if($currentPage->contents->styles !== NULL)
	{
		foreach($currentPage->contents->styles as $style)
		{
			$stylePath = determineStylePath($style);
			?>
			<link rel="stylesheet" type="text/css" href="<?= $stylePath ?>">
			<?php
		}
	}
}

/**
 * @}
 */
?>
