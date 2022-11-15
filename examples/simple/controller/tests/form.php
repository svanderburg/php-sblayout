<?php
use SBLayout\Model\BadRequestException;

if(count($_POST) > 0) // This is a POST request
{
	if(array_key_exists("firstname", $_POST) && $_POST["firstname"] != ""
		&& array_key_exists("lastname", $_POST) && $_POST["lastname"] != "")
		$GLOBALS["fullname"] = $_POST["firstname"]." ".$_POST["lastname"];
	else
		throw new BadRequestException("This page requires a firstname and lastname parameter!");
}
?>
