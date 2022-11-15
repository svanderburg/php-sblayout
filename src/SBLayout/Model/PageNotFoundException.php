<?php
namespace SBLayout\Model;

/**
 * An exception that gets thrown if the path to page does not exists.
 */
class PageNotFoundException extends PageException
{
	/**
	 * Creates a new PageNotFoundException instance
	 *
	 * @param $displayMessage Error message to be displayed (optional)
	 */
	public function __construct(string $displayMessage = null)
	{
		parent::__construct(404, "Not Found", $displayMessage);
	}
}
?>
