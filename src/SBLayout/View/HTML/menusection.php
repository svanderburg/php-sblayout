<?php
/**
 * @file
 * @brief View-HTML-MenuSection module
 * @defgroup View-HTML-MenuSection
 * @{
 */
namespace SBLayout\View\HTML;
use SBLayout\Model\Application;
use SBLayout\Model\Route;
use SBLayout\Model\Page\Page;
use SBLayout\Model\Page\ExternalPage;
use SBLayout\Model\Page\PageAlias;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Section\MenuSection;

function hasSubPages(Page $page): bool
{
    return (($page instanceof StaticContentPage || $page instanceof PageAlias) && $page->subPages !== NULL);
}

/**
 * Displays a menu section containing links to sub pages
 *
 * @param $application Encoding of the web application layout and pages
 * @param $section Menu section to display
 * @param $route Route from the entry page to current page to be displayed
 */
function displayMenuSection(Application $application, MenuSection $section, Route $route): void
{
	if($section->level <= count($route->ids))
	{
		$subPath = $route->composeBaseURL($section->level);
		$rootPage = $route->pages[$section->level];
		
		// Display links to the sub pages
		
		if(hasSubPages($rootPage))
		{
			foreach($rootPage->subPages as $id => $subPage)
			{
				if($subPage->checkVisibleInMenu())
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
						<a<?php if($route->hasVisitedPageOnLevel($id, $section->level) == $id) { ?> class="active"<?php } ?> href="<?php print($_SERVER["SCRIPT_NAME"]); ?>/<?php print($subPath.$id); ?>"><?php print($subPage->title); ?></a>
						<?php
					}
				}
			}
		}
	}
}

/**
 * @}
 */
?>
