<?php
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;

/**
 * Displays the document type declaration.
 * 
 * @param string $doctype Document type declaration to display. Supported values are: html4, html4transitional, html5
 */
function displayDoctype($doctype)
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

function determineFavIconPath($icon)
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
 * @param Application $application Encoding of the web application layout and pages
 */
function displayRequestedPage(Application $application, $doctype = "html4")
{
	/* Set baseURL globally so that others can use it for convenience */
	setBaseURL();
	
	/* Lookup current page */
	$currentPage = lookupCurrentPage($application);

	/* Display the controller page */
	displayController($currentPage);
	
	/* Display the doctype */
	displayDoctype($doctype);
	?>
<html>
	<head>
		<title><?php print($currentPage->title); ?> - <?php print($application->title); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php print($application->charset); ?>">
		<?php
		if($application->icon !== NULL)
		{
			?>
			<link rel="shortcut icon" href="<?php print(determineFavIconPath($application->icon)); ?>">
			<?php
		}
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
