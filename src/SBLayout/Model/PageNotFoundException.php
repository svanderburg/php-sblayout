<?php
namespace SBLayout\Model;
use Exception;

/**
 * An exception that gets thrown if the path to page does not exists.
 */
class PageNotFoundException extends PageException
{
	/**
	 * Creates a new PageNotFoundException instance
	 */
	public function __construct()
	{
		parent::__construct(404, "Not Found");
	}
}
?>
