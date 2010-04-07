var MkLst = {

	list: null,
	edit_current: null,
	sorting: false,
	saved: true,

	init:
		function () {
			window.onbeforeunload = function () {
				if( ! MkList.saved ) {
					MkLst.save_pending = true;
					return "Your list has unsaved changes!";
				}
				return true;
			}
			MkLst.list = $( "#list" );
			MkLst.list.sortable( { start: function () { MkLst.sorting = true; } } );
			$( ".add" ).click( MkLst.createListItem );
			$( ".list-item" ).click( MkLst.editListItem );
			$( ".save" ).click( MkLst.saveList );
			$( ".close" ).click( MkLst.closeList );
		},

	editListItem:
		function () {
			if( MkLst.edit_current != null ) { MkLst.edit_current.trigger( 'blur' ); }
			if( MkLst.sorting ) { MkLst.sorting = false; return; }
			MkLst.saved = false;
			MkLst.edit_current = $( '<input type="text" />' );
			li = $( this )
			MkLst.edit_current.val( li.text() )
			li.addClass( 'active' ).empty().append( MkLst.edit_current ).unbind( 'click' );
			MkLst.edit_current.focus().blur( MkLst.saveListItem ).keypress( MkLst.editKeyPress );
		},

	editKeyPress:
		function ( event ) {
			if( MkLst.edit_current == null ) { return; }
			if( event.keyCode == '13' || event.keyCode == '27' )
				MkLst.edit_current.trigger( 'blur' );
		},

	saveListItem:
		function () {
			if( MkLst.edit_current == null ) { return; }
			content = MkLst.edit_current.val()
			if( content == "" )
				MkLst.edit_current.parent().remove();
			else
				MkLst.edit_current.parent().removeClass( 'active' ).empty().text( content ).click( MkLst.editListItem );
			MkLst.edit_current = null
		},

	createListItem:
		function () {
			li = $( '<li class="list-item"></li>' ).click( MkLst.editListItem );
			MkLst.list.append( li );
			li.trigger( 'click' );
		},
		
	saveList:
		function () {
			if( MkLst.edit_current != null ) { MkLst.edit_current.trigger( 'blur' ); }
			form = $( '#edit-form' );
			list = $( '#list-value' );
			items = $( '.list-item' );
			send = '';
			for( i = 0; i < items.length; ++i )
				send = send + escape( $(items[i]).text() ) + '|';
			list.val( send );
			form.submit();
		},

	

} // MkLst

$( MkLst.init );