<?php
namespace SBLayout\Model\Section;

/**
 * Represents a section displaying menu links for every sub page to which a specific page refers.
 */
class MenuSection extends Section
{
	/** The level in the page hierarchy from which menu links must be displayed */
	public int $level;
	
	/**
	 * Creates a new MenuSection instance.
	 *
	 * @param $level The level in the page hierarchy from which menu links must be displayed
	 */
	public function __construct(int $level)
	{
		parent::__construct();
		$this->level = $level;
	}
}
?>
