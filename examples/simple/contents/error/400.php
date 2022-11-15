<?php
if(array_key_exists("error", $GLOBALS))
{
	?>
	<p><?= $GLOBALS["error"] ?></p>
	<?php
}
else
{
	?>
	<p>The request could not be processed due to an invalid parameter!</p>
	<?php
}
?>
