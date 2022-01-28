<?php
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\Page\ContentPage;
use SBLayout\Model\Section\StaticSection;
use SBLayout\Model\Section\MenuSection;
use SBLayout\Model\Section\ContentsSection;

/**
 * Displays a section.
 *
 * @param Application $application Encoding of the web application layout and pages
 * @param string $id Id of the section to be displayed
 * @param Route $route Route from the entry page to current page to be displayed
 * @param ContentPage $currentPage Page to be currently displayed
 */
function displaySection(Application $application, $id, Route $route, ContentPage $currentPage)
{
	$section = $application->sections[$id];
	
	?>
	<div id="<?php print($id); ?>">
		<?php
		if($section instanceof StaticSection)
		{
			require(\SBLayout\View\HTML\Util\composeContentPath("sections", $section->contents));
		}
		else if($section instanceof MenuSection)
		{
			displayMenuSection($application, $section, $route);
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
				require(\SBLayout\View\HTML\Util\composeContentPath($id, $currentPage->contents->sections[$id]));
			}
		}
		?>
	</div>
	<?php
}
?>
