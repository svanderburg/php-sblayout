<?php
/**
 * @file
 * @brief View-HTML-SubSiteMap module
 * @defgroup View-HTML-SubSiteMap
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Page\Page;

/**
 * Displays a site map of all sub pages and transitive sub pages reachable from a given page.
 *
 * @param $page Page to display the sub pages from
 * @param $baseURL URL of the given page
 */
function displaySubSiteMap(Page $page, string $baseURL): void
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
				<a href="<?= $url ?>"><?= $subPage->title ?></a>
				<?php
				displaySubSiteMap($subPage, $url);
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
