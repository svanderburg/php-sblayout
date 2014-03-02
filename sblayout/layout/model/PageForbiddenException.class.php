<?php
/**
 * An exception that gets thrown if access to a page is restricted.
 */
class PageForbiddenException extends Exception
{
	/**
	 * Creates a new PageForbiddenException instance
	 */
	public function __construct()
	{
		parent::__construct("Access denied to this page!");
	}
}  
?>
