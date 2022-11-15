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

	/** Error message to be displayed (optional) */
	public ?string $displayMessage;

	/**
	 * Creates a new PageException instance.
	 *
	 * @param $statusCode HTTP status code
	 * @param $message Exception error message
	 * @param $displayMessage Error message to be displayed (optional)
	 */
	public function __construct(int $statusCode, string $message, string $displayMessage = null)
	{
		parent::__construct($message);
		$this->headerMessage = $message; // Make a copy of the message so that it can be used in the HTTP header
		$this->statusCode = $statusCode;
		$this->displayMessage = $displayMessage;
	}
}
?>
