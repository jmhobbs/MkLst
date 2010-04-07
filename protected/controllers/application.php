<?php

	class Application_Controller extends Controller {
	
		protected $view = 'layout';
	
		public function __construct () {
			$this->view = new View( $this->view );
			$this->view->title = "MkLst";
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