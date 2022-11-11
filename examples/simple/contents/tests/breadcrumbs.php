<p>From level 0 with root page:</p>
<?php
\SBLayout\View\HTML\displayBreadcrumbs($GLOBALS["route"], 0, true);
?>

<p>From level 0 without root page:</p>
<?php
\SBLayout\View\HTML\displayBreadcrumbs($GLOBALS["route"], 0);
?>

<p>From level 1:</p>
<?php
\SBLayout\View\HTML\displayBreadcrumbs($GLOBALS["route"], 1);
?>
