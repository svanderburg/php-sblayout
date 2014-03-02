<?php
if(count($_POST) > 0)
	$GLOBALS["fullname"] = $_POST["firstname"]." ".$_POST["lastname"];
?>
