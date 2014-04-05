<?php
/**
 * Set the global baseURL variable to the dirname of the script.
 */
function setBaseURL()
{
	global $baseURL;
	$baseURL = dirname($_SERVER["SCRIPT_NAME"]);
	if($baseURL == "/")
		$baseURL = "";
}
?>
