<?php
namespace SBLayout\Model\Section;

/**
 * Represents a section that encapsulates other sections. This can be useful for layout purposes.
 */
class CompoundSection extends Section
{
	/** An associative array mapping ids to sections */
	public array $sections;

	/**
	 * Creates a new CompoundSection instance.
	 *
	 * @param $sections An associative array mapping ids to sections
	 */
	public function __construct(array $sections = array())
	{
		$this->sections = $sections;
	}
}
?>
