<?php
require_once("Section.class.php");

/**
 * Represents a section displaying menu links for every sub page to which a specific page refers.
 */
class MenuSection extends Section
{
	/** The level in the page hierarchy from which menu links must be displayed */
	public $level;
	
	/**
	 * Creates a new MenuSection instance.
	 * 
	 * @param id $level The level in the page hierarchy from which menu links must be displayed
	 */
	public function __construct($level)
	{
		parent::__construct();
		$this->level = $level;
	}
}
?>
