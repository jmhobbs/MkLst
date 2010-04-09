<h1><?php echo $type; ?> List - Enter Password</h1>

<form method="POST">
	<label for="password"><?php echo $type; ?>Password:</label>
	<input id="password" name="password" type="password" />
	<br/>
	
	<input type="submit" value="<?php echo $type; ?> List" class="label-offset" />
</form>