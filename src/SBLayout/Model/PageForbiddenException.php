<?php
namespace SBLayout\Model;
use Exception;

/**
 * An exception that gets thrown if access to a page is restricted.
 */
class PageForbiddenException extends PageException
{
	/**
	 * Creates a new PageForbiddenException instance
	 */
	public function __construct()
	{
		parent::__construct(403, "Forbidden");
	}
}
?>
