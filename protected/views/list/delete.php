<h1>Delete List - Enter Password</h1>

<p>
	<em>Lasciate ogne speranza, voi ch'intrate.</em>
</p>

<p>
	This can not be undone.
</p>

<h2>Fine, I get it.</h2>

<form method="POST">
	<?php if( $is_protected ): ?>
	<label for="password">List Delete Password:</label>
	<input id="password" name="password" type="password" />
	<br/>
	<?php endif; ?>
	
	<label for="yesimsure">Yes, I'm sure.</label>
	<input type="checkbox" value="yes" name="yesimsure" id="yesimsure" />
	<br/>
	
	<input type="submit" value="Delete List" class="label-offset" /> or  <a href="<?php echo uri::path( 'list/view/' . $id  ); ?>">Cancel</a>
</form>
