<?php
global $route;
$parentURL = $route->composeParentPageURL($_SERVER["SCRIPT_NAME"]);
?>
<p><a href="<?= $parentURL ?>">Go to the parent URL</a></p>
