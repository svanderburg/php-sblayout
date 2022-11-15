<?php
namespace SBLayout\Model;

/**
 * An exception that gets thrown if access to a page is restricted.
 */
class PageForbiddenException extends PageException
{
	/**
	 * Creates a new PageForbiddenException instance
	 *
	 * @param $displayMessage Error message to be displayed (optional)
	 */
	public function __construct(string $displayMessage = null)
	{
		parent::__construct(403, "Forbidden", $displayMessage);
	}
}
?>
