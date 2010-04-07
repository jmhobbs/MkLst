<?php

	class View {
		
		protected $_file = '';
		protected $_data = array();
		
		public function __construct ( $name ) {
			$this->_file = APP_ROOT . '/views/' . $name . '.php';
		}
		
		public function exists () {
			return file_exists( $this->_file );
		}

		public function __toString () {
			try {
				return $this->render();
			}
			catch ( Exception $e ) {
				return $e->getMessage();
			}
		}

		public function render () {
			if ( ! $this->exists() ) { throw new Exception ( 'View File Does Not Exist' ); }
			// Make variables available
			foreach( $this->_data as $key => $value )
				$$key = $value;
			// Render
			ob_start();
			include( $this->_file );
			$out = ob_get_contents();
			ob_end_clean();
			// Return
			return $out;
		}

		public function __set ( $name, $value ) {
			$this->_data[$name] = $value;
		}
		
		public function __get ( $name ) {
			if( isset( $this->_data[$name] ) )
				return $this->_data[$name];
			else
				return null;
		}
		
		public function __unset ( $name ) {
			unset( $this->_data[$name] );
		}

	}