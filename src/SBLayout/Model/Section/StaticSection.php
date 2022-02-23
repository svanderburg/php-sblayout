<?php
namespace SBLayout\Model\Section;

/**
 * Represents a static section that has contents that is the same across all pages.
 */
class StaticSection extends Section
{
	/** PHP file containing the actual contents of this section */
	public string $contents;
	
	/**
	 * Creates a new StaticSection instance.
	 *
	 * @param $contents PHP file containing the actual contents of this section
	 */
	public function __construct(string $contents)
	{
		parent::__construct();
		$this->contents = $contents;
	}
}
?>
