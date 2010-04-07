<?php
	require_once( dirname( __FILE__ ) . '/application.php' );

	class List_Controller extends Application_Controller {
		
		public function index () { header( 'Location: /mklst/' ); exit(); }
		
		public function view ( $id ) {
			$this->view->content = $view = new View( 'list/view' );
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
					$list->setPassphrase( $_POST['password'] );
					$now = date('YmdHis' );
					$list->setCreated( $now );
					$list->setModified( $now );
					$list->setList( serialize( array() )  );
					if( $list->save() ) {
						$_SESSION['can_edit'] = $list->getId();
						header( 'Location: /mklst/list/edit/' . $list->getId() );
						exit();
					}
					else {
						$this->view->flash = "Error saving list!";
					}
				}
			}
		
			$this->view->content = $view = new View( 'list/create' );
		}
		
		public function edit ( $id ) {
			$this->view->content = $view = new View( 'list/edit' );
		}
	}