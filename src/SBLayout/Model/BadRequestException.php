<?php
namespace SBLayout\Model;

/**
 * An exception that gets thrown if invalid parameters were provided.
 */
class BadRequestException extends PageException
{
	/**
	 * Creates a new BadRequestException instance.
	 *
	 * @param $displayMessage Error message to be displayed (optional)
	 */
	public function __construct(string $displayMessage = null)
	{
		parent::__construct(400, "Bad Request", $displayMessage);
	}
}
?>
