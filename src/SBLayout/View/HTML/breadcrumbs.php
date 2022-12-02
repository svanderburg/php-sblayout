<?php
/**
 * @file
 * @brief View-HTML-Breadcrumbs module
 * @defgroup View-HTML-Breadcrumbs
 * @{
 */

namespace SBLayout\View\HTML;
use SBLayout\Model\Route;

/**
 * Displays breadcrumbs that lead the user from an earlier page to the current page.
 *
 * @param $route Route from the entry page to current page to be displayed
 * @param $startIndex The index of the first level that needs to be displayed
 * @param $displayRoot Indicates whether to include the root page
 */
function displayBreadcrumbs(Route $route, int $startIndex = 0, bool $displayRoot = false): void
{
	?>
	<p class="breadcrumbs">
		<?php
		$first = true;
		$url = $_SERVER["SCRIPT_NAME"];

		$numOfIds = count($route->ids);

		if($displayRoot)
		{
			$currentPage = $route->pages[0];
			?>
			<a href="<?= $url ?>"<?= $numOfIds == 0 ? ' class="active"' : "" ?>><?= $currentPage->title ?></a>
			<?php
			$first = false;
		}

		for($i = 0; $i < $numOfIds; $i++)
		{
			$currentId = $route->ids[$i];
			$currentPage = $route->pages[$i + 1];

			$url = $currentPage->deriveURL($url, $currentId);

			if($i >= $startIndex)
			{
				if($first)
					$first = false;
				else
					print("&raquo; ");
				?><a href="<?= $url ?>"<?= ($i == $numOfIds - 1) ? ' class="active"' : "" ?>><?= $currentPage->title ?></a>
				<?php
			}
		}
		?>
	</p>
	<?php
}

/**
 * @}
 */
?>
