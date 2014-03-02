<?php
require_once("ContentPage.class.php");
require_once(dirname(__FILE__)."./../PageNotFoundException.class.php");
require_once(dirname(__FILE__)."./../PageForbiddenException.class.php");

/**
 * Defines a page referring to a collection of sub pages whose links can be picked
 * from a menu section. 
 */
class StaticContentPage extends ContentPage
{
	/** An associative array mapping URL path components to sub pages */
	public $subPages;
	
	/**
	 * Creates a new ContentPage instance.
	 * 
	 * @param string $title Title of the page that is used as a label in a menu section
	 * @param Contents $contents A content object storing properties of the content sections of a page
	 * @param array $subPages An associative array mapping ids to sub pages
	 */
	public function __construct($title, Contents $contents, array $subPages = null)
	{
		parent::__construct($title, $contents);
		$this->subPages = $subPages;
	}
	
	/**
	 * @see Page::lookupSubPage()
	 */
	public function lookupSubPage(Page $entryPage, array $ids, $index = 0)
	{
		if(count($ids) == $index)
			return parent::lookupSubPage($entryPage, $ids, $index);
		else
		{
			$currentId = $ids[$index]; // Take the first id of the array
			
			if(array_key_exists($currentId, $this->subPages))
			{
				$currentSubPage = $this->subPages[$currentId];
				return $currentSubPage->lookupSubPage($entryPage, $ids, $index + 1);
				
			}
			else
				throw new PageNotFoundException(); // If the key does not exists, the sub page does not either
		}
	}
}
?>
