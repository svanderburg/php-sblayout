<?php
namespace SBLayout\Model;
use Exception;

/**
 * An exception that gets thrown when something went wrong in a page lookup.
 */
class PageException extends Exception
{
	/** HTTP status code */
	public int $statusCode;

	/** Error message */
	public string $headerMessage;

	/**
	 * Creates a new PageException instance.
	 *
	 * @param $statusCode HTTP status code
	 * @param $message Exception error message
	 */
	public function __construct(int $statusCode, string $message)
	{
		parent::__construct($message);
		$this->headerMessage = $message; // Make a copy of the message so that it can be used in the HTTP header
		$this->statusCode = $statusCode;
	}
}
?>
