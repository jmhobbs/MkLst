<h1>
	<span id="name"><?php echo $alist->getName(); ?></span>
	<?php if( ! $edit ): ?>
	<span class="context-link">(<a href="<?php echo uri::path( 'list/edit/' . $alist->getId() ); ?>">Edit</a>)</span>
	<?php else: ?>
	<span class="context-link">(<a href="<?php echo uri::path( 'list/view/' . $alist->getId() ); ?>">View</a>)</span>
	<?php endif; ?>
	<span class="context-link">(<a href="<?php echo uri::path( 'list/delete/' . $alist->getId() ); ?>">Delete</a>)</span>
</h1>

<?php if( $edit ): ?>
<div class="buttons">
	<button class="add">Add Item +</button>
	<button class="save">Save</button>
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
</div>

<form id="edit-form" method="POST"><input type="hidden" name="list-value" id="list-value" value="" /></form>

<?php endif; ?>