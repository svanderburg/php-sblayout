<span>
	<?php
	if($active)
	{
		?>
		<a class="active" href="<?= $url ?>">
			<img src="<?= $GLOBALS["baseURL"] ?>/image/menu/go-home.png" alt="Home icon">
			<strong><?= $subPage->title ?></strong>
		</a>
		<?php
	}
	else
	{
		?>
		<a href="<?= $url ?>">
			<img src="<?= $GLOBALS["baseURL"] ?>/image/menu/go-home.png" alt="Home icon">
			<?= $subPage->title ?>
		</a>
		<?php
	}
	?>
</span>
