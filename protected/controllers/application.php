<?php

	class Application_Controller extends Controller {
	
		protected $view = 'layout';
	
		public function __construct () {
			$this->view = new View( $this->view );
			$this->view->title = "MkLst";
			if( isset( $_SESSION['flash'] ) ) {
				$this->view->flash = $_SESSION['flash'];
				unset( $_SESSION['flash'] );
			}
		}

		public function render () {
			try {
				return $this->view->render();
			}
			catch ( Exception $e ) {
				return $e->getMessage();
			}
		}

	}