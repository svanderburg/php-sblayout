<?php
require_once("baseurl.inc.php");
require_once("page.inc.php");
require_once("controller.inc.php");
require_once("scripts.inc.php");
require_once("styles.inc.php");
require_once("section.inc.php");

/**
 * Displays a simple HTML page containing the sections defined in the application layout.
 * 
 * @param Application $application Encoding of the web application layout and pages
 */
function displayRequestedPage(Application $application)
{
	/* Set baseURL globally so that others can use it for convenience */
	setBaseURL();
	
	/* Lookup current page */
	$currentPage = lookupCurrentPage($application);

	/* Display the controller page */
	displayController($currentPage);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<title><?php print($currentPage->title); ?> - <?php print($application->title); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php print($application->charset); ?>">
		<?php
		generateScriptSection($application, $currentPage);
		generateStyleSection($application, $currentPage);
		?>
	</head>

	<body>
		<?php
		foreach($application->sections as $id => $section)
			displaySection($application, $id, $currentPage);
		?>
	</body>
</html>
	<?php
}
