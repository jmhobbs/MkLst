<?php
	require_once( dirname( __FILE__ ) . '/application.php' );

	class List_Controller extends Application_Controller {
		
		public function __construct () {
			parent::__construct();
			if( ! isset( $_SESSION['can_edit'] ) || ! is_array( $_SESSION['can_edit'] ) )
				$_SESSION['can_edit'] = array();
			if( ! isset( $_SESSION['can_view'] ) || ! is_array( $_SESSION['can_view'] ) )
				$_SESSION['can_view'] = array();
		}
		
		public function index () { uri::redirect( '' ); }
		
		public function view ( $id, $try_edit = false ) {
			$list = Alist::constructByKey( $id );
			if ( ! is_object( $list ) ) {
				$this->view->content = new View( 'list/missing' );
				//! \todo Ban counter
				return;
			}
			
			$this->view->title = 'MkLst - ' . $list->getName();
			
			$view = new View( 'list/view' );
			
			if( $try_edit ) {
				$password = $list->getEditPassword();
				if( ! empty( $password ) && ! array_key_exists( $id, $_SESSION['can_edit'] ) ) {
					uri::redirect( 'list/password/edit/' . $id );
				}
				else {
					$this->view->edit = true;
					$view->edit = true;
					if( $_POST ) {
						$items = explode( '|', $_POST['list-value'] );
						for( $i = 1; $i < count( $items ); ++$i )
							if( empty( $items[$i] ) )
								unset( $items[$i] );
							else
								$items[$i] = urldecode( $items[$i] );
						if( empty( $items[0] ) )
							$items[0] = "You can't leave the list name empty.";
						$list->setName( $items[0] );
						unset( $items[0] );
						$list->setList( serialize( $items ) );
						if( $list->save() )
							$this->view->flash = "Saved";
						else
							$this->view->flash = "Not Saved!";
					}
				}
			}
			else {
				if( '' != $list->getViewPassword() && ! array_key_exists( $id, $_SESSION['can_view'] ) ) {
					uri::redirect( 'list/password/view/' . $id );
				}
			}
			
			$view->alist = $list;
			$this->view->content = $view;
		}
		
		public function create () {
			
			if( $_POST ) {
				if( empty( $_POST['name'] ) ) {
					$this->view->flash = "A list name is required.";
				}
				else {
					$list = new Alist();
					$list->setId( sha1( $_REQUEST['REMOTE_ADDR'] . time() . $_POST['name'] . $config['list_salt'] ) );
					$list->setName( $_POST['name'] );
					$list->setEmail( $_POST['email'] );
					$list->setViewPassword( $_POST['view_password'] );
					$list->setEditPassword( $_POST['edit_password'] );
					$list->setDeletePassword( $_POST['delete_password'] );
					$now = date('YmdHis' );
					$list->setCreated( $now );
					$list->setModified( $now );
					$list->setList( serialize( array() )  );
					if( $list->save() ) {
						$_SESSION['flash'] = 'List created!';
						$_SESSION['can_edit'][$list->getId()] = true;
						uri::redirect( 'list/edit/' . $list->getId() );
					}
					else {
						$this->view->flash = "Error saving list!";
					}
				}
			}
		
			$this->view->content = new View( 'list/create' );
		}
		
		public function edit ( $id ) {
			$this->view( $id, true );
		}
		
		public function delete ( $id ) {
			$list = Alist::constructByKey( $id );
			if ( ! is_object( $list ) ) {
				$this->view->content = new View( 'list/missing' );
				//! \todo Ban counter
				return;
			}
			
			# $_POST doesn't work here, as it can be posted but be totally empty
			if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				if( ! isset( $_POST['yesimsure'] ) or 'yes' != $_POST['yesimsure'] ) {
					$this->view->flash = 'You must confirm the deletion!';
				}
				else {
					if( '' == $list->getDeletePassword() or $_POST['password'] == $list->getDeletePassword() ) {
						if( $list->delete() ) {
							$_SESSION['flash'] = 'Poof! It\'s gone!';
							uri::redirect( '' );
						}
						else {
							$this->view->flash = 'Database error while deleting. Try again?';
						}
					}
					else {
						$this->view->flash = 'Incorrect delete password.';
					}
				}
			}
			
			$this->view->content = new View( 'list/delete' );
			$this->view->content->is_protected = ( '' != $list->getDeletePassword() );
		}
		
		public function password ( $type, $id ) {
		
			if( $type != "edit" and $type != "view" ) {
				$_SESSION['flash'] = 'Unknown password type "' . htmlspecialchars( $type ) . '".';
				uri::redirect( 'list/view/' . $id );
			}
		
			$list = Alist::constructByKey( $id );
			if ( ! is_object( $list ) ) {
				$this->view->content = new View( 'list/missing' );
				//! \todo Ban counter
				return;
			}
			
			if( 'edit' == $type ) {

				if( '' == $list->getEditPassword() or array_key_exists( $id, $_SESSION['can_edit'] ) ) {
					uri::redirect( 'list/edit/' . $id );
				}
			
				if( $_POST ) {
					if( $_POST['password'] == $list->getEditPassword() ) {
						$_SESSION['can_edit'][$list->getId()] = true;
						uri::redirect( 'list/edit/' . $id );
					}
					else {
						$this->view->flash = 'Sorry, that\'s not the password.';
						//! \todo Ban counter
					}
				}

			}
			else {

				if( '' == $list->getViewPassword() or array_key_exists( $id, $_SESSION['can_view'] ) ) {
					uri::redirect( 'list/view/' . $id );
				}
			
				if( $_POST ) {
					if( $_POST['password'] == $list->getViewPassword() ) {
						$_SESSION['can_view'][$list->getId()] = true;
						uri::redirect( 'list/view/' . $id );
					}
					else {
						$this->view->flash = 'Sorry, that\'s not the password.';
						//! \todo Ban counter
					}
				}

			}
			
			$this->view->content = new View( 'list/password' );
			$this->view->content->type = ucwords( $type );
		}
	}