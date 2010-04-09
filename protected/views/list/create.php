<h1>Create New List</h1>

<p>
	All the items below are optional except for the list name.  So why fill in the others?
	<ul>
		<li>
			<b>Your Email</b><br/>
			If you set this you will get notices when things happen to your lists. You can also recover passwords or even get a list of all the lists you've made.
		</li>
		<li>
			<b>View Password</b><br/>
			Without this set, anyone can view your list (if they can find it).
		</li>
		<li>
			<b>Edit Password</b><br/>
			Without this set, anyone can edit your list (if they can find it).
		</li>
		<li>
			<b>Delete Password</b><br/>
			Without this set, anyone can permanently delete your list (if they can find it).
		</li>
	</ul>
</p>

<p>
	Please note that it's not really very "dangerous" not to set passwords on your lists unless you are publishing the link somewhere.  List ID's are very large and unpredictable, so they aren't going to be guessed somehow. Additionally, anyone who goes trolling for list ID's and guesses too many wrong gets locked out of the system. For good. Consider this your warning.
</p>

<h2>Okay? Then go ahead.</h2>

<form method="POST">
	<label for="name">List Name:</label>
	<input id="name" name="name" type="text" />
	Required
	<br/>

	<label for="email">Your Email:</label>
	<input id="email" name="email" type="text" />
	Optional
	<br/>
	
	<label for="view_password">View Password:</label>
	<input id="view_password" name="view_password" type="text" />
	Optional
	<br/>

	<label for="edit_password">Edit Password:</label>
	<input id="edit_password" name="edit_password" type="text" />
	Optional
	<br/>
	
	<label for="delete_password">Delete Password:</label>
	<input id="delete_password" name="delete_password" type="text" />
	Optional
	<br/>

	<input type="submit" value="Create List" class="label-offset" />
</form>