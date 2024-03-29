<?php
namespace SBLayout\Model\Section;

/**
 * Represents a section having dynamic content determined by the selected menu link.
 */
class ContentsSection extends Section
{
	/** Indicates whether this is the main contents and the title should be displayed */
	public bool $displayTitle;
	
	/**
	 * Creates a new contents section instance.
	 *
	 * @param $displayTitle Indicates whether this is the main contents and the title should be displayed
	 */
	public function __construct(bool $displayTitle = false)
	{
		parent::__construct();
		$this->displayTitle = $displayTitle;
	}
}
