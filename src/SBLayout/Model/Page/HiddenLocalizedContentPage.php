<?php
namespace SBLayout\Model\Page;

/**
 * Defines a localized content page which link is not visible in any menu section.
 */
class HiddenLocalizedContentPage extends LocalizedContentPage
{
	/**
	 * @see LocalizedPage::__construct()
	 */
	public function __construct(array $subPages = array(), string $menuItem = null)
	{
		parent::__construct($subPages, $menuItem);
	}
	
	/**
	 * @see Page::checkVisibility()
	 */
	public function checkVisibility(): bool
	{
		return false;
	}
}
?>
