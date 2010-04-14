var MkLst = {

	list: null,
	edit_current: null,
	sorting: false,
	saved: true,

	init:
		function () {
			window.onbeforeunload = function () {
				if( ! MkLst.saved ) {
					return "Your list has unsaved changes!";
				}
			}
			MkLst.list = $( "#list" );
			MkLst.list.sortable( { start: function () { MkLst.sorting = true; } } );
			$( ".add" ).click( MkLst.createListItem );
			$( ".list-item" ).click( MkLst.editListItem );
			$( "#name" ).click( MkLst.editName );
			$( ".save" ).click( MkLst.saveList );
			$( document ).keypress( MkLst.documentKeyPress );
		},
		
	documentKeyPress:
		function ( event )  {
			if( MkLst.edit_current != null ) { return; }
			if( event.charCode == '110' ) { MkLst.createListItem(); }
		},

	editName:
		function () {
			if( MkLst.edit_current != null ) { MkLst.edit_current.trigger( 'blur' ); }
			MkLst.saved = false;
			MkLst.edit_current = $( '<input type="text" />' );
			span = $( this )
			MkLst.edit_current.val( span.text() )
			span.addClass( 'active' ).empty().append( MkLst.edit_current ).unbind( 'click' );
			MkLst.edit_current.focus().blur( MkLst.saveName ).keypress( MkLst.editKeyPress );
		},

	saveName:
		function () {
			if( MkLst.edit_current == null ) { return; }
			content = MkLst.edit_current.val()
			if( content == "" ) {
				content = "You can't leave the list name empty.";
			}
			MkLst.edit_current.parent().removeClass( 'active' ).empty().text( content ).click( MkLst.editName );
			MkLst.edit_current = null
		},

	editListItem:
		function () {
			if( MkLst.edit_current != null ) { MkLst.edit_current.trigger( 'blur' ); }
			if( MkLst.sorting ) { MkLst.sorting = false; return; }
			MkLst.saved = false;
			MkLst.edit_current = $( '<input type="text" />' );
			li = $( this )
			content = li.text()
			if( li.hasClass( 'strikethrough' ) ) {
				li.removeClass( 'strikethrough' );
				content = '-' + content;
			}
			MkLst.edit_current.val( content );
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
			else {
				if( '-' == content.substr( 0, 1 ) ) {
					content = content.substr( 1 );
					MkLst.edit_current.parent().addClass( 'strikethrough' );
				}
				MkLst.edit_current.parent().removeClass( 'active' ).empty().text( content ).click( MkLst.editListItem );
			}
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
			$( '.save,.add' ).attr( 'disabled', 'disabled' )
			if( MkLst.edit_current != null ) { MkLst.edit_current.trigger( 'blur' ); }
			MkLst.saved = true;
			form = $( '#edit-form' );
			list = $( '#list-value' );
			items = $( '.list-item' );
			send = $( '#name' ).text() + '|';
			for( i = 0; i < items.length; ++i ) {
				content = $(items[i]).text();
				if( $(items[i]).hasClass( 'strikethrough' ) )
					content = '-' + content;
				send = send + escape( content ) + '|';
			}
			list.val( send );
			form.submit();
		},

	

} // MkLst

$( MkLst.init );
