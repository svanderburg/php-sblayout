<?php
/**
 * @file
 * @brief View-HTML-SubSiteMap module
 * @defgroup View-HTML-SubSiteMap
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Route;
use SBLayout\Model\Page\Page;

/**
 * Displays a site map consisting of all sub pages and transitive sub pages of a given page.
 *
 * @param $route Route from the entry page to current page to be displayed
 * @param $page Page to display the sub pages from
 * @param $displayMenuItems Indicates whether to display each page link as a menu item or an ordinary link
 * @param $baseURL URL of the given page
 * @param $level Level of a menu section
 */
function displaySubSiteMap(Route $route, Page $page, bool $displayMenuItems, string $baseURL, int $level): void
{
	$iterator = $page->subPageIterator();
	$hasSubPages = false;

	foreach($iterator as $id => $subPage)
	{
		if(!$hasSubPages)
		{
			$hasSubPages = true;
			?>
			<ul>
			<?php
		}

		if($subPage->checkVisibleInMenu())
		{
			$url = $subPage->deriveURL($baseURL, $id, "&amp;");
			?>
			<li>
				<?php
				if($displayMenuItems)
				{
					$active = $subPage->checkActive($route, $id, $level);
					displayMenuItem($active, $url, $subPage);
				}
				else
					displayStandardMenuItem(false, $url, $subPage);

				displaySubSiteMap($route, $subPage, $displayMenuItems, $url, $level + 1);
				?>
			</li>
			<?php
		}
	}

	if($hasSubPages)
	{
		?>
		</ul>
		<?php
	}
}

/**
 * @}
 */
?>
