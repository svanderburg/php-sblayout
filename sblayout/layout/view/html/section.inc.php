<?php
require_once("menusection.inc.php");
require_once("util/composecontentpath.inc.php");

/**
 * Displays a section.
 * 
 * @param Application $application Encoding of the web application layout and pages
 * @param string $id Id of the section to be displayed
 * @param ContentPage $currentPage Page to be currently displayed
 */
function displaySection(Application $application, $id, ContentPage $currentPage)
{
	$section = $application->sections[$id];
	
	?>
	<div id="<?php print($id); ?>">
		<?php
		if($section instanceof StaticSection)
		{
			require(composeContentPath("sections", $section->contents));
		}
		else if($section instanceof MenuSection)
		{
			displayMenuSection($application, $section);
		}
		else if($section instanceof ContentsSection)
		{
			if($section->displayTitle)
			{
				?>
				<h1><?php print($currentPage->title); ?></h1>
				<?php
			}
			
			if(array_key_exists($id, $currentPage->contents->sections))
			{
				require(composeContentPath($id, $currentPage->contents->sections[$id]));
			}
		}
		?>
	</div>
	<?php
}
?>
