<?php
if(array_key_exists("fullname", $GLOBALS))
{
	?>
	<p>Hi, I believe your full name is: <?php print($GLOBALS["fullname"]); ?></p>
	<?php
} 
else
{
	?>
	<p>Please enter your names:</p>
	<form action="" method="post">
		<p>
			<label>First name:</label>
			<input type="text" name="firstname">
		</p>
		<p>
			<label>Last name:</label>
			<input type="text" name="lastname">
		</p>
		<p>
			<button type="submit">Submit</button>
		</p>
	</form>
	<?php
}
?>
