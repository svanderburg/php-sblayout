<?php
/**
 * @file
 * @brief View-HTML-Index module
 * @defgroup View-HTML-Index
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;

/**
 * Displays the document type declaration.
 *
 * @param $doctype Document type declaration to display. Supported values are: html4, html4transitional, html5
 */
function displayDoctype(string $doctype): void
{
	switch($doctype)
	{
		case "html4":
			?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
			<?php
			break;
		case "html4transitional":
			?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
			<?php
			break;
		case "html5":
			?>
<!DOCTYPE html>
			<?php
			break;
	}
}

/**
 * Determines the path to the favorite icon
 *
 * @param $icon Path to the favorite icon
 * @return The icon path relative to the base URL
 */
function determineFavIconPath(string $icon): string
{
	global $baseURL;
	
	if(substr($icon, 0, 1) == "/")
		return $icon;
	else
		return $baseURL."/".$icon;
}

/**
 * Displays a simple HTML page containing the sections defined in the application layout.
 *
 * @param $application Encoding of the web application layout and pages
 * @param $doctype Document type declaration to display. Supported values are: html4, html4transitional, html5
 */
function displayRequestedPage(Application $application, string $doctype = "html4"): void
{
	/* Set baseURL globally so that others can use it for convenience */
	setBaseURL();
	
	/* Determine page route */
	global $route, $currentPage;

	$route = determineRoute($application);
	$currentPage = $route->determineCurrentPage();

	/* Display the controller page */
	displayController($currentPage);
	
	/* Display the doctype */
	displayDoctype($doctype);
	?>
<html>
	<head>
		<title><?= $currentPage->title ?> - <?= $application->title ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= $application->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
		if($application->icon !== NULL)
		{
			?>
			<link rel="shortcut icon" href="<?= determineFavIconPath($application->icon) ?>">
			<?php
		}
		generateScriptSection($application, $currentPage);
		generateStyleSection($application, $currentPage);
		?>
	</head>

	<body>
		<?php
		displaySections($application, $route, $currentPage);
		?>
	</body>
</html>
	<?php
}

/**
 * @}
 */
