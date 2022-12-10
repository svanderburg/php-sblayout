<?php
if($active)
{
	?>
	<a class="alternative_link active" href="<?= $url ?>"><em><?= $subPage->title ?></em></a>
	<?php
}
else
{
	?>
	<a class="alternative_link" href="<?= $url ?>"><?= $subPage->title ?></a>
	<?php
}
?>
