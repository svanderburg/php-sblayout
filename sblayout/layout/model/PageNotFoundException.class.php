<?php
/**
 * An exception that gets thrown if the path to page does not exists.
 */
class PageNotFoundException extends Exception
{
	/**
	 * Creates a new PageNotFoundException instance
	 */
	public function __construct()
	{
		parent::__construct("Page not found!");
	}
}
?>
