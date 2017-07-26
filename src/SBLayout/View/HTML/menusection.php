<?php
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Page\ExternalPage;
use SBLayout\Model\Page\PageAlias;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Section\MenuSection;

/**
 * Displays a menu section containing links to sub pages
 * 
 * @param Application $application Encoding of the web application layout and pages
 * @param MenuSection $section Menu section to display
 */
function displayMenuSection(Application $application, MenuSection $section)
{
	if($section->level <= count($application->menuPathIds))
	{
		// Seek the page which links to their sub pages must be displayed in the menusection
		$page = $application->entryPage;
		$subPath = "";

		for($i = 0; $i < $section->level; $i++)
		{
			$currentId = $application->menuPathIds[$i];
			$subPath = $subPath.$currentId."/";
			
			if($page instanceof StaticContentPage || $page instanceof PageAlias)
				$page = $page->subPages[$currentId];
			else
				break;
		}
		
		// Display links to the sub pages
		
		if(($page instanceof StaticContentPage || $page instanceof PageAlias) && $page->subPages !== NULL)
		{
			foreach($page->subPages as $id => $subPage)
			{
				if($subPage->checkVisibility() && $subPage->checkAccessibility())
				{
					if($subPage instanceof ExternalPage)
					{
						?>
						<a href="<?php print($subPage->url); ?>"><?php print($subPage->title); ?></a>
						<?php
					}
					else
					{
						?>
						<a<?php if(count($application->menuPathIds) > $section->level && $application->menuPathIds[$section->level] == $id) { ?> class="active"<?php } ?> href="<?php print($_SERVER["SCRIPT_NAME"]); ?>/<?php print($subPath.$id); ?>"><?php print($subPage->title); ?></a>
						<?php
					}
				}
			}
		}
	}
}
?>
