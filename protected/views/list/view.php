<h1>MkLst: <span id="name"><?php echo $alist->getName(); ?></span></h2>
<?php if( $edit ): ?>
<div class="buttons">
	<button class="add">Add Item +</button>
	<button class="save">Save</button>
	<button class="close">Close</button>
	<span class="notify"></span>
</div>
<?php endif; ?>

<ol id="list">
	<?php
		$items = unserialize( $alist->getList() );
		foreach( $items as $item ):
	?>
		<li class="list-item"><?php echo $item; ?></li>
	<?php endforeach; ?>
</ol>

<?php if( $edit ): ?>
<div class="buttons">
	<button class="add">Add Item +</button>
	<button class="save">Save</button>
	<button class="close">Close</button>
	<span class="notify"></span>
</div>

<form id="edit-form"><input type="hidden" name="list" value="" /></form>

<?php endif; ?>